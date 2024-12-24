<?php

namespace Drupal\Tests\tour_core\Functional\ViewsUi;

use Drupal\Tests\tour_core\Functional\TourTestBase;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\locale\StringStorageInterface;
use Drupal\locale\TranslationString;

/**
 * Tests the Views UI tour.
 *
 * @group tour
 */
class ViewsUITourTest extends TourTestBase {

  /**
   * String translation storage object.
   *
   * @var \Drupal\locale\StringStorageInterface
   */
  protected StringStorageInterface $localeStorage;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['views_ui', 'language', 'locale'];

  /**
   * {@inheritdoc}
   */
  protected array $permissions = ['administer views'];

  /**
   * Tests views_ui tour tip availability.
   */
  public function testViewsUiTourTips(): void {
    // Create a basic view that shows all content, with a page and a block
    // display.
    $view['label'] = $this->randomMachineName(16);
    $view['id'] = $this->randomMachineName(16);
    $view['page[create]'] = 1;
    $view['page[path]'] = $this->randomMachineName(16);
    $this->drupalGet('admin/structure/views/add');
    $this->submitForm($view, 'Save and edit');
    $this->assertTourTips();
  }

  /**
   * Tests views_ui tour tip availability in a different language.
   */
  public function testViewsUiTourTipsTranslated(): void {
    $langcode = 'nl';

    // Add a default locale storage for this test.
    $this->localeStorage = $this->container->get('locale.storage');

    // Add Dutch language programmatically.
    ConfigurableLanguage::createFromLangcode($langcode)->save();

    // Handler titles that need translations.
    $handler_titles = [
      'Format',
      'Fields',
      'Sort criteria',
      'Filter criteria',
    ];

    foreach ($handler_titles as $handler_title) {
      // Create source string.
      $source = $this->localeStorage->createString([
        'source' => $handler_title,
      ]);
      $source->save();
      $this->createTranslation($source, $langcode);
    }

    // Create a basic view that shows all content, with a page and a block
    // display.
    $view['label'] = $this->randomMachineName(16);
    $view['id'] = $this->randomMachineName(16);
    $view['page[create]'] = 1;
    $view['page[path]'] = $this->randomMachineName(16);
    // Load the page in Dutch.
    $this->drupalGet($langcode . '/admin/structure/views/add');
    $this->submitForm($view, 'Save and edit');
    $this->assertTourTips();
  }

  /**
   * Creates single translation for source string.
   */
  protected function createTranslation($source, $langcode): TranslationString {
    return $this->localeStorage->createTranslation([
      'lid' => $source->lid,
      'language' => $langcode,
      'translation' => $this->randomMachineName(100),
    ])->save();
  }

}
