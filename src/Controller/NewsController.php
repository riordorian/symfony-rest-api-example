<?php

namespace App\Controller;

use App\Dto\NewsDto;
use App\Entity\News;
use App\Repository\NewsRepositoryInterface;
use App\Services\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/news', name: 'app_news')]
class NewsController extends AbstractController
{
	public function __construct(
	 	private NewsService $newsService,
		private SerializerInterface $serializer
	)
	{

	}

	#[Route(path: "", name: "all", methods: ["GET"])]
	function all(): Response
	{
		$data = $this->newsService->getAll();
		return $this->json($data);
	}

	#[Route(path: "", name: "create", methods: ["POST"])]
	function create(Request $request): Response
	{
		$data = $request->getContent();
		$requestData = $this->serializer->deserialize($data, NewsDto::class, 'json');

		try {
			$entity = $this->newsService->createNew(
				$requestData->title,
				$requestData->text,
				$requestData->author,
			);

			return $this->json([], 201, ["Location" => "/posts/" . $entity]);
		} catch (\Exception $e) {
			return $this->json(['error' => $e->getMessage()]);
		}
	}
}
