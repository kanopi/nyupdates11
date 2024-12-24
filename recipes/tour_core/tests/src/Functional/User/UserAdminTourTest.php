<?php

namespace Drupal\Tests\user\Functional;

use Drupal\Tests\tour_core\Functional\TourTestBase;

/**
 * Tests tour functionality for user pages.
 *
 * @group tour
 */
class UserAdminTourTest extends TourTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['block', 'tour', 'user'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = ['administer users'];

  /**
   * Test tips appear for various user pages.
   */
  public function testUserRelatedPages(): void {
    $this->testAdminPeopleTour();
    $this->testUserCreateTourTips();
    $this->testUserEditTourTips();
  }

  /**
   * Tests user tour tip availability.
   */
  protected function testAdminPeopleTour(): void {
    $this->drupalGet('admin/people');
    $this->assertTourTips();
  }

  /**
   * Tests User Create tour tip availability.
   */
  protected function testUserCreateTourTips(): void {
    $this->drupalGet('admin/people/create');
    $this->assertTourTips();
  }

  /**
   * Tests User Edit tour tip availability.
   */
  protected function testUserEditTourTips(): void {
    $uid = $this->adminUser->id();
    $this->drupalGet('user/' . $uid . '/edit');
    $this->assertTourTips();
  }

}
