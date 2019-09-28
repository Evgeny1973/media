<?php

namespace App\Controller;

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
		$pagination = $this->medias->all($request->query->getInt('page', 1), self::PER_PAGE, $request->query->get('sort', 'mediaName'), $request->query->get('direction', 'desc'));
		return $this->render('medias.html.twig', ['pagination' => $pagination]);
	}

	/**
	 * @Route("/create", name="create_media", methods={"GET", "POST"})
	 */
	public function create()
	{

	}

}
