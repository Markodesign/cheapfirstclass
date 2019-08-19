<?php
/**
 * Template Name: Form Page Template
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
wp_enqueue_script('jquery-ui-autocomplete', '', array('jquery-ui-widget', 'jquery-ui-position'), '1.8.6');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
function request_scripts()
{
    wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js');
    wp_enqueue_script('maskedinput', '/wp-includes/js/jquery/jquery.maskedinput.min.js');
}
add_action('wp_enqueue_scripts', 'request_scripts');
get_header();
?>

<div class="slider">
  <?php slider(1) ?>
  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css?<?php echo time(); ?>' type='text/css' media='all' />
  <!--<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/request/request.js?<?php echo time(); ?>'> </script>-->
  <div class="middle-row">
  <?php
    require_once 'request/Request.class.php';
    $request = new Request();
    echo $request->buildForm();
  ?>
  </div>
</div>
<div class="container">
  <div class="today-specials">
    <div class="middle-row">
      <div class="grid12">
        <h4><i class="star"></i>Today Specials</h4>
      </div>
    </div>
  </div>
  
  <div class="top-destination">
    <div class="middle-row">
      <div class="grid12">
        <h4><i class="cost"></i>Top Destinations</h4>
      </div>
    </div>
  </div>
  
  
  <div class="request-a-quote-block">
    <div class="middle-row">
      <div class="grid8">
        <p><i class="plane"></i>We <strong>Absolutely Guarantee</strong> The Lowest Fares For<br>
International First & Business Class Flights</p>
      </div>
      <div class="grid4"><a href="#">Reguest a Quote NOW!</a></div>
    </div>
  </div>
  <div class="latest-from-blog">
    <div class="middle-row">
      <div class="grid9">
        <h5><i class="blog"></i>Latest from our Blog</h5>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("latest-from-blog") ) : endif; ?>
      </div>
      <div class="grid3">
        <h5><i class="testimonials"></i>Testimonials</h5>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("testimonial") ) : endif; ?>
      </div>
    </div>
  </div>
</div>
</div>




<?php get_footer(); ?>
