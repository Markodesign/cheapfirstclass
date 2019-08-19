<?php
/**
 * Template Name: Main Page Template NEW
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

wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

wp_enqueue_script('jquery-ui-autocomplete', '', array('jquery-ui-widget', 'jquery-ui-position'), '1.8.6');


function request_scripts()
{

    wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js?v=100');
    wp_enqueue_script('maskedinput', '/wp-includes/js/jquery/jquery.maskedinput.min.js');
}
add_action('wp_enqueue_scripts', 'request_scripts');
get_header();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="b-popup" style="display: none" >
    <div class="b-popup-content">
        <a href="/">x</a>
        <div style="clear: both"></div>
        <div>Unfortunately, we offer only long-haul flights.</div>
    </div>
</div>
<style>
    .b-popup{
        width:100%;
        min-height:100%;
        background-color: rgba(0,0,0,0.5);
        overflow:hidden;
        position:fixed;
        top:0;
        font-size:22px;
        font-weight: bold;
        color: #000000;
        text-align: center;
        z-index: 1000;
    }
    .b-popup .b-popup-content{
        margin:40px auto 0px auto;
        width:300px;
        height: 200px;
        padding:10px;
        background-color: #fff;
        /*border-radius:5px;*/
        box-shadow: 0px 0px 10px #000;
    }
    .b-popup .b-popup-content a {
        color: green;
        display: block;
        float: right;
        margin-right: 10px;
        font-weight: normal;
        font-size: 18px;
    }
</style>
<div class="slider" id="rqform">

  <div class="mobile-home-block">
    <a class="mobile-number" href="tel:8008182451">800 818 2451</a>
    <p class="mobile-message">Don't wait! Sale ends soon. <a href="#">Book now</a></p>
  </div>

  <?php slider(1) ?>
    <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css' type='text/css' media='all' />
  <!--<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/request/request.js?<?php echo time(); ?>'> </script>-->
  <div class="middle-row">
  <?php
    require_once 'request/Request.class.php';
    $request = new Request();
    echo $request->buildForm();
  ?>
<!--<a href="https://www.shopperapproved.com/reviews/cheapfirstclass.com/"-->
<!--onclick="var nonwin=navigator.appName!='Microsoft Internet-->
<!--Explorer'?'yes':'no'; var certheight=screen.availHeight-90;-->
<!--window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no');-->
<!--return false;" class="rt-y"><img-->
<!--src="https://c683207.ssl.cf2.rackcdn.com/13409-r.gif" style="border:-->
<!--0" alt="" oncontextmenu="var d = new Date(); alert('Copying Prohibited-->
<!--by Law - This image and all included logos are copyrighted by Shopper-->
<!--Approved \251 '+d.getFullYear()+'.'); return false;" /></a>-->


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
        <img id='map' src="https://cheapfirstclass.com/wp-content/uploads/2016/05/123.jpg" width="100%" alt="top destinations for business class flights" />
     <?php //build_i_world_map(1); ?>
   </div>
<!--   <div class="mobile-destination">-->
<!--   	<div class="destination-item kong">-->
<!--		<span class="label">hong kong</span>-->
<!--	</div>-->
<!--	<div class="destination-item zurich">-->
<!--		<span class="label">zurich</span>-->
<!--	</div>-->
<!--	<div class="destination-item sydney">-->
<!--		<span class="label">sydney</span>-->
<!--	</div>-->
<!--	<div class="destination-item london">-->
<!--		<span class="label">london</span>-->
<!--	</div>-->
<!--	<div class="destination-item paris">-->
<!--		<span class="label">paris</span>-->
<!--	</div>-->
<!--   </div>-->
   <div class="grid3">
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

<h2>Recent Posts</h2>
<ul>
<?php
	$recent_posts = wp_get_recent_posts();
	foreach( $recent_posts as $recent ){
		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
	}
	wp_reset_query();
?>
</ul>


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
if (jQuery(window).width() < 767) {
    jQuery(".airport_autocomplete[name^=from]").attr("placeholder","From");
    jQuery(".airport_autocomplete[name^=to]").attr("placeholder","To");
}
</script>
<?php get_footer(); ?>
