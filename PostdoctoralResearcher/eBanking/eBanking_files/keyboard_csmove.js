var myForm = null;//override this variable to assign the document.form object in your JSP page
var vertical_position = "bottom";
var horizontal_position = "right";
var visible = false;
var overButton = false;
var field = null;
var myArray = new Array();
var keyboardFlag="small";
var alertFieldId;
var vkbFillElementSize;
var focusKey;
var moveflag=false;
//var vkbName = "vkb";
//var vkbShimName="vkbShim";
var vkbName = "largevkb";
var vkbShimName="largevkbShim";
var curr_LeftPosition;
var curr_HeightPosition;
var initialize = false;
var vkbForm;
var myBrowser;
var ieOnWindows=true;
var largeMap = "largevkb", largeMapShim = "largevkbShim";
var smallMap = "vkb", smallMapShim = "vkbShim";
var compKBDisabled = true, keyTrapped = false;
function BrowserType()
{
var userAgent = navigator.userAgent;
this.isIE    = false;
this.isNS    = false;
this.version = null;
if (userAgent.indexOf("MSIE") >= 0) {//IE compatible browsers
this.isIE = true;
return;
}
if (userAgent.indexOf("Netscape6/") >= 0) {
this.isNS = true;
return;
}
if (userAgent.indexOf("Gecko") >= 0) { //firefox and other browsers
this.isNS = true;
return;
}
}
myBrowser = new BrowserType();
function done(val)
{
hideVkb(val);
compKBDisabled = false;
}
function keyDown(e)
{
if(compKBDisabled)
{
var key;
if (myBrowser.isIE)
key=event.keyCode;
if((key==17) || (key==8))
{
keyTrapped = true;
//alert(keypressError);
return false;
}
}
}
function keyPress(e) 
{
if(compKBDisabled)
{
var key;
if(myBrowser.isIE)
key = event.keyCode
else if (myBrowser.isNS)
key = e.which
else if (ns4)	 
{
key = e.which
if(key == prevKey) 
{
key = 0;
prevKey=-100;
}
else 
{
prevKey=key;
}
}
if(key != 0 && key != 17 && key != 8) 
{
keyTrapped = true;
alert(keypressError);
return false;
}
}
}
function showCursor(cursorType){
if(cursorType=="hand"){overButton = true;}else{overButton = false;}
if(navigator.appName!="Netscape"){accessLayer(vkbName).cursor=cursorType;}
}
function add(val)
{
if(keyTrapped){ keyTrapped = false; return; }
var elPtr;
var i=0;
var foundField = false;
if(foundField == false)
{
	
elPtr = eval(vkbFillElement);

if(elPtr)
{
// this checks for length of field
var focusValue = new String(elPtr.value);
if(focusValue.length<vkbFillElementSize)
{
elPtr.value = focusValue + val;
}
else
{
//if(pwdExceedMaxLength.length > 0){ alert(pwdExceedMaxLength);}
}
foundField = true;
}
}
if(foundField == false)
{
alert(focusError);
}
}
function del(val)
{
var elPtr;
var i=0;
var foundField = false;
if(foundField == false)
{
elPtr = eval(vkbFillElement);
if(elPtr)
{
// this checks for length of field
var focusValue = new String(elPtr.value);
if(focusValue.length >0)
{
focusValue = focusValue.substring(0,focusValue.length-1);
elPtr.value = focusValue
}
foundField = true;
}
}
if(foundField == false)
{
alert(focusError);
}
}
function clear(val)
{
var elPtr;
elPtr = eval(vkbFillElement);
elPtr.value = "";
}
var origMouseX, origMouseY;	// set global variables used later on
var myObj = new Object();
function startdrag(event, objID) //Netscape 4.x browsers are not supported
{
if(overButton)
return false;
if(objID)
{
if(document.getElementById)
myObj.elNode = document.getElementById(objID);
else if(document.all)
myObj.elNode = document.all[objID];
}
else
{
if (myBrowser.isIE)
myObj.elNode = window.event.srcElement;
else if (myBrowser.isNS)
myObj.elNode = event.target;
}
if (myBrowser.isIE) {
origMouseX = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
origMouseY = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
}
if (myBrowser.isNS) {
origMouseX = event.clientX + window.scrollX;
origMouseY = event.clientY + window.scrollY;
}
myObj.cursorStartX = origMouseX;
myObj.cursorStartY = origMouseY;
myObj.elStartLeft  = parseInt(myObj.elNode.style.left);
myObj.elStartTop   = parseInt(myObj.elNode.style.top);
if (myBrowser.isIE) {
document.attachEvent("onmousemove", dragit);
document.attachEvent("onmouseup",   stopdrag);
window.event.cancelBubble = true;
window.event.returnValue = false;
}
if (myBrowser.isNS) {
document.addEventListener("mousemove", dragit,   true);
document.addEventListener("mouseup",   stopdrag, true);
event.preventDefault();
}
}
function dragit(event){	// function that operates on mousemove.  It moves the layer that was selected in the startdrag() function
var mouseX, mouseY;
if (myBrowser.isIE) {
mouseX = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
mouseY = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
}
if (myBrowser.isNS) {
mouseX = event.clientX + window.scrollX;
mouseY = event.clientY + window.scrollY;
}
//Now drag to object to where the new mouse position is
//Save the new position to be used later
curr_LeftPosition =(myObj.elStartLeft + mouseX - myObj.cursorStartX);
curr_HeightPosition = (myObj.elStartTop  + mouseY - myObj.cursorStartY);
curr_LeftPosition = curr_LeftPosition < 0 ? 0 : curr_LeftPosition;
curr_HeightPosition = curr_HeightPosition < 0 ? 0 : curr_HeightPosition;
if(ieOnWindows)
{
accessLayer(vkbShimName).left = curr_LeftPosition; // moves the layer to the appropriate place (moves the X coordinate of the layer)
accessLayer(vkbShimName).top = curr_HeightPosition; // moves the layer to the appropriate place (moves the Y coordinate of the layer)
}
myObj.elNode.style.left = curr_LeftPosition;
myObj.elNode.style.top  = curr_HeightPosition;
moveflag = true; //next time display the object at the same location
if (myBrowser.isIE)
{
window.event.cancelBubble = true;
window.event.returnValue = false;
}
else if (myBrowser.isNS)
{
event.preventDefault();
}
}
function stopdrag(event){
if (myBrowser.isIE) {
document.detachEvent("onmousemove", dragit);
document.detachEvent("onmouseup",   stopdrag);
}
if (myBrowser.isNS) {
document.removeEventListener("mousemove", dragit,   true);
document.removeEventListener("mouseup",   stopdrag, true);
}
}
function check_cookies(cookiename)
{
var cookie_val = getCookie(cookiename);
if( (cookie_val != "large") && (cookie_val != "small"))
cookie_val="small";
keyboardFlag=cookie_val;
if(cookie_val = "large")
{
vkbName = largeMap;
vkbShimName = largeMapShim;
}
else
{
vkbName = smallMap;
vkbShimName= smallMapShim;
}
}
function getexpirydate( nodays)
{
var UTCstring;
Today = new Date();
nomilli=Date.parse(Today);
Today.setTime(nomilli+nodays*24*60*60*1000);
UTCstring = Today.toUTCString();
return UTCstring;
}
function set_cookie(name,value,duration)
{
cookiestring=name+"="+escape(value)+";EXPIRES="+getexpirydate(duration);
document.cookie=cookiestring;
if(!getCookie(name))
{
return false;
}
else
{
return true;
}
}
var global_availWidth;
var global_availHeight;
var global_LeftPosition;
var global_HeightPosition;
function fixinit_size()
{
//check_cookies("capp_keyboard");
var temp_Lower_height;
var temp_Upper_height;
var temp_Lower_Limit;
var temp_Upper_Limit;
var height_randomFlag="false";
var width_randomFlag="false";
global_availWidth = document.body.clientWidth;
global_availHeight = document.body.clientHeight;
if(keyboardFlag=="small")
{
if(screen.width <= 800)
{
if(myBrowser.isIE)
{
temp_Lower_Limit = global_availWidth-(490);
temp_Upper_Limit = global_availWidth-(470);
temp_Lower_height = global_availHeight/4;
temp_Upper_height = global_availHeight/3;
}
else
{
temp_Lower_Limit = global_availWidth-(150);
temp_Upper_Limit = global_availWidth-(140);
temp_Lower_height = global_availHeight-200;
temp_Upper_height = global_availHeight-150;
}
global_LeftPosition=Math.floor(Math.random()*(1+temp_Upper_Limit - temp_Lower_Limit) + temp_Lower_Limit);
global_HeightPosition=Math.floor(Math.random()*(1+temp_Upper_height - temp_Lower_height) + temp_Lower_height);
}
else
{
if(myBrowser.isIE)
{
temp_Lower_Limit = global_availWidth-(500);
temp_Upper_Limit = global_availWidth-(450);
temp_Lower_height = global_availHeight/4;
temp_Upper_height = global_availHeight/3;
}
else
{
temp_Lower_Limit = global_availWidth-(250);
temp_Upper_Limit = global_availWidth-(200);
temp_Lower_height = global_availHeight/2;
temp_Upper_height = global_availHeight/1.8;
}
global_LeftPosition=Math.floor(Math.random()*(1+temp_Upper_Limit - temp_Lower_Limit) + temp_Lower_Limit);
global_HeightPosition=Math.floor(Math.random()*(1+temp_Upper_height - temp_Lower_height) + temp_Lower_height);
}
}
else
{
if(screen.width <= 800)
{
if(myBrowser.isIE)
{
temp_Lower_Limit = global_availWidth-(490);
temp_Upper_Limit = global_availWidth-(470);
temp_Lower_height = global_availHeight/4;
temp_Upper_height = global_availHeight/3;
}
else
{
temp_Lower_Limit = global_availWidth-(150);
temp_Upper_Limit = global_availWidth-(140);
temp_Lower_height = global_availHeight-200;
temp_Upper_height = global_availHeight-150;
}
global_LeftPosition=Math.floor(Math.random()*(1+temp_Upper_Limit - temp_Lower_Limit) + temp_Lower_Limit);
global_HeightPosition=Math.floor(Math.random()*(1+temp_Upper_height - temp_Lower_height) + temp_Lower_height);
}
else
{
if(myBrowser.isIE)
{
temp_Lower_Limit = global_availWidth-(500);
temp_Upper_Limit = global_availWidth-(450);
temp_Lower_height = global_availHeight/4;
temp_Upper_height = global_availHeight/3;
}
else
{
temp_Lower_Limit = global_availWidth-(250);
temp_Upper_Limit = global_availWidth-(200);
temp_Lower_height = global_availHeight/2;
temp_Upper_height = global_availHeight/1.8;
}
global_LeftPosition=Math.floor(Math.random()*(1+temp_Upper_Limit - temp_Lower_Limit) + temp_Lower_Limit);
global_HeightPosition=Math.floor(Math.random()*(1+temp_Upper_height - temp_Lower_height) + temp_Lower_height);
}
}
if( (global_LeftPosition >= temp_Lower_Limit) && (global_LeftPosition <= temp_Upper_Limit) )
{
global_availWidth =global_LeftPosition;
width_randomFlag="true";
}
else
{
width_randomFlag="false";
}
if( (global_HeightPosition >= temp_Lower_height) && (global_HeightPosition <= temp_Upper_height) )
{
global_availHeight =global_HeightPosition;
height_randomFlag="true";
}
else
{
height_randomFlag="false";
}
if(keyboardFlag=="small")
{
if(screen.width <= 800)
{
if(width_randomFlag=="false")
{
if(myBrowser.isIE)
global_availWidth=global_availWidth-(470);
else
global_availWidth=global_availWidth-(150);
}
if(height_randomFlag=="false")
{
if(myBrowser.isIE)
{
global_availHeight = global_availHeight/4;
}
else
{
global_availHeight = global_availHeight - 200;
}
}
}
else
{
if(width_randomFlag=="false")
{
if(myBrowser.isIE)
global_availWidth=global_availWidth-(450);
else
global_availWidth=global_availWidth-(450);
}
if(height_randomFlag=="false")
{
if(myBrowser.isIE)
global_availHeight = global_availHeight/3;
else
global_availHeight = global_availHeight/1.8;
}
}
}
else
{
if(screen.width <= 800)
{
if(width_randomFlag=="false")
{
if(myBrowser.isIE)
global_availWidth=global_availWidth-(450);
else
global_availWidth=global_availWidth-(140);
}
if(height_randomFlag=="false")
{
if(myBrowser.isIE)
global_availHeight = global_availHeight/2;
else
global_availHeight = global_availHeight-150;
}
}
else
{
if(width_randomFlag=="false")
{
if(myBrowser.isIE)
global_availWidth=global_availWidth-(500);
else
global_availWidth=global_availWidth-(200);
}
if(height_randomFlag=="false")
{
if(myBrowser.isIE)
global_availHeight = global_availHeight/4;
else
global_availHeight = global_availHeight/1.8;
}
}
}
initialize = true;
}
function showVkb(fieldRef)
{
	var arr=document.getElementById("btn_container");	
	arr.style.display='block';
	
	//if(!initialize){return;}
	fixinit_size();
	if(compKBDisabled){
		fieldRef.onkeypress=keyPress; fieldRef.onkeydown=keyDown;
	}
	if (keyboardFlag == "large"){		
		showVkbLarge(fieldRef);
		}
	else{
		vkbName = smallMap;
		vkbShimName = smallMapShim;
		showVkbSmall(fieldRef);
	}
}
function showVkbSmall(fieldRef)
{
	
	vkbFillElement = fieldRef;
	var availWidth;
	var availHeight;
	var vkbRef = accessLayer(vkbName);
	if(vkbRef.visibility == 'visible'){return}
	if(!moveflag){
		availWidth=global_availWidth;
		availHeight=global_availHeight;
		if (myBrowser.isIE && vkbRef){	
			if(screen.width <= 800){
				if(horizontal_position == "middle"){
					vkbRef.left = availWidth/3;
				}
				else if(horizontal_position == "left"){
					vkbRef.left= 0;
				}
				else{
					vkbRef.left = availWidth;
				}
			}
			else{
				vkbRef.left = availWidth;
			}
			if(screen.height <= 600 || availHeight <= 500){
				vkbRef.top = availHeight ;
			}
			else{
				vkbRef.top=availHeight;
			}
		}
		else if (myBrowser.isNS && vkbRef){
			if(screen.width <= 800){
				if(horizontal_position == "middle"){
				vkbRef.left = availWidth/3;
				}
				else if(horizontal_position == "left"){
				vkbRef.left = 0;
				}
				else{
				vkbRef.left = availWidth-255;
				}
			}
			else{
				vkbRef.left = availWidth-255;
			}
			if(screen.height <= 600 || availHeight <= 500)
			{
			vkbRef.top = availHeight-140;
			}
			else
			{
			vkbRef.top = availHeight/2;
			}
		}
	}
	else
{
vkbRef.left =curr_LeftPosition;
vkbRef.top =curr_HeightPosition;
}
if(vkbRef)
{
if(ieOnWindows)
{
var vkbShimRef = accessLayer(vkbShimName);
if(vkbShimRef)
{
vkbShimRef.top=vkbRef.top;
vkbShimRef.left=vkbRef.left;
vkbShimRef.visibility='visible';
vkbShimRef.zIndex=99;
}
}
vkbRef.visibility = 'visible';
vkbRef.zIndex = 100;
}
}
function showVkbLarge(fieldRef)
{
vkbFillElement = fieldRef;
var availWidth;
var availHeight;
var vkbRef = accessLayer(vkbName);
if(vkbRef.visibility == 'visible'){return}
if(!moveflag)
{
availWidth=global_availWidth;
availHeight=global_availHeight;
if (myBrowser.isIE && vkbRef)
{
if(screen.width <= 800)
{
if(horizontal_position == "middle")
{
vkbRef.left = availWidth/3;
}
else if(horizontal_position == "left")
{
vkbRef.left= 0;
}
else
{
vkbRef.left= availWidth;
}
}
else
{
vkbRef.left = availWidth;
}
if(screen.height <= 600 || availHeight <= 500)
{
vkbRef.top= availHeight ;
}
else
{
vkbRef.top=availHeight;
}
}
else if (myBrowser.isNS && vkbRef)
{
if(screen.width <= 800)
{
if(horizontal_position == "middle")
{
vkbRef.left = availWidth/3;
}
else if(horizontal_position == "left")
{
vkbRef.left = 0;
}
else
{
vkbRef.left = availWidth-255;
}
}
else
{
vkbRef.left = availWidth-255;
}
if(screen.height <= 600 || availHeight <= 500)
{
vkbRef.top = availHeight-140;
}
else
{
vkbRef.top = availHeight/2;
}
}
}
else
{
vkbRef.left =curr_LeftPosition;
vkbRef.top =curr_HeightPosition;
}
if(vkbRef)
{
if(ieOnWindows)
{
var vkbShimRef = accessLayer(vkbShimName);
if(vkbShimRef)
{
vkbShimRef.top=vkbRef.top;
vkbShimRef.left=vkbRef.left;
vkbShimRef.visibility='visible';
vkbShimRef.zIndex=100;
}
}
vkbRef.visibility = 'visible';
vkbRef.zIndex = 100;
}
}
function hideVkb(fieldRef)
{
var arr=document.getElementById("btn_container");
	
	arr.style.display='none';
		
	
	
if (keyboardFlag == "large")
{
hideVkbLarge(fieldRef);
}
else
{
vkbName = smallMap;
vkbShimName = smallMapShim;
hideVkbSmall(fieldRef);
}
fieldRef.value="";
}
function hideVkbSmall(fieldRef)
{
	delete fieldRef;
vkbFillElement = "";
var vkbRef = accessLayer(vkbName);
if(ieOnWindows)
{
var vkbShimRef = accessLayer(vkbShimName);
if(vkbShimRef){vkbShimRef.visibility = 'hidden'; vkbShimRef.zIndex=-1}
}
if(vkbRef){vkbRef.visibility = 'hidden'; vkbRef.zIndex=-1}
delete vkbRef;
}
function hideVkbLarge(fieldRef)
{
vkbFillElement = "";
var vkbRef = accessLayer(vkbName);
if(ieOnWindows)
{
var vkbShimRef = accessLayer(vkbShimName);
if(vkbShimRef){vkbShimRef.visibility = 'hidden'; vkbShimRef.zIndex=-1}
}
if(vkbRef){vkbRef.visibility = 'hidden'; vkbRef.zIndex=-1}
}
function smallkeyboard(element)
{
hideVkb(element);
keyboardFlag="small";
vkbName = smallMap;
vkbShimName = smallMapShim;
set_cookie('capp_keyboard',keyboardFlag,2);
var pwdField = null;
if(focusKey=="password"){pwdField = vkbForm.password;}
else if (focusKey=="pwd"){pwdField=vkbForm.pwd;}
else if(focusKey=="passwordConfirm"){pwdField = vkbForm.passwordConfirm;}
else if(focusKey=="currentPassword"){pwdField = vkbForm.currentPassword;}
else if(focusKey=="pin"){pwdField = vkbForm.pin;}
else if(focusKey=="secretAnswer1"){pwdField = vkbForm.secretAnswer1;}
else if(focusKey=="secretAnswer2"){pwdField = vkbForm.secretAnswer2;}
else if(focusKey=="oldPin"){pwdField = vkbForm.oldPin;}
else if(focusKey=="newPin"){pwdField = vkbForm.newPin;}
else if(focusKey=="renewPin"){pwdField = vkbForm.renewPin;}
alertFieldId=pwdField;
showVkb(pwdField);
focusId="1";
}
function largekeyboard(element)
{
hideVkb(element);
keyboardFlag="large";
vkbName = largeMap;
vkbShimName = largeMapShim;
set_cookie('capp_keyboard',keyboardFlag,2);
var pwdField = null;
if(focusKey=="password"){pwdField = vkbForm.password;}
else if (focusKey=="pwd"){pwdField=vkbForm.pwd;}
else if(focusKey=="passwordConfirm"){pwdField = vkbForm.passwordConfirm;}
else if(focusKey=="currentPassword"){pwdField = vkbForm.currentPassword;}
else if(focusKey=="pin"){pwdField = vkbForm.pin;}
else if(focusKey=="secretAnswer1"){pwdField = vkbForm.secretAnswer1;}
else if(focusKey=="secretAnswer2"){pwdField = vkbForm.secretAnswer2;}
else if(focusKey=="oldPin"){pwdField = vkbForm.oldPin;}
else if(focusKey=="newPin"){pwdField = vkbForm.newPin;}
else if(focusKey=="renewPin"){pwdField = vkbForm.renewPin;}
alertFieldId=pwdField;
showVkb(pwdField);
focusId="1";
}
function accessLayer(layerID)
{
if(document.getElementById && document.getElementById(layerID))
return document.getElementById(layerID).style;
else if(document.all && document.all[layerID])
return document.all[layerID].style;
else if(document.layers && document.layers[layerID])
return document.layers[layerID];
}

function space(val)
{
var elPtr;
var i=0;
var foundField = false;
if(foundField == false)
{
elPtr = eval(vkbFillElement);
if(elPtr)
{
var focusValue = new String(elPtr.value);
focusValue = focusValue + " ";
elPtr.value = focusValue
foundField = true;
}
}
if(foundField == false)
{
alert(focusError);
}
}

function changeGif(param)
{
	document.gif.src=param;
}
function changeGif1(param)
{
	document.gif1.src=param;
}
function changeGif2(param)
{
	document.gif2.src=param;
}
function changeGif3(param) 
{ 
  document.gif3.src=param; 
} 
function changeGif4(param) 
{ 
  document.gif4.src=param; 
} 

var b_timer = null; // blink timer 
var b_on = true; // blink state 
var blnkrs =  new Array();  // array of spans 
var b_count = 0; 
function blink(param,name){ 
	blink_x = 1 
	blink_y = 1 
	var tmp = document.getElementById(name).className; 
	add(param);	
	if (tmp == "alp_btn") { 
		document.getElementById(name).className = "blink";				
		blnkrs[b_count] = tmp; 
		++b_count; 
	} 		 
	ticToc(name); 
} 
function ticToc(name){ 
	if(blink_x==1)
	{ 
		blink_x=0; 
		blink_y++; 
		document.getElementById(name).style.visibility='visible'; 
	}else
	{ 
		blink_x=1; 
		blink_y++; 
		document.getElementById(name).style.visibility = "hidden";
	} 
	if (blink_y < 10) {var f = function(){ticToc(name);}
						setTimeout(f,75);
						return;}
	doShowblinkKeys();
} 