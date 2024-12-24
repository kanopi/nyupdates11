<?php

namespace Drupal\Tests\system\Functional;

use Drupal\Tests\dblog\Functional\FakeLogEntries;
use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests tour functionality.
 *
 * @group tour
 */
class SystemPageTourTests extends TourTestBase {

  use FakeLogEntries;

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['system', 'dblog'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = ['administer themes', 'administer modules', 'access site reports'];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->generateLogEntries(1);
  }

  /**
   * Test tips appear for various system pages.
   */
  public function testSystemRelatedPages(): void {
    $this->testAppearanceTour();
    $this->testExtendTour();
    $this->testDblogTour();
  }

  /**
   * Tests appearance tour tip availability.
   */
  protected function testAppearanceTour(): void {
    $this->drupalGet('admin/appearance');
    $this->assertTourTips();
  }

  /**
   * Tests modules extend tour tip availability.
   */
  protected function testExtendTour(): void {
    $this->drupalGet('admin/modules');
    $this->assertTourTips();
  }

  /**
   * Tests modules extend tour tip availability.
   */
  protected function testDblogTour(): void {
    $this->drupalGet('admin/reports/dblog');
    $this->assertTourTips();
  }

}
