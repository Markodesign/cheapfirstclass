<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>


<div class="clearing"></div>
<footer>
  <div class="top-line">
    <div class="middle-row"><?php echo build_lshowcase('none','airlines','inactive','normal','hcarousel','true','60','true,3000,true,false,500,10,true,false,true,1,20,1','0'); ?></div>
  </div>
  <div class="clearing"></div>
  <div class="middle-row">
    <div class="grid3 first-block"> <a href="/"><img src="/wp-content/themes/cheapfirstclasstheme/images/cheap-first-class-logo-footer.png" alt="Cheap First Class" /></a>
      <p class="phone">800 818 2451</p>


<div class="fb-like" data-href="/" data-width="200" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<p>&nbsp;</p>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="/">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
 <div class="g-plusone" data-href="/"></div>

    </div>
    <div class="grid5 second-block">
      <?php wp_nav_menu('menu=footer-menu'); ?>

<div class="menu-social-container"><ul class="menu" id="menu-social"><li class="fb menu-item menu-item-type-custom menu-item-object-custom menu-item-24" id="menu-item-24"><a href="https://www.facebook.com/CheapFirstClass" target="_blank">Facebook</a></li>
<li class="go menu-item menu-item-type-custom menu-item-object-custom menu-item-25" id="menu-item-25"><a href="https://plus.google.com/+Cheapfirstclassnow/about" target="_blank" rel="Publisher">google+</a></li>
<li class="yt menu-item menu-item-type-custom menu-item-object-custom menu-item-26" id="menu-item-26"><a href="https://www.youtube.com/channel/UCLDM_Uc2Mw34z2GvMv2DrCA" target="_blank">Youtube</a></li>
<li class="tw menu-item menu-item-type-custom menu-item-object-custom menu-item-27" id="menu-item-27"><a href="https://twitter.com/FirstClassTrips" target="_blank">Twitter</a></li>
</ul></div>

    </div>
    <div class="grid4 third-block">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("subscribe") ) : endif; ?>

    <p>Our Professional Affiliations:</p>
    <ul class="partners">
    <li><a href="#"><img src="/wp-content/themes/cheapfirstclasstheme/images/footer-partner-logo-1.png" alt="Cheap First Class" /></a></li>
    <li><a href="#"><img src="/wp-content/themes/cheapfirstclasstheme/images/footer-partner-logo-2.png" alt="Cheap First Class" /></a></li>
    <li><a href="#"><img src="/wp-content/themes/cheapfirstclasstheme/images/footer-partner-logo-3.png" alt="Cheap First Class" /></a></li>
    </ul>
    <p style="padding-bottom: 15px;" >CST License #: 2109760</p>

    </div>
  </div>
  <div class="bottom-line">
    <div class="middle-row">



      <p class="pp">First Class Trips LLC, 2014-2019 | <a href="/privacy-policy/">Privacy Policy</a></p>
    </div>
  </div>
</footer>

<?php
	wp_footer();
?>

<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */

var google_conversion_id = 969351608;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;

/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/969351608/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


</body></html>
