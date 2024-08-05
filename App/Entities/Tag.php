<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Tag
 * 
 * Represents a tag in the system.
 * This entity is mapped to the "tags" table in the database.
 * 
 * @package App\Entities
 * 
 */
#[ORM\Entity]
#[ORM\Table(name: 'tags')]
class Tag
{
  /**
   * The unique identifier for the tag.
   * @var int|null
   */
  #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
  private int|null $id = null;

  /**
   * The name of the tag.
   * @var string
   */
  #[ORM\Column(type: 'string')]
  private string $name;

  /**
   * The slug of the tag.
   * @var string
   */
  #[ORM\Column(type: 'string', unique: true)]
  private string $slug;
  private Post $post;

  /**
   * Tag creation date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $created_at;

  /**
   * Tag update date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $updated_at;

  /**
   * Returns tag id.
   * @return int|null
   */
  public function getId(): int|null
  {
    return $this->id;
  }

  /**
   * Returns tag name.
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set tag name.
   * @param string $name
   * @return void
   */
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  /**
   * Returns tag slug.
   * @return string
   */
  public function getSlug(): string
  {
    return $this->slug;
  }

  /**
   * Set tag slug.
   * @param string $slug
   * @return void
   */
  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  /**
   * Defines tag creation and update date.
   * @return void
   */
  #[ORM\PrePersist]
  public function onPrePersist(): void
  {
    $this->created_at = new DateTime();
    $this->updated_at = new DateTime();
  }

  /**
   * Sets the tag update date.
   * @return void
   */
  #[ORM\PreUpdate]
  public function onPreUpdate(): void
  {
    $this->updated_at = new DateTime();
  }
}