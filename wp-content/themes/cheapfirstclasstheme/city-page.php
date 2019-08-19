<?php
/**
 * Template Name: Template for city page
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

    wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js?v=98');
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

table.specials {background-color:#ffaa4e!important;width:100%;font-family:"Open Sans";font-size:22px;font-weight:300;color:#fff}
table.specials td{padding:20px}
table.specials h3{color:#fff!important}

.front-page-text ul{margin:0 0 0 40px!important}
.front-page-text li{padding:5px 0 5px 0!important;list-style-type:circle!important}

table.soldtickes {background-color:#ffaa4e!important;width:100%;font-family:"Open Sans";font-size:22px;font-weight:300;color:#fff}
table.soldtickes td{padding:20px;border-bottom:1px solid #ccc!important}
table.soldtickes h3{color:#fff!important}

.front-page-text {font-weight:400!important;color:#333!important;font-size:16px!important}
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






    <div class="front-page-text">
        <div class="middle-row">
            <div class="grid12">

                <?php
                // TO SHOW THE PAGE CONTENTS
                while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
                    <div class="entry-content-page">
                        <?php the_content(); ?> <!-- Page Content -->
                    </div><!-- .entry-content-page -->

                <?php
                endwhile; //resetting the page loop
                wp_reset_query(); //resetting the page query
                ?>
            </div>
        </div>
    </div>

</div>
</div>
<?php
$pagename = get_the_title();
?>

<script type="text/javascript">
    jQuery('#airport_from').val('<?php echo $pagename;?>');

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
