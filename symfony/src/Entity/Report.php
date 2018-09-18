<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReportRepository")
 */
class Report
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $Partner;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Month;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Hours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Minute;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Material;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Visits;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Studies;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPartner(): ?string
    {
        return $this->Partner;
    }

    public function setPartner(?string $Partner): self
    {
        $this->Partner = $Partner;

        return $this;
    }

    public function getMonth(): ?\DateTimeInterface
    {
        return $this->Month;
    }

    public function setMonth(?\DateTimeInterface $Month): self
    {
        $this->Month = $Month;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->Hours;
    }

    public function setHours(?int $Hours): self
    {
        $this->Hours = $Hours;

        return $this;
    }

    public function getMinute(): ?int
    {
        return $this->Minute;
    }

    public function setMinute(?int $Minute): self
    {
        $this->Minute = $Minute;

        return $this;
    }

    public function getMaterial(): ?int
    {
        return $this->Material;
    }

    public function setMaterial(int $Material): self
    {
        $this->Material = $Material;

        return $this;
    }

    public function getVisits(): ?int
    {
        return $this->Visits;
    }

    public function setVisits(?int $Visits): self
    {
        $this->Visits = $Visits;

        return $this;
    }

    public function getStudies(): ?int
    {
        return $this->Studies;
    }

    public function setStudies(?int $Studies): self
    {
        $this->Studies = $Studies;

        return $this;
    }
}
