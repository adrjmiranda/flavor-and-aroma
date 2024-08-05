<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * 
 * Represents a category in the system.
 * This entity is mapped to the "categories" table in the database.
 * 
 * @package App\Entities
 * 
 */
#[ORM\Entity]
#[ORM\Table(name: 'categories')]
class Category
{
  /**
   * The unique identifier for the category.
   * @var int|null
   */
  #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
  private int|null $id = null;

  /**
   * The name of the category.
   * @var string
   */
  #[ORM\Column(type: 'string')]
  private string $name;

  /**
   * The slug of the category
   * @var string
   */
  #[ORM\Column(type: 'string', unique: true)]
  private string $slug;

  /**
   * Category creation date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $created_at;

  /**
   * Category update date.
   * @var DateTime
   */
  #[ORM\Column(type: 'datetime')]
  private DateTime $updated_at;

  /**
   * Returns category id.
   * @return int|null
   */
  public function getId(): int|null
  {
    return $this->id;
  }

  /**
   * Returns category name
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set category name.
   * @param string $name
   * @return void
   */
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  /**
   * Returns category slug.
   * @return string
   */
  public function getSlug(): string
  {
    return $this->slug;
  }

  /**
   * Set category slug.
   * @param string $slug
   * @return void
   */
  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  /**
   * Defines category creation and update dates
   * @return void
   */
  #[ORM\PrePersist]
  public function onPrePersist(): void
  {
    $this->created_at = new DateTime();
    $this->updated_at = new DateTime();
  }

  /**
   * Update update date.
   * @return void
   */
  #[ORM\PreUpdate]
  public function onPreUpdate(): void
  {
    $this->updated_at = new DateTime();
  }
}