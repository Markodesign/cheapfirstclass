<?php
/**
 * Template Name: Main Page Template
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
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
function request_scripts()
{
    wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js');
    wp_enqueue_script('maskedinput', '/wp-includes/js/jquery/jquery.maskedinput.min.js');
}
add_action('wp_enqueue_scripts', 'request_scripts');
get_header();
?>

<div class="slider" id="rqform">
  <?php layerslider(1) ?>
    <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css' type='text/css' media='all' />
  <!--<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/request/request.js?<?php echo time(); ?>'> </script>-->
  <div class="middle-row">
  <?php
    require_once 'request/Request.class.php';
    $request = new Request();
    echo $request->buildForm();
  ?>

<a href="http://www.shopperapproved.com/reviews/cheapfirstclass.com/"
onclick="var nonwin=navigator.appName!='Microsoft Internet
Explorer'?'yes':'no'; var certheight=screen.availHeight-90;
window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no');
return false;" class="rt-y"><img
src="https://c683207.ssl.cf2.rackcdn.com/13409-r.gif" style="border:
0" alt="" oncontextmenu="var d = new Date(); alert('Copying Prohibited
by Law - This image and all included logos are copyrighted by Shopper
Approved \251 '+d.getFullYear()+'.'); return false;" /></a>


 </div>
</div>
<div class="container">
  <div class="today-specials">
    <div class="middle-row">
      <div class="grid12">
        <h1><i class="star"></i>Today Business class Flights Specials</h1>
        <?= do_shortcode('[easy-pricing-table id="77"]'); ?>
      </div>
    </div>
  </div>
  
  <div class="top-destination">
    <div class="middle-row">
      <div class="grid12">
        <h4><i class="cost"></i><a href="/category/top-destinations/">Top Destinations</a></h4>
      </div>
      <div class="grid9">
     <?php build_i_world_map(1); ?></div><div class="grid3">
     <div class="dest-description">
     <h6>Find out our best airfares to any destination worldwide</h6>
     <p>Looking for pricing or additional information on our first class flight deals and business class airfare specials? Call us right now. </p>
     <span>800-818-2451</span>
     </div>
     </div>
    </div>
  </div>
  
  
  <div class="request-a-quote-block">
    <div class="middle-row">
      <div class="grid8">
        <p><i class="plane"></i>We <strong>Absolutely Guarantee</strong> The Lowest Fares <br>For
International First & Business Class Flights</p>
      </div>
      <div class="grid4"><a href="#rqform" class="scroll request_anchor">Reguest a Quote NOW!</a></div>
    </div>
  </div>
   <div class="as-seen-to-block">
    <div class="middle-row"><div class="grid12">
    <p>AS seen on</p>
    <ul news-comp-logos>
    <li><img src="/wp-content/themes/cheapfirstclasstheme/images/cnn.png" alt="cnn" /></li>
    <li><img src="/wp-content/themes/cheapfirstclasstheme/images/nbc.png" alt="nbc" /></li>
    <li><img src="/wp-content/themes/cheapfirstclasstheme/images/fox.png" alt="fox" /></li>
    <li><img src="/wp-content/themes/cheapfirstclasstheme/images/cbs.png" alt="cbs" /></li>
    <li><img src="/wp-content/themes/cheapfirstclasstheme/images/yahoo.png" alt="yahoo" /></li>
    <li><img src="/wp-content/themes/cheapfirstclasstheme/images/san-francisco-chronicle.png" alt="san-francisco-chronicle" /></li>
    </ul>
    </div></div>
    </div>
    
  <div class="latest-from-blog">
    <div class="middle-row">
      <div class="grid9">
        <h5><i class="blog"></i><a href="/category/top-destinations/">Top Destinations Countries</a></h5>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("latest-from-blog") ) : endif; ?>
      </div>
      <div class="grid3">
        <h5><i class="testimonials"></i><a href="/customer-testimonials/">Testimonials</a></h5>

        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("testimonial") ) : endif; ?>
      </div>
    </div>
  </div>
  
  
   <div class="front-page-text">
    <div class="middle-row">
  <div class="grid12">
   <h4><i class="star"></i>Cheap First Class - Who We Are?</h4>
  <?php $contact_drop = new WP_Query('pagename=/front-page-text/'); while ($contact_drop->have_posts()) : $contact_drop->the_post(); $do_not_duplicate = $post->ID; ?>
          <?php the_content(); ?>
          <?php endwhile; ?>
          </div>
       </div></div>   
</div>
</div>

<script type="text/javascript">
jQuery('a.request_anchor').click(function(){
    jQuery('html, body').animate({
        scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
    }, 500);
    return false;
});
</script>
<?php get_footer(); ?>
