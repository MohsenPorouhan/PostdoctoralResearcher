 
function MakingMoneyForm(me)
				{
				
					if((event.keyCode==13) || (event.keyCode==9) || (event.keyCode==39) || (event.keyCode==37) || (event.keyCode==16))
						return;

					var TempStr = ''
					
					while(me.value.indexOf(',') != -1)
						me.value = me.value.replace(',','')
					
					var R = me.value.length % 3;
					TempStr =  me.value.substring(0,R);
					for(var i = R ; i < me.value.length ; i++ )
					{
						if ((me.value.length-i)%3==0)
						{
							TempStr = TempStr + "," + me.value.substring(i,i+1) 
						}
						else 
							TempStr = TempStr +  me.value.substring(i,i+1) 
					}
					
					//Removing First ','
					if(TempStr.substring(0,1) == ",")
						TempStr = TempStr.substring(1,TempStr.length)
					
					me.value=TempStr

						
				}

 
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
//  End -->
 