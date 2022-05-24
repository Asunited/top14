<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *@ORM\Entity(repositoryClass=PlayerRepository::class)
 * @ORM\Table(name="player")
 * @ORM\Entity
 */
class Player
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
     * @ORM\Column(name="name", type="string", length=24, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="year_old", type="string", length=8, nullable=true)
     */
    private $yearOld;

    /**
     * @ORM\ManyToOne(targetEntity=Equip::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getYearOld(): ?string
    {
        return $this->yearOld;
    }

    public function setYearOld(?string $yearOld): self
    {
        $this->yearOld = $yearOld;

        return $this;
    }



    public function getEquip(): ?Equip
    {
        return $this->equip;
    }

    public function setEquip(?Equip $equip): self
    {
        $this->equip = $equip;

        return $this;
    }
}
