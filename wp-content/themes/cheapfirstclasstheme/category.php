<?php
/**
 * The template for displaying Category Archive pages.
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

    <?
    if($_GET['request']=='done'){
        include_once("request_done.tpl");
   }?>


      <div class="middle-row">
        <div class="grid9">

				<h1 class="page-title"><?php
					printf( __( '%s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>
        </div>
        <div class="grid3">
		    <?php
		    if($_GET['request']=='done'){
		       wp_nav_menu(array('menu'=> 'footer-menu','container_id'    => 'sidebar-menu'));
		   }else{
		        get_sidebar();
		   }?>
        </div>
      </div>
    </div>
    <!-- #content -->
  </div>
  <!-- #container -->
</div>
</div>
<?php get_footer(); ?>
