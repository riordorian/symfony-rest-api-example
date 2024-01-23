<?php

namespace App\Entity;

use Symfony\Component\Uid\NilUuid;
use Symfony\Component\Uid\Uuid;

class NewsFactory
{
	static function create(string $title, string $text, Uuid $createdBy, int $status = 1): News
	{
		$new = new News();
		$new->setId(Uuid::v4());
		$new->setTitle($title);
		$new->setText($text);
		$new->setStatus($status);
		$new->setCreatedBy($createdBy);
		$new->setAcceptedBy(new NilUuid());
		$new->setCreatedAt(new \DateTimeImmutable());
		$new->setUpdatedAt(new \DateTimeImmutable());

		return $new;
	}
}