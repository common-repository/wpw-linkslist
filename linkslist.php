<?php
/*
Plugin Name: Linkslist
Plugin URI: http://www.archgfx.net/blog/index.php/themes/linkslist
Description: Replacement for the standard links widget

Author: Sunburntkamel
Version: 0.1
Author URI: http://www.archgfx.net/blog/index.php/about

    This Widget is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt

    This is a WordPress plugin (http://wordpress.org) and widget
    (http://automattic.com/code/widgets/).
*/

// We're putting the plugin's functions in one big function we then
// call at 'plugins_loaded' (add_action() at bottom) to ensure the
// required Sidebar Widget functions are available.
function widget_linkslist_init() {
    // Check to see required Widget API functions are defined...
    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )

        return; // ...and if not, exit gracefully from the script.

// start the linkslist widget
function widget_linkslist($args) {
// define the $wpdb variable (i don't know, ask otto)
global $wpdb;
        // $args is an array of strings which help your widget
        // conform to the active theme: before_widget, before_title,
        // after_widget, and after_title are the array keys.
		extract($args);
					//  here's where we use code form the wp_get_links codex
                   $link_cats = $wpdb->get_results("SELECT cat_id, cat_name FROM $wpdb->linkcategories");
				   // start a loop for each link category
 foreach ($link_cats as $link_cat) {

		// each time the loop is called, it makes a new API-compliant widget
        echo $before_widget; 
				// wrap each link category to match the theme
             echo $before_title
                . $link_cat->cat_name
                . $after_title; 
		//wrap each list in a unique id, to allow styling ?>
     	<ul id="linkcat-<?php echo $link_cat->cat_id; ?>">                  
     	<?php wp_get_links($link_cat->cat_id); ?>
		</ul>
<?php		// close the widget
         echo $after_widget;   
// end the loop 
 } 
 // end the linkslist widget 
}
 // register the widget
register_sidebar_widget('Links List',
    'widget_linkslist');
 } 
   // Delays plugin execution until Dynamic Sidebar has loaded first.
add_action('plugins_loaded', 'widget_linkslist_init');

?>