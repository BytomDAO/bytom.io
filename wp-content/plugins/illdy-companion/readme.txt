=== Plugin Name ===
Contributors: colorlibplugins, silkalns
Tags: woocommerce, widgets, plugin, demo, companion, home page, one page, parallax, social, portfolio, projects
Requires at least: 3.8
Tested up to: 4.7
Stable tag: trunk
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Illdy Companion is a companion plugin for Illdy WordPress theme by Colorlib.com.
== Description ==

Illdy Companion is a companion for Illdy One Page WordPress theme by Colorlib.com. This plugin won't do anything for other free or premium WordPress themes and you need to download and install <a href="https://colorlib.com/wp/themes/illdy/" target="_blank" rel="friend">Illdy</a>. If you are having problems with Illdy theme or its companion plugin the fastest way to receive help is via our theme <a href="http://colorlib.com/wp/forums" target="_blank" rel="friend">support forum</a>.

This plugin will add necessary WordPress widgets and allow to import demo content which will help you to with website setup.

While Illdy is a great one page WordPress theme it might not be for everyone therefore you might want to check other free <a href="https://colorlib.com/wp/themes/" target="_blank" rel="friend">WordPress themes</a> that are created by Colorlib.


= Plugin Options =

* Creates required WordPress widgets to be used in theme
* Creates demo(dummy) content for widgets to make them easier to use and understand how they work
* Provides an option to import demo(dummy) content.

= About Colorlib =

Colorlib is the best and by far the most popular source for free and premium WordPress themes. Our themes has been downloaded over 1,5 million times and are used by developers, webmasters and regular users all over the world. We believe in open source and that's why we have made our themes free to use for private and commercial use.

= Further Reading =

If you are new to WordPress but are dedicated to <a href="https://colorlib.com/wp/how-to-make-a-website/" target="_blank" rel="friend">make a website</a> on your own Colorlib is the right place to start. Usually the trickiest part is to choose the right hosting because all hosting providers are not equal. We have outlined the <a href="https://colorlib.com/wp/wordpress-hosting/" target="_blank" rel="friend">best WordPress hosting</a> providers and we hope you'll find them useful. We can also help with WordPress related <a href="https://colorlib.com/wp/fix-error-establishing-database-connection-wordpress/" target="_blank" rel="friend">errors</a> and problems.


== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the whole contents of the folder `illdy-companion` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress dashboard
3. Enjoy using it :)


== Screenshots ==

1. Screenshot of the Illdy companion plugin's demo content import option which you can find under Appearance - About Illdy in your WordPress dashboard.

== Frequently Asked Questions ==

= What themes this plugin supports? =

Currently it works only with Illdy theme.

= Am I obligated to use it? =

You can still use Illdy theme without this plugin but you won't be able to import demo content and use theme specific widgets that you see on front page of theme demo.

== Changelog ==

= 2.1.0 =
 * updated grunt package.json
 * Fixed #256 (videos in project section, they need an image backup)
 * Updated FancyBox to latest version
 * Added Colorlib Login Customizer as recommended plugin
 * Fixes #267 (add option to hide footer widget area || footer copyright message area)

= 2.0.3 =
 * Add TinyMCE instead of Textarea in Illdy Widgets ( https://github.com/puikinsh/illdy/issues/222 )
 * Parallax jumping on mobile ( https://github.com/puikinsh/illdy/issues/225 )

= 1.0.6 = 
* Portfolio URLs were not saving; bug fixed

= 1.0.5 =
* Improvements to support new Illdy theme version

= 1.0.4 =
* Code clean-up
* Wrapped all functions in a function_exists check just for sanity check
* All require_once functions are now using the plugin_dir_path function as a prefix. Absolute paths are preferred instead of relative ones.

= 1.0.2 =
* Updated description to reflect release of Illdy theme on WordPress.org

= 1.0.1 =
*  Small tweaks and bug fixes

= 1.0.0 =
* Initial release
