var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

//variables to check if width really changes


var map_div = jQuery('#iwm_map_canvas');
var width = map_div.parent().width(); 

jQuery(window).on('resize orientationchange', function() {
	

	if(map_div.parent().width() != width){

		width = map_div.parent().width();   

		delay(function(){

		     if (typeof iwmDrawVisualization == 'function') {

		     		 map_div.animate({
					    opacity: 0,
					  }, 100, function() {
					    iwmDrawVisualization();
				     	console.log('Map Redraw Finished');
					  });

		     		 map_div.animate({
					    opacity: 1,
					  }, 50, function() {
					    // Animation complete.
					  }); 
				     
					  		 
				} 

		    }, 200);


	}

});