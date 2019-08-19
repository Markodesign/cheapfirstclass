/**
 * @namespace Functions for hierselect elements
 */
qf.elements.tab = (function(){
    /**
     * Returns 'onload' handler for page containing tab.
     *
     * This resets hierselect to default values and repopulates options in second and
     * subsequent selects.
     *
     * @see     <a href="http://pear.php.net/bugs/bug.php?id=3176">PEAR bug #3176</a>
     * @param   {Element}   firstSelect First select element in hierselect chain
     * @returns {function()}
     * @private
     */
    function _getOnloadHandler(tabId) {
        BuildTabs(tabId);
        ActivateTab(tabId, 0);
    };

    function _getOncheckHandler(tabId) {
        ActivateErrorTab(tabId, 'error');
    };

    return {
        /**
         * Adds event handlers for hierselect behavior.
         *
         * @param {Array} selects               IDs of select elements in hierselect
         * @param {Function} optionsCallback    function that will be called to
         *                  get missing options (presumably via AJAX)
         */
        init: function(tabId, optionsCallback)
        {
            qf.events.addListener(window, 'load', _getOnloadHandler(tabId));

            // TODO: rewrite without jQuery
            // TODO: handler onFormError
            // активно використовувати обєкт qf
            form = jQuery('#'+tabId).parents('form');
            jQuery(form).submit(function() {
                _getOncheckHandler(tabId);
            });
            
        }
    };
})();

function getChildElementsByClassName(parentElement, className)
{
	var i, childElements, pattern, result;
	result = new Array();
	pattern = new RegExp("\\b"+className+"\\b");


	childElements = parentElement.getElementsByTagName('*');
	for(i = 0; i < childElements.length; i++)
	{
		if(childElements[i].className.search(pattern) != -1)
		{
            result[result.length] = childElements[i];
		}
	}
	return result;
}


function BuildTabs(containerId)
{
	var i, tabContainer, tabContents, tabHeading, title, tabElement;
	var divElement, ulElement, liElement, tabLink, linkText;


	// assume that if document.getElementById exists, then this will work...
	if(! eval('document.getElementById') ) return;

	tabContainer = document.getElementById(containerId);

	if(tabContainer == null)
        return;

	tabContents = tabContainer.getElementsByTagName('fieldset');
	//tabContents = getChildElementsByClassName(tabContainer, 'tab-content');
	if(tabContents.length == 0)
		return;

	divElement = document.createElement("div");
  	divElement.className = 'tab-header'
  	divElement.id = containerId + '-header';
	ulElement = document.createElement("ul");
  	ulElement.className = 'tab-list'

	tabContainer.insertBefore(divElement, tabContents[0]);
	divElement.appendChild(ulElement);

	for(i = 0; i < tabContents.length; i++)
	{
	//	tabHeading = getChildElementsByClassName(tabContents[i], 'tab');//--
	//	title = tabHeading[0].childNodes[0].nodeValue;                  //--
        title = tabContents[i].childNodes[0].childNodes[0].nodeValue;   //++

		// create the tabs as an unsigned list
		liElement = document.createElement("li");
		liElement.id = containerId + '-tab-' + i;

		tabLink = document.createElement("a");
		linkText = document.createTextNode(title);

		tabLink.className = "tab-item";

		tabLink.setAttribute("href","javascript://");
		//tabLink.setAttribute( "title", tabHeading[0].getAttribute("title"));              //--
		tabLink.onclick = new Function ("ActivateTab('" + containerId + "', " + i + ")");

		ulElement.appendChild(liElement);
		liElement.appendChild(tabLink);
		tabLink.appendChild(linkText);

		// remove the H1
		//tabContents[i].removeChild                                                        //--
	}
}

function ActivateTab(containerId, activeTabIndex)
{
	var i, tabContainer, tabContents;

	tabContainer = document.getElementById(containerId);
	if(tabContainer == null)
		return;

	//tabContents = getChildElementsByClassName(tabContainer, 'tab-content');
    tabContents = tabContainer.getElementsByTagName('fieldset');

	if(tabContents.length > 0)
	{
		for(i = 0; i < tabContents.length; i++)
		{
			//tabContents[i].className = "tab-content";
			tabContents[i].style.display = "none";
		}

		tabContents[activeTabIndex].style.display = "block";


    		tabList = document.getElementById(containerId + '-list');
		tabs = getChildElementsByClassName(tabContainer, 'tab-item');
		if(tabs.length > 0)
		{
			for(i = 0; i < tabs.length; i++)
			{
				tabs[i].className = "tab-item";
			}

			tabs[activeTabIndex].className = "tab-item tab-active";
			tabs[activeTabIndex].blur();
		}
	}
}

function ActivateErrorTab(containerId, ErrorClass){

   var i, tabContainer, tabContents,tabError;

	tabContainer = document.getElementById(containerId);

	if(tabContainer == null)
		return;

	//tabContents = getChildElementsByClassName(tabContainer, 'tab-content');
    tabContents = tabContainer.getElementsByTagName('fieldset');
    for (i = 0; i<tabContents.length; i++) {
       tabError = getChildElementsByClassName(tabContents[i], ErrorClass);
       if (tabError.length > 0) {
          ActivateTab(containerId, i);
          break;
       }
    }
}