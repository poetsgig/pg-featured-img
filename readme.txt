=== PG Featured Image ===
Contributors: Amy Aulisi
Donate link: 
Tags: widget, featured, sidebar, image, thumbnail, photo
Requires at least: 4.6.0
Tested up to: 4.9.6
Stable Tag: 1.1
License: GPLv2

== Description ==

PG Featured Image plugin allows you to display the featured image of the current post in sidebar area, or in a post page. You can select the size of the image from the list of WordPress registered image sizes. Displaying image title, caption, description and excerpt of current post are optional.

== Installation ==

It is very simple.

 * First Method *

1. Download the plugin zip file
2. Go to your WP Admin dashboard->Plugin section
3. Click on "Add New" tab, and click on the "Upload Plugin" button
4. Click on the "Choose File" button and select PG Featured Image zip file. Click "Install Now"

 * Second Method *

1. Go to your WP Admin dashboard->Plugin section
2. Click on "Add new" tab
3. Enter "PG Featured Image" in the search bar
4. Select PG Featured Image plugin and click "Install Now"

 * Activation *
 
5. Go to your Wordpress Admin dashboard > Plugin section. The list of installed plugins will show.
6. Hover down until you see "PG Featured Image" plugin and click "Activate"

 * Widget Setup*
 
7. Go to Appearance->Widgets to set and configure PG Featured Image. 

== How to Show Featured Image in Sidebar ==

As long as the post or page has a featured image, and you did step #7, it will automatically show in the sidebar.

== How to Show in Posts and Pages ==

1. Make sure your theme supports shortcode. In your functions.php file, check if the following code is present. Note that any change to your functions php is preferred to be done on a child theme. To create a child theme, refer to these posts: https://poetsgig.com/2017/07/how-to-create-a-wordpress-child-theme/ and https://developer.wordpress.org/themes/advanced-topics/child-themes/

/* Add shortcode support*/
add_filter('‘widget_text', 'do_shortcode');

2. Use the plugin "amr shortcode any widget". You can download the plugin here: https://wordpress.org/plugins/amr-shortcode-any-widget/

After you setup a PG Featured Image widget, save the settings. You will see a do_widget name at the bottom of the widget, similar to below:

[do_widget id=pg_featured_img-3]

There are two wats to show featured image in posts and pages:

2.1 Add the do_widget code to your post or page PHP template files. 
2.2 Add the code directly inside the post, WP Admin dashboard > Posts > Edit Post; or you can also add in a page, WP Admin dashboard > Pages > Edit Page. Put the code wherever you want the featured image to be displayed.

== Deactivation ==

1. If you setup a widget for use only in the sidebar, simply deactivate the plugin. Go to Wordpress Admin dashboard > Plugin section. Hover down until you see "PG Featured Image" plugin and click "Deactivate"

2. If you use the "amr shortcode any widget" to display featured image in a post or page, make sure to remove the do_widget code you added in your template files, or inside of your posts and pages. Sometimes, you do not need to deactivate "amr shortcode any widget", since you probably used its functionality to other widgets.

== MultiSite ==
This plugin has not been tested with multisite installation.

== Upgrade Notice ==
This plugin supports WordPress installation using version 4.6.0 and later, due to the code get_the_post_thumbnail_caption which was introduced in WordPress version 4.6.0.

== Frequently Asked Questions ==

== Changelog ==
= 1.1 =
* Added option to display image title

= 1.0 =
* Plugin is first created
