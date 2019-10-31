<?php
/**
 * Template Name: Contact Page Template
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

get_header();
?>

<div class="mapp">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3159.6753379518823!2d-122.42290260000003!3d37.633324!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f79c18d989b63%3A0xf509963e5cdaeb0a!2s1051+National+Ave+%23326!5e0!3m2!1sru!2sua!4v1403768261200" width="100%" height="350" frameborder="0" style="border:0" scrolling="no"></iframe>

 </div>
<div class="container inside">
  <div id="container">
    <div id="content" role="main">
      <div class="middle-row">
        <div class="grid12">
          <?php
			get_template_part( 'loop', 'page' );
			?>
        </div>

      </div>
    </div>
    <!-- #content --> 
  </div>
  <!-- #container --> 
</div>
</div>
<?php get_footer(); ?>
