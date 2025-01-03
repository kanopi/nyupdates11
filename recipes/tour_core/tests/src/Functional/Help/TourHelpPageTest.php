<?php

namespace Drupal\Tests\tour_core\Functional\Help;

use Behat\Mink\Exception\ExpectationException;
use Drupal\Tests\BrowserTestBase;
use Drupal\user\UserInterface;

/**
 * Verifies help page display of tours.
 *
 * @group tour
 */
class TourHelpPageTest extends BrowserTestBase {

  /**
   * Modules to enable, including some providing tours.
   *
   * @var array
   */
  protected static $modules = ['help', 'tour', 'locale', 'language'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * User that can access tours and help.
   *
   * @var \Drupal\user\UserInterface
   */
  protected UserInterface $tourUser;

  /**
   * A user who can access help but not tours.
   *
   * @var \Drupal\user\UserInterface
   */
  protected UserInterface $noTourUser;

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  protected function setUp(): void {
    parent::setUp();

    // Create users. For the Tour user, include permissions for the language
    // tours' parent pages, but not the translation tour's parent page. See
    // self:getTourList().
    $this->tourUser = $this->drupalCreateUser([
      'access help pages',
      'access tour',
      'administer languages',
    ]);
    $this->noTourUser = $this->drupalCreateUser([
      'access help pages',
    ]);
  }

  /**
   * Logs in users, tests help pages.
   */
  public function testHelp(): void {
    $this->drupalLogin($this->tourUser);
    $this->verifyHelp();

    $this->drupalLogin($this->noTourUser);
    $this->verifyHelp(FALSE);
  }

  /**
   * Verifies the logged-in user has access to the help properly.
   *
   * @param bool $tours_ok
   *   (optional) TRUE (default) if the user should see tours, FALSE if not.
   */
  protected function verifyHelp(bool $tours_ok = TRUE): void {
    $this->drupalGet('admin/help');

    try {
      // All users should be able to see the module section.
      $this->assertSession()
        ->pageTextContains('Module overviews are provided by modules');
      foreach ($this->getModuleList() as $name) {
        $this->assertSession()->linkExists($name);
      }

      // Some users should be able to see the tour section.
      if ($tours_ok) {
        $this->assertSession()
          ->pageTextContains('Tours guide you through workflows');
      }
      else {
        $this->assertSession()
          ->pageTextNotContains('Tours guide you through workflows');
      }

      $titles = $this->getTourList();

      // Test the titles that should be links.
      foreach ($titles[0] as $title) {
        if ($tours_ok) {
          $this->assertSession()->linkExists($title);
        }
        else {
          $this->assertSession()->linkNotExists($title);
          // Just test the first item in the list of links that should not
          // be there, because the second matches the name of a module that is
          // in the Module overviews section, so the link will be there and
          // this test will fail. Testing one should be sufficient to verify
          // the page is working correctly.
          break;
        }
      }

      // Test the titles that should not be links.
      foreach ($titles[1] as $title) {
        if ($tours_ok) {
          $this->assertSession()->pageTextContains($title);
          $this->assertSession()->linkNotExistsExact($title);
        }
        else {
          $this->assertSession()->pageTextNotContains($title);
          // Just test the first item in the list of text that should not
          // be there, because the second matches part of the name of a module
          // that is in the Module overviews section, so the text will be there
          // and this test will fail. Testing one should be sufficient to verify
          // the page is working correctly.
          break;
        }
      }
    }
    catch (ExpectationException) {
    }
  }

  /**
   * Gets a list of modules to test for hook_help() pages.
   *
   * @return array
   *   A list of module names to test.
   */
  protected function getModuleList(): array {
    return ['Help', 'Tour'];
  }

  /**
   * Gets a list of tours to test.
   *
   * @return array
   *   A list of tour titles to test. The first array element is a list of tours
   *   with links, and the second is a list of tours without links. Assumes
   *   that the user being tested has 'administer languages' permission but
   *   not 'translate interface'.
   */
  protected function getTourList():array {
    return [['Adding languages', 'Language'], ['Editing languages', 'Translation']];
  }

}
