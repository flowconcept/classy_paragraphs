<?php

/**
 * @file
 * Hooks provided by the Classy paragraphs module.
 */

use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Provide the allowed values for a 'classy_paragraphs' field.
 *
 * @param \Drupal\Core\Field\FieldStorageDefinitionInterface $definition
 *   The field storage definition.
 * @param \Drupal\Core\Entity\FieldableEntityInterface|null $entity
 *   (optional) The entity context if known, or NULL if the allowed values are
 *   being collected without the context of a specific entity.
 *
 * @return array
 *   The array of allowed values. Keys of the array are the raw stored values
 *   (class names), values of the array are the display labels. If $entity is
 *   NULL, you should return the list of all the possible allowed values in any
 *   context so that other code can support the allowed values for all possible
 *   entities and bundles.
 *
 * @ingroup hooks
 * @see classy_paragraphs_allowed_values()
 */
function hook_classy_paragraphs_options(FieldStorageDefinitionInterface $definition, FieldableEntityInterface $entity = NULL) {
  $values = array(
    'Group 1' => array(
      'some_class' => t('Foo'),
    ),
    'other_class' => t('Bar'),
  );

  if (isset($entity) && ($entity->bundle() == 'page')) {
    $values['special_class'] = t('Baz');
  }

  return $values;
}

/**
 * Alters the list of options to be displayed for a field.
 *
 * @param array $options
 *   The array of options for the field, as returned by
 *   \Drupal\Core\TypedData\OptionsProviderInterface::getSettableOptions(). An
 *   empty option (_none) might have been added, depending on the field
 *   properties.
 * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
 *   The field definition.
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   The entity object the field is attached to.
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
