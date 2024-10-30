Minimal Shortcode UI
======================
The minimum code required that allows the user configure and add an shortcode to the page contents using a popup form that is accessible through the TinyMCE content editor. Suitable for developers that wish to provide their users with an easy way of adding your custom shortcodes. The plugin provides an abstract shortcode class that can be extended and registered into the shortcode factory. Which will result in the shortcodes showing up in the dropdown menu.

![Screenshot](/screenshot-1.jpg?raw=true "Screenshot of the new button in the content editor")
![Screenshot](/screenshot-2.jpg?raw=true "Screenshot of the shortcode dialog")

----------

## Details
Version **1.2.1**  
Requires at least **WordPress 4.2**  
Tested up to **WordPress 4.4.2**

## Installation
[Download ZIP](https://github.com/Maxdw/minimal-shortcode-ui/archive/master.zip) -> WordPress -> Plugins -> Add New -> Upload Plugin -> *(select zip file)* -> Install Now

## Changelog
1.2.1 Tested WordPress 4.4.2 support
1.2.0 Changes that will give plugin/theme developers more control over their shortcodes. Added several filters and one action.
1.1.1 Fixes parsing errors when your server has ASP, eRuby or JSP enabled. The Underscore templates now use different delimiters.
1.1.0 Added new features for handling shortcode objects and rendering shortcodes
1.0.3 Fixed the example.php shortcode not displaying its image
1.0.2 Updated WordPress support for 4.3
1.0.1 Fixed jQuery UI styles not being loaded
1.0.0 Initial release

## License
The MIT License (MIT)

Copyright (c) 2015 Dutchwise V.O.F. (http://dutchwise.nl)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.