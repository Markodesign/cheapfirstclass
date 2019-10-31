<?php
/**
 * Template Name: Main Page A/B Template - 1
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

    //wp_enqueue_script('request', get_template_directory_uri() . '/request/request.js?v=100');
    wp_enqueue_script('maskedinput', '/wp-includes/js/jquery/jquery.maskedinput.min.js');
}
add_action('wp_enqueue_scripts', 'request_scripts');



get_header('template_1');


?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">

<link rel="stylesheet"  href="/wp-content/themes/cheapfirstclasstheme/css/template_1.css?v=2342344535435" type="text/css" media="all">
<script type="text/javascript" src="/wp-content/themes/cheapfirstclasstheme/js/template_1.js?v=3334543543543543"></script>

<div class="b-popup" style="display: none" >
    <div class="b-popup-content">
        <a href="/">x</a>
        <div style="clear: both"></div>
        <div>Unfortunately, we offer only long-haul flights.</div>
    </div>
</div>


<div class="slider" id="rqform">

    <!-- HEADER -->
    <header>
        <div class="middle-row">
            <div class="logo">
                <a href="/"><img src="/wp-content/themes/cheapfirstclasstheme/images/template_1/logo.png" alt="Cheap First Class" /></a>
            </div>
            <div class="telHeader">800 818 <span>2451</span></div>
            <div class="headerMainMenu">
                <div><a href="/">Home</a></div>
                <div><a href="">Blog</a></div>
                <div><a href="">Contact</a></div>
                <div><a href="">More</a></div>
            </div>

        </div>
    </header>

    <div class="afterlogo_block"><img src="/wp-content/themes/cheapfirstclasstheme/images/template_1/find.png" alt="Cheap First Class" /></div>

    <div class="orderForm">
            <?php slider(1) ?>
            <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css' type='text/css' media='all' />

          <div class="middle-row new-home-page-1">


              <div id="request_holder" class="tab">

                  <div class="content-fr" id="type_roundtrip">
                      <form autocomplete="off" id="submitTripForm">
                      <div class="request_type">
                          <div class="custom-select round-trip-select">
                              <select name="type" id="select_round_trip">
                                  <option value="roundtrip">Round-trip</option>
                                  <option value="roundtrip">Round-trip</option>
                                  <option value="oneway">One-way</option>
                                  <option value="multicity">Multi-city</option>
                              </select>
                          </div>

                          <div class="custom-select traveler-select">
                              <select class="traveler_count" name="traveler_count">
                                  <option value="1">1 Traveller</option>
                                  <option value="1">1 Traveller</option>
                                  <option value="2">2 Travellers</option>
                                  <option value="3">3 Travellers</option>
                                  <option value="4">4 Travellers</option>
                                  <option value="5">5 Travellers</option>
                                  <option value="6">6 Travellers</option>
                              </select>
                          </div>

                          <div class="custom-select cabin-select">
                              <select class="cabin" name="cabin">
                                  <option value="Business Class">Business Class</option>
                                  <option value="Business Class">Business Class</option>
                                  <option value="First Class">First Class</option>
                              </select>
                          </div>

                      </div>
                      <div>

                              <input type="hidden" autocomplete="false"   name="action" value="send" />
                              <input type="hidden" autocomplete="false"  name="type" value="roundtrip" />

                              <div class="airportfrom-wrapper input-wrapper">
                                <input type="text" id="airport_from"  autocomplete="false" name="from" class="airport_autocomplete avf" placeholder="From Airport or City*" />
                              </div>
                              <div class="airportto-wrapper input-wrapper">
                                  <input type="text" id="airport_to" autocomplete="false"  name="to" class="airport_autocomplete avf" placeholder="To Airport or City*" />
                              </div>
                                  <div class="date-wrapper input-wrapper">
                                  <input type="text" autocomplete="false" name="departure" class="rq_datepicker avf" placeholder="Departure" />
                              </div>
                              <div class="date-wrapper input-wrapper">
                                  <input type="text" autocomplete="false" name="return" class="rq_datepicker avf" placeholder="Return" />
                              </div>

                              <div class="content-bt">
                                  <div id="send_button_holder">
                                      <input type="button" class="send_request" onclick="rq_sendRequest();" value="Order now!" />
                                      <div class="sending_wait"></div>
                                  </div>

                              </div>

                              <div style="clear: both;"></div>
                              <div class="traveler_contacts" style="display: none">
                                  <div class="name-wrapper input-wrapper">
                                      <input type="text" autocomplete="false" name="name" placeholder="Name*" />
                                  </div>
                                  <div class="email-wrapper input-wrapper">
                                      <input type="text" autocomplete="false" name="email" placeholder="E-mail*" />
                                  </div>
                                  <div class="phone-wrapper input-wrapper">
                                      <input type="text" autocomplete="false" name="mobile" class="rq_mobile" placeholder="Phone mobile*" />
                                  </div>
                              </div>
                              <div style="clear: both;"></div>

                      </div>
                      </form>
                  </div>
                  <div class="after-message" style="display:none;">
                      <div class="left-message-block"><p class="blue-text">Thank You! Your Reference Number: <strong id="reference"></strong></p><br>
                          <p>Our Travel Specialist will process<br>your request and contact you ASAP</p>
                          <p><a style="cursor:pointer;" onclick="jQuery('.fancybox-close-small').click();" class="mess-btn">Another Quote Request</a></p>
                          <p>If you need additional assistance or have any questions, please call</p>
                      </div>

                      <a href="tel:8008182451" class="telMobile">800 818 2451</a>

                      <div class="right-message-block">
                          <img src="/wp-content/themes/cheapfirstclasstheme/images/support-girl.png" alt="800-818-2451" class="support-girl"/>
                      </div>
                  </div>
              </div>



          </div>

    </div>
</div>

