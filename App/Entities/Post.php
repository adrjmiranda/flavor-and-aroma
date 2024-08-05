<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;

/**
 * Class Post
 * 
 * Represents a post in the system.
 * This entity is mapped to the "posts" table in the database.
 * 
 * @package App\Entities
 * 
 */
#[ORM\Entity]
#[ORM\Table(name: 'posts')]
class Post
{
  /**
   * The unique identifier for the post.
   * @var int|null
   */
  #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
  private int|null $id = null;

  /**
   * The title of the post.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255)]
  private string $title;

  /**
   * The slug of the post.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255, unique: true)]
  private string $slug;

  /**
   * The body of the post
   * @var string
   */
  #[ORM\Column(type: 'string', columnDefinition: 'LONGTEXT NOT NULL')]
  private string $body;

  /**
   * The image name of the post
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255)]
  private string $image_name;

  /**
   * The id of the post creator
   * @var \App\Entities\Admin
   */
  #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'posts_created')]
  private Admin $admin;

  /**
   * Post comments.
   * @var Collection
   */
  #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post')]
  private Collection $comments;

  /**
   * Post creation date
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $created_at;

  /**
   * Post update date
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $updated_at;

  /**
   * List of post categories.
   * @var Collection
   */
  #[ORM\ManyToMany(targetEntity: Category::class)]
  private Collection $categories;

  /**
   * List of post tags.
   * @var Collection
   */
  #[ORM\ManyToMany(targetEntity: Tag::class)]
  private Collection $tags;

  public function __construct()
  {
    $this->categories = new ArrayCollection();
    $this->comments = new ArrayCollection();
    $this->tags = new ArrayCollection();
  }

  /**
   * Returns post id.
   * @return int|null
   */
  public function getId(): int|null
  {
    return $this->id;
  }

  /**
   * Returns post title.
   * @return string
   */
  public function getTitle(): string
  {
    return $this->title;
  }

  /**
   * Set post title.
   * @param string $title
   * @return void
   */
  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  /**
   * Returns post slug.
   * @return string
   */
  public function getSlug(): string
  {
    return $this->slug;
  }

  /**
   * Set post slug.
   * @param string $slug
   * @return void
   */
  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  /**
   * Returns post body.
   * @return string
   */
  public function getBody(): string
  {
    return $this->body;
  }

  /**
   * Set post body.
   * @param string $body
   * @return void
   */
  public function setBody(string $body): void
  {
    $this->body = $body;
  }

  /**
   * Returns post image name.
   * @return string
   */
  public function getImageName(): string
  {
    return $this->image_name;
  }

  /**
   * Set post image name.
   * @param string $image_name
   * @return void
   */
  public function setImageName(string $image_name): void
  {
    $this->image_name = $image_name;
  }

  /**
   * Returns the creator of the post.
   * @return \App\Entities\Admin
   */
  public function getAdmin(): Admin
  {
    return $this->admin;
  }

  /**
   * Defines the post creator.
   * @param \App\Entities\Admin $admin
   * @return void
   */
  public function setAdmin(Admin $admin): void
  {
    $this->admin = $admin;
  }

  /**
   * Sets update and creation dates.
   * @return void
   */
  #[ORM\PrePersist]
  public function onPrePersist(): void
  {
    $this->created_at = new DateTime();
    $this->updated_at = new DateTime();
  }

  /**
   * Update the update date with each update.
   * @return void
   */
  #[ORM\PreUpdate]
  public function onPreUpdate(): void
  {
    $this->updated_at = new DateTime();
  }

  /**
   * Add a category to the post's category list.
   * @param \App\Entities\Category $category
   * @return void
   */
  public function addCategory(Category $category): void
  {
    $this->categories[] = $category;
  }

  /**
   * Add a category to the post's tag list.
   * @param \App\Entities\Tag $tag
   * @return void
   */
  public function addTag(Tag $tag): void
  {
    $this->tags[] = $tag;
  }

  /**
   * Add a comment to the post.
   * @param \App\Entities\Comment $comment
   * @return void
   */
  public function addComment(Comment $comment): void
  {
    $this->comments[] = $comment;
  }
}