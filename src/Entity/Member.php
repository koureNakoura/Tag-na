<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $quality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faceBookProfile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tweeterProfile = null;

    #[ORM\Column(length: 255)]
    private ?string $full_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkedInProfile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFullName();
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(string $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getFaceBookProfile(): ?string
    {
        return $this->faceBookProfile;
    }

    public function setFaceBookProfile(?string $faceBookProfile): self
    {
        $this->faceBookProfile = $faceBookProfile;

        return $this;
    }

    public function getTweeterProfile(): ?string
    {
        return $this->tweeterProfile;
    }

    public function setTweeterProfile(?string $tweeterProfile): self
    {
        $this->tweeterProfile = $tweeterProfile;

        return $this;
    }
    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
   
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLinkedInProfile(): ?string
    {
        return $this->linkedInProfile;
    }

    public function setLinkedInProfile(?string $linkedInProfile): self
    {
        $this->linkedInProfile = $linkedInProfile;

        return $this;
    }
}
