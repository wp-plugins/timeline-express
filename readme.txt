=== Timeline Express ===
Contributors: eherman24
Donate link: http://www.evan-herman.com/contact/?contact-reason=I%20want%20to%20make%20a%20donation%20for%20all%20your%20hard%20work
Tags: vertical, timeline, animated, css3, animations, evan, herman, evan herman, easy, time, line, font awesome, font, awesome, announcements, notifications, simple, events, calendar, scroll, triggered, scrolling, animated, fade, in, fade in
Requires at least: 3.9
Tested up to: 4.0.1
Stable tag: 1.1
License: GPLv2 or later

Timeline express allows you to create a beautiful vertical animated and responsive timeline of posts , without writing a single line of code. Sweet!

== Description ==

Timeline express allows you to create a vertical animated timeline of announcement posts , without writing a single line of code. You simply create the 'announcement' posts, set the announcement date and publish. The timeline will populate automatically in chronological order, based on the announcement date. Easily limit the announcements displayed to Upcoming announcements, past announcements or simply display all of them.

**Features**

* Load a custom template for single announcements (new)
* Localized date formatting for international users (new)
* Hundreds of Font awesome icons included. Specify a different icon for each announcement
* CSS3 animations on scroll
* Set the color of the announcement
* Specify the length to trim each announcemnt, or randomize it
* Hide the date of the announcement
* Hide the 'read more' button for each announcement
* Specify an image to display for each announcement
* Delete announcements on uninstallation (so no orphan posts are hanging around in your database)
* Easy to use shortcode to place the timeline wherever your heart desires ( `[timeline-express]` )
* TinyMCE button to generate the shortcode
* Specify Ascending vs Descending display order
* Highly extensible
* Translatable

**Translated**

Timeline express comes ready for translation. I would love to get things translated into as many languages as possible. At the moment the following translations are available for Timeline Express :

* English
* Chinese (zh_CN) - thanks goes to <a href="http://www.vahichen.com" target="_blank">Vahi Chen</a>
* Portuguese (pt_BR) - thanks goes to <a href="http://toborino.com" target="_blank">Gustavo Magalhães</a>
* Polish (pl_PL) - thanks goes to Kanios

<em>We're always looking for polyglots to help with the translations. If you enjoy this plugin, speak multiple languages and want to contribute please <a href="http://www.evan-herman.com/contact/" target="_blank">contact me</a> about how you can help translate things so users around the world can benefit from this plugin.</em>

**Hooks + Filters**

**Setup a custom date format for front end display (New v1.0.9)**

New in version 1.0.9 is the localization of dates on the front end. The date format is now controlled by your date settings inside of 'General > Settings'.

If, for one reason or another, you'd like to specify a different date format than provided by WordPress core you can use the provided filter `timeline_express_custom_date_format`.

The one parameter you need to pass into your function is $date_format, which is (as it sounds) the format of the date.

Some formatting examples:

* `m.d.Y` - 11.19.2014
* `d-m-y` - 11-19-14
* `d M y` - 19 Nov 2014
* `D j/n/Y` - Wed 11/19/2014
* `l jS \of\ F` - Wednesday 19th of November

Example:
<code>
function custom_te_date_format( $date_format ) {
	$date_format = "M d , Y"; // will print the date as Nov 19 , 2014
	return $date_format;
}
add_filter( 'timeline_express_custom_date_format' , 'custom_te_date_format' , 10 );
</code>

* d - Numeric representation of a day, with leading zeros 01 through 31.
* m - Numeric representation of a month, with leading zeros 01 through 12.
* y - Numeric representation of a year, two digits.

* D - Textual representation of a day, three letters Mon through Sun.
* j - Numeric representation of a day, without leading zeros 1 through 31.
* n - Numeric representation of a month, without leading zeros 1 through 12.
* Y - Numeric representation of a year, four digits.

* S - English ordinal suffix for the day of the month. Consist of 2 characters st, nd, rd or th.
* F - Textual representation of a month, January through December.

* M - Textual representation of a month, three letters Jan through Dec.


<em>[view more date formatting parameters](http://php.net/manual/en/function.date.php)</em>


**Load Your Own Single Announcement Template File (New v1.0.8)**

By default all single announcements will try and load a single.php template file. If that can't be found, we've done our best to implement a template for you. If your unhappy with the template file we've provided you have two options. Your first option is to copy over the single-announcement-template directory contained within the plugin into your active themes root. This will trigger the plugin to load that file instead. You can then customize this file to your hearts content without fear of losing any of your changes in the next update.

Your next option is to use our new filter for loading your own custom template file. If for whatever reason you've designed or developed your own single.php file which you would rather use, or you just want to use your themes page.php template instead, you can use the provided filter to change the loaded template. Here is an example ( you want to drop this code into your active theme's functions.php file ) :

Example:
<code>
// By default Timeline Express uses single.php for announcements
// you can load page.php instead
// just change page.php to whatever your template file is named
// keep in mind, this is looking in your active themes root for the template
function custom_timeline_express_template_file( $template_file ) {
	$template_file = 'page.php';
	return $template_file;
}
add_filter( 'timeline_express_custom_template' , 'custom_timeline_express_template_file' , 10 );
</code>

<br />
<br />
<strong>While the plugins I develop are free, maintaining and supporting them is hard work. If you find this plugin useful, or it helps in anyway, please consider making a <a href="http://www.evan-herman.com/contact/?contact-reason=I%20want%20to%20make%20a%20donation%20for%20all%20your%20hard%20work">donation</a> for its continued development.</strong>

== Installation ==

1. Download the plugin .zip file
2. Log in to yourdomain.com/wp-admin
3. Click Plugins -> Add New -> Upload
4. Activate the plugin
6. On the left hand menu, hover over 'Timeline Express' and click 'New Announcement'
7. Begin populating the timeline with events. (Note: Events will appear in chronological order according to the <strong>announcement date</strong>)
8. Once you have populated the timeline, head over to the settings page (Settings > Timeline Express) to customize your timeline.
9. Create a new page, and enter the shortcode [timeline-express] to display the vertical timeline (Note: Timeline Express displays best on full width pages)

== Frequently Asked Questions ==

= How do I use this plugin? =
Begin by simply installing the plugin. Once the plugin has been installed, go ahead and begin creating announcement posts. You'll find a new menu item just below 'Posts'.
After you have a substantial number of announcements set up, you're ready to display the timeline on the front end of your site.

Timeline express displays best on full width pages, but is not limited to them. Create a new page, and drop the shortcode into the page - `[timeline-express]`.
Publish your page, and view it on the front end the see your new super sweet timeline! (scroll for animation effects!)

= What template is the single announcement post using? Can I customize it at all? I want to do x, y or z. =
The single announcement post is using a custom template file that comes pre-bundled with the plugin. If you want to customize the template for whatever reason
you can do so, by creating a directory in your active theme called 'timeline-express'. Once the directory is created, simply copy the file titled 'single-timeline-express-announcement.php' into
the newly created 'timeline-express' directory in your theme. Timeline express will then automagically pull in the newly created template in your theme root. You can go ahead and customize 
it to your hearts desire without fear of losing any changes in future updates!

= Can I create more than one timeline? =
At the moment no, but I will consider adding that into a future update if people show enough interest.

= At what width are the breakpoints set? =
Breakpoints are set at 822px. The timeline will shift/re-adjust automatically using masonry based on the height of each announcement container.

= How can I translate this plugin? =
The text-domain for all gettext functions is `timeline-express`.

If you enjoy this plugin and want to contribute, I'm always looking for people to help translate the plugin into any of the following languages, credit will be given where credit is due :

* Arabic
* English
* French
* German
* Greek
* Hebrew
* Hindi
* Hong Kong
* Italian
* Japanese
* Korean
* Persian
* Portuguese (European)
* Romanian
* Russian
* Spanish
* Swedish
* Taiwanese
* Tamil
* Urdu
* Vietnamese
* Welsh

Read the Codex article "[I18n for WordPress Developers]"(http://codex.wordpress.org/I18n_for_WordPress_Developers) for more information. 

== Future Ideas ==

Have an idea for a future release feature? I love hearing about new ideas! You can get in contact with me through the contact form on my website, <a href="http://www.evan-herman.com/contact/" target="_blank">Evan-Herman.com</a>.

== Screenshots ==

1. Timeline Express announcement post creation screen
2. Timeline Express announcement management on the 'Edit Announcements' page
3. Timeline Express sample timeline with multiple icons/colors
4. Timeline Express responsive (mobile version)
5. Timeline Express full settings page

== Changelog ==

= 1.1 - December 3rd, 2014 =
* Fixed: Fixed styles when timeline is inside posts (fixed icon size, duplicate images)
* Fixed: Fixed a few enqueue functions
* Enhancement: Polish language translation now included (pl_PL) - thanks goes to Kanios
* Enhancement: Enqueued new styles on single announcement posts to style the announcement pages a bit better
* Enhancement: Added new custom image size, to unify announcement images on the timeline ('timeline-express')
* Enhancement: Added new function `timeline_express_get_image_id()` to get attachment image IDs by URL
* Enhancement: Stripped out a lot of un-needed code

= 1.0.9 - November 19th, 2014 =
* Updated: Localized date format displayed on the front end as requested by our international users ( format now takes on what you have in 'General > Settings' )
* Updated: Fixed styling issue on date picker arrows
* Feature: Added new filter to allow users to specify a custom date format (`timeline_express_custom_date_format`)

= 1.0.8 - November 17th, 2014 =
* Updated: Single announcement template file, which was causing issues for some users on specific themes
* Feature: Added a new filter to allow users to load custom template files
* Feature: Added auto update feature for Timeline Express
* Fixed: Issue where links in the excerpt and 'read more' links couldn't be clicked due to overlapping masonry elements
* Fixed: Missing image on welcome page
* Fixed: Minor issues on welcome page including some links

= 1.0.7 - November 13th, 2014 =
* Enhancement: Portuguese language translation now included (pt_BR) - thanks goes to <a href="http://toborino.com" target="_blank">Gustavo Magalhães</a>

= 1.0.6 = 
* Fixed fatal error thrown on activation for sites running older versions of PHP

= 1.0.5 = 
* Change priority argument on register post type function, which caused conflicts with other custom post types on certain sites

= 1.0.4 = 
* Chinese language translation now included (zh_CN) - thanks goes to <a href="http://www.vahichen.com" target="_blank">Vahi Chen</a>
* Removed some un-necessary styles (timeline title/content font-size+font-family declerations)

= 1.0.3 = 
* Included new function to retain formatting in the announcement excerpt in the timeline (`te_wp_trim_words_retain_formatting()`)

= 1.0.2 = 
* Add a display order setting to set Ascending or Descending display order for announcements in the timeline
* Fixed "cannot access settings page" when clicking on the settings tab when on the settings page already

= 1.0.1 =
* Update masonry function to include .imagesLoaded(); to prevent overlapping containers in the timeline

= 1.0 =
* Initial Release to the WordPress repository

== Upgrade Notice ==
= 1.0.9 - December 3rd, 2014 =
We've updated some of the styles packaged with Timeline Express, added a new custom image size for announcements (you may need to regererate your images) multiple style issues when the timeline is used inside posts.

= 1.0.9 - November 19th, 2014 =
Localized date formats based on 'General > Settings', and added a custom filter to allow users to alter the date format however they see fit.

= 1.0.8 - November 17th, 2014 =
Added a new filter to allow users to load custom template files, updated the single announcement template file, and fixed a few styling issues

= 1.0.7 - November 13th, 2014 = 
We have now included Portuguese language translation (pt_BR) - thanks goes to <a href="http://toborino.com" target="_blank">Gustavo Magalhães</a>.

= 1.0.6 = 
We have fixed a fatal error that was being thrown on activation for site running older versions of PHP.

= 1.0.5 = 
We have changed the priority parameter on the custom post type register function, which was causing conflicts on certain user sites.

= 1.0.4
We have now included Chinese language translation (zh_CN) - thanks goes to <a href="http://www.vahichen.com" target="_blank">Vahi Chen</a>. We have also made a few adjustments to the style declarations of the timeline content and title on the front end.

= 1.0.3 = 
* Included new function to retain formatting in the announcement excerpt in the timeline (te_wp_trim_words_retain_formatting())

= 1.0.2 =
* Add display order setting to specify ascending or descending order of announcements in the timeline
* Fixed "cannot access settings page" when clicking on the settings tab when on the settings page already

= 1.0.1 =
* Update masonry function to include .imagesLoaded(); to prevent overlapping containers in the timeline

= 1.0 =
* Initial Release to the WordPress repository