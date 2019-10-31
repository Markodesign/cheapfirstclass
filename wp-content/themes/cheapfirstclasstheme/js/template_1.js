function rq_sendRequest()
{
    var current_tab = 'roundtrip';

    if(rq_checkFields())
    {
        var send_usa_code = true;

        if (jQuery('#airport_from').attr('data-country') == 'no'){
            send_usa_code = false;
        }

        if (send_usa_code){
            //ga('send', 'event', 'Button', 'Domestic Flight', 'Get the deal');
            jQuery('.b-popup').show();
        }else{
            //jQuery('#request_holder .response').html('');
            //jQuery('#send_button_holder .send_request').toggle();
            //jQuery('#send_button_holder .sending_wait').toggle();

            var gatype = jQuery('#select_round_trip').val();

            //ga('send', 'event', 'Button', gatype, 'Get the deal', 1);

            jQuery.post('/request.php', rq_form2Object(jQuery('#submitTripForm')), function(response)
            {
                if(response.status == 'success')
                {
                    jQuery('.send_request').hide();
                    jQuery('#loader').show();

                    if(into==true && infrom==true){
                        var qry = '?request=' +response.reference;
                    }else{
                        qry = '?search=none&request='+response.reference;
                    }

                    var url = window.location.href;
                    if (url.indexOf('business-class-flights-finder') != -1){
                        window.location.href="/business-class-flights-finder/results/"+new Date().getTime() + qry ;// + "#rqform";
                    }else{
                        window.location.href="/results/"+new Date().getTime() + qry; // + "#rqform";
                    }

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
function rq_form2Object($form)
{
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    jQuery.map(unindexed_array, function(n, i) { indexed_array[n['name']] = n['value']; });
    indexed_array['page_url'] = window.location.href;
    return indexed_array;
}
function rq_checkFields()
{
    var valid = true;
    var current_tab = 'roundtrip';

    jQuery('#request_holder div.tab#type_' + current_tab + ' form input').each(function(index, element)
    {
        if(jQuery(element).val() == '')
        {
            jQuery(element).animate({'background-color': '#ff9000'}, 500, function(){jQuery(this).animate({'background-color': 'white'}, 500);});
            valid = false;
        }
    });
    return valid;
}

$( document ).ready(function() {
    var x, i, j, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /* For each element, create a new DIV that will act as the selected item: */
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /* For each element, create a new DIV that will contain the option list: */
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < selElmnt.length; j++) {
            /* For each option in the original select element,
            create a new DIV that will act as an option item: */
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function (e) {
                /* When an item is clicked, update the original select box,
                and the selected item: */
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
            /* When the select box is clicked, close any other select boxes,
            and open/close the current select box: */
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        /* A function that will close all select boxes in the document,
        except the current select box: */
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }

    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);


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
        jQuery('.traveler_contacts').fadeIn(700);
    });

});
