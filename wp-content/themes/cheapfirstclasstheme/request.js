var current_tab = 'roundtrip';
into = false;
infrom = false;


jQuery(document).ready(function()

{
    rq_showCheckedForm();
    jQuery('#request_holder .request_type input').change(function(){ rq_showCheckedForm(); });
    rq_initUIElements();

});

function rq_initUIElements()
{

     jQuery( 'input[name=departure]' ).datepicker({
		minDate: new Date(),
		dateFormat: 'mm/dd/yy',
		onClose: function( selectedDate ) {
			 jQuery( "input[name=return]" ).datepicker( "option", "minDate", selectedDate );
		}
    });
     jQuery( 'input[name=return]' ).datepicker({
		defaultDate: "+1d",
		dateFormat: 'mm/dd/yy'
    });

    jQuery( '.rq_datepicker' ).datepicker({
        minDate: new Date(),
        dateFormat: 'mm/dd/yy',
        onClose: function( selectedDate ) {
            jQuery( "input[name=return]" ).datepicker( "option", "minDate", selectedDate );
        }
    });

    jQuery('input.airport_autocomplete').autocomplete({source: function(request, response)
    {
        jQuery.post('/request.php', {'action': 'autocomplete', 'term': request.term}, function(data)
        {
            response(jQuery.map(data.results, function(item)
            {
                return { label: item.title, value: item.title , country : item.country}
            }));
        }, 'json');
    },
    select: function( event, ui ) {
      if(jQuery(this).attr('name')=='from'){
        infrom = true;
      }else
      if(jQuery(this).attr('name')=='to'){
        into = true;
      }
        jQuery(this).attr('data-country',ui.item.country);

    }
  }).keydown(function functionName() {
      if(jQuery(this).attr('name')=='from'){
        infrom = false;
      }else
      if(jQuery(this).attr('name')=='to'){
        into = false;
      }
  });




    jQuery('#request_holder .avf').bind('change paste keyup ', function()
    {
        rq_showTravelerContactFields();
    });
    jQuery('#request_holder div.tab#type_' + current_tab + ' form .avf').change(); // onload check
}

function rq_showCheckedForm()
{
    current_tab = jQuery('#request_holder .request_type input:checked').attr('id');
    jQuery('#request_holder div.tab').css('display', 'none');
    jQuery('#request_holder div.tab#type_' + current_tab).css('display', 'block');
}

function rq_sendRequest()
{
    var current_tab = jQuery('#request_holder .request_type input:checked').attr('id');

    if(rq_checkFields())
    {
        var send_usa_code = true;
        jQuery('#request_holder div.tab#type_' + current_tab + ' form input').each(function(){
            var attr =  jQuery(this).attr('data-country');
            if (typeof(attr) != 'undefined'){
                if (attr == 'no'){
                    send_usa_code = false;
                }
            }
        });

        if (send_usa_code){
            ga('send', 'event', 'Button', 'Domestic Flight', 'Get the deal');
            jQuery('.b-popup').show();
        }else{
            jQuery('#request_holder .response').html('');
            jQuery('#send_button_holder .send_request').toggle();
            jQuery('#send_button_holder .sending_wait').toggle();
            var gatype = 'Roundtrip';
            switch(current_tab)
            {
                case 'roundtrip': gatype = 'Round Trip'; break;
                case 'oneway': gatype = 'One Way'; break;
                case 'multicity': gatype = 'Multicity'; break;
                default:break;
            }

            ga('send', 'event', 'Button', gatype, 'Get the deal', 1);
            jQuery.post('/request.php', rq_form2Object(jQuery('#request_holder div.tab#type_' + current_tab + ' form')), function(response)
            {
                if(response.status == 'success')
                {

                    jQuery('#loader').show();

                    if(into==true && infrom==true){
                        var qry = '';
                    }else{
                        qry = '?search=none';
                    }

                    var url = window.location.href;
                    if (url.indexOf('business-class-flights-finder') != -1){
                        window.location.href="/business-class-flights-finder/results/"+new Date().getTime() + qry ;// + "#rqform";
                    }else{
                        window.location.href="/results/"+new Date().getTime() + qry; // + "#rqform";
                    }


                    /* jQuery('#request_holder div.tab#type_' + current_tab + ' form input[type="text"]').val('');
                     rq_showTravelerContactFields();
                     jQuery('#reference').html(response.reference);
                     jQuery('.content-fr, .content-bt').slideUp('slow', function()
                     {
                     jQuery('.after-message').slideDown();
                     }); */
                }
                else
                {
                    jQuery('#request_holder .response').html('<div class="' + response.status + '">' + response.message + '</div>');
                    if(response.extended)
                    {
                        var
                            invalid_fields = new Array(),
                            fields_str = String(response.extended);
                        invalid_fields = fields_str.split(',');
                        jQuery.each(invalid_fields, function(index, selector)
                        {
                            jQuery(selector).animate({'background-color': '#ff9000'}, 500, function(){jQuery(this).animate({'background-color': 'white'}, 500);});
                        });
                    }
                }
                jQuery('#send_button_holder .send_request').toggle();
                jQuery('#send_button_holder .sending_wait').toggle();
            }, 'json');
        }


    }
    else console.log('error fields in ' + current_tab);
}

function hideSuccessMessage()
{
    rq_showTravelerContactFields();
    jQuery('.after-message').slideUp('slow', function()
    {
        jQuery('#reference').html('');
        jQuery('.content-fr, .content-bt').slideDown('slow');
    });
}

function rq_addMultiCity()
{
    if(current_tab != 'multicity') return;
    var number = parseInt(jQuery('#request_holder #type_multicity #multicity_counter').val()) + 1;
    jQuery('#request_holder #type_multicity #multicity_counter').val(number);
    jQuery('<div class="rq_multicity rq_mc' + number + '" style="display: none;"><input type="text" name="from' + number + '" class="airport_autocomplete avf" placeholder="From Airport or City*" /><input type="text" name="to' + number + '" class="airport_autocomplete avf" placeholder="To Airport or City*" /><div class="date-wrapper input-wrapper"><input type="text" name="departure' + number + '" class="rq_datepicker avf" placeholder="Departure" /></div><span class="remove_multicity" onclick="rq_removeMultiCity(' + number + ')">&times;</span></div>').appendTo(jQuery('#rq_multicity_holder')).slideDown('slow');
    rq_initUIElements();

}

function rq_removeMultiCity(number)
{
    jQuery('#request_holder #type_multicity #rq_multicity_holder .rq_mc' + number).slideUp('slow', function(){jQuery(this).remove();})
}

function rq_showTravelerContactFields()
{
    var show = true;
    jQuery('#request_holder div.tab#type_' + current_tab + ' form .avf').each(function(index, element)
    {
        if(jQuery(element).val() == '') show = false;
    });
    if(show == true) jQuery('#request_holder div.tab#type_' + current_tab + ' div.traveler_contacts').removeClass('hidden');
    else jQuery('#request_holder div.tab#type_' + current_tab + ' div.traveler_contacts').addClass('hidden');
}

function rq_checkFields()
{
    var valid = true;
    jQuery('#request_holder div.tab#type_' + current_tab + ' form input, #request_holder div.tab#type_' + current_tab + ' .form-row input').each(function(index, element)
    {
        if(jQuery(element).val() == '')
        {
            jQuery(element).animate({'background-color': '#ff9000'}, 500, function(){jQuery(this).animate({'background-color': 'white'}, 500);});
            valid = false;
        }
    });
    return valid;
}

function rq_form2Object($form)
{
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    jQuery.map(unindexed_array, function(n, i) { indexed_array[n['name']] = n['value']; });
    indexed_array['page_url'] = window.location.href;
    return indexed_array;
}

function rq_isEmail(email)
{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

(function(d){d.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(f,e){d.fx.step[e]=function(g){if(!g.colorInit){g.start=c(g.elem,e);g.end=b(g.end);g.colorInit=true}g.elem.style[e]="rgb("+[Math.max(Math.min(parseInt((g.pos*(g.end[0]-g.start[0]))+g.start[0]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[1]-g.start[1]))+g.start[1]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[2]-g.start[2]))+g.start[2]),255),0)].join(",")+")"}});function b(f){var e;if(f&&f.constructor==Array&&f.length==3){return f}if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(e[1]),parseInt(e[2]),parseInt(e[3])]}if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(e[1])*2.55,parseFloat(e[2])*2.55,parseFloat(e[3])*2.55]}if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}if(e=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[d.trim(f).toLowerCase()]}function c(g,e){var f;do{f=d.css(g,e);if(f!=""&&f!="transparent"||d.nodeName(g,"body")){break}e="backgroundColor"}while(g=g.parentNode);return b(f)}var a={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]}})(jQuery);
