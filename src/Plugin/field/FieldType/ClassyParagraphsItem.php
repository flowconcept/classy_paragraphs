<?php
/**
 * @file
 * Contains \Drupal\classy_paragraphs\Plugin\Field\FieldType\ClassyParagraphsItem.
 */

namespace Drupal\classy_paragraphs\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Session\AccountInterface;
use Drupal\options\Plugin\Field\FieldType\ListItemBase;

/**
 * Plugin implementation of the 'classy_paragraphs' field type.
 *
 * @FieldType (
 *   id = "classy_paragraphs",
 *   label = @Translation("Classy paragraphs"),
 *   category = @Translation("Paragraphs"),
 *   description = @Translation("This field stores a selected class."),
 *   default_widget = "options_select",
 *   default_formatter = "list_default",
 * )
 */
class ClassyParagraphsItem extends ListItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $columns = array(
      'value' => array(
        'type' => 'varchar',
        'length' => 256,
        'not null' => FALSE,
      ),
    );
    return array(
      'columns' => $columns,
      'indexes' => array(
        'value' => array('value'),
      ),
    );
  }

  /**
   * {@inheritdoc}y
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Classy paragraph class'))
      ->setDescription(t('This field stores a selected class.'));
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return !isset($value) || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  protected function allowedValuesDescription() {
    return 'Enter some classes.';
  }

  /**
   * {@inheritdoc}
   */
  public function getSettableOptions(AccountInterface $account = NULL) {
    $allowed_options = classy_paragraphs_allowed_values($this->getFieldDefinition()->getFieldStorageDefinition(), $this->getEntity());
    return $allowed_options;
  }
}
?>