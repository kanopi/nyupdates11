<?php

namespace Drupal\Tests\tour_core\Functional\Shortcut;

use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests the Shortcut tour.
 *
 * @group tour
 */
class ShortcutTourTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['block', 'shortcut', 'tour'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = [
    'administer blocks',
    'administer shortcuts',
    'access tour',
  ];

  /**
   * Tests Shortcut tour tip availability.
   */
  public function testShortcutTourTips(): void {
    $this->drupalGet('admin/config/user-interface/shortcut/manage/default/customize');
    $this->assertTourTips();
  }

}
