# Tour Core Recipe

This recipe creates a default set of Tours around Drupal core basic functionality.

>The Tour module provides users with guided tours of the site interface. Each tour consists
of several tips that highlight elements of the user interface, guide the user through a
workflow, or explain key concepts of the website.

## Table of contents

- Requirements
- Installation
- Configuration
- Maintainers

## Requirements

* Drupal 10.3 or higher.
* Recipe will install all required modules. Only contrib module is [Tour](https://www.drupal.org/project/tour).

## Installation

To apply recipe:
`php core/scripts/drupal recipe ../recipes/[recipe-name] -v`

## Configuration

After installing users with 'administer tour' permission can edit, disable, add, remove, etc tours
from `admin/config/user-interface/tour`

## Maintainers

- Stephen Mustgrave [smustgrave](https://www.drupal.org/u/smustgrave)
