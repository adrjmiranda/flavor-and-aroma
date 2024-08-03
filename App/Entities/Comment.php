<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use DateTime;

/**
 * Class Comment
 * 
 * Represents a comment in the system.
 * This entity is mapped to the "comments" table in the database.
 * 
 * @package App\Entities
 * 
 */
#[ORM\Entity]
#[ORM\Table(name: 'comments')]
class Comment
{
  /**
   * The unique identifier for the comment.
   * @var int|null
   */
  #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
  private int|null $id = null;

  /**
   * Post containing the comment.
   * @var Post
   */
  #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comments')]
  private Post $post;

  /**
   * User who made the comment.
   * @var User
   */
  #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
  private User $user;

  /**
   * Comment text.
   * @var string
   */
  #[ORM\Column(type: 'string', columnDefinition: 'TEXT NOT NULL')]
  private string $content;

  /**
   * Comment creation date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $created_at;

  /**
   * Comment update date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $updated_at;

  /**
   * Returns comment id.
   * @return int|null
   */
  public function getId(): int|null
  {
    return $this->id;
  }

  /**
   * Returns comment user.
   * @return \App\Entities\User
   */
  public function getUser(): User
  {
    return $this->user;
  }

  /**
   * Set comment user.
   * @param \App\Entities\User $user
   * @return void
   */
  public function setUser(User $user): void
  {
    $this->user = $user;
  }

  /**
   * Returns comment post.
   * @return \App\Entities\Post
   */
  public function getPost(): Post
  {
    return $this->post;
  }

  /**
   * Set comment post.
   * @param \App\Entities\Post $post
   * @return void
   */
  public function setPost(Post $post): void
  {
    $this->post = $post;
  }

  /**
   * Returns comment content.
   * @return string
   */
  public function getContent(): string
  {
    return $this->content;
  }

  /**
   * Set comment content.
   * @param string $content
   * @return void
   */
  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  /**
   * Sets the creation and update date of the comment.
   * @return void
   */
  #[ORM\PrePersist]
  public function onPrePersist(): void
  {
    $this->created_at = new DateTime();
    $this->updated_at = new DateTime();
  }

  /**
   * Comment update date.
   * @return void
   */
  #[ORM\PreUpdate]
  public function onPreUpdate(): void
  {
    $this->updated_at = new DateTime();
  }
}