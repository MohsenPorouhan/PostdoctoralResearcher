var message="Sorry, Right Click is not allowed";
var dtCh= "/"; var minYear=1900; var maxYear=2100;

/*************************************************************************
 * Function Name : clickIE4,clickNS4
 * Description   : To disable the Right Button Click Event depends on the browser
 * Usage         : onChange
*************************************************************************/

function clickIE4()
{
	if (event.button==2)
	{
		alert(message);
		return false;
	}
}

function clickNS4(e)
{
	if (document.layers||document.getElementById&&!document.all)
	{
		if (e.which==2||e.which==3)
		{
			alert(message);
			return false;
		}
	}
}

if (document.layers)
{
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById)
{
	document.onmousedown=clickIE4;	
}
document.oncontextmenu=new Function("alert(message);return false")


/*
For Disabling F5(Refresh window) and Ctrl+R(Refresh window) and Ctrl+N(New Window)
*/

var message1="Sorry, Refresh Function is disabled.\nClick 'OK' to Proceed.";
var message2="Sorry, New Window Function is disabled.\nClick 'OK' to Proceed.";
var asciiF5 = 116; 
var ctrlR	= 114;
var ctrlN	= 110;
if(document.all)
{	
	//ie has to block in the key down 
	document.onkeydown  = disableF5Key
} 
else if (document.layers || document.getElementById)
{ 
	//NS and mozilla have to block in the key press; 
	document.onkeypress = onKeyPress; 
} 

function onKeyPress(evt) 
{ 
	var oEvent = (window.event) ? window.event : evt; 
	var nKeyCode = oEvent.keyCode ? oEvent.keyCode :oEvent.which ? oEvent.which : void 0; 
	var nCtrlKeyCode = oEvent.ctrlKey ? oEvent.ctrlKey :oEvent.which ? oEvent.which : void 0;
	var bIsFunctionKey = false; 
	if(nKeyCode==asciiF5)
	{ 
		bIsFunctionKey = asciiF5; 
	} 
	if(nCtrlKeyCode==true && nKeyCode==ctrlR)
	{ 
		bIsFunctionKey = ctrlR; 
	} 	
	if(nCtrlKeyCode==true && nKeyCode==ctrlN)
	{ 
		bIsFunctionKey = ctrlN; 
	} 		
	var sChar = String.fromCharCode(nKeyCode).toUpperCase(); 
	var oTarget = (oEvent.target) ? oEvent.target : oEvent.srcElement; 
	var sTag = oTarget.tagName.toLowerCase(); 
	var sTagType = oTarget.getAttribute("type"); 

	var bRet = true; 
	if(sTagType != null)
	{ 
		sTagType = sTagType.toLowerCase(); 
	} 
	if(bIsFunctionKey)
	{ 
		bRet = false; 
	} 

	if(!bRet)
	{ 
		try
		{ 
			oEvent.returnValue = false; 
			oEvent.cancelBubble = true; 
			/*if(document.all)
			{ 
				//IE 
				oEvent.keyCode = 0; 
			}*/
			if(!document.all)
			{ 
				//NS 
				oEvent.preventDefault(); 
				oEvent.stopPropagation(); 
			} 
			if((nKeyCode==nCtrlKeyCode)||((nCtrlKeyCode==true)&&(nKeyCode==116)))
			{				 
				return bRet; 
			}else{
			if(nKeyCode==ctrlN)
			{ 
				alert(message2);
			} 
			if(nKeyCode==asciiF5 || nKeyCode==ctrlR)
			{ 
				alert(message1);
			} 
			}
					
			
		}
		catch(ex)
		{ 
			//alert(ex); 
		} 
	} 
	return bRet; 
} 

function disableF5Key()
{
	if(window.event && window.event.keyCode == 116) 
	{	
		// Capture and remap F5
		window.event.keyCode = 0;
		alert(message1);
		return false;
  	}
	if(window.event.ctrlKey && window.event.keyCode == 82)
	{	
		//  When ctrl is pressed with R-82
		window.event.keyCode = 0;
		alert(message1);
		return false;
  	}
	if(window.event.ctrlKey && window.event.keyCode == 78)
	{	
		//  When ctrl is pressed with N-78
		window.event.keyCode = 0;
		alert(message2);
		return false;
  	}
}


function isBlank(s,internalCall)
{ var lenParam = arguments.length; if(s.type=="password")
{ if(s.value=="") return true;}
else if(s.type=="textarea")
{ if(s.value=="") return true;}
else if(s.type=="text")
{ if (lenParam <= 1)
{ s.value = s.value.replace(/^\s+/g, '').replace(/\s+$/g, '');}
if(s.value=="") return true; var count = 0 ; var count1 = 0; var stopind = 0; for(var j=0;j<s.value.length;j++)
{ if(s.value.charAt(j)== " ")
count++; else
{ stopind = j; break;}
}
if(count == s.value.length)
return true;}
else if((s.type=="select-one") || (s.type=="select-multiple"))
{ var len = s.length; var ind = s.options.selectedIndex; if(len==0) return true; for(var i=0;i<len;i++)
{ if((s.options[i].selected) && (s.options[i].value==""))
return true;}
if(ind<0)
{ return true;}
if(s.options[ind].value=="" || s.options[ind].value == null )
{ return true;}
}
return false;
}

function checkBlank(obj)
{ var len=obj.length; var returnFlag=false; for(var i=0; i<len;i++)
{ if(obj.options[i].value!="")
{ returnFlag=true; break;}
}
return(returnFlag);}
function fnCBSIsValidEmailAddress (string) { var addressPattern = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/; return addressPattern.test(string);}
function ValidateEmailAddress(emailField,name,description)
{ if(isBlank(emailField,'Y') || fnCBSIsValidEmailAddress(emailField.value)) return true; else
{ alert(name+"  Invalid Entry : Correct Format is xxx@xx.xxx "); emailField.focus(); return false;}
}
function getSelectedObj() { var ret; if ( this.parentobj != null ) { ret = this.parentobj.selectedList; if ( ret.length <= 0 )
ret = this.parentobj.getSelectedObj();}
else { ret = this.selectedList;}
return ret;}

function getDescData(descArray,codeArray,theObj,descObj)
{ 
	for(var i=0;i<descArray.length;i++)
	{ 
		var selectedid = getSelectedListValue(theObj); 
		if(selectedid==codeArray[i])
		{ 
			descObj.value=descArray[i];
			break;
		}
}
if(0==theObj.selectedIndex)
{ descObj.value="";}
}

function getSelectedListValue(selectList)
{ var value = selectList.options[selectList.selectedIndex].value; if (typeof value == 'undefined' || value == null || value == '')
value = selectList.options[selectList.selectedIndex].text; return value;}

function setLovValues(lovName,lovValue)
{ 
	var i ;
	for(i=0;i<lovName.options.length;i++)
	{
		//alert("lovName.options[i].value"+lovName.options[i].value);
		//alert("lovValue"+lovValue);
		if(lovName.options[i].value==lovValue)
		lovName.options[i].selected=true;
	}
}
function setLovValues1(lovName,lovValue)
{ 
	var i ;
	for(i=0;i<lovName.options.length;i++)
	{
		var lovNameValue = "";
		lovNameValue = lovName.options[i].value;
		if(lovNameValue.indexOf("--") > -1){ 
			lovNameValue = lovNameValue.substring(0,lovNameValue.indexOf("--"));
		}
		if(lovNameValue==lovValue){
		lovName.options[i].selected=true;
		}
	}
}
//******************************************************
//BHD
function getDescDataFilter(descArray,codeArray,theObj,descObj)
{ 
	for(var i=0;i<descArray.length;i++)
	{ 
		var selectedid = getSelectedListValueFilter(theObj); 
		if(selectedid==codeArray[i])
		{ 
			descObj.value=descArray[i];
			break;
		}
}
if(0==theObj.selectedIndex)
{ descObj.value="";}
}

function getSelectedListValueFilter(selectList)
{ 
	var value = selectList.options[selectList.selectedIndex].value;
	alert("value"+value);
	if (typeof value == 'undefined' || value == null || value == '')
	{
		return;
	}else{	
	 return value;
	}
	//value = selectList.options[selectList.selectedIndex].text;
}

//****************************************************




function Optpopulate(obj,elname)
{ var objField = document.getElementById(elname); if(obj.length != 0)
{ objField.options[0] = new Option();
objField.options[0].text = "";
objField.options[0].value = "";
for ( var i = 0; i< obj.length; i++ )
	{ if(obj[i]!="")
		{ objField.options[i+1] = new Option();
		  objField.options[i+1].text = obj[i];
		  objField.options[i+1].value = obj[i];
	}
}
}
else if(obj.length == 0)
{ objField.options[0] = new Option();}
return;}

function OptpopulateByFrmObj(obj,objField)
{ 
//	var objField = document.getElementById(elname); 
	if(obj.length != 0)
		{ 
		objField.options[0] = new Option();
		objField.options[0].text = "";
		objField.options[0].value = "";
		for ( var i = 0; i< obj.length; i++ ){
			if(obj[i]!=""){ 
				objField.options[i+1] = new Option();
				objField.options[i+1].text = obj[i];
				objField.options[i+1].value = obj[i];
				}
			}
		}
	else if(obj.length == 0){
		objField.options[0] = new Option();
		}
	return;
}


function Optpopulate1(obj1,obj2,elname)
{ var objField = document.getElementById(elname); if(obj1.length != 0 && obj2.length != 0)
{ objField.options[0] = new Option(); objField.options[0].text = ""; objField.options[0].value = ""; for ( var i = 0; i< obj1.length; i++ ) { if(obj1[i]!="" && obj2[i]!="")
{ objField.options[i+1] = new Option(); objField.options[i+1].text = obj2[i]; objField.options[i+1].value = obj1[i];}
}
}
return;}
function Optpopulate0(obj1,obj2,elname)
{
var objField = document.getElementById(elname);
if(obj1.length != 0 && obj2.length != 0)
{
	for ( var i = 0; i< obj1.length; i++ ) {
			
			if(obj1[i]!="" && obj2[i]!="")
			{   objField.options[i] = new Option();
				objField.options[i].text  = obj2[i];
				objField.options[i].value = obj1[i];
			}	
				
		}
	}
 return;
}
function showtip(current,e,text)
{ if (document.all)
{ thetitle=text.split('<br>')
if (thetitle.length > 1)
{ thetitles=""
for (i=0; i<thetitle.length-1; i++)
thetitles += thetitle[i] + "\r\n"
current.title = thetitles
}
else
current.title = text
}
else if (document.layers)
{ document.tooltip.document.write('<layer bgColor="#FFFFE7" style="border:1px ' +'solid black; font-size:12px;color:#000000;">' + text + '</layer>')
document.tooltip.document.close()
document.tooltip.left=e.pageX+5
document.tooltip.top=e.pageY+5
document.tooltip.visibility="show"
}
}
function hidetip()
{ if (document.layers)
document.tooltip.visibility="hidden"
}
function checkBlankSpace(s)
{ while (s.substring(0,1) == ' ')
{ s = s.substring(1,s.length);}
while (s.substring(s.length-1,s.length) == ' ')
{ s = s.substring(0,s.length-1);}
return s;}
function checkSpecialChars(Field)
{ var val = Field.value; var flag; for(i=0;i<val.length;i++)
{ if(val.charAt(i)=='#' || val.charAt(i)=='~' || val.charAt(i)=='&' || val.charAt(i)=='^' || val.charAt(i)=='@' || val.charAt(i)=='!' || val.charAt(i)=='`' || val.charAt(i)=='$'|| val.charAt(i)=='%'|| val.charAt(i)=='*'|| val.charAt(i)=='('|| val.charAt(i)==')'|| val.charAt(i)=='?'|| val.charAt(i)=='|' )
return false;}
return true;}
function checkspecialCharsBeneficiary(Field){ var iChars = "`~!@#$%^&*()+=-[]\\\';/{}|\"<>?"; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) != -1) { return false;}
}
return true;}
function newcheckspecialChars(Field){ var iChars = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	var charfield = Field.value; 
	for (var i = 0; i < charfield.length; i++) {
		if (iChars.indexOf(charfield.charAt(i)) == -1) 
			{ return true;
			}
		}
	}
function newblankspaceChars(Field)
{ var iChars = "       "; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) != -1) { return true;}
}
}
function newpercentagespecialChars(Field)
{ var iChars = "!@#$^&*()+=-[]\\\';,./{}|\":<>?"; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) != -1) { return true;}
}
}
function newspecialChars(Field)
{ var iChars = "!@#$^&*()+=-[]\\\';,./{}|\":<>?."; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) != -1) { return true;}
}
}
function checkSp(param)
{ var val=param.value; for(var i=0;i<val.length;i++)
{ if(!((val.charAt(i)>='A' && val.charAt(i)<='Z') || (val.charAt(i)>='a' && val.charAt(i)<='z') || (val.charAt(i)<='9' && val.charAt(i)>='0')))
{ return true;}
}
}
function checkAlphaNumeric(param)
{ var numflag = false; var charflag = false; var val=param.value; for(var i=0;i<val.length;i++)
{ var pos1 = i; var pos2 = i+1; var element = val.substring(parseInt(pos1),parseInt(pos2)); if(isNaN(element))
{ charflag = true;}
else
{ numflag = true;}
}
if(!numflag)
{ return true;}
else if(!charflag)
{ return true;}
}
function containSameChars(myNewPassword,myOldPassword) { var smallerLength; var matchingChars; var i; matchingChars = 0; smallerLength = (myNewPassword.length > myOldPassword.length) ? myOldPassword.length : myNewPassword.length; for (i=0; i<smallerLength; i++) { if (myNewPassword.charAt(i) == myOldPassword.charAt(i)) { matchingChars++;}
}
if (matchingChars > 2) { return true;}
return false;}
function checkSMSGreaterDate(date1,date2)
{ var fromdt=date1.value
var todt=date2.value
if( (fromdt=="") && (todt=="")) return true; if( ((fromdt!="") && (todt=="") ) || ((fromdt=="") && (todt!="") ))
{ return false;}
var firstslash=fromdt.indexOf("/")
var lastslash=fromdt.lastIndexOf("/")
var yearfrom=fromdt.substr(lastslash+1)
var monfrom=fromdt.substring(firstslash+1,lastslash)
var dayfrom=fromdt.substr(0,firstslash)
fromdt = monfrom+"/"+dayfrom+"/"+yearfrom; var todt=date2.value
firstslash=todt.indexOf("/")
lastslash=todt.lastIndexOf("/")
var yearto=todt.substr(lastslash+1)
var monto=todt.substring(firstslash+1,lastslash)
var dayto=todt.substr(0,firstslash)
todt = monto+"/"+dayto+"/"+yearto; firstDate= Date.parse(fromdt); secondDate=Date.parse(todt); var chk =true; diff = firstDate-secondDate; if(diff>0 )
{ return false;}
return true;}
function checkspecialCharsSMS(Field){ var iChars = "%@#$^&*()+=[]\\\';/{}|\"<>?"; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) != -1) { return true;}
}
}
function checkAlphaChars(Field){ var iChars = "0123456789%"; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) == -1) { return false;}
}
return true;}
function checkAlphaNumericChars(Field){ var iChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; var charfield = Field.value; for (var i = 0; i < charfield.length; i++) { if (iChars.indexOf(charfield.charAt(i)) == -1) { return false;}
}
return true;}

function Trimspace (Field)
	{ 
		var inDate = Field.value;
		if(isWhitespace (inDate))
			{ 
				Field.value='';
				inDate = Field.value;
			}
		if(inDate.length!=0)
			{ 
				var i=0 ; var j=0 ;
				for(i=0;i<inDate.length;i++)
					{ 
						if(inDate.charAt(i)==' ')
						j++;
						else break;
					}
				inDate =inDate.substring(j,inDate.length);
				var k=0
				if(inDate.charAt(inDate.length-1)==' ')
					{ 
						for(i=inDate.length-1;i>=0;i--)
							{ 
								if(inDate.charAt(i)==' ')
									{ 
										k++;
									}
								else
									{ 
									break 
									}
							}
					}
				inDate =inDate.substring(0,inDate.length-k);
			}
			return inDate;
	}
function hidingIcon(obj)
{ if(navigator.appName == 'Netscape')
{ document.getElementById(obj).style.visibility="hidden"
}
else if (document.all)
{ document.all[obj].style.visibility = 'hidden';}
}
function checkdate_cur(DateFormat,ActDate,Field,Message)
{ var dateval = Field; if(dateval.length==0)
return; else
return validdate(DateFormat,ActDate,Field,Message);}
function checkdate_less(DateFormat,ActDate,Field,Message)
{ var dateval = Field; if(dateval.length==0)
return; else
return validdate1(DateFormat,ActDate,Field,Message);}
function checkdate_greaterThanToday(DateFormat,ActDate,Field,Message)
{ var dateval = Field; if(dateval.length==0)
return; else
return validdate3(DateFormat,ActDate,Field,Message);}
function validdate(DateFormat,ActDate,Field,Message)
{ var Format = DateFormat; var Dchar = Format.charAt(0); dateTwo=Field; chkdate=ActDate; var td = new Date(); var tday = td.getDate(); var tmonth = td.getMonth()+1; var tyear = td.getYear()+1900; var sep ; var inDay; var inMonth; var inYear; var inDay1; var inMonth1; var inYear1; var oneDateNum; var twoDateNum; if(Dchar=='D' || Dchar=='d')
{ sep = Format.charAt(2); inDay = parseInt(dateTwo.substring(0,dateTwo.indexOf( sep )), 10); inMonth = parseInt(dateTwo.substring(dateTwo.indexOf( sep ) + 1, dateTwo.lastIndexOf( sep )), 10 ); inYear = parseInt(dateTwo.substring(dateTwo.lastIndexOf( sep ) + 1, dateTwo.length), 10); twoDateNum = (inYear * 10000) + (inMonth * 100) + inDay; inDay1 = parseInt(chkdate.substring(0,chkdate.indexOf( sep )), 10); inMonth1 = parseInt(chkdate.substring(chkdate.indexOf( sep ) + 1, chkdate.lastIndexOf( sep )), 10 ); inYear1 = parseInt(chkdate.substring(chkdate.lastIndexOf( sep ) + 1, chkdate.length), 10); oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1;}
if(parseInt(twoDateNum)<parseInt(oneDateNum))
{ alert(Message); return false;}
return true;}
function validdate1(DateFormat,ActDate,Field,Message)
{ var Format = DateFormat; var Dchar = Format.charAt(0); dateTwo=Field; chkdate=ActDate; var td = new Date(); var tday = td.getDate(); var tmonth = td.getMonth()+1; var tyear = td.getYear()+1900; var sep ; var inDay; var inMonth; var inYear; var inDay1; var inMonth1; var inYear1; var oneDateNum; var twoDateNum; if(Dchar=='D' || Dchar=='d')
{ sep = Format.charAt(2); inDay = parseInt(dateTwo.substring(0,dateTwo.indexOf( sep )), 10); inMonth = parseInt(dateTwo.substring(dateTwo.indexOf( sep ) + 1, dateTwo.lastIndexOf( sep )), 10 ); inYear = parseInt(dateTwo.substring(dateTwo.lastIndexOf( sep ) + 1, dateTwo.length), 10); twoDateNum = (inYear * 10000) + (inMonth * 100) + inDay; inDay1 = parseInt(chkdate.substring(0,chkdate.indexOf( sep )), 10); inMonth1 = parseInt(chkdate.substring(chkdate.indexOf( sep ) + 1, chkdate.lastIndexOf( sep )), 10 ); inYear1 = parseInt(chkdate.substring(chkdate.lastIndexOf( sep ) + 1, chkdate.length), 10); oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1;}
if(parseInt(twoDateNum)>parseInt(oneDateNum))
{ alert(Message); return false;}
return true;}
function validdate3(DateFormat,ActDate,Field,Message)
{ var Format = DateFormat; var Dchar = Format.charAt(0); dateTwo=Field; chkdate=ActDate; var td = new Date(); var tday = td.getDate(); var tmonth = td.getMonth()+1; var tyear = td.getYear()+1900; var sep ; var inDay; var inMonth; var inYear; var inDay1; var inMonth1; var inYear1; var oneDateNum; var twoDateNum; if(Dchar=='D' || Dchar=='d')
{ sep = Format.charAt(2); inDay = parseInt(dateTwo.substring(0,dateTwo.indexOf( sep )), 10); inMonth = parseInt(dateTwo.substring(dateTwo.indexOf( sep ) + 1, dateTwo.lastIndexOf( sep )), 10 ); inYear = parseInt(dateTwo.substring(dateTwo.lastIndexOf( sep ) + 1, dateTwo.length), 10); twoDateNum = (inYear * 10000) + (inMonth * 100) + inDay; inDay1 = parseInt(chkdate.substring(0,chkdate.indexOf( sep )), 10); inMonth1 = parseInt(chkdate.substring(chkdate.indexOf( sep ) + 1, chkdate.lastIndexOf( sep )), 10 ); inYear1 = parseInt(chkdate.substring(chkdate.lastIndexOf( sep ) + 1, chkdate.length), 10); oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1;}
if(parseInt(twoDateNum)>=parseInt(oneDateNum))
{ alert(Message); return false;}
return true;}
function datedifference_valid(DateFormat,ActDate,Field)
{ var Format = DateFormat; var Dchar = Format.charAt(0); dateTwo=Field; chkdate=ActDate; var td = new Date(); var tday = td.getDate(); var tmonth = td.getMonth()+1; var tyear = td.getYear()+1900; var sep ; var inDay; var inMonth; var inYear; var inDay1; var inMonth1; var inYear1; var oneDateNum; var twoDateNum; if(Dchar=='D' || Dchar=='d')
{ sep = Format.charAt(2); inDay = parseInt(dateTwo.substring(0,dateTwo.indexOf( sep )), 10); inMonth = parseInt(dateTwo.substring(dateTwo.indexOf( sep ) + 1, dateTwo.lastIndexOf( sep )), 10 ); inYear = parseInt(dateTwo.substring(dateTwo.lastIndexOf( sep ) + 1, dateTwo.length), 10); twoDateNum = (inYear * 10000) + (inMonth * 100) + inDay; inDay1 = parseInt(chkdate.substring(0,chkdate.indexOf( sep )), 10); inMonth1 = parseInt(chkdate.substring(chkdate.indexOf( sep ) + 1, chkdate.lastIndexOf( sep )), 10 )-1; inYear1 = parseInt(chkdate.substring(chkdate.lastIndexOf( sep ) + 1, chkdate.length), 10); oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1;}
if (parseInt(inYear1) > parseInt(inYear))
{ if(parseInt(twoDateNum) > parseInt(oneDateNum) || (parseInt(inMonth) - parseInt(inMonth1)) != 12 || parseInt(inDay) <= parseInt(inDay1))
{ return false;}
return true;}
else
{ if(parseInt(twoDateNum)<parseInt(oneDateNum))
{ return false;}
return true;}
}
function checkIfDateValid(dateFormat, dateField)
{ var inDate = dateField; if(inDate.length==0)
return false; var inDate = dateField; var consFormat = dateFormat; var daysInMonth = new Array(12); daysInMonth[1] = 31; daysInMonth[2] = 29; daysInMonth[3] = 31; daysInMonth[4] = 30; daysInMonth[5] = 31; daysInMonth[6] = 30; daysInMonth[7] = 31; daysInMonth[8] = 31; daysInMonth[9] = 30; daysInMonth[10] = 31; daysInMonth[11] = 30; daysInMonth[12] = 31; var inDay = ''; var inMonth = ''; var inYear = ''; var FormatSep = ''; var sep = '/'; var strDate = ''; var strMonth = '00'; var strCon = '0'; var invalidDate = 0; if (inDate.indexOf('-') > 0 )
{ sep = '-';}; if (inDate.indexOf('.') > 0 )
{ sep = '.';}; if( consFormat.substring(0, 2) == 'dd' )
{ FormatSep = consFormat.substring(2,3); inDay = inDate.substring( 0, inDate.indexOf( sep ) ); inMonth = inDate.substring( inDate.indexOf( sep ) + 1, inDate.lastIndexOf( sep ) ); inYear = inDate.substring( inDate.lastIndexOf( sep ) + 1, inDate.length );}
invalidDate = 0; if (inDay.length > 0 && inDay.length <= 2)
{ inDay = parseInt(inDay, 10);}
else
{ invalidDate = 1;}
if (inMonth.length > 0 && inMonth.length <= 2)
{ inMonth = parseInt(inMonth, 10);}
else
{ invalidDate = 1;}
if (inYear.length < 1 || inYear.length > 4 || inYear.length == 3 )
{ invalidDate = 1;}
else
{ inYear = parseInt(inYear, 10);}
if (invalidDate==0)
{ if (inYear < 100 && inYear > 40)
{ inYear += 1900;}
if (inYear < 100 && inYear <= 40)
{ inYear += 2000;}
}
if( inMonth < 1 || inMonth > 12 )
{ invalidDate = 1;}
if ((inDay < 1) || (inDay > daysInMonth[inMonth]) )
{ invalidDate = 1;}
if ((inMonth == 2) && (inDay > ( ( (inYear % 4 == 0) && ( !(inYear % 100 == 0) || (inYear % 400 == 0) ) ) ? 29 : 28 ) ))
{ invalidDate = 1;}
if (invalidDate == 1 || isNaN(inDay) || isNaN(inMonth) || isNaN(inYear) )
{ return false;}
else
{ inDay = strCon + inDay; inMonth = strCon + inMonth; if( consFormat.substring(0, 2) == 'dd' )
{ strDate = inDay.substring(inDay.length-2,inDay.length) + FormatSep + inMonth.substring(inMonth.length-2,inMonth.length) + FormatSep + inYear;}
else if( consFormat.substring(0, 2) == 'MM' )
{ strDate = inMonth.substring(inMonth.length-2,inMonth.length) + FormatSep + inDay.substring(inDay.length-2,inDay.length) + FormatSep + inYear;}
else
{ strDate = inYear + FormatSep + inMonth.substring(inMonth.length-2,inMonth.length) + FormatSep + inDay.substring(inDay.length-2,inDay.length)
};}
return true;}
function emailCheck (emailStr)
{ var checkTLD=1; var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/; var emailPat=/^(.+)@(.+)$/; var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]"; var validChars="\[^\\s" + specialChars + "\]"; var quotedUser="(\"[^\"]*\")"; var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/; var atom=validChars + '+'; var word="(" + atom + "|" + quotedUser + ")"; var userPat=new RegExp("^" + word + "(\\." + word + ")*$"); var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$"); var matchArray=emailStr.match(emailPat); if (matchArray==null) { return false;}
var user=matchArray[1]; var domain=matchArray[2]; for (i=0; i<user.length; i++) { if (user.charCodeAt(i)>127) { return false;}
}
for (i=0; i<domain.length; i++) { if (domain.charCodeAt(i)>127) { return false;}
}
if (user.match(userPat)==null) { return false;}
var IPArray=domain.match(ipDomainPat); if (IPArray!=null) { for (var i=1;i<=4;i++) { if (IPArray[i]>255) { return false;}
}
return true;}
var atomPat=new RegExp("^" + atom + "$"); var domArr=domain.split("."); var len=domArr.length; for (i=0;i<len;i++) { if (domArr[i].search(atomPat)==-1) { return false;}
}
if (checkTLD && domArr[domArr.length-1].length!=2 &&
domArr[domArr.length-1].search(knownDomsPat)==-1) { return false;}
if (len<2) { return false;}
return true;}
var dtCh= "/"; var minYear=1900; var maxYear=2100; function isInteger(s){ var i; for (i = 0; i < s.length; i++){ var c = s.charAt(i); if (((c < "0") || (c > "9"))) return false;}
return true;}
function stripCharsInBag(s, bag){ var i; var returnString = ""; for (i = 0; i < s.length; i++){ var c = s.charAt(i); if (bag.indexOf(c) == -1) returnString += c;}
return returnString;}
function daysInFebruary (year){ return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );}
function DaysArray(n) { for (var i = 1; i <= n; i++) { this[i] = 31
if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
if (i==2) {this[i] = 29}
}
return this
}
function isDate(dtStr){ var daysInMonth = DaysArray(12)
var pos1=dtStr.indexOf(dtCh)
var pos2=dtStr.indexOf(dtCh,pos1+1)
var strDay=dtStr.substring(0,pos1)
var strMonth=dtStr.substring(pos1+1,pos2)
var strYear=dtStr.substring(pos2+1)
strYr=strYear
if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
for (var i = 1; i <= 3; i++) { if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
}
month=parseInt(strMonth)
day=parseInt(strDay)
year=parseInt(strYr)
if (pos1==-1 || pos2==-1){ alert("Please enter a valid date")
return false
}
if (strMonth.length<1 || month<1 || month>12){ alert("Please enter a valid month")
return false
}
if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){ alert("Please enter a valid day")
return false
}
if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){ alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
return false
}
if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){ alert("Please enter a valid date")
return false
}
return true
}
function isWhitespace (s)
{ var reWhitespace = /^[ ]+$/ ; return (reWhitespace.test(s));}
var vWinCal = null; function closeWin()
{ if (vWinCal != null)
{ if (!vWinCal.closed)
{ vWinCal.self.close();}
}
}
function checkGreaterDate(date1,date2,description)
 {

	var fromdt=date1.value
	var todt=date2.value


	if( (fromdt=="") && (todt=="")) return true;
	if( ((fromdt!="") && (todt=="") ) || ((fromdt=="") && (todt!="") ))
	{
               if(fromdt=="")
               date1.focus();
               else
               date2.focus();
		//alert("Enter Both "+ description + " Dates or do not enter any dates");
		return false;
	}

	var firstslash=fromdt.indexOf("/")
	var lastslash=fromdt.lastIndexOf("/")
	var yearfrom=fromdt.substr(lastslash+1)
	var monfrom=fromdt.substring(firstslash+1,lastslash)
	var dayfrom=fromdt.substr(0,firstslash)
	fromdt = monfrom+"/"+dayfrom+"/"+yearfrom;



	var todt=date2.value

	firstslash=todt.indexOf("/")
	lastslash=todt.lastIndexOf("/")
	var yearto=todt.substr(lastslash+1)
	var monto=todt.substring(firstslash+1,lastslash)
	var dayto=todt.substr(0,firstslash)
	todt = monto+"/"+dayto+"/"+yearto;




	firstDate= Date.parse(fromdt);

	secondDate=Date.parse(todt);

	var chk =true;
	diff = firstDate-secondDate;

	if(diff>0 )
	{

	//alert("Invalid Entry: 'To' date cannot be earlier than 'From' date.")
	date1.focus();
		//alert("The From " + description + " date should not be greater than  "+ description+ " Todate");
		return false;
	}
	return true;

}


function checkGreaterDateUserProfile(date1,date2,description)
 {

	var fromdt=date1.value
	var todt=date2.value


	if( (fromdt=="") && (todt=="")) return true;
	if( ((fromdt!="") && (todt=="") ) || ((fromdt=="") && (todt!="") ))
	{
               if(fromdt=="")
               date1.focus();
               else
               date2.focus();
		//alert("Enter Both "+ description + " Dates or do not enter any dates");
		return false;
	}

	var firstslash=fromdt.indexOf("/")
	var lastslash=fromdt.lastIndexOf("/")
	var yearfrom=fromdt.substr(lastslash+1)
	var monfrom=fromdt.substring(firstslash+1,lastslash)
	var dayfrom=fromdt.substr(0,firstslash)
	fromdt = monfrom+"/"+dayfrom+"/"+yearfrom;



	var todt=date2.value

	firstslash=todt.indexOf("/")
	lastslash=todt.lastIndexOf("/")
	var yearto=todt.substr(lastslash+1)
	var monto=todt.substring(firstslash+1,lastslash)
	var dayto=todt.substr(0,firstslash)
	todt = monto+"/"+dayto+"/"+yearto;




	firstDate= Date.parse(fromdt);

	secondDate=Date.parse(todt);

	var chk =true;
	diff = firstDate-secondDate;

	if(diff>0 )
	{

	alert("Validity End Date cannot be earlier than Validity Start Date.")
	date1.focus();
		//alert("The From " + description + " date should not be greater than  "+ description+ " Todate");
		return false;
	}
	return true;

}



/* javascript function to check whether the from date is less than to the other date entered or not*/


function checkOtherGreaterDate(date1,date2,description)
 {

	var fromdt=date1.value
	var todt=date2.value

    if(todt == "")
        return true;
	/*if( (fromdt=="") && (todt=="")) return true;
	if( ((fromdt!="") && (todt=="") ) || ((fromdt=="") && (todt!="") ))
	{
               if(fromdt=="")
               date1.focus();
               else
               date2.focus();
		return false;
	}*/

	var firstslash=fromdt.indexOf("/")
	var lastslash=fromdt.lastIndexOf("/")
	var yearfrom=fromdt.substr(lastslash+1)
	var monfrom=fromdt.substring(firstslash+1,lastslash)
	var dayfrom=fromdt.substr(0,firstslash)
	fromdt = monfrom+"/"+dayfrom+"/"+yearfrom;



	var todt=date2.value

	firstslash=todt.indexOf("/")
	lastslash=todt.lastIndexOf("/")
	var yearto=todt.substr(lastslash+1)
	var monto=todt.substring(firstslash+1,lastslash)
	var dayto=todt.substr(0,firstslash)
	todt = monto+"/"+dayto+"/"+yearto;

	firstDate= Date.parse(fromdt);

	secondDate=Date.parse(todt);

	var chk =true;
	diff = secondDate-firstDate;

	if(diff >= 0 )
	    return true
	else
	{
    	alert("Invalid Entry: "+description);
    	date2.focus();
        return false;
	}

}


function checkGreaterDatewithoutdependency(date1,date2,description)
 {

	var fromdt=date1.value
	var todt=date2.value

	var firstslash=fromdt.indexOf("/")
	var lastslash=fromdt.lastIndexOf("/")
	var yearfrom=fromdt.substr(lastslash+1)
	var monfrom=fromdt.substring(firstslash+1,lastslash)
	var dayfrom=fromdt.substr(0,firstslash)
	fromdt = monfrom+"/"+dayfrom+"/"+yearfrom;


	var todt=date2.value

	firstslash=todt.indexOf("/")
	lastslash=todt.lastIndexOf("/")
	var yearto=todt.substr(lastslash+1)
	var monto=todt.substring(firstslash+1,lastslash)
	var dayto=todt.substr(0,firstslash)
	todt = monto+"/"+dayto+"/"+yearto;



	firstDate= Date.parse(fromdt);
	secondDate=Date.parse(todt);
	var chk =true;
	diff = firstDate-secondDate;

	if(diff>0 )
	{

		alert("\"From Date\" cannot be greater than \"To Date\"" );
		date1.focus();
		return false;
	}
	return true;

}

function confirmPassword(frm,selAuthPwd,spCharNotallowed,enterNumPwd,spaceNotAllowed,pwdMaxChar,pwdMinChar)
{
	if(frm.authpassword.value == "")
	{
		alert(selAuthPwd);
		frm.authpassword.focus();
		frm.authpassword.value = "";
		return false;
	}
	if((newcheckspecialChars(frm.authpassword)))
	{
		alert(spCharNotallowed);
		frm.authpassword.focus();
		frm.authpassword.value = "";
		return false ;
	} 
	if((checkAlphaNumericChars(frm.authpassword)))
	{
		alert(enterNumPwd);
		frm.authpassword.focus();
		frm.authpassword.value = "";
		return false ;
	}
	if((newblankspaceChars(frm.authpassword)))
	{
		alert(spaceNotAllowed);
		frm.authpassword.focus();
		frm.authpassword.value = "";
		return false;
	}
	if(frm.authpassword.value.length > 9) 
	{
		alert(pwdMaxChar);
        frm.authpassword.focus();
		return false;
	}
	if(frm.authpassword.value.length < 6) 
	{
		alert(pwdMinChar);
        frm.authpassword.focus();
		return false;
	}
	return true;
}


/*************************************************************************
 * Function Name : checkBoxSelectAll
 * Description   : To check all the checkboxes when the selectall checkbox is checked
 * Parameters    : 
                   formObj - form name 
       field1  - select all checkbox field
       field2  - loop checkboxes
*************************************************************************/
 
function checkBoxSelectAll(formObj,field1,field2)
{
 if (formObj != null)
 {
  var checkall = false;
  var length = formObj.elements.length;
  for (i = 0; i < length; i++)
  {
   if(formObj.elements[i].type == "checkbox" )
   {
    if(formObj.elements[i].name == field1 && formObj.elements[i].checked == true)
    {
     checkall = true;
     continue;
    }
//   alert('a :'+formObj.elements[i].name)
    if (formObj.elements[i].type == "checkbox" && formObj.elements[i].name == field2 && checkall)
    {
     formObj.elements[i].checked = true;
    }
    else
    {
     formObj.elements[i].checked = false;
    }  
//   else
//    alert('b :'+formObj.elements[i].name);
   }
  }
 }
}
 

 

/*************************************************************************
 * Function Name : checkBoxUnSelectAll
 * Description   : To Uncheck the Select all checkbox when one of the checkboxes is unchecked
 * Parameters    : 
     field1-selectall checkbox object
     field2-unchecked checkbox object
                 
*************************************************************************/
 
function checkBoxUnSelectAll(field1,field2)
{
 if (field2.checked==false && field1.checked==true)
 {
  field1.checked=false;
 }
}


/*************************************************************************
 * Function Name : ltrim,rtrim,trim
 * Description   : Trming the spaces
 * Parameters    : s - field value
 *************************************************************************/

function ltrim ( s )
{
	return s.replace( /^\s*/, "" );
}

function rtrim ( s )
{
	return s.replace( /\s*$/, "" );
}

function trim( s )
{
	return rtrim(ltrim(s));
} 
function checkdate_LesserThanToday(DateFormat,ActDate,Field,Message)
{ 
	var dateval = Field;
	if(dateval.length==0)
	return;
	else
	return validdatelesser(DateFormat,ActDate,Field,Message);
}
function validdatelesser(DateFormat,ActDate,Field,Message)
{ 
	var Format = DateFormat;
	var Dchar = Format.charAt(0);
	dateTwo=Field; chkdate=ActDate;
	var td = new Date();
	var tday = td.getDate();
	var tmonth = td.getMonth()+1;
	var tyear = td.getYear()+1900;
	var sep ;
	var inDay;
	var inMonth;
	var inYear;
	var inDay1;
	var inMonth1;
	var inYear1;
	var oneDateNum;
	var twoDateNum;
	if(Dchar=='D' || Dchar=='d')
		{
		sep = Format.charAt(2);
		inDay = parseInt(dateTwo.substring(0,dateTwo.indexOf( sep )), 10);
		inMonth = parseInt(dateTwo.substring(dateTwo.indexOf( sep ) + 1, dateTwo.lastIndexOf( sep )), 10 );
		inYear = parseInt(dateTwo.substring(dateTwo.lastIndexOf( sep ) + 1, dateTwo.length), 10); twoDateNum = (inYear * 10000) + (inMonth * 100) + inDay;
		inDay1 = parseInt(chkdate.substring(0,chkdate.indexOf( sep )), 10);
		inMonth1 = parseInt(chkdate.substring(chkdate.indexOf( sep ) + 1, chkdate.lastIndexOf( sep )), 10 );
		inYear1 = parseInt(chkdate.substring(chkdate.lastIndexOf( sep ) + 1, chkdate.length), 10);
		oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1;
		}
   if(parseInt(twoDateNum)<parseInt(oneDateNum))
		{ 
	    alert(Message);
		return false;
		}
	return true;
}

function newcheckspecialPwdChars(Field)
	{
		var iChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
		var charfield = Field.value; 
		for (var i = 0; i < charfield.length; i++)
			{ 
			if (!(iChars.indexOf(charfield.charAt(i)) != -1))
				{ 
				return true;
				}
			}
		return false;
	}


//<KCB:ADDED FOR DATE PICKER:RAGHAV:16032007:START>
function DateValidation(dateFormat,dateField)
{
	var inDate = dateField.value;
	var consFormat = dateFormat.value;

	var daysInMonth = new Array(12);
	daysInMonth[1] = 31;
	daysInMonth[2] = 29;  
	daysInMonth[3] = 31;
	daysInMonth[4] = 30;
	daysInMonth[5] = 31;
	daysInMonth[6] = 30;
	daysInMonth[7] = 31;
	daysInMonth[8] = 31;
	daysInMonth[9] = 30;
	daysInMonth[10] = 31;
	daysInMonth[11] = 30;
	daysInMonth[12] = 31;

	var inDay = '';
	var inMonth = '';
	var inYear = '';
	var FormatSep = '';
	var sep = '/';
	var strDate = '';
	var strMonth = '00';
	var strCon = '0';
	var invalidDate = 0;

    if (inDate.indexOf('-') > 0 )
		sep = '-';
	if (inDate.indexOf('.') > 0 ) 
		sep = '.';
	if( consFormat.substring(0, 2) == 'dd' )
	{
		FormatSep = consFormat.substring(2,3);
		inDay = inDate.substring( 0, inDate.indexOf( sep ) );
		inMonth = inDate.substring( inDate.indexOf( sep ) + 1, inDate.lastIndexOf( sep ) );
		inYear  = inDate.substring( inDate.lastIndexOf( sep ) + 1, inDate.length );
	}
	else if( consFormat.substring(0, 2) == 'MM' )
	{
		FormatSep = consFormat.substring(2,3);
		inMonth = inDate.substring( 0, inDate.indexOf( sep ) );
		inDay = inDate.substring( inDate.indexOf( sep ) + 1, inDate.lastIndexOf( sep ) );
		inYear  = inDate.substring( inDate.lastIndexOf( sep ) + 1, inDate.length );
	}
	else
	{
		FormatSep = consFormat.substring(4,5);
		inYear = inDate.substring( 0, inDate.indexOf( sep ) );
		inMonth = inDate.substring( inDate.indexOf( sep ) + 1, inDate.lastIndexOf( sep ) );
		inDay  = inDate.substring( inDate.lastIndexOf( sep ) + 1, inDate.length );
	};
	invalidDate = 0;
	if (inDay.length > 0 && inDay.length <= 2) 
		inDay = parseInt(inDay, 10);
    else
		invalidDate = 1;

	if (inMonth.length > 0 && inMonth.length <= 2)
		inMonth = parseInt(inMonth, 10);
    else
		invalidDate = 1;

	if (inYear.length < 1 || inYear.length > 4 || inYear.length == 3 )
		invalidDate = 1;
	else 
		inYear = parseInt(inYear, 10);

	if (invalidDate==0) 
    {
		if (inYear < 100 && inYear > 40) 
			inYear += 1900;

		if (inYear < 100 && inYear <= 40) 
			inYear += 2000;
	}
    if( inMonth < 1 || inMonth > 12 )
		invalidDate = 1;

	if ((inDay < 1) || (inDay > daysInMonth[inMonth]) )
		invalidDate = 1; 

	if ((inMonth == 2) && (inDay >  (  ( (inYear % 4 == 0) && ( !(inYear % 100 == 0) || (inYear % 400 == 0) ) ) ? 29 : 28 ) )) 
		invalidDate = 1;

	if (invalidDate == 1 || isNaN(inDay) || isNaN(inMonth) || isNaN(inYear) )
	{
		alert('Please Enter a Valid Date\r\nExpected Date Format is '+consFormat);
		return; 
	}
	else 
	{
		inDay = strCon + inDay;
		inMonth = strCon + inMonth;

		if( consFormat.substring(0, 2) == 'dd' )
		{
			strDate = inDay.substring(inDay.length-2,inDay.length) + FormatSep + inMonth.substring(inMonth.length-2,inMonth.length) + FormatSep + inYear;
		}
		else if( consFormat.substring(0, 2) == 'MM' )
		{
			strDate = inMonth.substring(inMonth.length-2,inMonth.length) + FormatSep + inDay.substring(inDay.length-2,inDay.length) + FormatSep + inYear;
		}
		else
		{
			strDate =  inYear + FormatSep + inMonth.substring(inMonth.length-2,inMonth.length) + FormatSep + inDay.substring(inDay.length-2,inDay.length)
		};
	}
	dateField.value=strDate;  
	return;
}
function ValidateDate(theobj2,currdate,name,rule)
{


	var fromdt=theobj2.value

	var firstslash=fromdt.indexOf("/")
	var lastslash=fromdt.lastIndexOf("/")
	var yearfrom=fromdt.substr(lastslash+1)
	var monfrom=fromdt.substring(firstslash+1,lastslash)
	var dayfrom=fromdt.substr(0,firstslash)


    if(fromdt==""){
	    return true;
	}

	if(yearfrom == 0)
	{
	alert("Year cannot be zero");
	theobj2.focus();
	return false;
	}

	for (idx1 = 0; idx1 < fromdt.length; idx1++)
	{
    		ch1 = fromdt.substring(idx1, idx1 +1 );
    		if ((ch1 < "0") || (ch1 > "9")) {
	       	 if (ch1 == "/"){
	        	continue;
	        	}
	        else{
   	 alert("Invalid Entry: Enter date in format DD/MM/YYYY.")
         theobj2.focus();
	  		//alert("Invalid Date Format"+ " for " + name )
        		return false;}
     	 }
	}

	if ( dayfrom < 1 || dayfrom>31 ) { // check month range
	alert("Invalid Entry: "+ name +" entered is invalid.")
	theobj2.focus();
	//alert("In "+name + " Day must be between 1 and 31.");

	return false;
	}
	if (monfrom < 1 || monfrom > 12 ) { // check month range

	alert("Invalid Entry: Month should be between 01 and 12 in "+ name);
	theobj2.focus();
//  alert("In "+name + " Month must be between 1 and 12.");
	return false;
	}

	var idx1 = 0;
	    var ch1 = "";
	    var idx2 = 0;
	    var ch2 = "";





	if ((monfrom==4 || monfrom==6 || monfrom==9 || monfrom==11) && dayfrom==31 ) {
	alert("Invalid Entry: "+ name +" entered is invalid.")
	theobj2.focus();
	//alert("Invalid "+name + " : Month "+monfrom+"  doesn't have 31 days!")
	return false;
	}



	if (monfrom == 2 || monfrom== 02) { // check for february 29th
	var isleap1 = (yearfrom % 4 == 0 && (yearfrom % 100 != 0 || yearfrom % 400 == 0));
		if (dayfrom>29 || (dayfrom==29 && !isleap1)) {
	alert("Invalid Entry: "+ name +" entered is invalid.")
	theobj2.focus();
//			alert("Invalid Entry: February " + yearfrom + " doesn't have " + dayfrom + " days!");
			return false;
    	}
/*	else{
			return true
		}*/
	}


if(currdate!=null && rule != "gtdate")
{
	var Todt=theobj2.value;

	var firstslash1=currdate.indexOf("/")
	var lastslash1=currdate.lastIndexOf("/")

	var currmon=currdate.substring(firstslash1+1,lastslash1)
	var currday=currdate.substr(0,firstslash1)
	var curryr=currdate.substr(lastslash1+1)

	var firstslash2=Todt.indexOf("/")
	var lastslash2=Todt.lastIndexOf("/")

	var yearto=Todt.substr(lastslash2+1)
	var monto=Todt.substring(firstslash2+1,lastslash2)
	var dayto=Todt.substr(0,firstslash2)
/* validation of "greater than current date" 			*/
/* above validation is not needed for the maturity days */
	if(theobj2.NotFuture=='true')
		return true;

	var diff1=curryr-yearto;
	var mondiff1 = currmon-monto;
	var daydiff1 = currday-dayto;

   // changed on 23-11 for sandeep if (theobj2.CanntBeLessThanCurrent=='true' && (diff1>0 || mondiff1>0 || daydiff1>0) )
   	 if (rule=='lt' && (diff1>0 || (diff1 == 0 && mondiff1>0) || (diff1 == 0 && mondiff1==0 && daydiff1>0)) ){
		alert("Invalid Entry :" + name + "  cannot be less than the Current Date");
		return false;
	}
      	else if(rule=='gt' && (diff1>0 || (diff1 == 0 && mondiff1>0) || (diff1 == 0 && mondiff1==0 && daydiff1>=0)) ){
      	alert("Invalid Entry :" + name + "  should be greater than the Current Date");
			return false;
	  }
    	else if (rule=='gt' && (diff1<0 || mondiff1<0 || daydiff1<0) ){
				return true;
	}
    else if (rule=='lt' && (diff1<0 || mondiff1<0 || daydiff1<0) ){
		return true;
	}

	else  if(diff1 > 0){
		return true;
	}
	else if(diff1 == 0 && mondiff1>0){
		return true;
	}

	else if(diff1 == 0 && mondiff1==0 && daydiff1>=0){
		return true;
	}
	else
	{
	alert("Invalid Entry: " + name + "  should not be later than current date.")
	theobj2.focus();
		return false;
	}
}
return false;
}
//<KCB:ADDED FOR DATE PICKER:RAGHAV:16032007:END>
function onConfirmAuth()
{
	document.onkeypress = onConfirmKeyPress; 
}
function onConfirmKeyPress(evt) 
{ 
	var oEvent = (window.event) ? window.event : evt; 
	var nKeyCode = oEvent.keyCode ? oEvent.keyCode :oEvent.which ? oEvent.which : void 0; 
	if(nKeyCode==13)
	{
		return false;
	}
	return true;
}
function isDateValid(dtStr){ var daysInMonth = DaysArray(12)
var pos1=dtStr.indexOf(dtCh)
var pos2=dtStr.indexOf(dtCh,pos1+1)
var strDay=dtStr.substring(0,pos1)
var strMonth=dtStr.substring(pos1+1,pos2)
var strYear=dtStr.substring(pos2+1)
strYr=strYear
if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
for (var i = 1; i <= 3; i++) { if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
}
month=parseInt(strMonth)
day=parseInt(strDay)
year=parseInt(strYr)
if (pos1==-1 || pos2==-1){ 
return false
}
if (strMonth.length<1 || month<1 || month>12){ 
return false
}
if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){ 
return false
}
if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){ 
return false
}
if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){ 
return false
}
return true
}

/* For Blinking*/
window.onerror = null;
 var bName = navigator.appName;
 var bVer = parseInt(navigator.appVersion);
 var NS4 = (bName == "Netscape" && bVer >= 4);
 var IE4 = (bName == "Microsoft Internet Explorer" 
 && bVer >= 4);
 var NS3 = (bName == "Netscape" && bVer < 4);
 var IE3 = (bName == "Microsoft Internet Explorer" 
 && bVer < 4);
 var blink_speed=600;
 var i=0;
 
if (NS4 || IE4) {
 if (navigator.appName == "Netscape") {
 layerStyleRef="layer.";
 layerRef="document.layers";
 styleSwitch="";
 }else{
 layerStyleRef="layer.style.";
 layerRef="document.all";
 styleSwitch=".style";
 }
}

//BLINKING
function Blink(layerName){

 if(fg=="HIDE")
 {
 document.getElementById(layerName).style.visibility='hidden'
 }
 else
 {
		 if (NS4 || IE4) 
		 { 
			 if(i%2==0)
			 {
			 eval(layerRef+'["'+layerName+'"]'+
			 styleSwitch+'.visibility="visible"');
			 }
			 else
			 {
			 eval(layerRef+'["'+layerName+'"]'+
			 styleSwitch+'.visibility="hidden"');
			 }
		 } 
 }
			 if(i<1)
			 {
			 i++;
			 } 
			 else
			 {
			 i--
			 }
			 setTimeout("Blink('"+layerName+"')",blink_speed);
}
/* Blinking End */

/*************************************************************************
 * Function Name : checkGreaterDate
 * Description   : Comparision of Dates
 *  Usage        : onSubmit

 * Parameters    : date1 - Date Object 1
				   date2 - Date	Object 2
 *************************************************************************/

function checkGreaterDateReports(date1,date2)
{
	var fromdt=date1.value
	var todt=date2.value
		
	if( (fromdt=="") && (todt==""))
		return true;
	if( ((fromdt!="") && (todt=="") ) || ((fromdt=="") && (todt!="") ))
	{
        if(fromdt=="")
		    date1.focus();
        else
            date2.focus();
		return false;
	}

	var firstslash=fromdt.indexOf("/")
	var lastslash=fromdt.lastIndexOf("/")
	var yearfrom=fromdt.substr(lastslash+1)

	var monfrom=fromdt.substring(firstslash+1,lastslash)
	var dayfrom=fromdt.substr(0,firstslash)
	fromdt = monfrom+"/"+dayfrom+"/"+yearfrom;
	
	var todt=date2.value

	firstslash=todt.indexOf("/")
	lastslash=todt.lastIndexOf("/")
	var yearto=todt.substr(lastslash+1)
	var monto=todt.substring(firstslash+1,lastslash)
	var dayto=todt.substr(0,firstslash)
	todt = monto+"/"+dayto+"/"+yearto;

	firstDate= Date.parse(fromdt);
	secondDate=Date.parse(todt);
	var chk =true;
	diff = firstDate-secondDate;
	//alert("diff"+diff);

	if(diff>0 )
	{
		
		date1.focus();
		return false;
	}
	
	return true;

}

function GetTagValues_Ajax(b,elename)
{
    var obj			= b.getElementsByTagName(elename); 

	var arrValues=new Array();

	for (var i=0; i < obj.length; i++) 
	{ 
		 arrValues[i] = obj.item(i).firstChild.nodeValue; 

		
			}
	
	return arrValues;
}

function openpopupwindow(url,height,width) {
var options = "fullscreen=no,Toolbar = no, status=no,scrollbars=yes,resizable=yes,menubar=no,width=" + width + ",height=" + height;
var OpenWin = window.open(url,"PopupWindow",options);
}


 
var Message='Welcome to KHCB Internet Retail Banking';
	var place=1;

	function scrollIn()
	{
		window.status=Message.substring(0, place);
		if (place >= Message.length)
		{
			place=1;
			window.setTimeout("scrollOut()",300); 
		}
		else
		{
			place++;
			window.setTimeout("scrollIn()",50); 
		} 
	}
	function scrollOut()
	{
		window.status=Message.substring(place, Message.length);
		if (place >= Message.length)
		{
			place=1;
			window.setTimeout("scrollIn()", 100);
		} 
		else 
		{
			place++;
			window.setTimeout("scrollOut()", 50);
		}
	}


function getDescDataCurrCode(descArray,codeArray,currCode,currMnem,theObj,descObj)
{ 
	for(var i=0;i<descArray.length;i++)
	{ 
		var selectedid = getSelectedListValue(theObj); 
		if(selectedid==codeArray[i])
		{ 
            for(var j=0;j<currCode.length;j++)
			{ 
				if(currMnem[j]==descArray[i]){;
				descObj.value=currCode[j];
				break;
				}
			}		
			
		}
	}
}


function  isPastDate(DateFormat,SDate,Date1)  
	{ 
		var Format = DateFormat.value; 

		var Dchar = Format.charAt(0); 

		var dateNow=SDate.value; 
		var dateOne=Date1.value; 
		

		var sep ; 
		var inDay0; 
		var inMonth0; 
		var inYear0; 
		var inDay1; 
		var inMonth1; 
		var inYear1; 
		
		var nowDateNum; 
		var oneDateNum; 
		
	if(Dchar=='D' || Dchar=='d')  
	{ 
		  sep = Format.charAt(2); 

		  inDay0 = parseInt(dateNow.substring(0,dateNow.indexOf( sep )), 10); 
		  inMonth0  = parseInt(dateNow.substring(dateNow.indexOf( sep ) + 1, dateNow.lastIndexOf( sep )), 10 ); 
		  inYear0  = parseInt(dateNow.substring(dateNow.lastIndexOf( sep ) + 1, dateNow.length), 10); 
		  nowDateNum = (inYear0 * 10000) + (inMonth0 * 100) + inDay0; 

		  inDay1 = parseInt(dateOne.substring(0,dateOne.indexOf( sep )), 10); 
		  inMonth1  = parseInt(dateOne.substring(dateOne.indexOf( sep ) + 1, dateOne.lastIndexOf( sep )), 10 ); 
		  inYear1  = parseInt(dateOne.substring(dateOne.lastIndexOf( sep ) + 1, dateOne.length), 10); 
		  oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1; 

		  
	} 
	else if(Dchar=='M')  
	{ 
		  sep = Format.charAt(2); 

		  inMonth0 = parseInt(dateNow.substring(0,dateNow.indexOf( sep )), 10); 
		  inDay0  = parseInt(dateNow.substring(dateNow.indexOf( sep ) + 1, dateNow.lastIndexOf( sep )), 10 ); 
		  inYear0  = parseInt(dateNow.substring(dateNow.lastIndexOf( sep ) + 1, dateNow.length), 10); 
		  nowDateNum = (inYear0 * 10000) + (inMonth0 * 100) + inDay0; 

		  inMonth1 = parseInt(dateOne.substring(0,dateOne.indexOf( sep )), 10); 
		  inDay1  = parseInt(dateOne.substring(dateOne.indexOf( sep ) + 1, dateOne.lastIndexOf( sep )), 10 ); 
		  inYear1  = parseInt(dateOne.substring(dateOne.lastIndexOf( sep ) + 1, dateOne.length), 10); 
		  oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1; 

		  		  
	} 
	else if(Dchar=='Y' || Dchar=='y')  
	{ 
		  sep = Format.charAt(4); 

		  inYear0 = parseInt(dateNow.substring(0,dateNow.indexOf( sep )), 10); 

		  inMonth0  = parseInt(dateNow.substring(dateNow.indexOf( sep ) + 1, dateNow.lastIndexOf( sep )), 10 ); 
		  inDay0  = parseInt(dateNow.substring(dateNow.lastIndexOf( sep ) + 1, dateNow.length), 10); 
		  nowDateNum = (inYear0 * 10000) + (inMonth0 * 100) + inDay0; 

		  inYear1 = parseInt(dateOne.substring(0,dateOne.indexOf( sep )), 10); 
		  inMonth1  = parseInt(dateOne.substring(dateOne.indexOf( sep ) + 1, dateOne.lastIndexOf( sep )), 10 ); 
		  inDay1  = parseInt(dateOne.substring(dateOne.lastIndexOf( sep ) + 1, dateOne.length), 10); 
		  oneDateNum = (inYear1 * 10000) + (inMonth1 * 100) + inDay1; 

		  
	} 

	if(parseInt(oneDateNum)>parseInt(nowDateNum))
	{
		

		 Date1.focus(); 
		 return false ; 
	}

	
	 
	 return true ;
} 