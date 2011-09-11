var Froogaloop=(function(){function Froogaloop(iframe){return new Froogaloop.fn.init(iframe);}
var eventCallbacks={},hasWindowEvent=false,slice=Array.prototype.slice;Froogaloop.fn=Froogaloop.prototype={playerDomain:'',element:null,init:function(iframe){if(typeof iframe==="string"){iframe=document.getElementById(iframe);}
this.element=iframe;return this;},api:function(method,valueOrCallback){if(!this.element||!method){return false;}
var self=this,element=self.element,target_id=element.id!=''?element.id:null,params=!isFunction(valueOrCallback)?valueOrCallback:null,callback=isFunction(valueOrCallback)?valueOrCallback:null;if(callback){storeCallback(method,callback,target_id);}
postMessage(method,params,element);return self;},addEvent:function(eventName,callback){if(!this.element){return false;}
var self=this,element=self.element,target_id=element.id!=''?element.id:null;storeCallback(eventName,callback,target_id);if(eventName!='ready'){postMessage('addEventListener',eventName,element);}
if(hasWindowEvent){return self;}
playerDomain=getDomainFromUrl(element.getAttribute('src'));if(window.addEventListener){window.addEventListener('message',onMessageReceived,false);}
else{window.attachEvent('onmessage',onMessageReceived,false);}
hasWindowEvent=true;return self;},removeEvent:function(eventName){if(!this.element){return false;}
var self=this,element=self.element,target_id=element.id!=''?element.id:null,removed=removeCallback(eventName,target_id);if(eventName!='ready'&&removed){postMessage('removeEventListener',eventName,element);}}};function postMessage(method,params,target){if(!target.contentWindow.postMessage){return false;}
var url=target.getAttribute('src').split('?')[0],data=JSON.stringify({method:method,value:params});target.contentWindow.postMessage(data,url);}
function onMessageReceived(event){if(event.origin!=playerDomain){return false;}
var data=JSON.parse(event.data),value=data.value,method=data.event||data.method,eventData=data.data,target_id=target_id==''?null:data.player_id,callback=getCallback(method,target_id),params=[];if(!callback){return false;}
if(value!==undefined){params.push(value);}
if(eventData){params.push(eventData);}
if(target_id){params.push(target_id);}
return params.length>0?callback.apply(null,params):callback.call();}
function storeCallback(eventName,callback,target_id){if(target_id){if(!eventCallbacks[target_id]){eventCallbacks[target_id]={};}
eventCallbacks[target_id][eventName]=callback;}
else{eventCallbacks[eventName]=callback;}}
function getCallback(eventName,target_id){if(target_id){return eventCallbacks[target_id][eventName];}
else{return eventCallbacks[eventName];}}
function removeCallback(eventName,target_id){if(target_id&&eventCallbacks[target_id]){if(!eventCallbacks[target_id][eventName]){return false;}
eventCallbacks[target_id][eventName]=null;}
else{if(!eventCallbacks[eventName]){return false;}
eventCallbacks[eventName]=null;}
return true;}
function getDomainFromUrl(url){var url_pieces=url.split('/'),domain_str='';for(var i=0,length=url_pieces.length;i<length;i++){if(i<3){domain_str+=url_pieces[i];}
else{break;}
if(i<2){domain_str+='/';}}
return domain_str;}
function isFunction(obj){return!!(obj&&obj.constructor&&obj.call&&obj.apply);}
function isArray(obj){return toString.call(obj)==='[object Array]';}
Froogaloop.fn.init.prototype=Froogaloop.fn;return(window.Froogaloop=window.$f=Froogaloop);})();