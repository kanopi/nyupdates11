<?php

namespace Drupal\Tests\tour_core\Functional\Content;

use Drupal\Tests\tour_core\Functional\TourTestBase;
use Drupal\user\Entity\Role;
use Drupal\user\RoleInterface;

/**
 * Tests the Node form tour.
 *
 * @group tour
 */
class NodeFormTourTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['node'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = [
    'access administration pages',
    'administer content types',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Create Basic page node type.
    $this->drupalCreateContentType(['type' => 'page', 'name' => 'Basic page']);

    Role::load(RoleInterface::AUTHENTICATED_ID)
      ->grantPermission('create page content')
      ->grantPermission('edit own page content')
      ->save();
  }

  /**
   * Tests Node edit form tour tip availability.
   */
  public function testNodeEditFormTourTips(): void {
    $this->drupalGet('node/add/page');
    $this->assertTourTips();

    $node = $this->drupalCreateNode(['type' => 'page']);

    $this->drupalGet("node/{$node->id()}/edit");
    $this->assertTourTips();
  }

}
