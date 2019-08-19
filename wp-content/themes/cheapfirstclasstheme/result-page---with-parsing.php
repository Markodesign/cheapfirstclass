<?php
session_start();
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
get_header();?>

<div class="slider" id="rqform">
  <?php slider(1) ?>
    <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css' type='text/css' media='all' />
  <!--<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/request/request.js?<?php echo time(); ?>'> </script>-->
<div class="middle-row">
  <?php
    require_once 'wp-content/themes/cheapfirstclasstheme/request/Request.class.php';
    $request = new Request();
    echo $request->buildForm();

if(!empty($_GET['search'])){
?>
<div id="flyboardholder">
	<div class='flightboard middle-row'>

		<div class='fl-header'>

			<div class="fl-container">

  			<div id='search-status' class="fl-search-count"><span id='searchstatus'></span><br><span id='allresults'>Request complete</span></div>

  			<h1 id='offers-count'>Thank You for your request! Your Reference Number: <b><?php if(!empty($_SESSION['reference']))echo $_SESSION['reference']?></b>. <br /> <span>Our Travel Specialist will process your request and contact you ASAP</span></h1>
			</div>

		</div>

	</div>

</div>
<?php
}else

if(isset($_SESSION['request'])){?>

<div id="flyboardholder">
	<div class='flightboard middle-row'>

		<div class='fl-header'>

			<div class="fl-container">

  			<div id='search-status' class="fl-search-count"><span id='searchstatus'><span id='sm-loader'></span></span><br><span id='allresults'>searching for</span> results</div>

  			<h1 id='offers-count'><div id='ld-report'>SEARCHING...<div id="ld-status">Start search engine</div></div></h1>
			</div>
      <div id="progressbar"></div>
		</div>

		<div id="flyboardcontent"></div>

	</div>

</div>

	  <script>

		  jQuery(function($){

			  sendRequest();
		  })

	  </script>
<?php }?>

 </div>
</div>
<div class="container">

</div>
</div>

<script type="text/javascript">
jQuery('a.request_anchor').click(function(){
    jQuery('html, body').animate({
        scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
    }, 500);
    return false;
});

function flyboard(data){

		allresults += parseInt(data.allresults) || 0;

		allresultswrap.text(allresults);

		offerscount = data.bestresults;

		flyboardcontent.html(tmpl(data));
		container.height(flyboardholder.height());

	}

function sendRequest(){

	jQuery.get('/api/get_data.php');

	var k = 0;

					inter = setInterval(function(){
						jQuery.ajax({
						    type: "get",
						    url: "/api/index.php",
						    dataType: "json",
						    success: function(data) {

							    if(data.data=='empty'){
							       console.log('empty');
							    }else

							    if(data.data){
							      loader.hide();
                    //clearInterval(statuses)
							      flyboard(data.data);
							    }
							    k++;
								if(data.status=='done' || k>40){
									loader.hide();
                  clearInterval(statuses);
									if(data.data){
                    offerscountwrap.html("Thank You for your request! Your Reference Number: <b><?php if(!empty($_SESSION['reference']))echo $_SESSION['reference']?></b>. <br /> <span>Our Travel Specialist will process your request and contact you ASAP</span>");
										flyboard(data.data);
									}else{
                    offerscountwrap.html("Thank You for your request! Your Reference Number: <b><?php if(!empty($_SESSION['reference']))echo $_SESSION['reference']?></b>. <br /> <span>Searching took more time as usual, that's why we will contact with you as soon as possible</span>");
                  }

                  progressbar.progressbar( "value", 100);
                  clearInterval(progress);

									jQuery('#searchstatus').text('Search complete');
								    clearInterval(inter)
							    }

						    },
						    error: function(error) {
								alert('Error. Please try again');
								console.log('Error was helped');
								console.log(error)
								clearInterval(inter)
						    }
						});

					},2200)

}

jQuery(function($){

	loader = $('#loader');

	flyboardholder = jQuery('#flyboardholder .flightboard');
	flyboardcontent = jQuery('#flyboardcontent');
	container = $('.container');

	allresults = 0;
	allresultswrap = $('#allresults');
	offerscount = 0;
	offerscountwrap = $('#offers-count');

/*  statusbar*/
statusar = [
'Initiation directions',
'Looking for Airports',
'Selection airlines',
'Flights analysis',
'Pricing analysis',
'Offers generation',
'Including base #',
];

ldstatus = jQuery('#ld-status');

k = 0;
l = 2;
statuses = setInterval(function(){

  var status = statusar[k];
  if(k==6){
    status += " " + l;
  }

  ldstatus.html(status);

  k++;
  if(k>=7){
    k=0;
    l++;
  }
},3000);

/*  end statusbar*/

/*progressbar*/
  progressbar = $( "#progressbar" ),
  progressLabel = $( ".progress-label" );

progressbar.progressbar({
  value: false
});

setTimeout( progress, 2000 );
/* end progressbar*/

});

function progress() {
  var val = progressbar.progressbar( "value" ) || 0;

  progressbar.progressbar( "value", val + 2 );
  if ( val < 10 ) {
    setTimeout( progress, 80 );
  }else
  if ( val < 15 ) {
    setTimeout( progress, 1000 );
  }else
  if ( val < 55 ) {
    setTimeout( progress, 80 );
  }else
  if ( val < 58 ) {
    setTimeout( progress, 1000 );
  }else
  if ( val < 70 ) {
    setTimeout( progress, 80 );
  }else
  if ( val < 73 ) {
    setTimeout( progress, 1000 );
  }else
  if ( val < 99 ) {
    setTimeout( progress, 80 );
  }
}

function tmpl(flightdata){

	//console.log(flightdata)

	var tmpl = '';
	var k = 0;

	console.log('fldata',flightdata);
	for (index in flightdata.flights) {

		k++;

		data = flightdata.flights[index];

		tmpl += '<div class="fl-container"><div class="fl-grid8">';

		for (key in data.flights) {
			flight = data.flights[key];

			tmpl += '<div class="fl-item"><div class="fl-item-box"><div class="fl-name">												<img class="fl-logo" src="/images/airlines/' + flight.airlineLogo+ '" alt="' + flight.airlineName+ '" title="' + flight.airlineName+ '">				</div>											<div class="fl-time fl-time-from"><strong>' + flight.depature+ '</strong> ' + flight.depatureName+ ', ' + flight.from+ '</div>											<div class="fl-duration">					<span class="fl-duration-time">' + flight.duration+ '</span>					<span class="fl-stops">' + flight.stops+ ' </span>				</div>				<div class="fl-time fl-time-to"> <strong> ' + flight.arrival + '</strong> ' + flight.arrivalName + ', ' + flight.to + '</div>			</div>				</div>';

		}

		tmpl +='</div><div class="fl-grid4"><div class="fl-price">';

		if(data.travelers>1){

			tmpl +='<div class="fl-price-box usericon smalltext">' +
						data.personprice+ ' ' + data.currency +
						'<sup>*</sup>' +
					'</div>' +
					'<div class="fl-price-box groupicon">' +
						data.price + ' ' + data.currency +
						'<sup>*</sup>' +
					'</div>';
			tmpl +='<div class="fl-price-box usericon smalltext">' +
			data.personprice+ ' ' + data.currency +
			'<sup>*</sup>' +
			'</div>' +
			'<div class="fl-price-box groupicon">' +
			data.price + ' ' + data.currency +
			'<sup>*</sup>' +
			'</div>';

		}else{
			//tmpl += '<div class="fl-price-box usericon">' + data.price + ' ' + data.currency + '<sup>*</sup></div>';
			tmpl += '<div class="fl-price-box usericon js-send-request">Request a quote - Save Up To 65%</div>';
			tmpl += '<div class="fl-price-box usericon"><a target="_blank" href="<?php echo 2;?>">Book On Momondo.com for full price ' + data.price + ' ' + data.currency + '</a></div>';
		}

		tmpl +='</div></div>				<div class="clearfix"></div>';

		tmpl +='</div>';

	}
	return tmpl;
}

</script>
<?php get_footer(); ?>
