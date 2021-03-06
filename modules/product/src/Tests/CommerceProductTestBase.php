<?php

/**
 * @file
 * Definition of \Drupal\commerce_product\Tests\CommerceProductTestBase.
 */

namespace Drupal\commerce_product\Tests;

use Drupal\simpletest\WebTestBase;
use Drupal\Component\Utility\String;

/**
 * Defines base class for shortcut test cases.
 */
abstract class CommerceProductTestBase extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('commerce', 'devel', 'commerce_product');

  /**
   * User with permission to administer products.
   */
  protected $admin_user;

  /**
   * The product to test against
   */
  protected $product;

  protected function setUp() {
    parent::setUp();
    $this->admin_user = $this->drupalCreateUser(array(
      'administer commerce_product entities',
      'create commerce_product entities',
      'delete commerce_product entities',
      'view commerce_product entities',
      'administer product types',
    ));
    $this->drupalLogin($this->admin_user);
  }

  /**
   * Creates a new entity
   *
   * @param $entityType
   * @param array $values
   *   An array of settings.
   *   Example: 'id' => 'foo'.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   */
  protected function createEntity($entityType, $values) {
    $entity = entity_create($entityType, $values);
    $status = $entity->save();

    $this->assertEqual(
      $status,
      SAVED_NEW,
      String::format('Created %label entity %type.',
        array(
          '%label' => $entity->getEntityType()->getLabel(),
          '%type' => $entity->id()
        )
      )
    );

    return $entity;
  }

}
