<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use App\Repository\PostRepository;
use App\Entity\Comment;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Defines the properties of the Post entity to represent the blog posts.
 *
 * See https://symfony.com/doc/current/doctrine.html#creating-an-entity-class
 *
 * Tip: if you have an existing database, you can generate these entity class automatically.
 * See https://symfony.com/doc/current/doctrine/reverse_engineering.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
#[ORM\Entity(repositoryClass: PostRepository::class)]
#[UniqueEntity(fields: ['slug'], message: 'post.slug_unique', errorPath: 'title')]
#[Vich\Uploadable]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $slug = null;

    #[ORM\Column]
    private \DateTimeImmutable $publishedAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $lang = null;

    /**
     * @var Collection<int, Description>
     */
    #[ORM\OneToMany(targetEntity: Description::class, mappedBy: 'post')]
    private Collection $description;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail = null;
    #[Vich\UploadableField(mapping:"post_thumbnail", fileNameProperty:"thumbnail")]
    #[Assert\Image(mimeTypes: ["image/jpeg", "image/jpg","image/png"], allowLandscape: true, allowPortrait: true,)]
    private $thumbnailFile ;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private DateTimeImmutable $updateAt;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post')]
    private Collection $comments;

    public function __construct()
    {
        $this->publishedAt = new \DateTimeImmutable();
        $this->description = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    { 
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getPublishedAt(): \DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @return Collection<int, Description>
     */
    public function getDescription(): Collection
    {
        return $this->description;
    }

    public function addDescription(Description $description): static
    {
        if (!$this->description->contains($description)) {
            $this->description->add($description);
            $description->setPost($this);
        }

        return $this;
    }

    public function removeDescription(Description $description): static
    {
        if ($this->description->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getPost() === $this) {
                $description->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getThumbnailFile(): ?File
    {
        return $this->thumbnailFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $thumbnailFile
     */
    public function setThumbnailFile(?File $thumbnailFile= null):void
    {
        $this->thumbnailFile = $thumbnailFile;

        if (null !== $thumbnailFile) {
            $this->updateAt = new \DateTimeImmutable('now');
        }
        //$this->imageFile = null;
    }
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
    public function getUpdateAt(): ?DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        $this->comments->removeElement($comment);

        return $this;
    }

    public function __toString(): string
    {
        return $this->slug!=null?$this->slug:$this->id;
    }
}



