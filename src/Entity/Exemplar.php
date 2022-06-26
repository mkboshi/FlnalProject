<?php

namespace App\Entity;

use App\Repository\ExemplarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExemplarRepository::class)
 */
class Exemplar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_issue;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_returne;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="exemplar")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity=Reader::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_reader;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateIssue(): ?\DateTimeInterface
    {
        return $this->date_issue;
    }

    public function setDateIssue(\DateTimeInterface $date_issue): self
    {
        $this->date_issue = $date_issue;

        return $this;
    }

    public function getDateReturne(): ?\DateTimeInterface
    {
        return $this->date_returne;
    }

    public function setDateReturne(?\DateTimeInterface $date_returne): self
    {
        $this->date_returne = $date_returne;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getIdReader(): ?Reader
    {
        return $this->id_reader;
    }
    public function getid_reader(): ?Reader
    {
        return $this->id_reader;
    }

    public function setIdReader(?Reader $id_reader): self
    {
        $this->id_reader = $id_reader;

        return $this;
    }

    public function __toString(){

        return strval( $this->getId());
    }

}