# Hyvä Themes - SVG support for the Magento CMS Wysiwyg Editor

[![Hyvä Themes](https://hyva.io/media/wysiwyg/logo-compact.png)](https://hyva.io/)

Allow SVG images to be used in CMS blocks and pages via the TinyMCE Wysiwyg Editor.

## hyva-themes/magento2-wysiwyg-svg

![Supported Magento Versions][ico-compatibility]

Compatible with Magento 2.4.0 and higher.

## Installation

1. Install via composer
    ```
    composer require hyva-themes/magento2-wysiwyg-svg
    ```
2. Enable module
    ```
    bin/magento setup:upgrade
    ```

## Usage

No configuration is required or available.

To use, switch a CMS Wysiwyg Editor to the HTML view and past the SVG where you want it.
Then switch back to the regular view and save the CMS block or page.

Note: this module can be used with any Magento theme - there is no hard requirement to use a Hyvä frontend theme.

## Credits

Thanks to Pekka M. for the help figuring out how to customize the editor.

### License

This package is licensed under the **Open Software License (OSL 3.0)**.

* **Copyright:** Copyright © 2020-present Hyvä Themes. All rights reserved.
* **License Text (OSL 3.0):** The full text of the OSL 3.0 license can be found in the `LICENSE.txt` file within this package, and is also available online at [http://opensource.org/licenses/osl-3.0.php](http://opensource.org/licenses/osl-3.0.php).

[ico-compatibility]: https://img.shields.io/badge/magento-%202.4-brightgreen.svg?logo=magento&longCache=true&style=flat-square
