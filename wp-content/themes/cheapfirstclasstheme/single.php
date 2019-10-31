<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

wp_enqueue_script('jquery-ui-autocomplete', '', array('jquery-ui-widget', 'jquery-ui-position'), '1.8.6');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
function request_scripts()
{
    wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js');
    wp_enqueue_script('maskedinput', '/wp-includes/js/jquery/jquery.maskedinput.min.js');
}
add_action('wp_enqueue_scripts', 'request_scripts');
get_header();
?>

<div class="container inside">
  <div id="container">
    <div id="content" role="main">
      <div class="middle-row">
        <div class="grid9">
          <?php
			get_template_part( 'loop', 'single' );
			?>
        </div>
        <div class="grid3">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
    <!-- #content --> 
  </div>
  <!-- #container --> 
</div>
</div>
<?php get_footer(); ?>
