<?php

namespace Drupal\Tests\tour_core\Functional\Content;

use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests the Content Admin view.
 *
 * @group tour
 */
class ContentAdminViewTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['node', 'views'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = [
    'access administration pages',
    'access content overview',
  ];

  /**
   * Tests Admin content tour tip availability.
   */
  public function testAdminContentViewTips(): void {
    $this->drupalGet('admin/content');
    $this->assertTourTips();
  }

}
