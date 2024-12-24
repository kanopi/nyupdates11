describe('Verify the Saplings Theme recipe applied properly.', () => {

  /**************************************************************
   * Module install and verification section.
   *************************************************************/
  it('Verify all modules were installed and enabled.', () => {
    // Login and visit the extend/modules page.
    cy.login()
    cy.visit('/admin/modules')
    // Verify Help module was installed and enabled.
    cy.get('#edit-modules-help-enable').should('be.checked')
    // Verify Display Suite module was installed and enabled.
    cy.get('#edit-modules-ds-enable').should('be.checked')
    // Verify Display Suite Extras module was installed and enabled.
    cy.get('#edit-modules-ds-extras-enable').should('be.checked')
    // Verify Layout Options module was installed and enabled.
    cy.get('#edit-modules-layout-options-enable').should('be.checked')
    // Verify UI Patterns module was installed and enabled.
    cy.get('#edit-modules-ui-patterns-enable').should('be.checked')
    // Verify UI Patterns Display Suite module was installed and enabled.
    cy.get('#edit-modules-ui-patterns-ds-enable').should('be.checked')
    // Verify UI Patterns Layouts module was installed and enabled.
    cy.get('#edit-modules-ui-patterns-layouts-enable').should('be.checked')
    // Verify UI Patterns Library module was installed and enabled.
    cy.get('#edit-modules-ui-patterns-library-enable').should('be.checked')
    // Verify UI Patterns Field Formatters module was installed and enabled.
    cy.get('#edit-modules-ui-patterns-field-formatters-enable').should('be.checked')
    // Verify UI Patterns Settings module was installed and enabled.
    cy.get('#edit-modules-ui-patterns-settings-enable').should('be.checked')
    // Verify UI Skins module was installed and enabled.
    cy.get('#edit-modules-ui-skins-enable').should('be.checked')
    // Verify UI Styles module was installed and enabled.
    cy.get('#edit-modules-ui-styles-enable').should('be.checked')
  })

  /**************************************************************
   * Configuration actions verification section.
   *************************************************************/
  it('Verify Display Suite settings.', () => {
    cy.login()
    cy.visit('/admin/structure/ds/settings')
    cy.get('.vertical-tabs__menu').contains('Field Templates').click()
    cy.get('#edit-fs1-field-template').should('be.checked')
    cy.get('#edit-fs1-ft-expert-prefix-suffix-textarea').should('not.be.checked')
    cy.get('#edit-fs1-ft-layout-builder').should('not.be.checked')
    cy.get('#edit-fs1-ft-default').should('have.value', 'default')
    cy.get('.vertical-tabs__menu').contains('Extra fields').click()
    cy.get('#edit-fs2-fields-extra').should('not.be.checked')
    cy.get('.vertical-tabs__menu').contains('Other').click()
    cy.get('#edit-fs3-use-field-names').should('be.checked')
    cy.get('#edit-fs3-exclude-layout-builder-blocks-on-block-field').should('not.be.checked')
    cy.get('#edit-fs3-exclude-ds-layout-layout-builder').should('not.be.checked')
    cy.get('#edit-fs3-field-permissions').should('not.be.checked')
    cy.get('#edit-fs3-region-to-block').should('not.be.checked')
    cy.get('#edit-fs3-switch-field').should('not.be.checked')
    cy.get('#edit-fs3-hidden-region').should('not.be.checked')
    cy.get('#edit-fs3-override-node-revision').should('not.be.checked')
    cy.get('.vertical-tabs__menu').contains('BC settings').click()
    cy.get('#edit-fs4-ft-bc').should('not.be.checked')
    cy.get('#edit-fs4-layout-icon-image-bc').should('not.be.checked')
    cy.get('#edit-fs4-layout-suggestion-bc').should('not.be.checked')
    cy.get('#edit-fs4-ft-default-bc').should('not.be.checked')
  })

  /**************************************************************
   * Theme configuration verification section.
   *************************************************************/
  it('Verify appearance/themes settings.', () => {
    cy.login()
    cy.visit('/admin/appearance')
    cy.get('.theme-default').find('#saplings-child-label').should('include.text', 'Saplings Child                     (default theme)')
    cy.get('#edit-admin-theme--2').should('have.value', 'gin')
    cy.get('#edit-use-admin-theme').should('be.checked')
    cy.visit('/admin/appearance/settings/saplings_child')
    cy.get('#edit-toggle-node-user-picture').should('not.be.checked')
    cy.get('#edit-toggle-comment-user-picture').should('be.checked')
    cy.get('#edit-toggle-comment-user-verification').should('be.checked')
    cy.get('#edit-toggle-favicon').should('be.checked')
    cy.get('#edit-default-logo').should('be.checked')
    cy.get('#edit-default-favicon').should('be.checked')
  })
  it('Verify Saplings Child Block layout regions exist.', () => {
    cy.login()
    cy.visit('/admin/structure/block')
    cy.get('#block-admin-display-form').find('.region-title-navigation').should('include.text', 'Navigation')
    cy.get('#block-admin-display-form').find('.region-title-navigation_collapsible').should('include.text', 'Navigation (Collapsible)')
    cy.get('#block-admin-display-form').find('.region-title-header').should('include.text', 'Top Bar')
    cy.get('#block-admin-display-form').find('.region-title-highlighted').should('include.text', 'Highlighted')
    cy.get('#block-admin-display-form').find('.region-title-help').should('include.text', 'Help')
    cy.get('#block-admin-display-form').find('.region-title-content').should('include.text', 'Content')
    cy.get('#block-admin-display-form').find('.region-title-sidebar_first').should('include.text', 'Primary')
    cy.get('#block-admin-display-form').find('.region-title-sidebar_second').should('include.text', 'Secondary')
    cy.get('#block-admin-display-form').find('.region-title-footer').should('include.text', 'Footer')
  })
  it('Verify UI Suite Bootstrap settings.', () => {
    cy.login()
    cy.visit('/admin/appearance/css-variables/ui_suite_bootstrap')
    cy.get('.vertical-tabs__menu').contains('Body').click()
    cy.get('.vertical-tabs__menu').contains('Box shadow').click()
    cy.get('.vertical-tabs__menu').contains('Colors').click()
    cy.get('.vertical-tabs__menu').contains('Colors: Background color subtle').click()
    cy.get('.vertical-tabs__menu').contains('Colors: Border subtle').click()
    cy.get('.vertical-tabs__menu').contains('Colors: RGB').click()
    cy.get('.vertical-tabs__menu').contains('Colors: Text emphasis').click()
    cy.get('.vertical-tabs__menu').contains('Component: Accordion').click()
    cy.get('.vertical-tabs__menu').contains('Component: Alert').click()
    cy.get('.vertical-tabs__menu').contains('Component: Badge').click()
    cy.get('.vertical-tabs__menu').contains('Component: Breadcrumb').click()
    cy.get('.vertical-tabs__menu').contains('Component: Button').click()
    cy.get('.vertical-tabs__menu').contains('Component: Card').click()
    cy.get('.vertical-tabs__menu').contains('Component: Close button').click()
    cy.get('.vertical-tabs__menu').contains('Component: Dropdown').click()
    cy.get('.vertical-tabs__menu').contains('Component: List group').click()
    cy.get('.vertical-tabs__menu').contains('Component: Modal').click()
    cy.get('.vertical-tabs__menu').contains('Component: Modal (backdrop)').click()
    cy.get('.vertical-tabs__menu').contains('Component: Navbar').click()
    cy.get('.vertical-tabs__menu').contains('Component: Nav link').click()
    cy.get('.vertical-tabs__menu').contains('Component: Nav pills').click()
    cy.get('.vertical-tabs__menu').contains('Component: Nav tabs').click()
    cy.get('.vertical-tabs__menu').contains('Component: Nav underline').click()
    cy.get('.vertical-tabs__menu').contains('Component: Offcanvas').click()
    cy.get('.vertical-tabs__menu').contains('Component: Pagination').click()
    cy.get('.vertical-tabs__menu').contains('Component: Popover').click()
    cy.get('.vertical-tabs__menu').contains('Component: Progress').click()
    cy.get('.vertical-tabs__menu').contains('Component: Spinner').click()
    cy.get('.vertical-tabs__menu').contains('Component: Toast').click()
    cy.get('.vertical-tabs__menu').contains('Component: Tooltip').click()
    cy.get('.vertical-tabs__menu').contains('Content: Images').click()
    cy.get('.vertical-tabs__menu').contains('Element').click()
    cy.get('.vertical-tabs__menu').contains('Fonts').click()
    cy.get('.vertical-tabs__menu').contains('Form').click()
    cy.get('.vertical-tabs__menu').contains('Helper: Focus ring').click()
    cy.get('.vertical-tabs__menu').contains('Helper: Icon link').click()
    cy.get('.vertical-tabs__menu').contains('Helper: Ratio').click()
    cy.get('.vertical-tabs__menu').contains('Utility: Background').click()
    cy.get('.vertical-tabs__menu').contains('Utility: Border').click()
    cy.get('.vertical-tabs__menu').contains('Utility: Link').click()
  })
})
