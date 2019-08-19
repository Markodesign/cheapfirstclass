<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
		<div id="primary" class="widget-area" role="complementary">
            <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css?<?php echo time(); ?>' type='text/css' media='all' />
              <h5><i class="star"></i><a href="/customer-testimonials/">Get a Quote Now!</a></h5>
  <?php
    require_once 'request/Request.class.php';
    $request = new Request();
    echo $request->buildForm();
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("right-sidebar") ) : endif;
?> 
	</div><!-- #primary .widget-area -->