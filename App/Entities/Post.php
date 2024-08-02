<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
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
  #[ORM\Column(type: 'string', length: 255)]
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
   * @var int
   */
  #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'posts_created')]
  private Admin $admin;

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
}