<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
/**
 * Class User
 * 
 * Represents a user in the system.
 * This entity is mapped to the "users" table in the database.
 * 
 * @package App\Entities
 * 
 */
class User
{
  /**
   * The unique identifier for the user.
   * @var int|null
   */
  #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
  private int|null $id = null;

  /**
   * The name of the user.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255)]
  private string $name;

  /**
   * The email of the user.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255, unique: true)]
  private string $email;

  /**
   * The password hash of the user.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255)]
  private string $password;

  /**
   * User creation date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $created_at;

  /**
   * User update date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $updated_at;

  /**
   * Post comments.
   * @var Collection
   */
  #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post')]
  private Collection $comments;

  public function __construct()
  {
    $this->comments = new ArrayCollection();
  }

  /**
   * Returns user id.
   * @return int|null
   */
  public function getId(): int|null
  {
    return $this->id;
  }

  /**
   * Returns user name.
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set user name.
   * @param string $name
   * @return void
   */
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  /**
   * Returns user email.
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * Set user email.
   * @param string $email
   * @return void
   */
  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  /**
   * Returns user password hash.
   * @return string
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  /**
   * Set user password hash.
   * @param string $password
   * @return void
   */
  public function setPassword(string $password): void
  {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
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
   * Adds a new user-made comment.
   * @param \App\Entities\Comment $comment
   * @return void
   */
  public function addComment(Comment $comment): void
  {
    $this->comments[] = $comment;
  }
}