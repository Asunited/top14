<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\EquipRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equip
 * @ORM\Entity(repositoryClass= "EqiupRepository")
 * @ORM\Table(name="equip")
 * @ORM\Entity
 */
class Equip
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="equip", type="string", length=256, nullable=true)
     */
    private $equip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="short_name", type="string", length=256, nullable=true)
     */
    private $shortName;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="equip")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="equip")
     */
    private $players;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquip(): ?string
    {
        return $this->equip;
    }

    public function setEquip(?string $equip): self
    {
        $this->equip = $equip;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setEquip($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getEquip() === $this) {
                $article->setEquip(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->equip;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setEquip($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getEquip() === $this) {
                $player->setEquip(null);
            }
        }

        return $this;
    }
}
