<?php

/**
 * @file
 * Contains Drupal\commerce\Entity\CommerceProductType.
 */

namespace Drupal\commerce_product\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\commerce_product\CommerceProductTypeInterface;

/**
 * Defines the Commerce Product Type entity type.
 *
 * @ConfigEntityType(
 *   id = "commerce_product_type",
 *   label = @Translation("Product type"),
 *   handlers = {
 *     "list_builder" = "Drupal\commerce_product\CommerceProductTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\commerce_product\Form\CommerceProductTypeForm",
 *       "edit" = "Drupal\commerce_product\Form\CommerceProductTypeForm",
 *       "delete" = "Drupal\commerce_product\Form\CommerceProductTypeDeleteForm"
 *     }
 *   },
 *   config_prefix = "commerce_product_type",
 *   admin_permission = "administer commerce_product_type entities",
 *   bundle_of = "commerce_product",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "entity.commerce_product_type.edit_form",
 *     "delete-form" = "entity.commerce_product_type.delete_form"
 *   }
 * )
 */
class CommerceProductType extends ConfigEntityBundleBase implements CommerceProductTypeInterface {

  /**
   * The product type machine name and primary ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The product type UUID.
   *
   * @var string
   */
  protected $uuid;

  /**
   * The product type label.
   *
   * @var string
   */
  protected $label;

  /**
   * The product type description.
   *
   * @var string
   */
  protected $description;

  /**
   * The default revision setting for products of this type.
   *
   * @var bool
   */
  public $revision;

  /**
   * Indicates whether a body field should be created for this product type.
   *
   * This property affects entity creation only. It allows default configuration
   * of modules and installation profiles to specify whether a Body field should
   * be created for this bundle.
   *
   * @var bool
   */
  protected $create_body = TRUE;

  /**
   * The label to use for the body field upon entity creation.
   *
   * @var string
   */
  protected $create_body_label = 'Body';

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);

    // Create a body if the create_body property is true and we're not in
    // the syncing process.
    if ($this->get('create_body') && !$this->isSyncing()) {
      $label = $this->get('create_body_label');
      commerce_product_add_body_field($this->id, $label);
    }
   }

}
