<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
		<div id="primary" class="widget-area js-float-widget" role="complementary">
            <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/request/request.css?<?php echo time(); ?>' type='text/css' media='all' />
              <h5><i class="star"></i><a href="/customer-testimonials/">Get a Quote Now!</a></h5>
  <?php
    require_once 'request/Request.class.php';
    $request = new Request();
    echo $request->buildForm();
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("right-sidebar") ) : endif;
?>
            <script>
               (function ( jQuery ){
                /*
                    var element = jQuery('.js-float-widget');
                    var elementPosition = element.offset();
                  //  console.log(elementPosition);
                    jQuery(window).scroll(function(){
                        if (element.length){
                            var doc_height = jQuery(document).height();
                            //  console.log(doc_height - jQuery(window).scrollTop() - jQuery(window).height());
                            //  console.log(doc_height - jQuery(document).scrollTop());
                            if(jQuery(window).scrollTop()+40 > elementPosition.top ){
                                console.log(doc_height - jQuery(window).scrollTop()- jQuery(window).height() - element.height());
                                if ( ((doc_height - jQuery(window).scrollTop()- jQuery(window).height()  )<450 +element.height()) ){
                                    element.css('position','fixed').css('bottom','10px').css('top','none');
                                    element.find('#request_holder').css('margin', '0');
                                }else{
                                    element.css('position','fixed').css('top','40px').css('bottom','none');
                                    element.find('#request_holder').css('margin', '0');
                                }


                            } else {
                                element.css('position','static');
                            }
                        }


                    });*/
                   var element = jQuery('.js-float-widget');
                   if (element.length) {
                       var topPos = element.offset().top;
                       jQuery(window).scroll(function () {
                           var top = jQuery(document).scrollTop(),
                               pip = jQuery('footer').offset().top,
                               height = element.outerHeight();
                           if ((top+40) > topPos && top < pip - height) {
                               jQuery('.js-float-widget').addClass('wid-fixed').removeAttr("style");
                           }
                           else if (top > pip - height) {
                               jQuery('.js-float-widget').removeClass('wid-fixed').css({
                                   'position': 'absolute',
                                   'bottom': '0'


                               });
                           }
                           else {
                               jQuery('.js-float-widget').removeClass('wid-fixed');
                           }
                       });
                   }


                })(jQuery)

            </script>
            <style>
                .wid-fixed{
                    position: fixed;
                    top:40px;
                }
                #primary.js-float-widget #request_holder{
                    margin: 0;
                }
                .wid-fixed .testimonial_rotator_widget_wrap{
                    width: 265px;
                }

            </style>
	</div><!-- #primary .widget-area -->