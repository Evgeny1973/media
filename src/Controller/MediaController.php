<?php

namespace App\Controller;

use App\Model\Media\Entity\Media;
use App\Model\Media\UseCase\Create;
use App\Model\Media\UseCase\Delete;
use App\Model\Media\UseCase\Update;
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
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function all(Request $request)
	{
		$pagination = $this->medias->all($request->query->getInt('page', 1), self::PER_PAGE,
			$request->query->get('sort', 'mediaName'), $request->query->get('direction', 'desc'));
		return $this->render('medias.html.twig', ['pagination' => $pagination]);
	}

	/**
	 * @Route("/create", name="create_media", methods={"GET", "POST"})
	 * @param Request $request
	 * @param Create\Handler $handler
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
	 * @param Media $media
	 * @param Delete\Handler $handler
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function delete(Media $media, Delete\Handler $handler)
	{
		$command = new Delete\Command($media);
		$handler->handle($command);
		return $this->redirectToRoute('all_medias');
	}

	/**
	 * @Route("/medias/{media}/update", name="update_media", methods={"GET", "POST"})
	 * @param Media $media
	 * @param Update\Handler $handler
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function update(Media $media, Update\Handler $handler, Request $request)
	{
		$command = new Update\Command($media);
		$form = $this->createForm(Update\Form::class, $command);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			try {
				$handler->handle($command);
				return $this->redirectToRoute('all_medias');
			} catch (\DomainException $e) {
				return $this->redirectToRoute('all_medias');
			}
		}
		return $this->render('update.html.twig', ['form' => $form->createView()]);
	}
}
