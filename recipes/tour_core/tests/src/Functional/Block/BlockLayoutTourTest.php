<?php

namespace Drupal\Tests\tour_core\Functional\Block;

use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests the Block Layout tour.
 *
 * @group tour
 */
class BlockLayoutTourTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected array $permissions = ['administer blocks', 'access tour'];

  /**
   * Tests Block Layout tour tip availability.
   */
  public function testBlockLayoutTourTips(): void {
    $this->drupalGet('admin/structure/block');
    $this->assertTourTips();
  }

}
