<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;

/**
 * Class Admin
 * 
 * Represents a admin in the system.
 * This entity is mapped to the "admin" table in the database.
 * 
 * @package App\Entities
 * 
 */
#[ORM\Entity]
#[ORM\Table(name: 'admin')]
class Admin
{
  /**
   * The unique identifier for the admin.
   * @var int|null
   */
  #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
  private int|null $id = null;

  /**
   * The name of the admin.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255)]
  private string $name;

  /**
   * The email of the admin.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255, unique: true)]
  private string $email;

  /**
   * The password hash of the admin.
   * @var string
   */
  #[ORM\Column(type: 'string', length: 255)]
  private string $password;

  /**
   * Admin creation date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $created_at;

  /**
   * Admin update date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $updated_at;

  /**
   * List of posts created
   * @var Collection
   */
  #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'admin')]
  private Collection $posts_created;

  public function __construct()
  {
    $this->posts_created = new ArrayCollection();
  }

  /**
   * Returns admin id.
   * @return int|null
   */
  public function getId(): int|null
  {
    return $this->id;
  }

  /**
   * Returns admin name.
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set admin name.
   * @param string $name
   * @return void
   */
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  /**
   * Returns admin email.
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * Set admin email.
   * @param string $email
   * @return void
   */
  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  /**
   * Returns admin password hash.
   * @return string
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  /**
   * Set admin password hash.
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
   * Add a post to the list of posts already created.
   * @param \App\Entities\Post $post
   * @return void
   */
  public function addCreatedPost(Post $post): void
  {
    $this->posts_created[] = $post;
  }
}