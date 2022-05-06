<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $PathImg;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="photos")
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPathImg()
    {
        return $this->PathImg;
    }

    public function setPathImg($PathImg): self
    {
        $this->PathImg = $PathImg;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
