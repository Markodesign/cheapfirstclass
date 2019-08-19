/*
 HTML_QuickForm2 client-side validation library
 Package version 0.6.0
 http://pear.php.net/package/HTML_QuickForm2

 Copyright 2006-2011, Alexey Borzov, Bertrand Mansion
 Licensed under new BSD license 
 http://opensource.org/licenses/bsd-license.php
*/
var qf=qf||{};qf.elements=qf.elements||{};
qf.typeOf=function(a){var b=typeof a;if("function"==b&&"undefined"==typeof a.call)return"object";else if("object"==b)if(a){if(a instanceof Array||!(a instanceof Object)&&"[object Array]"==Object.prototype.toString.call(a)&&"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("splice"))return"array";if(!(a instanceof Object)&&("[object Function]"==Object.prototype.toString.call(a)||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&
!a.propertyIsEnumerable("call")))return"function"}else return"null";return b};qf.addNamespace=function(a){for(var a=a.split("."),b=window,c;a.length&&(c=a.shift());)b=b[c]?b[c]:b[c]={}};qf.Map=function(a){this._map={};this._keys=[];this._count=0;a&&this.merge(a)};
qf.Map.prototype=function(){function a(a,d){return Object.prototype.hasOwnProperty.call(a,d)}function b(){if(this._count!=this._keys.length){for(var b=0,d=0,e={};b<this._keys.length;){var g=this._keys[b];a(this._map,g)&&!a(e,g)&&(this._keys[d++]=g,e[g]=!0);b++}this._keys.length=d}}return{hasKey:function(b){return a(this._map,b)},length:function(){return this._count},getValues:function(){b.call(this);for(var a=[],d=0;d<this._keys.length;d++)a.push(this._map[this._keys[d]]);return a},getKeys:function(){b.call(this);
return this._keys.concat()},isEmpty:function(){return 0==this._count},clear:function(){this._map={};this._count=this._keys.length=0},remove:function(c){if(!a(this._map,c))return!1;delete this._map[c];this._count--;this._keys.length>this._count*2&&b.call(this);return!0},get:function(b,d){if(a(this._map,b))return this._map[b];return d},set:function(b,d){a(this._map,b)||(this._count++,this._keys.push(b));this._map[b]=d},merge:function(a,b){var e,g,f=0;if(a instanceof qf.Map)e=a.getKeys(),g=a.getValues();
else for(var h in e=[],g=[],a)e[f]=h,g[f++]=a[h];h=b||qf.Map.mergeReplace;for(f=0;f<e.length;f++)this.hasKey(e[f])?this.set(e[f],h(this.get(e[f]),g[f])):this.set(e[f],g[f])}}}();qf.Map.mergeReplace=function(a,b){return b};qf.Map.mergeKeep=function(a){return a};qf.Map.mergeArrayConcat=function(a,b){"array"!=qf.typeOf(a)&&(a=[a]);"array"!=qf.typeOf(b)&&(b=[b]);return a.concat(b)};qf.form=function(){return{getValue:function(a){typeof a=="string"&&(a=document.getElementById(a));if(!a||!("type"in a))return null;switch(a.type.toLowerCase()){case "checkbox":case "radio":return a.checked?a.value:null;case "select-one":var b=a.selectedIndex;return-1==b?null:a.options[b].value;case "select-multiple":for(var b=[],c=0;c<a.options.length;c++)a.options[c].selected&&b.push(a.options[c].value);return b;default:return typeof a.value=="undefined"?null:a.value}},getSubmitValue:function(a){typeof a==
"string"&&(a=document.getElementById(a));if(!a||!1 in a||a.disabled)return null;switch(a.type.toLowerCase()){case "reset":case "button":return null;default:return qf.form.getValue(a)}},getContainerSubmitValue:function(){for(var a=new qf.Map,b=0;b<arguments.length;b++)if(arguments[b]instanceof qf.Map)a.merge(arguments[b],qf.Map.mergeArrayConcat);else{if("object"==qf.typeOf(arguments[b]))var c=arguments[b].name,d=arguments[b].value;else c=document.getElementById(arguments[b]).name,d=qf.form.getSubmitValue(arguments[b]);
if(null!==d){var e={};e[c]=d;a.merge(e,qf.Map.mergeArrayConcat)}}return a},setValue:function(a,b){typeof a=="string"&&(a=document.getElementById(a));if(a&&"type"in a)switch(a.type.toLowerCase()){case "checkbox":case "radio":a.checked=!!b;break;case "select-one":var c=a;c.selectedIndex=-1;for(var d,e=0;d=c.options[e];e++)if(d.value==b){d.selected=!0;break}break;case "select-multiple":c=a;d=b;"array"!=qf.typeOf(d)&&(d=[d]);for(var g=0;e=c.options[g];g++){e.selected=!1;for(var f=0,h=d.length;f<h;f++)if(e.value==
d[f])e.selected=!0}break;default:a.value=b}}}}();qf.$v=qf.form.getSubmitValue;qf.$cv=qf.form.getContainerSubmitValue;qf.classes={add:function(a,b){"string"==qf.typeOf(b)&&(b=b.split(/\\s+/));if(a.className){for(var c=" "+a.className+" ",d=a.className,e=0,g=b.length;e<g;e++)b[e]&&0>c.indexOf(" "+b[e]+" ")&&(d+=" "+b[e]);a.className=d}else a.className=b.join(" ")},remove:function(a,b){if(a.className){"string"==qf.typeOf(b)&&(b=b.split(/\\s+/));for(var c=(" "+a.className+" ").replace(/[\n\t\r]/g," "),d=0,e=b.length;d<e;d++)b[d]&&(c=c.replace(" "+b[d]+" "," "));a.className=c.replace(/^\s+/,"").replace(/\s+$/,"")}},
has:function(a,b){if(-1<(" "+a.className+" ").replace(/[\n\t\r]/g," ").indexOf(" "+b+" "))return!0;return!1}};qf.events={test:function(){var a={submitBubbles:!0,changeBubbles:!0,focusinBubbles:!1},b=document.createElement("div");if(b.attachEvent)for(var c in{submit:!0,change:!0,focusin:!0}){var d="on"+c,e=d in b;e||(b.setAttribute(d,"return;"),e=typeof b[d]==="function");a[c+"Bubbles"]=e}return a}(),addListener:function(a,b,c,d){a.addEventListener?a.addEventListener(b,c,d):a.attachEvent("on"+b,c)},removeListener:function(a,b,c,d){a.removeEventListener?a.removeEventListener(b,c,d):a.detachEvent("on"+b,c)},
fixEvent:function(a){a=a||window.event;a.preventDefault=a.preventDefault||function(){this.returnValue=!1};a.stopPropagation=a.stopPropagation||function(){this.cancelBubble=!0};if(!a.target)a.target=a.srcElement;if(!a.relatedTarget&&a.fromElement)a.relatedTarget=a.fromElement==a.target?a.toElement:a.fromElement;if(a.pageX==null&&a.clientX!=null){var b=document.documentElement,c=document.body;a.pageX=a.clientX+(b&&b.scrollLeft||c&&c.scrollLeft||0)-(b.clientLeft||0);a.pageY=a.clientY+(b&&b.scrollTop||
c&&c.scrollTop||0)-(b.clientTop||0)}if(!a.which&&a.button)a.which=a.button&1?1:a.button&2?3:a.button&4?2:0;return a}};qf.Rule=function(a,b,c,d){this.callback=a;this.owner=b;this.message=c;this.chained=d||[[]]};qf.LiveRule=function(a,b,c,d,e){qf.Rule.call(this,a,b,c,e);this.triggers=d};qf.LiveRule.prototype=new qf.Rule;qf.LiveRule.prototype.constructor=qf.LiveRule;
qf.Validator=function(a,b){this.rules=b||[];this.errors=new qf.Map;a.validator=this;qf.events.addListener(a,"submit",qf.Validator.submitHandler);for(var c=0,d;d=this.rules[c];c++)if(d instanceof qf.LiveRule){qf.events.test.changeBubbles?qf.events.addListener(a,"change",qf.Validator.liveHandler,!0):(qf.events.addListener(a,"click",function(a){var a=qf.events.fixEvent(a),b=a.target;("select"==b.nodeName.toLowerCase()||"input"==b.nodeName.toLowerCase()&&("checkbox"==b.type||"radio"==b.type))&&qf.Validator.liveHandler(a)}),
qf.events.addListener(a,"keydown",function(a){var a=qf.events.fixEvent(a),b=a.target,d="type"in b?b.type:"";(13==a.keyCode&&"textarea"!=b.nodeName.toLowerCase()||32==a.keyCode&&("checkbox"==d||"radio"==d)||"select-multiple"==d)&&qf.Validator.liveHandler(a)}));qf.events.test.focusinBubbles?qf.events.addListener(a,"focusout",qf.Validator.liveHandler,!0):qf.events.addListener(a,"blur",qf.Validator.liveHandler,!0);break}};
qf.Validator.submitHandler=function(a){var a=qf.events.fixEvent(a),b=a.target;b.validator&&!b.validator.run(b)&&a.preventDefault()};qf.Validator.liveHandler=function(a){var a=qf.events.fixEvent(a),b=a.target.form;b.validator&&b.validator.runLive(a)};
qf.Validator.prototype=function(){function a(a){for(a=document.getElementById(a);!qf.classes.has(a,"element")&&"fieldset"!=a.nodeName.toLowerCase();)a=a.parentNode;qf.classes.remove(a,["error","valid"]);b(a);return a}function b(a){for(var a=a.getElementsByTagName("span"),b=0,c;c=a[b];b++)qf.classes.has(c,"error")&&c.parentNode.removeChild(c)}function c(b,e){b.hasKey(e.owner)&&(b.remove(e.owner),a(e.owner));for(var g=0,f;f=e.chained[g];g++)for(var h=0,i;i=f[h];h++)c(b,i)}return{msgPrefix:"Invalid information entered:",
msgPostfix:"Please correct these fields.",onStart:function(a){b(a)},onError:function(a,b){this.onFieldError(a,b)},onValid:function(){this.onFormValid()},onInvalid:function(){this.onFormError()},onFieldError:function(b,c){var g=a(b);qf.classes.add(g,"error");var f=document.createElement("span");f.className="error";f.appendChild(document.createTextNode(c));f.appendChild(document.createElement("br"));if("fieldset"!=g.nodeName.toLowerCase())g.insertBefore(f,g.firstChild);else{var h=g.getElementsByTagName("legend");
0==h.length?g.insertBefore(f,g.firstChild):h[h.length-1].parentNode.insertBefore(f,h[h.length-1].nextSibling)}},onFieldValid:function(b){b=a(b);qf.classes.add(b,"valid")},onFormValid:function(){},onFormError:function(){},run:function(a){this.onStart(a);this.errors.clear();for(var a=0,b;b=this.rules[a];a++)this.errors.hasKey(b.owner)||this.validate(b);return this.errors.isEmpty()?(this.onFormValid(),!0):(this.onFormError(),!1)},runLive:function(a){for(var a=" "+a.target.id+" ",b=new qf.Map,g=-1;b.length()>
g;)for(var g=b.length(),f=0,h;h=this.rules[f];f++)if(h instanceof qf.LiveRule&&!b.hasKey(f))for(var i=0,j;j=h.triggers[i];i++)if(-1<a.indexOf(" "+j+" ")){b.set(f,!0);c(this.errors,h);a+=h.triggers.join(" ")+" ";break}for(f=0;h=this.rules[f];f++)b.hasKey(f)&&!this.errors.hasKey(h.owner)&&this.validate(h)},validate:function(a){for(var b=!1,c=a.callback.call(this),f=0,h;h=a.chained[f];f++){for(var i=0,j;j=h[i];i++)if(c=c&&this.validate(j),!c)break;if(b=b||c)break;c=!0}if(!b&&a.message&&!this.errors.hasKey(a.owner))this.errors.set(a.owner,
a.message),this.onFieldError(a.owner,a.message);else if(!this.errors.hasKey(a.owner))this.onFieldValid(a.owner);return b}}}();qf.rules=qf.rules||{};qf.rules.each=function(a){for(var b=0;b<a.length;b++)if(!a[b]())return!1;return!0};qf.rules.empty=function(a){switch(qf.typeOf(a)){case "array":for(var b=0;b<a.length;b++)if(!qf.rules.empty(a[b]))return!1;return!0;case "undefined":case "null":return!0;default:return""==a}};
qf.rules.nonempty=function(a,b){var c,d=0;if("array"==qf.typeOf(a)){for(c=0;c<a.length;c++)qf.rules.nonempty(a[c],1)&&d++;return d>=b}else if(a instanceof qf.Map){var e=a.getValues();if(1==a.length()){c=a.getKeys()[0];var g=e[0];if("[]"==c.slice(-2)&&"array"==qf.typeOf(g))return qf.rules.nonempty(g,b)}for(c=0;c<e.length;c++)qf.rules.nonempty(e[c],1)&&d++;return d>=b}else return""!=a&&"undefined"!=qf.typeOf(a)&&"null"!=qf.typeOf(a)};
