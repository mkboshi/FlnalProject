<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity=PubHouse::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pub_house;

    /**
     * @ORM\OneToMany(targetEntity=Exemplar::class, mappedBy="book")
     */
    private $exemplar;

    /**
     * @ORM\ManyToMany(targetEntity=Catalog::class, mappedBy="book_id")
     */
    private $catalogs;

    public function __construct()
    {
        $this->exemplar = new ArrayCollection();
        $this->catalogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(?\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPubHouse(): ?PubHouse
    {
        return $this->pub_house;
    }

    public function getpub_house(): ?PubHouse
    {
        return $this->pub_house;
    }

    public function setPubHouse(?PubHouse $pub_house): self
    {
        $this->pub_house = $pub_house;

        return $this;
    }

    /**
     * @return Collection<int, Exemplar>
     */
    public function getExemplar(): Collection
    {
        return $this->exemplar;
    }

    public function addExemplar(Exemplar $exemplar): self
    {
        if (!$this->exemplar->contains($exemplar)) {
            $this->exemplar[] = $exemplar;
            $exemplar->setBook($this);
        }

        return $this;
    }

    public function removeExemplar(Exemplar $exemplar): self
    {
        if ($this->exemplar->removeElement($exemplar)) {
            // set the owning side to null (unless already changed)
            if ($exemplar->getBook() === $this) {
                $exemplar->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Catalog>
     */
    public function getCatalogs(): Collection
    {
        return $this->catalogs;
    }

    public function addCatalog(Catalog $catalog): self
    {
        if (!$this->catalogs->contains($catalog)) {
            $this->catalogs[] = $catalog;
            $catalog->addBookId($this);
        }

        return $this;
    }

    public function removeCatalog(Catalog $catalog): self
    {
        if ($this->catalogs->removeElement($catalog)) {
            $catalog->removeBookId($this);
        }

        return $this;
    }

    public function __toString(){

        return strval($this->getTitle());
    }



}