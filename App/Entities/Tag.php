<?php

namespace App\Entities;

/**
 * Class Tag
 * 
 * Represents a tag in the system.
 * This entity is mapped to the "tags" table in the database.
 * 
 * @package App\Entities
 * 
 */
class Tag
{
  private int|null $id = null;
  private string $name;
  private string $slug;
}