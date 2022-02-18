=== Plugin Name ===
Contributors: bortpress
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=cactus%40cactuscomputers%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: Posts, Gallery, Masonry, Image, Post Gallery, Thumbnail Gallery, Featured Image Gallery
Requires at least: 3.9.1
Tested up to: 4.5.3
Stable tag: 1.1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a customizable gallery of your post featured images in either a grid or a masonry layout.

== Description ==
= Note =

Cactus Masonry Classic has been superseded by [Cactus Masonry Plus](http://cactus.cloud/masonryplus).  Cactus Masonry Plus is also free and available in the WordPress plugin repository.

= What is Cactus Masonry Classic? =

Cactus Masonry Classic (which we will call CMC from now on), is a WordPress plugin designed to display a gallery of post and/or page featured images that can be filtered, sorted, and treated as hyperlinks.

In other words, a CMC gallery will display a list of all matching posts which link back to their permalinks when clicked! This functionality would be perfect for an art or photo gallery where further information needs to be displayed on each item. Of course, you can choose where each picture links, whether back to the original image (at a size of your choosing), the original post, a Lightbox styled gallery, or nowhere at all.

As CMC essentially searches your WordPress site for posts, you can specify which category (or categories) of post to display, and sort those posts by date, comment count, author, randomly, and more!

You can also specify the layout options for the pictures. By default, the pictures are positioned in a masonry styled layout, where the images are slotted into each other like irregular bricks in an old stone wall. However, you can force the plugin to restrict or constrain the heights or widths of the images to create a tidy and whitespace free gallery of images. Check out the [Cactus Masonry Classic Home Page](http://cactuscomputers.com.au/masonry) for an example where the width has been constrained to 33.3%.

You may also specify how the images glow when the user’s mouse hovers overhead, whether the images have borders, and how much (if any) spacing should exist between each image.

The Cactus Masonry Classic plugin provides a versatile WordPress plugin that allows you to display your posts by their thumbnail in a clean and visually pleasing format. 

= Can I See it In Action? =

Yes, go to the main page of [Cactus Masonry Classic Website](http://cactuscomputers.com.au/masonry) to check it out! 

= Does it Cost Money? =

No, it’s all free to use. This is not one of those “free” plugins that require a payment before you can use any of its useful features. This is completely free – no watermarks, no ads, no nagging. Just one free plugin.

However, it did take a fair amount of time to make… so if you are feeling generous… feel free to [donate something](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=cactus%40cactuscomputers%2ecom%2eau&lc=AU&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted). But no pressure or anything :). 

= Can I Make a Feature Request? =

CMC has reached the end of its supported life.  Bug fixes will still be issued, but new features are unlikely to be released.

CMC has now been replaced by Cactus Masonry Plus.  This plugin is a total rebuild of CMC, including improved performance, fewer and smaller files, and a whole bunch of new features.

Cactus Masonry Plus is also free, but it is also open to new feature requests.  To find out more, visit the [Cactus Masonry Plus Website](http://cactus.cloud/masonryplus).


== Installation ==

Just click the Download link and Activate it!

CMC can also be downloaded from the [Cactus Masonry Classic Website](http://cactuscomputers.com.au/masonry) as a zip file for manual installation. 

If you choose to install CMC manually it is important that you install the plugin in the correct folder.  While CMC will work from any folder, changing the folder will affect your ability to automatically receive new updates.

The correct folder for CMC is a folder called masonry-post-gallery within your WordPress plugins folder.  By default the path should be wp-content/plugins/masonry-post-gallery/. 


= How Do I Use Cactus Masonry Classic? =

Simple. If you can use a shortcode, then you can use CMC.

A shortcode is a special piece of code you can insert into your WordPress posts and pages which links to an active plugin. If you insert [cactus-masonry] into one of your posts, you will see the CMC gallery appear when you view (or preview) that post.

The shortcode can take a variety of parameters. For example, [cactus-masonry width=”33.33%”] will generate a gallery were each image is a third of the page wide. An example of this can be seen on the main page of the [CMC Website](http://cactuscomputers.com.au/masonry). You can use as many or as few parameters in your shortcode as you want.

For a full list of CMC’s shortcode parameters, visit the [Shortcode Parameters](http://cactuscomputers.com.au/masonry/gallery-options) page.

Alternately, visit the [Shortcode Generator](http://cactuscomputers.com.au/masonry/short-code-generator) to have your shortcode made for you! 

For support, visit our [Support Forum](http://support.cactus.cloud).

== Changelog ==

= 1.1.0.3 =
* Updated Desandro Masonry to 4.0.0

= 1.1.0.2 =
* Added the ability to list categories on each result with the display_post_categories shortcode
* Updated readme
* Started rebranding to Cactus Masonry Classic
* Some small efficiency improvements

= 1.1.0.1 =
* Fixed a bug caused by unescaped double quotes in the title and excerpt fields
* Added the ability to display a custom field in the databox using the display_custom_field parameter

= 1.1.0.0 =
* Changed how the galleries are queried to create a massive performance boost on servers with limited resources
* Added the ability to specify posts to ignore using the post_id parameter
* Updated the help file to address the new support site

= 1.0.0.0 =
* Compressed style sheets and javascript
* Rebuilt javascript class to improve efficiency and scalability
* Fixed a PHP bug that causes an error
* Started measures for the cleanest possible transition from Cactus Masonry to Cactus Masonry Plus

= 0.5.0.1b =
* Fixed an alignment issue that could cause the gallery to run off the page horizontally under some conditions.

= 0.5.0.0b =
* WARNING:  Updating to this version will likely affect the spacing above your gallery if you are using vertical spacing.  Please check your pages after the update.
* Fixed an error with the excerpt classname.  Was originally spelled as 'cm_exerpt'.  Now spelled correctly.  The original spelling also remains in place for backwards compatability.
* Added the category_ids parameter.  This allows users to filter their galleries by category ID rather than slug.  Multiple comma-separated values may be used.  Categories may also be excluded from the search with this parameter.
* Added the category_and parameter.  This allows the construction of a gallery of images that contain all of the listed categories.
* Added the stamp_id parameter.  This, combined with CSS, will allow users to add a sticky post to the gallery.
* Added the category_as_brick_class parameter.  This option adds the post category to each images class name for easier custom styling.
* Added the id_as_brick_class parameter.  This adds the post/page ID to the image class for targetted styling.
* Added the author_ids parameter.  Now posts can be filtered by author ID.
* Fixed an issue where boolean parameters would not be accepted if they were written in the wrong case.
* Fixed an issue where setting vertical spacing would cause a gap to appear above the gallery.
* New documentation pages in progress.  The shortcode generator is now out of date.

= 0.4.0.9b =
* WARNING:  Many users have manually altered the plugin to suit their particular niche needs.  If you have modified the plugin, contact us before updating, and we will try to help with the migration.
* Updated spin.js, masonry.js, imagesLoaded.js, and lightbox.js dependencies
* Updated licensing terms.
* Added the ability to specify a custom link rel attribute.  Added by request to help with some plugin interactions.  Not generally useful.
* Set the default transition duration to zero to improve resize performance.  This can be altered with the transitionDuration parameter, but setting this value may cause layout and performance issues.
* Added the ability to open each item in a new window with the open_in_new_windows parameter
* Fixed issue where lightbox.js was loaded even when the lightbox was switched off


= 0.4.0.8b =
* Added the ability to search for posts by tag slug.  The new tag parameter supports a tag slug or comma separated list of tag slugs.
* You can now search for child posts of a given post only.  Specify the parent post's ID using the post_parent_id parameter.
* Added the ability to perform a basic search using a custom taxonomy and term.
* Added title and excerpt display to galleries where JavaScript is disabled.
* Fixed a bug where inner borders won't show when gallery images are cropped

= 0.4.0.7b =
* Fixed a bug where the title and excerpt databox would appear incorrectly when masonry=false

= 0.4.0.6b =
* Fixed a bug with custom post types
* Cactus Masonry now broadcasts the number of posts found to help with external pagination

= 0.4.0.5b =
* Removed BOM to stop header error

= 0.4.0.4b =
* Fixed encoding to UTF8

= 0.4.0.3b =
* Further fixes for the wptexturize bug which should no longer interfere with other plugins
* Fixed an error with the page_size parameter

= 0.4.0.2b =
* Fixed a bug with the console error caused by an non-existent image id set as the default image id
* Fixed a major bug that may cause problems due to code changes caused by wptexturize on some sites...  uh... wptexturize...

= 0.4.0.1b =
* Removed a reference to the lightbox map file to fix a 404 warning in compatible browsers

= 0.4.0.0b =
* WARNING:  This update modifies Cactus Masonry's CSS behaviour.  There are a number of changes in place to support new features and handle Internet Explorer issues.  For one, the #masonry_post_gallery selector has been changed to div.masonry_post_gallery.  These changes will not affect the gallery's default appearance - but they may affect custom CSS styling.  Be sure to check your site's appearance after updating.
* Added the ability to select post/page-like custom post types in the gallery
* Eliminated unnecessary site overhead caused by the plugin
* Added the ability to manually handle the loading of external scripts to improve AJAX loading time
* Added an override for the automatic width setting that can cause the gallery to resize its contents after external image resizing
* Added the ability to crop images to fill each brick
* Added the ability to specify an image background colour for added flexibility around transparent images when using the different hover colours
* Added the option to specify an additional custom class name for the link elements in the gallery to increase compatibility with other plugins.
* Multiple instances of Cactus Gallery can now run at the same time on the same page
* Improved gallery functionality when masonry is switched off
* Fixed a layout bug that may occur on some IE installs
* Modified how image spacing works to address IE11's inability to render basic CSS
* Fixed some minor style issues that could cause bugs in older IE browsers
* Fixed a major bug in IE8 to IE11 caused by (in)compatibility mode
* Fixed a bug where the title/excerpt box can appear above the loading box
* Fixed a bug where borders would be cut off an image with a set max-width/max-height
* Fixed a bug where excerpts containing a line feed or carriage return would break the plugin
* Fixed a bug where the search_start and page_size parameters fail to function correctly when there are posts present with no featured image and default_image_id is unspecified
* Various large efficiency improvements
* Changed how fixed (non-percentage) widths are handled to improve efficiency
* Improved gallery functionality in situations with extremely large numbers of posts

= 0.3.8.4b =
* Fixed a bug that can cause a PHP warning

= 0.3.8.3b =
* A bug fix for an issue that stops posts with certain characters in their titles and excerpts from appearing in the gallery.

= 0.3.8.2b =
* Applied some CSS enhancements to make the plugin's styling more robust on a variety of different web environments
* Made additions to the plugin's FAQ section
* Added screenshots to the WordPress plugin documentation

= 0.3.8.1b =
* Fixed a bug that can cause the plugin to not function due to an uncommon interaction with WordPress's wpautop 'feature'

= 0.3.8.0b =
* Added the ability to display a title and/or an exerpt on each image in a gallery
* Added a CSS customization page to the website to assist with styling the gallery
* Fixed a bug that causes the lightbox gallery to fail when loading a default image

= 0.3.7.3b =
* Added a fix that will allow Cactus Masonry to function even if its installed in an unexpected folder on the server
* Added version number to main div class for easier debugging
* Added some manual installation instructions
* Added some detail to the FAQ section of the documentation

= 0.3.7.2b =
* Bug fix to address issue that presents itself when infinite_scroll='false'

= 0.3.7.1b =
* Bug fix to address older versions of PHP

= 0.3.7.0b =
* Updated the infinite scroll to allow for IE8 compatibility
* Fixed bug in infinite scroll code that would sometimes stop a page from loading until the user scrolled the page up
* Improved the infinite scroll loading buffer to better address a range of scenarios
* Removed the spinner from the loading box when run within IE8 to reduce outdated browser related bugs
* Cleaned up code to slightly improve performance and improve backwards compatibility
* Added parameters to allow for better gallery handling on browsers where JavaScript is disabled
* Added the require_javascript parameter which will hide the gallery when set to true on any browser without JavaScript
* Added the javascript_error_message parameter to set an error message that should be displayed when JavaScript is disabled
* Fixed noscript_height and noscript_width to force images to a specific size when JavaScript is disabled.
* Fixed a small typo and updated a link in the documentation
* Added the upgrade notice

= 0.3.6.1b =
* Modified documentation to improve readability
* Fixed a bug that affected the post/page sort order since the last update

= 0.3.6.0b =
* Added link to plugin home page in short description
* Updated function names to reduce the chance of a conflict
* Restructured some code to improve flow and testing capabilities
* Added the ability to specify a default image.  Now posts without a featured image can be shown if a default image is specified.
* Added the ability to search for posts, pages, posts and pages, or nothing at all
* Added an instructions page under the WordPress Dashboard Settings menu
* Improved documentation on website to address new features

= 0.3.5.4b =
* Improved plugin short description to reduce confusion
* Reorganized code output to fix a W3C compliance issue
* Small code layout fixes

= 0.3.5.3b =
* Fixed an error that could occur when displaying posts with an apostrophe in their title

= 0.3.5.2b =
* Masonry Post Gallery is renamed to Cactus Masonry 
* Improved documentation on Cactus Masonry website
* Plugin documentation has been rewritten
* The [cactus-masonry] shortcode can now be used (while maintaining reverse compatibility)
* Added the search_start parameter which allows the post query to be offset by a given number of posts
* Added the page_size parameter which allows the post query to be limited to a given number of matches

= 0.3.5.1b =
* Implemented an option to show or hide the infinite scroll loader
* Updated the documentation to use the masonry website and shortcode generator
* Added links to the masonry home page to the WordPress plugin page

= 0.3.5.0b =
* Greatly improved gallery efficiency on load and window resize
* Fixed a layout sizing error when maxWidth is set

= 0.3.4.4b =
* Fixed error that occurs on multipage galleries

= 0.3.4.3b =
* Fixed script breaking bug caused by typo

= 0.3.4.2b =
* Fixed error on IE8 that stopped images from loading
* Fixed incompatibility with IE8 that affected the loading box
* Now masonry disables on IE7 and earlier 

= 0.3.4.1b =
* A compatibility fix for different versions of PHP

= 0.3.3b =
* Added infinite scroll functionality to improve loading speed on larger pages
* Added the infinite_scroll parameter to toggle infinite scroll
* Added the posts_per_page to determine the number of images to load each time with the infinite scroll
* Made the loading box float at the top centre of the screen
* Addressed graphical bugs with the loading box
* Improved code efficiency
* Removed support for the height parameter set as a percentage
* Fixed a bug that stopped the height parameter from working properly
* Fixed a bug that stopped the vertical spacing parameter from working properly
* Fixed a bug that made the vertical spacing half that of the horizontal spacing
* Fixed a bug with the hover colour parameter
* Fixed a bug where the loading box will block mouse clicks
* Set the default horizontal and vertical spacing values to 10

= 0.3.2b =
* Fixed a bug that stopped the category parameter from working

= 0.3.1b =
* Fixed a bug where the gallery would always appear at the top of the page
* Added a number of code improvements including an external CSS file
* Changed how the borders work to make them more reliable and even
* Changed how the spacing and widths behave to make percentage based column layouts more reliable
* Added a flexible border parameter called soft_gutter
* Fixed a bug where the fit_width parameter would break the code
* Set fit_width to "false" by default as it interacts with columns set to a percentage width causing the page to look wrong while loading
* Made stylesheet improvements to fix minor display issues
* Small documentation errors have been fixed
* Published fit_width parameter to documentation
* Updated documentation to suite changes
* Changed the plugins version numbering system to better match WordPress standards and easier to update

= 0.3.0b =
* Fixed the percentage column/row width/height functionality.  Now 33% will give three columns with images fitting their column sizes.
* Added the option to specify whether each image will link to its post, itself, a different sized version of itself, or nowhere
* Added the capability to display a lightbox style gallery using the show_lightbox parameter
* Removed any absolute paths to the plugins directory to make plugin more robust to future WordPress versions
* Fixed some more bugs that have arose with certain image size and alignment functionality
* Fixed the percentage width and height functionalities
* Fixed a problem with boolean shortcode parameters
* Fixed an inconsistancy in the wording of the shortcode instructions
* Updated the documentation to recognize these changes

= 0.2.0b =
* Updated upscaling feature.  Now has the option to independently set max_height and max_width for upscaled objects.
* Made MPG more functional in the absence of JavaScript.
* Added to option to specify a grid layout that will take effect when JavaScript is disabled
* Updated the documentation to recognize these changes 

= 0.1.5b =
* Added upscaling feature.  Now images that are shorter or narrower than a specified width or height can be upscaled until they reach the specified size.  The image thumbnail quality will be increased until it reaches the largest size available, reaches the largest size specified under the max_upscale_size parameter, or reaches or exceeds the max_height or max_width parameters. 
* Removed support for percentages in the max_height and max_width fields
* Updated the documentation to include new features
* Added padding to the top of the loading box

= 0.1.1b =
* Incompletely implemented post_order and post_orderby parameters fixed
* Default max_width and max_height parameters changed to "none"
* Default horizontal_spacing and vertical_spacing set to 0
* Minor correction made to the parameters section of the documentation to reflect these changes
* Minor correction made to the parameters section of the documentation to fix incorrect parameter options
* Additional information added to the parameters section of the documentation to clarify the behaviour of the vertical and horizontal spacing

= 0.1.0b =
* The initial version is released.  This is a testing beta, so there will be revisions, and some features may not work as planned.

== Frequently Asked Questions == 

Please refer to the [FAQ page](http://cactuscomputers.com.au/masonry/frequently-asked-questions/) of the Cactus Masonry website.

== Upgrade Notice ==

= 1.1.0.1 =
* Fixed a bug and added a new parameter

= 1.1.0.0 =
* Made major improvements to the plugin's efficiency

= 1.0.0.0 =
* Rebuilt scripts, bug fixes, compressed code, added reliability and efficiency

= 0.5.0.0b =
* New features and fixes. WARNING: This update may affect your gallery's top margin. Please check your pages after updating.

= 0.4.0.9b =
Updates and new features.  DO NOT UPDATE if you have customized the plugin yourself.  Contact us first!

= 0.4.0.8b =
Upgrade for a bug fix and the new ability to search by parent ID, Tag, or basic taxonomy terms (thanks Eric).

= 0.4.0.7b =
Update for a fix that can cause the title and excerpts to display incorrectly when masonry is set to false

= 0.4.0.6b =
Fixed a bug with the custom_post_types parameter - thanks Bjørn for bringing this to my attention.  Added a global variable to help with external pagination.

= 0.4.0.5b =
WARNING: The 0.4 updates change the #masonry_post_gallery to div.masonry_post_gallery which could affect your custom CSS.  Fixed encoding to UTF8 without BOM.

= 0.4.0.4b =
WARNING: The 0.4 updates change the #masonry_post_gallery to div.masonry_post_gallery which could affect your custom CSS.  Fixed encoding to UTF8.

= 0.4.0.3b =
WARNING: The 0.4 updates change the #masonry_post_gallery to div.masonry_post_gallery which could affect your custom CSS.  Fixed a major bug caused by an interaction with wptexturize.

= 0.4.0.2b =
WARNING: The 0.4 updates change the #masonry_post_gallery to div.masonry_post_gallery which could affect your custom CSS.  Fixed a major bug caused by an interaction with wptexturize.

= 0.4.0.1b =
WARNING: The 0.4 updates change the #masonry_post_gallery to div.masonry_post_gallery which could affect your custom CSS.  The latest update fixes a 404 warning for lightbox.min.map.

= 0.4.0.0b =
WARNING: This update changes the #masonry_post_gallery to div.masonry_post_gallery and could affect your custom CSS.  Upgrade for numerous bug fixes, new features, and efficiency improvements.

= 0.3.8.3b =
Upgrade to fix a bug that occurs when certain characters exist in a post's title.

= 0.3.8.2b =
Upgrade for some more robust default styling and documentation improvements.

= 0.3.8.1b =
Upgrade to fix an uncommon bug that can cause the plugin to not function on certain WordPress configurations

= 0.3.8.0b =
Upgrade for the ability to display titles and/or custom excepts in the Cactus Masonry gallery.  The update includes a bugfix for the lightbox gallery.

= 0.3.7.3b =
Upgrade for an update to handle different install locations more elegantly, improved documentation, and some added debug capabilities

= 0.3.7.2b =
Upgrade to fix a bug that stops the gallery from loading properly when infinite_scroll is set to false

= 0.3.7.1b =
Upgrade to address a PHP error triggered on older versions of PHP

= 0.3.7.0b =
Upgrade for a number of new features and new IE8 backwards compatibility.  Cactus Masonry now has better error detection and handling abilities when dealing with browsers with JavaScript disabled.  Now default image sizes, error messages, and gallery behaviour can be modified to suit any browser with JavaScript disabled.  The infinite scroll feature has been improved to remove a bug, work on IE8, and perform under a variety of different conditions.  Upgrade notices have also been added and the Cactus Masonry WordPress.org listing has been improved.

= 0.3.6.1b =
Upgrade for a bug fix and some modified documentation to improve readability

= 0.3.6.0b =
Upgrade for a variety of new exciting features including improved documentation, a default image parameter (for posts with no image), the ability to show pages as well as posts, and an instructions page in WordPress itself!

= 0.3.5.4b =
Upgrade for improved W3C compliance, code fixes, and improved documentation

= 0.3.5.3b =
Upgrade to fix an error that could occur when displaying posts with an apostrophe in their title

= 0.3.5.2b =
Upgrade to enjoy the new version of Masonry Post Gallery - now called Cactus Masonry! The new version comes with some exciting new features to match its exciting new name.  The new version has a new shortcode (but maintains reverse compatibility), new search parameters, and some rewritten documentation.

= 0.3.5.1b =
Upgrade for an option to show/hide the loading box and for much improved documentation

= 0.3.5.0b =
Upgrade for greatly improved gallery efficiency on load and window resize and to fixed a layout sizing error that occurs when maxWidth is set

= 0.3.4.4b =
Upgrade to fix an error that occurs on multipage galleries

= 0.3.4.3b =
Upgrade to address a script breaking bug

= 0.3.4.2b =
Upgrade to fix a bug in IE8 that stopped images from loading and affected the loading box. The new version checks for older versions of IE to avoid displaying a broken website on an incompatible and outdated browser.

= 0.3.4.1b =
Upgrade for a compatibility fix to address some older versions of PHP

= 0.3.3b =
Upgrade for new infinite scroll functionality to heavily improve performance and user experience.  This update also contains various bug fixes.

= 0.3.2b =
Upgrade to fix a bug that stopped the category parameter from working

= 0.3.1b =
Upgrade for a major gallery positioning bug fix, coding improvements, border and spacing behaviour improvements, code fixes, and a variety of other improvements.

= 0.3.0b =
Upgrade for a width/height bug fix, new image link options, new lightbox functionality, redesigned code for future-proofing, a major shortcode bug fix, various smaller bug fixes, and more consistent documentation.

= 0.2.0b =
Upgrade for new features and some JavaScript free functionality.

= 0.1.5b =
Upgrade for new features, bug fixes, display improvements, and more documentation

= 0.1.1b =
Upgrade for fixed broken sort parameters, improved default sizing and spacing values, some parameter changes, and documentation improvements.

== Screenshots ==

1. The [Shortcode Generator](http://cactuscomputers.com.au/masonry/shortcode-generator/) webpage

2. The [Shortcode Generator](http://cactuscomputers.com.au/masonry/shortcode-generator/) webpage

3. A gallery with the following shortcode: [cactus-masonry link_location='medium' post_orderby='rand' width='50%' horizontal_spacing='20' vertical_spacing='20' border_thickness='5px' border_color='white' outer_border_thickness='5px' show_lightbox='true']

4. A gallery with the following shortcode: [cactus-masonry width='25%' horizontal_spacing='0' vertical_spacing='0']

5. A gallery with the following shortcode: [cactus-masonry width='33.33%']

6. A gallery with the following shortcode: [cactus-masonry display_post_titles='true' display_post_excerpts='true' width='33.33%']

7. A gallery with the following shortcode: [cactus-masonry width='50%' horizontal_spacing='20' vertical_spacing='20' border_thickness='5px' border_color='white' outer_border_thickness='5px']

8. A gallery with the following shortcode: [cactus-masonry width='250px' horizontal_spacing='20' vertical_spacing='20']



