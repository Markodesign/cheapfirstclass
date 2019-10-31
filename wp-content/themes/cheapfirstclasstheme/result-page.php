<?php
session_start();
if(!empty($_REQUEST['template_page']) or !empty($_SESSION['template_page'])){



    if($_REQUEST['template_page']==1 or $_SESSION['template_page']==1){
        $_SESSION['template_page'] = 1;

        include_once('main-page_1.php');
    }
}else {
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
    wp_enqueue_style('jquery-style', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
    function request_scripts()
    {
        wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js');
        wp_enqueue_script('maskedinput', '/wp-includes/js/jquery/jquery.maskedinput.min.js');
        wp_enqueue_script('jquery-ui', '//code.jquery.com/ui/1.11.4/jquery-ui.js');
    }

    add_action('wp_enqueue_scripts', 'request_scripts');
    get_header(); ?>
    <style>
        .slider {
            height: unset;
        }
    </style>
    <!--sssssssss-->
    <div class="slider" id="rqform">
        <?php slider(1) ?>

        <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css' type='text/css'
              media='all'/>


        <div class="middle-row">


            <?php
            require_once 'wp-content/themes/cheapfirstclasstheme/request/Request.class.php';
            $request = new Request();
            echo $request->buildForm();

            if (!empty($_GET['search'])) {
                ?>

                <!--    <link rel="stylesheet" href="/wp-content/themes/cheapfirstclasstheme/jquery.fancybox.min.css" />-->
                <!--    <script src="/wp-content/themes/cheapfirstclasstheme/jquery.fancybox.min.js"></script>-->
                <!---->
                <!--    <script>-->
                <!--        jQuery(document).ready(function($) {-->
                <!--            $.fancybox.open({-->
                <!--                src: '#flyboardholder',-->
                <!--                type: 'inline',-->
                <!--                buttons: ["close"]-->
                <!--            });-->
                <!--        });-->
                <!--    </script>-->
                <!---->
                <!---->
                <!--    <div id="flyboardholder" style="display: none">-->
                <!--        <div class='flightboard middle-row'>-->
                <!--            <div class='fl-header'>-->
                <!--                <h3>Request complete</h3><br/><br/>-->
                <!--                <h1 id='offers-count'>Thank You for your request! Your Reference Number: <b>--><?php //if(!empty($_SESSION['reference']))echo $_SESSION['reference']
                ?><!--</b>. <br /> <span>Our Travel Specialist will process your request and contact you ASAP</span></h1>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <?php
            }

            ?>

        </div>
    </div>
    <?php
}?>
    <div class="container">
        <?php
        //print_r($_SESSION['reference']);
        ?>
    </div>
    </div>

    <link rel="stylesheet" href="/wp-content/themes/cheapfirstclasstheme/jquery.fancybox.min.css"/>
    <script src="/wp-content/themes/cheapfirstclasstheme/jquery.fancybox.min.js"></script>

    <script type="text/javascript">
        jQuery('a.request_anchor').click(function () {
            jQuery('html, body').animate({
                scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top
            }, 500);
            return false;
        });

        <?php if($_SESSION['reference']){?>

        jQuery(document).ready(function ($) {
            $('#reference').html('<?php echo $_SESSION['reference']?>');
            //$('#request_holder .after-message').fadeIn(500);

            $.fancybox.open({
                src: '#request_holder .after-message',
                type: 'inline',
                buttons: ["close"]
            });

        });

        <?php }?>

    </script>
    <?php get_footer(); ?>

