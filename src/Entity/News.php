<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, nullable: false)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private $text = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: false)]
    private ?int $status = null;

    #[ORM\Column(name: "created_at", type: "datetime_immutable", nullable: false, updatable: false)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: "updated_at", nullable: false)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(name: "accepted_by", type: 'uuid', nullable: true)]
    private ?Uuid $acceptedBy = null;

    #[ORM\Column(name: "created_by", type: 'uuid')]
    private ?Uuid $createdBy = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText($text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAcceptedBy(): ?Uuid
    {
        return $this->acceptedBy;
    }

    public function setAcceptedBy(?Uuid $acceptedBy): static
    {
        $this->acceptedBy = $acceptedBy;

        return $this;
    }

    public function getCreatedBy(): ?Uuid
    {
        return $this->createdBy;
    }

    public function setCreatedBy(Uuid $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

	public function __toString(): string
	{
		return sprintf('New element id: %s', $this->getId());
	}

}
