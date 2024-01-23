<?php

namespace App\Services;

use App\Entity\News;
use App\Entity\NewsFactory;
use App\Repository\NewsRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;


/*
 * * @method News[]    findAll()
 */
final class NewsService
{
	public function __construct(
		private readonly NewsRepositoryInterface $newsRepository,
		private EntityManagerInterface $entityManager
	)
	{}

	/**
	 * @return News[]
	 */
	public function getAll(): array
	{
		return $this->newsRepository->findAll();
	}

	/**
	 * @return string
	 */
	public function createNew(string $title, string $text, string $createdBy): string
	{
		$entity = NewsFactory::create(
			title: $title,
			text: $text,
			createdBy: Uuid::fromString($createdBy)
		);

		$this->entityManager->persist($entity);
		$this->entityManager->flush();

		return $entity->getId();
	}
}