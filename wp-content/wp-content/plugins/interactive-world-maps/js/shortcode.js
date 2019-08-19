
var apiversion = iwmparam[0]['apiversion'];
//var apiversion = "1.1";

google.load('visualization', apiversion , {'packages': ['geochart']});
google.setOnLoadCallback(iwmDrawVisualization);


function iwmDrawVisualization() {

	var geocharts = {};
    var data = {};
    var values = {};
    var listener_actions = {};
    var listener_custom = {};
    var identifier = {};

	for (var key in iwmparam) {	

		var usehtml = parseInt(iwmparam[key]['usehtml']);

		var iwmid = parseInt(iwmparam[key]['id']);
		var bgcolor = iwmparam[key]['bgcolor'];  
		var stroke = parseInt(iwmparam[key]['stroke']);
		var bordercolor = iwmparam[key]['bordercolor']; 
		var incolor = iwmparam[key]['incolor']; 
		var actcolor = iwmparam[key]['actcolor']; 
		var width = parseInt(iwmparam[key]['width']); 
		var height = parseInt(iwmparam[key]['height']);
		var ratio = (iwmparam[key]['aspratio'] === '1');
		var interactive = (iwmparam[key]['interactive'] === 'true');
		var toolt = iwmparam[key]['tooltip'];
		var region = iwmparam[key]['region']; 
		var resolution = iwmparam[key]['resolution']; 
		var markersize = parseInt(iwmparam[key]['markersize']); 
		var displaymode = iwmparam[key]['displaymode'];  
		var placestxt =  iwmparam[key]['placestxt']; 

		placestxt = placestxt.replace(/^\s+|\s+$/g,'');

		var action = iwmparam[key]['action']; 
		var customaction = iwmparam[key]['custom_action']; 

		identifier[key] = iwmid;
		listener_actions[key] = action;
		listener_custom[key] = customaction;

		var places = placestxt.split(";");

		
	
				
		
	   data[key] = new google.visualization.DataTable();
	   
	   	if(displaymode == "markers02" || displaymode == "text02") {

	   		 

		     data[key].addColumn('number', 'Lat');                                
		     data[key].addColumn('number', 'Long');
		 }
	   
	   
		data[key].addColumn('string', 'Country'); // Implicit domain label col.
		data[key].addColumn('number', 'Value'); // Implicit series 1 data col.
		data[key].addColumn({type:'string', role: 'tooltip', p:{html:true}}); // 
			
			var colorsmap = [];
			var colorsmapecho = "";		
			
		values[key] = {};

			//places.length-1 to eliminate empty value at the end
		for (var i = 0; i < places.length-1; i++) {
			var entry = places[i].split(",");
			
			var ttitle = entry[1].replace(/&#59/g,";");
			ttitle = ttitle.replace(/&#44/g,",");
			var ttooltip = entry[2].replace(/&#59/g,";");
			ttooltip = ttooltip.replace(/&#44/g,",");

			var iwmcode = entry[0];
			iwmcode = iwmcode.replace(/^\s+|\s+$/g,'');
			
			
			//If data != markers02
			if(displaymode != "markers02" && displaymode != "text02") {
			

				data[key].addRows([[{v:iwmcode,f:ttitle},i,ttooltip]]);
				var index = iwmcode;

				}

			else {

				var trim = entry[0].replace(/^\s+|\s+$/g,"");
				var latlon = trim.split(" ");
				var lat = parseFloat(latlon[0]);
				var lon = parseFloat(latlon[1]);
							
						
				data[key].addRows([[lat,lon,ttitle,i,ttooltip]]);		
				
				var index = lat;


				//finally set dislay mode of markers02 to proper value
				//displaymode = "markers";
				
				}


			var colori = entry[4];
			
			values[key][index] = entry[3].replace(/&#59/g,";");
			values[key][index] = values[key][index].replace(/&#44/g,",");	
			
			colorsmapecho = colorsmapecho + "'"+colori+"',";
			colorsmap.push(colori);
			
			}
			
			
		defmaxvalue = 0;
		if ((places.length-2) > 0) {
		defmaxvalue = places.length-2;	
		}
		
		if(displaymode=="markers02"){
			displaymode="markers";
		}
		if(displaymode=="text02"){
			displaymode="text";
		}	 	 	

		var htmltooltip = false;
		if(usehtml==1) {
			htmltooltip = true;
		}

		var options = {
			backgroundColor: {fill:bgcolor,stroke:bordercolor ,strokeWidth:stroke },
			colorAxis:  {minValue: 0, maxValue: defmaxvalue,  colors: colorsmap},
			legend: 'none',	
			backgroundColor: {fill:bgcolor,stroke:bordercolor ,strokeWidth:stroke },		
			datalessRegionColor: incolor,
			displayMode: displaymode, 
			enableRegionInteractivity: interactive,
			resolution: resolution,
			sizeAxis: {minValue: 1, maxValue:1,minSize:markersize,  maxSize: markersize},
			region:region,
			keepAspectRatio: ratio,
			width:width,
			height:height,
			tooltip: {trigger:toolt, isHtml: htmltooltip}		
			};

		var divid = "map_canvas_"+iwmid;  	

	    geocharts[key] = new google.visualization.GeoChart(document.getElementById(divid));
		
		
		if(action!="none") {

			 google.visualization.events.addListener(geocharts[key], 'select', (function(x) {
             return function () {

                var selection = geocharts[x].getSelection();
                
                if (selection.length == 1) {
                    var selectedRow = selection[0].row;
                    var selectedRegion = data[x].getValue(selectedRow, 0);
                    
                    if(values[x][selectedRegion]!=""){
                   
                   		iwm_run_action(values[x][selectedRegion],identifier[x],listener_actions[x],listener_custom[x]);
                    
                    }
                }
            }
        })(key));

		}
		
		geocharts[key].draw(data[key], options);
	}


}


function iwm_run_action(value,id,action,customaction) {

	//console.log('values for action:'+value+';'+id+';'+action+';'+customaction);

	if(action == 'i_map_action_open_url') {	
		document.location = value; 
	}
		
	if(action == 'i_map_action_alert') {
		
		alert(value); 
	}

	if(action == 'i_map_action_open_url_new') {
		
		window.open(value); 
	}

	if(action == 'i_map_action_content_below' || action == 'i_map_action_content_above' ) {
		document.getElementById('imap'+id+'message').innerHTML = value;
	}

	if(action == 'i_map_action_custom') {

		var name = "iwm_custom_action_"+id;
		window[name](value);
	}
}
