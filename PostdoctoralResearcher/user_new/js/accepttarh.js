// JavaScript Document
/* ---------------------------- */
/* XMLHTTPRequest Enable */
/* ---------------------------- */
function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
}else{
request_type = new XMLHttpRequest();
}
return request_type;
}

var http = createObject();
var http1 = createObject();
var http2 = createObject();
/* -------------------------- */
/* LOGIN */
/* -------------------------- */
/* Required: var nocache is a random number to add to request. This value solve an Internet Explorer cache issue */
var nocache = 0;


function getdata(codetarh,value) {
	
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http2.open('get', 'conf_accept_tarh.php?value='+value+'&codetarh='+codetarh+'&nocache ='+nocache);
http2.onreadystatechange = getdataReply;
http2.send(null);

}
function getdataReply() {
if(http2.readyState == 4){
var response = http2.responseText;
if(response == 0){
// if login fails
document.getElementById('sabtetarh').innerHTML ="<input value='1' type='checkbox' name='sabtetarh' id='sabtetarh' />";
// else if login is ok show a message: "Welcome + the user name".
} else {
document.getElementById('sabtetarh').innerHTML =response;
}
}
}