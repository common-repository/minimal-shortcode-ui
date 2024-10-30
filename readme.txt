=== Plugin Name ===
Contributors: maxdw
Donate link: http://dutchwise.nl/
Tags: shortcode,shortcodes,ui,developers,multilingual
Requires at least: 4.2
Tested up to: 4.4.2
Stable tag: 1.2.1
License: MIT
License URI: http://www.opensource.org/licenses/mit-license.php

Allows theme/plugin developers to make their custom shortcodes easily accessible to their users through a modal dialog from the content editor.

== Description ==

The minimum code required that allows the user configure and add an shortcode to the page contents using a popup form that is accessible through the TinyMCE content editor. 

Suitable for developers that wish to provide their users with an easy way of adding your custom shortcodes. The plugin provides an abstract shortcode class that can be extended and registered into the shortcode factory. Which will result in the shortcodes showing up in the dropdown menu.


== Installation ==

1. Download ZIP file
2. Unzip contents to the /wp-content/plugins/ directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. If developing shortcodes for your theme or plugin, have a look at example.php

== Frequently Asked Questions ==

= Is this plugin multilingual? =

All text is run through translation functions, but no translation files are provided out of the box.

= How do I start adding shortcodes to my content? =

When you activate the plugin a new button will be available in the 'Visual' mode of the content editor. This will open up a dialog that will allow you to select and customize available shortcodes.

= How do I add my own custom shortcodes? =

Make sure the plugin is active and have a look at example.php in the plugin's root directory.

== Screenshots ==

1. screenshot-1.jpg
2. screenshot-2.jpg

== Upgrade Notice ==

-

== Changelog ==

= 1.2.1 =
* Tested WordPress 4.4.2 support

= 1.2.0 =
* Changes that will give plugin/theme developers more control over their shortcodes.
* Added filter sui_shortcode_get
* Added filter sui_shortcode_array
* Added filter sui_shortcodes_before_remove
* Added filter sui_shortcodes_before_unregister
* Added filter sui_shortcodes_before_add
* Added filter sui_shortcodes_before_register
* Added filter sui_shortcodes_get
* Added action sui_shortcodes_before_registration
* Added filter sui_shortcodes_registration

= 1.1.1 =
* Fixes parsing errors when your server has ASP, eRuby or JSP enabled. The Underscore templates now use different delimiters.

= 1.1.0 =
* Added Shortcodes::exists to check for Shortcode existence by tag name or class name
* Added Shortcodes::get to return the registered Shortcode object by tag name or class name
* Added the ability to define field labels by using the Shortcode's object _labels property or the 'label' key when defining a field using the Shortcode _setSchemaAttribute method
* Added the ability to render the shortcode itself rather than the result of the shortcode, use $shortcode->getShortcode($attributes, $content) to get the source shortcode

= 1.0.3 =
* Fixed the example.php shortcode not displaying its image

= 1.0.2 =
* Updated WordPress support for 4.3

= 1.0.1 =
* Fixes jQuery UI styles not being loaded for the dialog

= 1.0.0 =
* Initial version