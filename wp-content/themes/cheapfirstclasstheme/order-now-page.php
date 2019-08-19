<?php
/**
 * Template Name: Order Now Template
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

?>
<!doctype html>
<html lang="en">
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-52520495-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-52520495-1');
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52520495-1', 'auto');
  ga('send', 'pageview');

</script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Cheap First Class</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=latin-ext"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/order-now/css/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri() ?>/order-now/css/slick-theme.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_template_directory_uri() ?>/order-now/css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/order-now/css/style.css?v=1"/>
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
</head>
<body>
<header>
    <div class="header-top">
        <div class="content small clearfix">
            <a href="/" class="logo">
                <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/logo.png" alt="logo">
            </a>
            <div class="callus">
                <p>Call us right now!</p>
                <a href="tel:800-818-2451">800-818-2451</a>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="content small">
            <div class="mobile-title">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <h3>navigation</h3>
            </div>
            <ul class="header-bottom-nav">
                <li class="active">
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="#">How to get cheap first class flights</a>
                </li>
                <li>
                    <a href="#">Business class flight deals</a>
                </li>
                <li>
                    <a href="#">Last minute flight specials</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<main>

    <div class="booking-form" id="request_holder">
        <div class="booking-form-big-title">
            <h1> Fly Business & First Class For Less </h1>
            <div class="airlines">
                <ul class="airlinesList">
                    <li class="airlinesList__item qatar"></li>
                    <li class="airlinesList__item emirates"></li>
                    <li class="airlinesList__item korean"></li>
                    <li class="airlinesList__item eva"></li>
                    <li class="airlinesList__item singapore"></li>
                    <li class="airlinesList__item cathay"></li>
                    <li class="airlinesList__item asiana"></li>
                    <li class="airlinesLabel and-others" red-dot="" data-text-id="ng-main-page-heading-2"><span class="red-dot-wrap">and others...</span></li>
                </ul>
            </div>
        </div>

        <div class="content small">
            <div class="form-wrapper">
                <div class="ubc">
                    <span>used by<br>company</span>
                </div>
                <div class="form-nav request_type">
                    <label for="roundtrip" class="js-roundtrip"><input type="radio" id='roundtrip' value="roundtrip"
                                                                       name="type" checked='checked'>Round Trip</label>
                    <label for="oneway" class="js-oneway"><input type="radio" id='oneway' value="oneway" name="type">One-way</label>
                    <label for="multy" class="js-multy"><input type="radio" id='multy' value="multicity" name="type">Multy-city</label>
                </div>
                <div class="form">
                    <div id="type_roundtrip" class="form-tab tab roundtrip">
                        <form autocomplete="off">
                            <div class="form-row form-fields">
                                <input type="hidden" name="action" value="send">
                                <input type="hidden" name="type" value="roundtrip">
                                <input type="text" class="faoc airport_autocomplete avf" name="from" autocomplete="off"
                                       placeholder="From Airport or City*">
                                <input type="text" class="faoc airport_autocomplete avf" name="to" autocomplete="off"
                                       placeholder="To Airport or City*">
                                <input type="text" class="datepicker depart avf" name="departure" value=""
                                       placeholder="Departure">
                                <input type="text" class="datepicker return avf" name="return" placeholder="Return">
                                <div class="input-dropdown">
                                    <div class="class-type"><span class="number">1</span>&nbsp&nbsp|&nbsp&nbsp<span
                                                class="type-class">Business</span></div>
                                    <div class="dropdown-menu">
                                        <div class="passengers clearfix">
                                            <span>Passengers</span>
                                            <input type="button" value="+" class="plus" id="plus1">
                                            <input type="text" size="25" name="traveler_count" value="1" class="count"
                                                   id="count1">
                                            <input type="button" value="-" class="minus" id="minus1">
                                        </div>
                                        <div class="cabin clearfix">
                                            <span>Cabin</span>
                                            <select name="cabin" id="cabin1">
                                                <option value="Business Class">Business</option>
                                                <option value="First Class">First</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="traveler_contacts form-row hidden">
                                  <div class="name-wrapper">
                                    <input type="text" class="faoc" name="name" placeholder="Name*">
                                  </div>
                                  <div class="email-wrapper">
                                    <input type="text" class="faoc" name="email" placeholder="E-mail*">
                                  </div>
                                  <div class="phone-wrapper">
                                    <input type="text" name="mobile" class="faoc rq_mobile" placeholder="Phone mobile*">
                                  </div>
                                </div>


                            </div>
                        </form>

                    </div>
                    <div id="type_oneway" class="form-tab tab oneway">
                        <form autocomplete="off">
                            <div class="form-row form-fields">
                                <input type="hidden" name="action" value="send">
                                <input type="hidden" name="type" value="oneway">
                                <input type="text" class="faoc airport_autocomplete avf " name="from" autocomplete="new-password"
                                       placeholder="From Airport or City*">
                                <input type="text" class="faoc airport_autocomplete avf" name="to" autocomplete="new-password"
                                       placeholder="To Airport or City*">
                                <input type="text" class="datepicker depart avf" placeholder="Departure" name="departure" >
<!--                                <input type="text" class="datepicker return avf" placeholder="Return">-->
                                <div class="input-dropdown">
                                    <div class="class-type"><span class="number">1</span>&nbsp&nbsp|&nbsp&nbsp<span
                                                class="type-class">Business</span></div>
                                    <div class="dropdown-menu">
                                        <div class="passengers clearfix">
                                            <span>Passengers</span>
                                            <input type="button" value="+" class="plus" id="plus2">
                                            <input type="text" size="25" value="1" name="traveler_count" class="count" id="count2">
                                            <input type="button" value="-" class="minus" id="minus2">
                                        </div>
                                        <div class="cabin clearfix">
                                            <span>Cabin</span>
                                            <select name="cabin" id="cabin2">
                                                <option value="Business Class">Business</option>
                                                <option value="First Class">First</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="traveler_contacts form-row hidden">
                                    <input type="text" class="faoc" name="name" placeholder="Name*">
                                    <input type="text" class="faoc" name="email" placeholder="E-mail*">
                                    <input type="text" name="mobile" class="faoc rq_mobile"
                                           placeholder="Phone mobile*">
                                </div>
                            </div>
                        </form>

                    </div>
                    <div id="type_multy" class="form-tab tab multy">
                        <form data-cityCount="0">
                            <div class="form-row form-fields">
                                <input type="hidden" name="action" value="send">
                                <input type="hidden" name="type" value="multy">
                                <div class="form-row block-multy-city">

                                    <input type="text" class="faoc airport_autocomplete avf" name="from" autocomplete="new-password"
                                           placeholder="From Airport or City*">
                                    <input type="text" class="faoc airport_autocomplete avf" name="to" autocomplete="new-password"
                                           placeholder="To Airport or City*">
                                    <input type="text" class="datepicker depart" placeholder="Departure" name="departure" value="">
                                    <button type="button" class="delete-row">&#x2715</button>
                                </div>

                                <div class="input-dropdown">
                                    <div class="class-type"><span class="number">1</span>&nbsp&nbsp|&nbsp&nbsp<span
                                                class="type-class">Business</span></div>
                                    <div class="dropdown-menu">
                                        <div class="passengers clearfix">
                                            <span>Passengers</span>
                                            <input type="button" value="+" class="plus" id="plus3">
                                            <input type="text" size="25" value="1" name="traveler_count" class="count" id="count3">
                                            <input type="button" value="-" class="minus" id="minus3">
                                        </div>
                                        <div class="cabin clearfix">
                                            <span>Cabin</span>
                                            <select name="cabin" id="cabin3">
                                                <option value="Business Class">Business</option>
                                                <option value="First Class">First</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="button" class="add-row">Add Multicity</button>
                            </div>



                            <div class="traveler_contacts form-row hidden" style="margin-top: 30px;">
                                <input type="text" class="faoc" name="name" placeholder="Name*">
                                <input type="text" class="faoc" name="email" placeholder="E-mail*">
                                <input type="text" name="mobile" class="faoc rq_mobile"
                                       placeholder="Phone mobile*">
                            </div>
                        </form>


                    </div>
                    <button type="submit" class="request" onclick="rq_sendRequest();return false;">Request a Quote NOW
                    </button>
                </div>
                <div class="form-footer clearfix">
                    <a class="hiw" href="#">How it works?</a>
                    <ul class="steps clearfix">
                        <li>1. Call Us Now <span>8000-818-2451</span></li>
                        <li>2. Get <span>The Best</span> Flight Deal!</li>
                        <li>3. Enjoy <span>Your Luxury</span> Flight!</li>
                    </ul>
                    <a class="shopper" href="#"><img
                                src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/shopper.jpg"
                                alt="shopper"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="business-class">
        <div class="content">
            <h2>Today Business class Flights Specials</h2>
            <div class="offers clearfix">
                <div class="offer-item">
                    <div class="title">
                        <h5>Europe</h5>
                    </div>
                    <div class="main-offer">
                        <p>Fares from <span>$2,440*</span></p>
                    </div>
                    <div class="offer-list">
                        <p>London from <span>$2,445*</span></p>
                        <p>Rome from <span>$2,478*</span></p>
                        <p>Zurich from <span>$2,569*</span></p>
                        <p>Frankfurt from <span>$2,585*</span></p>
                        <p>Paris from <span>$2,590*</span></p>
                    </div>
                </div>
                <div class="offer-item">
                    <div class="title">
                        <h5>Asia</h5>
                    </div>
                    <div class="main-offer">
                        <p>Fares from <span>$2,850*</span></p>
                    </div>
                    <div class="offer-list">
                        <p>Bangkok from <span>$2,860*</span></p>
                        <p>Seoul from <span>$2,870*</span></p>
                        <p>Beijing from <span>$2,882*</span></p>
                        <p>Hong Kong from <span>$2,890*</span></p>
                        <p>Tokyo from <span>$2,950*</span></p>
                    </div>
                </div>
                <div class="offer-item">
                    <div class="title">
                        <h5>Africa</h5>
                    </div>
                    <div class="main-offer">
                        <p>Fares from <span>$4,175*</span></p>
                    </div>
                    <div class="offer-list">
                        <p>Accara from <span>$4,190*</span></p>
                        <p>Lagos from <span>$4,299*</span></p>
                        <p>Abuja from <span>$4,370*</span></p>
                        <p>Dar es Salaam from <span>$4,680*</span></p>
                        <p>Johannesburg from <span>$4,873*</span></p>
                    </div>
                </div>
                <div class="offer-item">
                    <div class="title">
                        <h5>Asia</h5>
                    </div>
                    <div class="main-offer">
                        <p>Fares from <span>$2,850*</span></p>
                    </div>
                    <div class="offer-list">
                        <p>Bangkok from <span>$2,860*</span></p>
                        <p>Seoul from <span>$2,870*</span></p>
                        <p>Beijing from <span>$2,882*</span></p>
                        <p>Hong Kong from <span>$2,890*</span></p>
                        <p>Tokyo from <span>$2,950*</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="destinations">
        <div class="content clearfix">
            <div class="dest-item clearfix">
                <div class="dest-item--block --big">
                    <h2>Top Destinations</h2>
                    <p>Find out our best airfares to any destination worldwide</p>
                    <p class="small">Looking for pricing or additional information on our first class flight deals and
                        business class airfare specials? <span>Call us right now. </span><a href="tel:800-818-2451">800-818-2451</a>
                    </p>
                </div>
                <div class="dest-item--block --big">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-1.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>Hong Kong</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
                <div class="dest-item--block --small">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-4.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>Dubai</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
                <div class="dest-item--block --small">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-5.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>Tokyo</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
            </div>
            <div class="dest-item">
                <div class="dest-item--block --small">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-2.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>Sydney</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
                <div class="dest-item--block --small">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-3.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>London</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
                <div class="dest-item--block --small">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-6.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>Paris</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
                <div class="dest-item--block --small">
                    <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/destination-7.jpg"
                         alt="destination">
                    <div class="hover-block">
                        <h6>Seoul</h6>
                        <button class="js-request-but">Request a Quote NOW</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lowest-fare">
        <div class="content clearfix">
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/plane.png" alt="plane">
            <p>We <span>Absolutely Guarantee</span> The Lowest Fares For International First & Business Class Flights
            </p>
            <button class="js-request-but">Request a Quote NOW</button>
        </div>
    </div>
    <div class="news-block">
        <div class="content">
            <span>AS seen on</span>
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/news-1.png" alt="news">
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/news-2.png" alt="news">
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/news-3.png" alt="news">
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/news-4.png" alt="news">
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/news-5.png" alt="news">
            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/news-6.png" alt="news">
        </div>
    </div>
    <div class="destination-countries">
        <div class="content">
            <h2>Top Destinations Countries</h2>
            <div class="countries-block">
                <div class="country-item">
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/top-countries-1.jpg"
                             alt="">
                        <div class="item-info">
                            <p>Cheap business class flights to Sydney</p>
                        </div>
                    </div>
                    <p>Australia’s economy is strong and stable, which means that the business environment in this
                        country is thriving. Sydney is the capital of the business and financial life in Australia… <a
                                href="#">read more</a></p>
                </div>
                <div class="country-item">
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/top-countries-2.jpg"
                             alt="">
                        <div class="item-info">
                            <p>Delta One Business Class Food Review</p>
                        </div>
                    </div>
                    <p>There are several ways to highlight the benefits of a trip in the business class. Passengers that
                        choose the premium services in the air want to punctuate their status and enjoy… <a href="#">read
                            more</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials">
        <div class="content">
            <h2>Clients Testimonials</h2>
            <div class="clients-slider">
                <div class="clients-item">
                    <div class="client-text">
                        <p>A Ori,<br>I'm always traveling overseas<br>Lana customized for me all my trips like my
                            personal assistant<br>at the right price with the best fly.<br>She is awesome!!</p>
                    </div>
                    <div class="client-name">
                        <h6>Andrea Ori</h6>
                    </div>
                    <div class="client-photo">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/client-1.png"
                             alt="client">
                    </div>
                </div>
                <div class="clients-item">
                    <div class="client-text">
                        <p>I'm very happy with the service and the deals I get from Max! Even last minute! I recently
                            stopped using my previous wholesale flight provider because the service, prices and
                            availability of the right flights has greatly improved since switching over! I appreciate
                            Max always being available to take my emails or calls. Keep up the good work!</p>
                    </div>
                    <div class="client-name">
                        <h6>Susan</h6>
                    </div>
                    <div class="client-photo">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/client-2.png"
                             alt="client">
                    </div>
                </div>
                <div class="clients-item">
                    <div class="client-text">
                        <p>A Ori,<br>I'm always traveling overseas<br>Lana customized for me all my trips like my
                            personal assistant<br>at the right price with the best fly.<br>She is awesome!!</p>
                    </div>
                    <div class="client-name">
                        <h6>Andrea Ori</h6>
                    </div>
                    <div class="client-photo">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/client-1.png"
                             alt="client">
                    </div>
                </div>
                <div class="clients-item">
                    <div class="client-text">
                        <p>I'm very happy with the service and the deals I get from Max! Even last minute! I recently
                            stopped using my previous wholesale flight provider because the service, prices and
                            availability of the right flights has greatly improved since switching over! I appreciate
                            Max always being available to take my emails or calls. Keep up the good work!</p>
                    </div>
                    <div class="client-name">
                        <h6>Susan</h6>
                    </div>
                    <div class="client-photo">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/client-2.png"
                             alt="client">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-us">
        <div class="content small">
            <h2>Cheap First Class - Who We Are?</h2>
            <p>When it comes to international airfares, customers often look for advantageous deals. cheapfirstclass.com
                is ready to help you! Our main aim is to minimize your expenses and <span>maximize the satisfaction from your flight!</span>
            </p>
        </div>
    </div>
    <div class="partners">
        <div class="content js-partners">
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-1.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-2.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-3.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-4.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-5.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-1.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-2.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-3.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-4.png"
                        alt="partner"></div>
            <div class="partners-img"><img
                        src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/partners-5.png"
                        alt="partner"></div>
        </div>
    </div>
    <div class="recent-posts">
        <div class="content content-flex">
            <div class="flex--item">
                <h3>Recent Posts</h3>
                <ul>
                    <li><a href="http://cheapfirstclass.com/5-best-business-class-flights-to-europe-in-2017/">5 Best
                            Business Class Flights to Europe in 2017</a></li>
                    <li><a href="http://cheapfirstclass.com/get-compensation-if-you-sick-on-holiday-in-uk/">How to get
                            compensation if you sick on holiday in the UK</a></li>
                </ul>
            </div>
            <div class="flex--item">
                <ul>
                    <li><a href="http://cheapfirstclass.com/best-business-class-seats-on-cathay-pacific/">Best business
                            class seats on Cathay Pacific</a></li>
                    <li><a href="http://cheapfirstclass.com/how-to-upgrade-to-business-class-on-american-airlines/">How
                            to
                            Upgrade To Business Class on American Airlines</a></li>
                    <li><a href="http://cheapfirstclass.com/how-to-get-upgraded-to-first-class-on-delta/">How to Get
                            Upgraded To First Class On Delta</a></li>
                    <li><a href="http://cheapfirstclass.com/15-ways-how-to-get-upgrade-to-business-class-emirates/">15
                            Ways
                            How to Get Upgrade to Business Class Emirates</a></li>
                </ul>
            </div>
            <div class="flex--item">
                <ul>
                    <li><a href="http://cheapfirstclass.com/cathay-pacific-first-class-777-300er-review-in-2017/">Cathay
                            Pacific First Class 777-300er Review in 2017</a></li>
                    <li><a href="http://cheapfirstclass.com/delta-one-lounge-review/">Delta One Lounge Review</a></li>
                    <li><a href="http://cheapfirstclass.com/2017-review-of-cathay-pacific-business-class/">2017 Review
                            of
                            Cathay Pacific Business Class</a></li>
                    <li><a href="http://cheapfirstclass.com/2017-review-of-emirates-airbus-a380-business-class/">2017
                            Review
                            of Emirates Airbus A380 Business Class</a></li>
                </ul>
            </div>

            <ul>


            </ul>

        </div>
    </div>
</main>

<footer>
    <div class="footer -top">
        <div class="content content-flex">
            <div class="flex--item">
                <div class="first-content">
                    <a href="/">
                        <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/footer-logo.png"
                             alt="footer-logo">
                    </a>
                    <div class="callus-footer">
                        <span>Call us</span>
                        <a href="tel:800-818-2451">800-818-2451</a>
                    </div>
                    <div class="soc-icons">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/soc-google.png"
                                 alt="google+">
                        </a>
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/soc-facebook.png"
                                 alt="facebook">
                        </a>
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/soc-yt.png"
                                 alt="youtube">
                        </a>
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/soc-twitter.png"
                                 alt="twitter">
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex--item">
                <div class="middle-content">
                    <h4>Navigations</h4>


                    <?php wp_nav_menu('menu=footer-menu'); ?>

                </div>
            </div>
            <div class="flex--item">
                <div class="last-content">
                    <form action="" method="post">
                        <input type="email" name="email" placeholder="Enter your e-mail">
                        <input type="submit">
                        <div class="play"></div>
                    </form>
                    <h4>Our professional Affiliations:</h4>
                    <div class="affiliations">
                        <a href="#"><img
                                    src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/affiliate-1.png"
                                    alt="affiliations"></a>
                        <a href="#"><img
                                    src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/affiliate-2.png"
                                    alt="affiliations"></a>
                        <a href="#"><img
                                    src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/affiliate-3.png"
                                    alt="affiliations"></a>
                        <a href="#"><img
                                    src="<?php echo get_template_directory_uri() ?>/order-now/resources/images/affiliate-4.png"
                                    alt="affiliations"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer -bottom">
        <div class="content">
            <p>CheapFirstClass.com 2014-<?php echo date('Y'); ?> All Rights Reserved
                &nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</p>
            <a href="#">Privacy Policy</a>
        </div>
    </div>
</footer>


<script type="text/javascript"
        src="<?php echo get_template_directory_uri() ?>/order-now/js/jquery-1.11.3.min.js"></script>

<script type="text/javascript"
        src="<?php echo get_template_directory_uri() ?>/order-now/js/slick/slick.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/order-now/js/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/order-now/js/main.js?a=1as<?= rand(100, 10000); ?>"></script>

<script type="text/javascript"
        src="<?php echo get_template_directory_uri() ?>/request/request.js?a=1as<?= rand(100, 10000); ?>"></script>

</body>
</html>