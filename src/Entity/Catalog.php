<?php

namespace App\Entity;

use App\Repository\CatalogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatalogRepository::class)
 */
class Catalog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name_catalog;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="catalogs")
     */
    private $book_id;

    public function __construct()
    {
        $this->book_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCatalog(): ?string
    {
        return $this->name_catalog;
    }

    public function setNameCatalog(string $name_catalog): self
    {
        $this->name_catalog = $name_catalog;

        return $this;
    }



    public function getbook_id(): Collection
    {
        return $this->book_id;
    }

    public function addBookId(Book $bookId): self
    {
        if (!$this->book_id->contains($bookId)) {
            $this->book_id[] = $bookId;
        }

        return $this;
    }

    public function removeBookId(Book $bookId): self
    {
        $this->book_id->removeElement($bookId);

        return $this;
    }

    public function __toString(){

        return strval( $this->getNameCatalog());
    }



    /**
     * @return Collection<int, Book>
     */
    public function getBookId(): Collection
    {
        return $this->book_id;
    }

}