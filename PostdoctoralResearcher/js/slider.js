var expandFirstItemAutomatically = false;	
var initMenuIdToExpand = false;	
var expandMenuItemByUrl = true;	
var initialMenuItemAlwaysExpanded = true;	
var dhtmlgoodies_slmenuObj;
var divToScroll = false;
var ulToScroll = false;	
var divCounter = 1;
var otherDivsToScroll = new Array();
var divToHide = false;
var parentDivToHide = new Array();
var ulToHide = false;
var offsetOpera = 0;
if(navigator.userAgent.indexOf('Opera')>=0)offsetOpera=1;	
var slideMenuHeightOfCurrentBox = 0;
var objectsToExpand = new Array();
var initExpandIndex = 0;
var alwaysExpanedItems = new Array();
function popMenusToShow()
{
	var obj = divToScroll;
	var endArray = new Array();
	while(obj && obj.tagName!='BODY'){
		if(obj.tagName=='DIV' && obj.id.indexOf('slideDiv')>=0){
			var objFound = -1;
			for(var no=0;no<otherDivsToScroll.length;no++){
				if(otherDivsToScroll[no]==obj){
					objFound = no;		
				}					
			}	
			if(objFound>=0){
				otherDivsToScroll.splice(objFound,1);	
			}		
		}	
		obj = obj.parentNode;
	}	
}
function showSubMenu(e,inputObj)
{
	if(this && this.tagName)inputObj = this.parentNode;
	if(inputObj && inputObj.tagName=='LI'){
		divToScroll = inputObj.getElementsByTagName('DIV')[0];
		for(var no=0;no<otherDivsToScroll.length;no++){
			if(otherDivsToScroll[no]==divToScroll)return;
		}			
	}
	hidingInProcess = false;
	if(otherDivsToScroll.length>0){
		if(divToScroll){				
			if(otherDivsToScroll.length>0){
				popMenusToShow();
			}
			if(otherDivsToScroll.length>0){	
				autoHideMenus();
				hidingInProcess = true;
			}
		}	
	}		
	if(divToScroll && !hidingInProcess){
		divToScroll.style.display='';
		otherDivsToScroll.length = 0;
		otherDivToScroll = divToScroll.parentNode;
		otherDivsToScroll.push(divToScroll);	
		while(otherDivToScroll && otherDivToScroll.tagName!='BODY'){
			if(otherDivToScroll.tagName=='DIV' && otherDivToScroll.id.indexOf('slideDiv')>=0){
				otherDivsToScroll.push(otherDivToScroll);
									
			}
			otherDivToScroll = otherDivToScroll.parentNode;
		}			
		ulToScroll = divToScroll.getElementsByTagName('UL')[0];
		if(divToScroll.style.height.replace('px','')/1<=1)scrollDownSub();
	}	
}
function autoHideMenus()
{
	if(otherDivsToScroll.length>0){
		divToHide = otherDivsToScroll[otherDivsToScroll.length-1];
		parentDivToHide.length=0;
		var obj = divToHide.parentNode.parentNode.parentNode;
		while(obj && obj.tagName=='DIV'){			
			if(obj.id.indexOf('slideDiv')>=0)parentDivToHide.push(obj);
			obj = obj.parentNode.parentNode.parentNode;
		}
		var tmpHeight = (divToHide.style.height.replace('px','')/1 - slideMenuHeightOfCurrentBox);
		if(tmpHeight<0)tmpHeight=0;
		if(slideMenuHeightOfCurrentBox)divToHide.style.height = tmpHeight  + 'px';
		ulToHide = divToHide.getElementsByTagName('UL')[0];
		slideMenuHeightOfCurrentBox = ulToHide.offsetHeight;
		scrollUpMenu();		
	}else{
		slideMenuHeightOfCurrentBox = 0;
		showSubMenu();			
	}
}
function scrollUpMenu()
{

	var height = divToHide.offsetHeight;
	height-=15;
	if(height<0)height=0;
	divToHide.style.height = height + 'px';

	for(var no=0;no<parentDivToHide.length;no++){	
		parentDivToHide[no].style.height = parentDivToHide[no].getElementsByTagName('UL')[0].offsetHeight + 'px';
	}
	if(height>0){
		setTimeout('scrollUpMenu()',1);
	}else{
		divToHide.style.display='none';
		otherDivsToScroll.length = otherDivsToScroll.length-1;
		autoHideMenus();			
	}
}	
function scrollDownSub()
{
	if(divToScroll){			
		var height = divToScroll.offsetHeight/1;
		var offsetMove =Math.min(15,(ulToScroll.offsetHeight - height));
		height = height +offsetMove ;
		divToScroll.style.height = height + 'px';
		
		for(var no=1;no<otherDivsToScroll.length;no++){
			var tmpHeight = otherDivsToScroll[no].offsetHeight/1 + offsetMove;
			otherDivsToScroll[no].style.height = tmpHeight + 'px';
		}			
		if(height<ulToScroll.offsetHeight)setTimeout('scrollDownSub()',1); else {
			divToScroll = false;
			ulToScroll = false;
			if(objectsToExpand.length>0 && initExpandIndex<(objectsToExpand.length-1)){
				initExpandIndex++;
				
				showSubMenu(false,objectsToExpand[initExpandIndex]);
			}
		}
	}
}
function initSubItems(inputObj,currentDepth)
{		
	divCounter++;		
	var div = document.createElement('DIV');	
	div.style.overflow = 'hidden';	
	div.style.position = 'relative';
	div.style.display='none';
	div.style.height = '1px';
	div.id = 'slideDiv' + divCounter;
	div.className = 'slideMenuDiv' + currentDepth;		
	inputObj.parentNode.appendChild(div);	
	div.appendChild(inputObj);
	var menuItem = inputObj.getElementsByTagName('LI')[0];
	while(menuItem){
		if(menuItem.tagName=='LI'){
			var aTag = menuItem.getElementsByTagName('A')[0];
			aTag.className='slMenuItem_depth'+currentDepth;	
			var subUl = menuItem.getElementsByTagName('UL');
			if(subUl.length>0){
				initSubItems(subUl[0],currentDepth+1);					
			}
			aTag.onclick = showSubMenu;				
		}			
		menuItem = menuItem.nextSibling;						
	}		
}
function initSlideDownMenu()
{
	dhtmlgoodies_slmenuObj = document.getElementById('right-menu');
	dhtmlgoodies_slmenuObj.style.visibility='visible';
	var mainUl = dhtmlgoodies_slmenuObj.getElementsByTagName('UL')[0];		
	var mainMenuItem = mainUl.getElementsByTagName('LI')[0];
	mainItemCounter = 1;
	while(mainMenuItem){			
		if(mainMenuItem.tagName=='LI'){
			var aTag = mainMenuItem.getElementsByTagName('A')[0];
			aTag.className='slMenuItem_depth1';	
			var subUl = mainMenuItem.getElementsByTagName('UL');
			if(subUl.length>0){
				mainMenuItem.id = 'mainMenuItem' + mainItemCounter;
				initSubItems(subUl[0],2);
				aTag.onclick = showSubMenu;
				mainItemCounter++;
			}				
		}			
		mainMenuItem = mainMenuItem.nextSibling;	
	}		
	
	if(location.search.indexOf('mainMenuItemToSlide')>=0){
		var items = location.search.split('&');
		
		for(var no=0;no<items.length;no++){
			if(items[no].indexOf('mainMenuItemToSlide')>=0){
				values = items[no].split('=');
				showSubMenu(false,document.getElementById('mainMenuItem' + values[1]));	
				initMenuIdToExpand = false;				
			}
		}			
	}else if(expandFirstItemAutomatically>0){
		if(document.getElementById('mainMenuItem' + expandFirstItemAutomatically)){
			showSubMenu(false,document.getElementById('mainMenuItem' + expandFirstItemAutomatically));
			initMenuIdToExpand = false;
		}
	}

	if(expandMenuItemByUrl)
	{
		var aTags = dhtmlgoodies_slmenuObj.getElementsByTagName('A');
		for(var no=0;no<aTags.length;no++){
			var hrefToCheckOn = aTags[no].href;				
			if(location.href.indexOf(hrefToCheckOn)>=0 && hrefToCheckOn.indexOf('#')<hrefToCheckOn.length-1){
				initMenuIdToExpand = false;
				var obj = aTags[no].parentNode;
				while(obj && obj.id!='right-menu'){
					if(obj.tagName=='LI'){							
						var subUl = obj.getElementsByTagName('UL');
						if(initialMenuItemAlwaysExpanded)alwaysExpanedItems[obj.parentNode] = true;
						if(subUl.length>0){								
							objectsToExpand.unshift(obj);
						}
					}
					obj = obj.parentNode;	
				}
				showSubMenu(false,objectsToExpand[0]);
				break;					
			}			
		}
	}
			
	if(initMenuIdToExpand)
	{
		objectsToExpand = new Array();
		var obj = document.getElementById(initMenuIdToExpand)
		while(obj && obj.id!='right-menu'){
			if(obj.tagName=='LI'){
				var subUl = obj.getElementsByTagName('UL');
				if(initialMenuItemAlwaysExpanded)alwaysExpanedItems[obj.parentNode] = true;
				if(subUl.length>0){						
					objectsToExpand.unshift(obj);
				}
			}
			obj = obj.parentNode;	
		}
		
		showSubMenu(false,objectsToExpand[0]);
	}
		
}

window.onload =initSlideDownMenu;
    

