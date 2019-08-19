<?php
/**
 * Template Name: Unsubscribe Template
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
get_header(); ?>

	<div id="container">
		<div id="content" role="main">

			<div style="min-height:500px;text-align: center;">
                <div style="margin-top: 30px;font-size: 25px;font-weight: bold;">
                    <?php if ($_REQUEST['rq_name']){?>
                        Hi <?php echo $_REQUEST['rq_name']; ?>,  you are unsubscribed!
                    <?php } else{?>
                        Some error.
                    <?php }?>
                </div>

            </div>

		</div><!-- #content -->
	</div><!-- #container -->


<?php get_footer(); ?>