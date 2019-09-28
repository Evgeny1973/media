<?php

namespace App\Controller;

use App\Model\Media\Entity\Media;
use App\Model\Media\UseCase\Create;
use App\Model\Media\UseCase\Delete;
use App\Model\Media\Entity\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
	private const PER_PAGE = 8;
	/**
	 * @var MediaRepository
	 */
	protected $medias;

	public function __construct(MediaRepository $medias)
	{
		$this->medias = $medias;
	}

	/**
	 * @Route("/", name="all_medias", methods={"GET"})
	 */
	public function all(Request $request)
	{
		$pagination = $this->medias->all($request->query->getInt('page', 1), self::PER_PAGE,
			$request->query->get('sort', 'mediaName'), $request->query->get('direction', 'desc'));
		return $this->render('medias.html.twig', ['pagination' => $pagination]);
	}

	/**
	 * @Route("/create", name="create_media", methods={"GET", "POST"})
	 */
	public function create(Request $request, Create\Handler $handler)
	{
		$command = new Create\Command;
		$form = $this->createForm(Create\Form::class, $command);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			try {
				$handler->handle($command);
				return $this->redirectToRoute('all_medias');
			} catch (\DomainException $e) {
				return $this->redirectToRoute('all_medias');
			}
		}
		return $this->render('create.html.twig', ['form' => $form->createView()]);
	}

	/**
	 * @Route("/medias/{media}/delete", name="delete_media", methods={"GET"})
	 */
	public function delete(Media $media, Delete\Handler $handler)
	{
		$command = new Delete\Command($media);
		$handler->handle($command);
		return $this->redirectToRoute('all_medias');
	}
}
