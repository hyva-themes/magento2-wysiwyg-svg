# Hyvä Themes - CMS Wysiwyg fixes

[![Hyvä Themes](https://hyva.io/media/wysiwyg/logo-compact.png)](https://hyva.io/)

Allow SVG images to be used in CMS blocks and pages via the TinyMCE Wysiwyg Editor.

## hyva-themes/magento2-cms-wysiwyg

![Supported Magento Versions][ico-compatibility]

Compatible with Magento 2.4.0 and higher.

## Installation

1. Install via composer
    ```
    composer config repositories.hyva-themes/magento2-cms-wysiwyg git git@gitlab.hyva.io:hyva-themes/magento2-cms-wysiwyg.git
    composer require hyva-themes/magento2-cms-wysiwyg
    ```
2. Enable module
    ```
    bin/magento setup:upgrade
    ```

## Usage

No configuration is required or available.

To use, switch a CMS Wysiwyg Editor to the HTML view and past the SVG where you want it.
Then switch back to the regular view and save the CMS block or page.

## Credits

Thanks to Pekka M. for the help figuring out how to customize the editor.

## License

Hyvä Themes - https://hyva.io

Copyright © Hyvä Themes B.V 2020-present. All rights reserved.

The BSD-3-Clause License. Please see [License File](LICENSE.txt) for more information.

[ico-compatibility]: https://img.shields.io/badge/magento-%202.4-brightgreen.svg?logo=magento&longCache=true&style=flat-square
