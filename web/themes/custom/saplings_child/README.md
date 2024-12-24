# Saplings Child Theme

This is a subtheme of the Ui Bootstrap Theme to demonstrate how some
integrations can be done like:

- CKEditor 5 stylesheets
- Negative margins in utility classes
- Background gradients

Those integrations cannot be done in the base theme because either not enabled
in Bootstrap default compiled CSS or impossible to do in a generic way.

## Usage

You can copy/paste this theme to init your own subtheme.

You will have to change:

- the machine names of files
- the machine names inside those files
- adapt path to the Bootstrap library to recompile assets
- if you are using this in a local testing install, it's likely that `fin init`
failed and did not prompt you to run `fin install-theme-tools` so make sure you
 do that!

## Setup Steps

Follow these steps to set up and customize your subtheme:

1. Navigate to your theme directory:

   ```
   cd web/themes/custom/saplings_child
   ```

2. Create all your custom SCSS files under the "assets/scss/custom" directory.

3. Run the following command to watch and compile SCSS files:

   ```
   npm run watch
   ```

   This command watches for changes in your SCSS files and automatically
   compiles them.

## Policy

There is no backward compatibility policy in this example theme.

Breaking change can happen at any moment.

## Custom Styles needed for USCF Starter Sites

There is one variable that isn't available via the UI Skins module that we
will have to update via the theme file which is --bs-nav-link-font-size
Change need which can be placed in the overrides.scss file

   ```
   .menu--banner .nav-link {
   --bs-nav-link-font-size: 0.875rem;
   }

   ```
