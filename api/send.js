/**
 * Wait until the test condition is true or a timeout occurs. Useful for waiting
 * on a server response or for a ui change (fadeIn, etc.) to occur.
 *
 * @param testFx javascript condition that evaluates to a boolean,
 * it can be passed in as a string (e.g.: "1 == 1" or "$('#bar').is(':visible')" or
 * as a callback function.
 * @param onReady what to do when testFx condition is fulfilled,
 * it can be passed in as a string (e.g.: "1 == 1" or "$('#bar').is(':visible')" or
 * as a callback function.
 * @param timeOutMillis the max amount of time to wait. If not specified, 3 sec is used.
 */
"use strict";

function waitFor(testFx, onReady, timeOutMillis) {
	var maxtimeOutMillis = timeOutMillis ? timeOutMillis : 1000 * 60, //< Default Max Timout is 3s
        start = new Date().getTime(),
        condition = false,
        interval = setInterval(function() {
            if ( (new Date().getTime() - start < maxtimeOutMillis) && !condition ) {
                // If not time-out yet and condition not yet fulfilled
                condition = (typeof(testFx) === "string" ? eval(testFx) : testFx()); //< defensive code
            } else {
                if(!condition) {
                    // If condition still not fulfilled (timeout but condition is 'false')
                    console.log("'waitFor()' timeout");
                    phantom.exit(1);
                } else {
                    // Condition fulfilled (timeout and/or condition is 'true')
                    console.log("'waitFor()' finished in " + (new Date().getTime() - start) + "ms.");
                    typeof(onReady) === "string" ? eval(onReady) : onReady(); //< Do what it's supposed to do once the condition is fulfilled
                    clearInterval(interval); //< Stop this interval
                }
            }
        }, 2000); //< repeat check every 250ms
};


var page = require('webpage').create();
page.settings.loadImages = false;

// Отключение CSS и сторонних ресурсов

page.onResourceRequested = function(requestData, request) {

  if (
    (/\.doubleclick\./gi).test(requestData['url']) ||
    (/\.pubmatic\.com$/gi).test(requestData['url']) ||
    (/yandex/gi).test(requestData['url']) ||
    (/google/gi).test(requestData['url']) ||
    (/gstatic/gi).test(requestData['url']) ||
    (/http:\/\/.+?\.css$/gi).test(requestData['url'])
   ) {
    console.error( "BLOCKED: " + requestData['url'] );
    request.abort();
  }

};

var system = require('system');
var fs = require('fs');
var url = decodeURIComponent(system.args[1]); 

var filename = system.args[2];
/* var postBody = 'currency=USD';

page.open('http://www.momondo.com/FlightWS.asmx/SetCurrency', 'POST', postBody, function(status) {
  console.log('Send curresny Status: ' + status);
}); */


page.settings.loadImages = false;
page.open(url, function (status) {
    // Check for page load success
    if (status !== "success") {
        console.log("Unable to access network");
    } else {

		console.log(system.args[1]);
        // Wait for 'signin-dropdown' to be visible
        waitFor(function() {
            // Check in the page if a specific element is now visible
			var html = page.evaluate(function() {
                
				return document.getElementById('searchProgressText').textContent
            });
            
			var result = page.evaluate(function() {
		          //return $('#flight_viewmenu').html();
		          return document.getElementById('flight_results').innerHTML;   //.textContent;   //.innerHTML
		    });

            console.log(result);
            
            //console.log(html);
			if(html=='Search complete'){
				result = result + '[Search complete]';
            }
			
			
			var file = fs.open("results/" +filename + '.html', "w");
			file.write(result);
		    file.close();
            //var d = new Date();
			//page.render("screen/" +d + '.png');
			
            if(html=='Search complete'){
                return 'Search complete';
            }
            
        }, function() {
           console.log("The sign-in dialog should be visible now.");
           phantom.exit();
        });        
    }
});
