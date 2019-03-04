<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpelerRepository")
 */
class Speler
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roepnaam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tussenvoegsel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $achternaam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\School", inversedBy="spelers")
     */
    private $schoolID;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Toernooi", inversedBy="spelers")
     */
    private $toernooiID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Wedstrijd", mappedBy="speler1ID")
     */
    private $wedstrijds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Wedstrijd", mappedBy="speler2ID")
     */
    private $speler2ID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Wedstrijd", mappedBy="WinnaarID")
     */
    private $winnaarID;

    public function __construct()
    {
        $this->toernooiID = new ArrayCollection();
        $this->wedstrijds = new ArrayCollection();
        $this->speler2ID = new ArrayCollection();
        $this->winnaarID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoepnaam(): ?string
    {
        return $this->roepnaam;
    }

    public function setRoepnaam(string $roepnaam): self
    {
        $this->roepnaam = $roepnaam;

        return $this;
    }

    public function getTussenvoegsel(): ?string
    {
        return $this->tussenvoegsel;
    }

    public function setTussenvoegsel(?string $tussenvoegsel): self
    {
        $this->tussenvoegsel = $tussenvoegsel;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getSchoolID(): ?School
    {
        return $this->schoolID;
    }

    public function setSchoolID(?School $schoolID): self
    {
        $this->schoolID = $schoolID;

        return $this;
    }

    /**
     * @return Collection|Toernooi[]
     */
    public function getToernooiID(): Collection
    {
        return $this->toernooiID;
    }

    public function addToernooiID(Toernooi $toernooiID): self
    {
        if (!$this->toernooiID->contains($toernooiID)) {
            $this->toernooiID[] = $toernooiID;
        }

        return $this;
    }

    public function removeToernooiID(Toernooi $toernooiID): self
    {
        if ($this->toernooiID->contains($toernooiID)) {
            $this->toernooiID->removeElement($toernooiID);
        }

        return $this;
    }

    /**
     * @return Collection|Wedstrijd[]
     */
    public function getWedstrijds(): Collection
    {
        return $this->wedstrijds;
    }

    public function addWedstrijd(Wedstrijd $wedstrijd): self
    {
        if (!$this->wedstrijds->contains($wedstrijd)) {
            $this->wedstrijds[] = $wedstrijd;
            $wedstrijd->setSpeler1ID($this);
        }

        return $this;
    }

    public function removeWedstrijd(Wedstrijd $wedstrijd): self
    {
        if ($this->wedstrijds->contains($wedstrijd)) {
            $this->wedstrijds->removeElement($wedstrijd);
            // set the owning side to null (unless already changed)
            if ($wedstrijd->getSpeler1ID() === $this) {
                $wedstrijd->setSpeler1ID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wedstrijd[]
     */
    public function getSpeler2ID(): Collection
    {
        return $this->speler2ID;
    }

    public function addSpeler2ID(Wedstrijd $speler2ID): self
    {
        if (!$this->speler2ID->contains($speler2ID)) {
            $this->speler2ID[] = $speler2ID;
            $speler2ID->setSpeler2ID($this);
        }

        return $this;
    }

    public function removeSpeler2ID(Wedstrijd $speler2ID): self
    {
        if ($this->speler2ID->contains($speler2ID)) {
            $this->speler2ID->removeElement($speler2ID);
            // set the owning side to null (unless already changed)
            if ($speler2ID->getSpeler2ID() === $this) {
                $speler2ID->setSpeler2ID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wedstrijd[]
     */
    public function getWinnaarID(): Collection
    {
        return $this->winnaarID;
    }

    public function addWinnaarID(Wedstrijd $winnaarID): self
    {
        if (!$this->winnaarID->contains($winnaarID)) {
            $this->winnaarID[] = $winnaarID;
            $winnaarID->setWinnaarID($this);
        }

        return $this;
    }

    public function removeWinnaarID(Wedstrijd $winnaarID): self
    {
        if ($this->winnaarID->contains($winnaarID)) {
            $this->winnaarID->removeElement($winnaarID);
            // set the owning side to null (unless already changed)
            if ($winnaarID->getWinnaarID() === $this) {
                $winnaarID->setWinnaarID(null);
            }
        }

        return $this;
    }
}
