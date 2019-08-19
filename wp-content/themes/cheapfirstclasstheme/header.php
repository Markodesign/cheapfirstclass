<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<!DOCTYPE html>
<html id="ls-global" lang="en-US">
<head>
<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='88146701-0',d=document,l=d.location,c=d.cookie;
if(l.search.indexOf('utm_expid='+k)>0)return;
function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
</script><script>utmx('url','A/B');</script>
<!-- End of Google Analytics Content Experiment code -->

<meta charset="utf-8" />
<meta name="google-site-verification" content="KNOLwHSgj0SYI2NNnpbCC_Mmf7jGme5rb0Kk6Gg_-r8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if( is_front_page() ) {echo '<meta name="description" content="SAVE UP TO 72% with us!
Call or request free quote online for best first or business class flight deals now. Cheap international flight tickets to any destination worldwide." >';}
?>
<title>
<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	?>
</title>

<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link id="page_favicon" href="/favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" media="all" href="/wp-content/themes/cheapfirstclasstheme/style.css" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/cheapfirstclasstheme/images/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/cheapfirstclasstheme/images/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/cheapfirstclasstheme/images/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="/wp-content/themes/cheapfirstclasstheme/images/apple-touch-icon-57-precomposed.png">

<!--[if lt IE 9]> <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
<?php
	wp_head();
?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52520495-1', 'auto');
  ga('send', 'pageview');

</script>

<script>
function isGoogleChrome() {
return /chrome/.test(navigator.userAgent.toLowerCase());
};
jQuery(document).ready(function() {
    jQuery('input').attr('autocomplete', isGoogleChrome() ? 'disabled' :  'off');
});
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter37374700 = new Ya.Metrika({
                    id:37374700,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37374700" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script type='text/javascript'>
window.__wtw_lucky_site_id = 11672;

 (function() {
  var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
  wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://cdn') + '.luckyorange.com/w.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
   })();
 </script>

<script async src="https://apis.google.com/js/platform.js" defer></script>


<script type='text/javascript'>
window.__wtw_lucky_site_id = 29533;

 (function() {
  var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
  wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://cdn') + '.luckyorange.com/w.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
   })();
 </script>

<script type='text/javascript'>
window.__lo_site_id = 25351;

	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	  })();
	</script>


<script type='text/javascript'>
window.__lo_site_id = 25351;

	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	  })();
	</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1696994053909977');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1696994053909977&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
    <style>
        input[type='text']{
            text-align: left !important;
        }
    </style>
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- HEADER -->
<header>
  <div class="middle-row">
    <div class="grid3 logo"><a href="/"><img src="/wp-content/themes/cheapfirstclasstheme/images/cheap-first-class-logo.png" alt="Cheap First Class" /></a><a href="https://cheapfirstclass.com">
      <h2>CheapFirstClass</h2>
      </a></div>
    <div class="grid3 description">
      <p>Find out our Best International <br><strong>First & Business Class </strong><br>
        Airfare Deals to any Destination</p>
    </div>
    <div class="grid4 phone">800 818 2451</div>
    <div class="grid2 certif" id="block_logo_header">
      <div class="ubc">US Based <br>
        Company</div>

<a target="_blank" id="bbblink" class="sehzbus" href="https://www.bbb.org/greater-san-francisco/business-reviews/online-travel-agency/flybusinesscheapcom-in-san-bruno-ca-451517#bbbseal" title="CheapFirstClass.com, Online Travel Agency, San Bruno, CA" style="display: block;position: relative;overflow: hidden; width: 100px; height: 38px; margin: 0px; padding: 0px;"><img style="padding: 0px; border: none;" id="bbblinkimg" src="https://seal-goldengate.bbb.org/logo/sehzbus/flybusinesscheapcom-451517.png" width="200" height="38" alt="FlyBusinessCheap.com, Online Travel Agency, San Bruno, CA" /></a><!--script type="text/javascript">var bbbprotocol = ( ("https:" == document.location.protocol) ? "https://" : "https://" ); document.write(unescape("%3Cscript src='" + bbbprotocol + 'seal-goldengate.bbb.org' + unescape('%2Flogo%2Fflybusinesscheapcom-451517.js') + "' type='text/javascript'%3E%3C/script%3E"));</script-->

</div>
  </div>
</header>
<nav>
  <div class="middle-row">
    <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
  </div>
</nav>

  <div class="request-a-quote-block invis">

    <div class="middle-row">
      <div class="grid4"><a href="#primary" class="scroll">Reguest a Quote NOW!</a></div>
    </div>
  </div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var logo = document.querySelector('header .logo a');
        var ubc = document.querySelector('#block_logo_header');
        var mobileHeader = document.getElementById('sdrn_bar');
        var mobileLogo = logo.cloneNode(true);
        mobileHeader.appendChild(mobileLogo);

        var mobileubc = ubc.cloneNode(true);
        mobileHeader.appendChild(mobileubc);
    });
</script>