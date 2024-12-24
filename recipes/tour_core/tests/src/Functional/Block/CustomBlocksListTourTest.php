<?php

namespace Drupal\Tests\tour_core\Functional\Block;

use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests the Custom Blocks List tour.
 *
 * @group tour
 */
class CustomBlocksListTourTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['block_content'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = [
    'administer block types',
    'administer blocks',
    'access tour',
  ];

  /**
   * Tests Custom Blocks List tour tip availability.
   */
  public function testCustomBlocksListTourTips(): void {
    $this->drupalGet('admin/structure/block-content');
    $this->assertTourTips();
  }

}
