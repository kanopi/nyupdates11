<?php

namespace Drupal\Tests\tour_core\Functional\FieldUI;

use Drupal\TestTools\Random;
use Drupal\Tests\tour_core\Functional\TourTestBase;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\user\UserInterface;

/**
 * Tests the Field UI tour.
 *
 * @group tour
 */
class FieldUITourTest extends TourTestBase {

  /**
   * An admin user with administrative permissions.
   *
   * @var \Drupal\user\UserInterface
   */
  protected UserInterface $adminUser;

  /**
   * The generated type we are using for testing.
   *
   * @var string
   */
  protected string $typeName;

  /**
   * Modules to install.
   *
   * @var array
   */
  protected static $modules = ['node', 'field', 'field_ui', 'text'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = ['administer node fields'];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    // Create content type, with underscores.
    $type_name = strtolower(Random::machineName(8)) . '_test';
    $this->drupalCreateContentType(['name' => $type_name, 'type' => $type_name]);

    $machine_name = 'field_' . strtolower(Random::machineName());
    // Create a field instance, so we can check the add existing field tip.
    $field_storage = FieldStorageConfig::create([
      'field_name' => $machine_name,
      'entity_type' => 'node',
      'type' => 'text',
      'settings' => [
        'max_length' => 255,
      ],
    ]);
    $field_storage->save();

    $instance = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => $type_name,
    ]);
    $instance->save();

    // Create a second content type.
    $type_name = strtolower(Random::machineName(8)) . '_test';
    $type = $this->drupalCreateContentType([
      'name' => $type_name,
      'type' => $type_name,
    ]);
    $this->typeName = $type->label();
  }

  /**
   * Tests field_ui tour tip availability.
   */
  public function testFieldUiTourTips(): void {
    $this->drupalGet('/admin/structure/types/manage/' . $this->typeName . '/fields');
    $this->assertTourTips();
  }

}
