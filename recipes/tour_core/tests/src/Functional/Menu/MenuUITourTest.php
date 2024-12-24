<?php

namespace Drupal\Tests\tour_core\Functional\Menu;

use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests the Menu UI tour.
 *
 * @group tour
 */
class MenuUITourTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['block', 'menu_ui', 'tour'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = ['administer menu'];

  /**
   * Tests menu ui tour tip availability.
   */
  public function testMenuUiTourTips(): void {
    $this->drupalGet('admin/structure/menu');
    $this->assertTourTips();
  }

}
