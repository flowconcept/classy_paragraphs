<?php

/**
 * @file
 * Hooks provided by the Classy paragraphs module.
 */

use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Alters the list of options to be displayed for a field.
 *
 * @param array $options
 *   The array of options for the field, as returned by
 *   \Drupal\Core\TypedData\OptionsProviderInterface::getSettableOptions(). An
 *   empty option (_none) might have been added, depending on the field
 *   properties.
 *
 * @param field_definition: The field definition
 *     (\Drupal\Core\Field\FieldDefinitionInterface).
 * @param entity: The entity object the field is attached to
 *     (\Drupal\Core\Entity\EntityInterface).
 *
 * @ingroup hooks
 * @see classy_paragraphs_allowed_values()
 */
function hook_classy_paragraphs_options_alter(&$options, $definition, $entity) {
  // Check if this is the field we want to change.
  if ($definition->getName() == 'my_classy_paragraphs_field') {
    // Do something
  }
}

/**
 * Provide the allowed values for a 'classy_paragraphs' field.
 * This hook can be used by themes.
 * @see hook_views_pre_render()
 *
 * @param \Drupal\Core\Field\FieldStorageDefinitionInterface $definition
 *   The field storage definition.
 * @param \Drupal\Core\Entity\FieldableEntityInterface|null $entity
 *   (optional) The entity context if known, or NULL if the allowed values are
 *   being collected without the context of a specific entity.
 *
 * @return array
 *   The array of allowed values. Keys of the array are the raw stored values
 *   (number or text), values of the array are the display labels. If $entity
 *   is NULL, you should return the list of all the possible allowed values in
 *   any context so that other code (e.g. Views filters) can support the allowed
 *   values for all possible entities and bundles.
 *
 * @ingroup hooks
 * @see classy_paragraphs_allowed_values()
 */
function hook_classy_paragraphs_options(FieldStorageDefinitionInterface $definition, FieldableEntityInterface $entity = NULL) {
  if (isset($entity) && ($entity->bundle() == 'not_a_programmer')) {
    $values = array(
      1 => 'One',
      2 => 'Two',
    );
  }
  else {
    $values = array(
      'Group 1' => array(
        0 => 'Zero',
        1 => 'One',
      ),
      'Group 2' => array(
        2 => 'Two',
      ),
    );
  }

  return $values;
}
