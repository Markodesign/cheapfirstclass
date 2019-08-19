<?php
/*
Template Name: Template for city page
*/
?>
<?php
    get_header();
?>

<div id="container">
    <div id="content" role="main">

        <?php
        /* Run the loop to output the posts.
         * If you want to overload this in a child theme then include a file
         * called loop-index.php and that will be used instead.
         */
        get_template_part( 'city', 'page' );
        ?>

    </div><!-- #content -->
</div><!-- #container -->


<?php get_footer(); ?>
