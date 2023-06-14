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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $googleId;

    /**
     * @ORM\Column(type="smallint")
     */
    private $isbn10;

    /**
     * @ORM\Column(type="smallint")
     */
    private $isbn13;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $page_count;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $publisher;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $published_at;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="book_id")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Readings::class, mappedBy="book_id")
     */
    private $readings;

    /**
     * @ORM\OneToMany(targetEntity=Crush::class, mappedBy="book_id")
     */
    private $crushes;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="books")
     */
    private $genre;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->readings = new ArrayCollection();
        $this->crushes = new ArrayCollection();
        $this->genre = new ArrayCollection();
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

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(string $googleId): self
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getIsbn10(): ?int
    {
        return $this->isbn10;
    }

    public function setIsbn10(int $isbn10): self
    {
        $this->isbn10 = $isbn10;

        return $this;
    }

    public function getIsbn13(): ?int
    {
        return $this->isbn13;
    }

    public function setIsbn13(int $isbn13): self
    {
        $this->isbn13 = $isbn13;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getPageCount(): ?int
    {
        return $this->page_count;
    }

    public function setPageCount(int $page_count): self
    {
        $this->page_count = $page_count;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeImmutable $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setBookId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBookId() === $this) {
                $comment->setBookId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Readings>
     */
    public function getReadings(): Collection
    {
        return $this->readings;
    }

    public function addReading(Readings $reading): self
    {
        if (!$this->readings->contains($reading)) {
            $this->readings[] = $reading;
            $reading->setBookId($this);
        }

        return $this;
    }

    public function removeReading(Readings $reading): self
    {
        if ($this->readings->removeElement($reading)) {
            // set the owning side to null (unless already changed)
            if ($reading->getBookId() === $this) {
                $reading->setBookId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Crush>
     */
    public function getCrushes(): Collection
    {
        return $this->crushes;
    }

    public function addCrush(Crush $crush): self
    {
        if (!$this->crushes->contains($crush)) {
            $this->crushes[] = $crush;
            $crush->setBookId($this);
        }

        return $this;
    }

    public function removeCrush(Crush $crush): self
    {
        if ($this->crushes->removeElement($crush)) {
            // set the owning side to null (unless already changed)
            if ($crush->getBookId() === $this) {
                $crush->setBookId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }
}
