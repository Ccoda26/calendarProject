<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $EventTitle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $EventStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $EventEnd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventTitle(): ?string
    {
        return $this->EventTitle;
    }

    public function setEventTitle(string $EventTitle): static
    {
        $this->EventTitle = $EventTitle;

        return $this;
    }

    public function getEventStart(): ?\DateTimeInterface
    {
        return $this->EventStart;
    }

    public function setEventStart(\DateTimeInterface $EventStart): static
    {
        $this->EventStart = $EventStart;

        return $this;
    }

    public function getEventEnd(): ?\DateTimeInterface
    {
        return $this->EventEnd;
    }

    public function setEventEnd(\DateTimeInterface $EventEnd): static
    {
        $this->EventEnd = $EventEnd;

        return $this;
    }
}
