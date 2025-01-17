<?php

namespace App\Entity;

use App\Repository\JeuxEDUCRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuxEDUCRepository::class)]
class JeuxEDUC
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column]
    private ?int $age_recommende = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date_mise_ajour = null;

    /**
     * @var Collection<int, CommentairesJeux>
     */
    #[ORM\OneToMany(targetEntity: CommentairesJeux::class, mappedBy: 'jeux')]
    private Collection $commentairesJeuxes;

    public function __construct()
    {
        $this->commentairesJeuxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAgeRecommende(): ?int
    {
        return $this->age_recommende;
    }

    public function setAgeRecommende(int $age_recommende): static
    {
        $this->age_recommende = $age_recommende;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getDateMiseAjour(): ?\DateTimeInterface
    {
        return $this->Date_mise_ajour;
    }

    public function setDateMiseAjour(?\DateTimeInterface $Date_mise_ajour): static
    {
        $this->Date_mise_ajour = $Date_mise_ajour;

        return $this;
    }

    /**
     * @return Collection<int, CommentairesJeux>
     */
    public function getCommentairesJeuxes(): Collection
    {
        return $this->commentairesJeuxes;
    }

    public function addCommentairesJeux(CommentairesJeux $commentairesJeux): static
    {
        if (!$this->commentairesJeuxes->contains($commentairesJeux)) {
            $this->commentairesJeuxes->add($commentairesJeux);
            $commentairesJeux->setJeux($this);
        }

        return $this;
    }

    public function removeCommentairesJeux(CommentairesJeux $commentairesJeux): static
    {
        if ($this->commentairesJeuxes->removeElement($commentairesJeux)) {
            // set the owning side to null (unless already changed)
            if ($commentairesJeux->getJeux() === $this) {
                $commentairesJeux->setJeux(null);
            }
        }

        return $this;
    }
}
