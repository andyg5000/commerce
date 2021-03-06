<?php

/**
 * @file
 * Contains Drupal\commerce\CommerceStoreTypeInterface.
 */

namespace Drupal\commerce;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a store type entity.
 */
interface CommerceStoreTypeInterface extends ConfigEntityInterface {

  /**
   * Returns the store type description.
   *
   * @return string
   *   The store type description.
   */
  public function getDescription();

  /**
   * Sets the description of the store type.
   *
   * @param string $description
   *   The new description.
   *
   * @return $this
   */
  public function setDescription($description);

}
