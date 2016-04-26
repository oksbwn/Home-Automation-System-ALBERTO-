function DivContLoader(DivName,PageName)
		{
			if (window.XMLHttpRequest)
					{
						xmlhttp=new XMLHttpRequest();
					}
			else 
					{
						xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
					}
	xmlhttp.onreadystatechange=function()
			{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById(DivName).innerHTML=xmlhttp.responseText;
					}
			}
		xmlhttp.open('GET',PageName,true);
		xmlhttp.send();
		}
function addImageName(){
	var id=document.getElementById('food_name').value;
	document.getElementById('food_image').value=id.toLowerCase().replace(/ /g,"_");
}
function addImageNameProfile(){
	var id=document.getElementById('profile_name').value;
	document.getElementById('profile_image').value=id.toLowerCase().replace(/ /g,"_");
}
function changeHomeProfileClicked(profileID){
	   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Profile Changed Sucessfully.');
			}
		}
	var val=""
	
	var link="http://192.168.0.1/smart_home/API/web_interface/change_home_profile.php?ID="+profileID;
	xmlhttp.open("GET",link,false);
	xmlhttp.send();
}
function changeAudioProfileClicked(profileID){
	   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Audio Profile Changed Sucessfully.');
			}
		}
	var val=""
	
	var link="http://192.168.0.1/smart_home/API/utilities_all/changeAudioProfile.php?NAME=Test&ID="+profileID;
	xmlhttp.open("GET",link,false);
	xmlhttp.send();
}
function addAudioProfile(){
   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Profile added Sucessfully.');
			}
		}
	var val="";
	var name=document.getElementById('profile_name').value;
	var image=document.getElementById('profile_image').value;
	var sequence=document.getElementById('sequence').value;
	var inputs=document.getElementById('input_devices').value;
	var outputs=document.getElementById('output_devices').value;
	var date=document.getElementById('date_added').value;
	
	var link="http://192.168.0.1/smart_home/API/web_interface/add_audio_profile.php?IMG="+image+"&NAME="+name+"&SEQ="+sequence+"&IN="+inputs+"&OUT="+outputs+"&DATE="+date;
	xmlhttp.open("GET",link,false);
	xmlhttp.send();
}
function addHomeProfile(){
   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Profile added Sucessfully.');
			}
		}
	var val="";
	var offDevices=document.getElementById('off_devices').value;
	var onDevices=document.getElementById('on_devices').value;
	var forDevice=document.getElementById('for_devices').value;
	var Image=document.getElementById('profile_image').value;
	var profileName=document.getElementById('profile_name').value;
	var date=document.getElementById('date_added').value;
	var link="http://192.168.0.1/smart_home/API/web_interface/add_home_profile.php?OFF="+offDevices+"&ON="+onDevices+"&FOR="+forDevice+"&IMG="+Image+"&NAME="+profileName+"&DATE="+date;
	xmlhttp.open("GET",link,false);
	xmlhttp.send();
}


function addSensor(sl_no){
   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Sensor Added Sucessfully.');
			}
		}
	
	var id=document.getElementById('sensor_id').value;
	var board=document.getElementById('board_id').value;
	var type=document.getElementById('type_sensor').value;
	var date=document.getElementById('date_added').value;
	
	var link="http://192.168.0.1/smart_home/API/web_interface/add_sensor.php?NO="+sl_no+"&ID="+id+"&BOARD="+board+"&DATE="+date+"&TYPE="+type;
	xmlhttp.open("GET",link,false);
    xmlhttp.send();
}
function addFood(){
   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Food added Sucessfully.');
			}
		}
	var val="";
	var name=document.getElementById('food_name').value;
	var image=document.getElementById('food_image').value;
	var calorie=document.getElementById('food_calorie').value;
	var date=document.getElementById('date_added').value;
	var type=document.getElementById('date_added').value;
	if(document.getElementById('type_check1').checked==1)
		val=val+", breakfast";
	if(document.getElementById('type_check2').checked==1)
		val=val+", lunch";
	if(document.getElementById('type_check3').checked==1)
		val=val+", snacks";
	if(document.getElementById('type_check4').checked==1)
		val=val+", dinner";
	var link="http://192.168.0.1/smart_home/API/web_interface/add_food.php?IMG="+image+"&NAME="+name+"&CAL="+calorie+"&DATE="+date+"&TYPE="+val;
	xmlhttp.open("GET",link,false);
	xmlhttp.send();
}

function addBoard(sl_no){
   var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('Board Added Sucessfully.');
			}
		}
	
	var id=document.getElementById('board_id').value;
	var out=document.getElementById('out_pins').value;
	var inp=document.getElementById('in_pins').value;
	var sensors=document.getElementById('in_sensors').value;	
	var comment=document.getElementById('comment').value;
	var mac=document.getElementById('mac_id').value;
	var ip=document.getElementById('board_ip').value;
	var type=document.getElementById('board_type').value;
	var date=document.getElementById('date_added').value;
	
	var link="http://192.168.0.1/smart_home/API/web_interface/add_board.php?NO="+sl_no+"&ID="+id+"&OUT="+out+"&IN="
			+inp+"&SENS="+sensors+"&COMM="+comment+"&MAC="+mac+"&IP="+ip+"&TYPE="+type+"&DATE="+date;
	xmlhttp.open("GET",link,false);
    xmlhttp.send();
}
function addMACIP(sl_no){
		var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert('MAC ID and IP added successfully.');
			}
		}
	
	var comment=document.getElementById('details').value;
	var mac=document.getElementById('mac_id').value;
	var ip=document.getElementById('board_ip').value;
	var date=document.getElementById('date_added').value;
	
	var link="http://192.168.0.1/smart_home/API/web_interface/add_mac_ip.php?NO="+sl_no+"&COMM="+comment+"&MAC="+mac+"&IP="+ip+"&DATE="+date;
	xmlhttp.open("GET",link,false);
    xmlhttp.send();
}
function loadStatusChangeButtonClicked(idInDatabase,containerId,image,name){
	alert(idInDatabase);
	//http://192.168.0.1/smart_home/API/web_interface/change_load_status.php?NO=idInDatabase
			var xmlhttp;
       if (window.XMLHttpRequest)
	      {
           xmlhttp=new XMLHttpRequest();
          }
       else 
	      {
	       xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
           }
		xmlhttp.onreadystatechange=function()
		{ 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			response=xmlhttp.responseText;
			if(response.charAt(0)=='O')
				document.getElementById(containerId).innerHTML='<img src="img/devices/'+image+'_on.png" style="height:16px width:16px"></img><p>'+name+'</p><span class="notification green">ON</span>';
			else if(response.charAt(0)=='F')
				document.getElementById(containerId).innerHTML='<img src="img/devices/'+image+'_off.png" style="height:16px width:16px"></img><p>'+name+'</p><span class="notification red">OFF</span>';
			
			}
		}
	var link="http://192.168.0.1/smart_home/API/web_interface/change_load_status.php?NO="+idInDatabase;
	xmlhttp.open("GET",link,false);
    xmlhttp.send();
}
function readMessage(type,from,date,read,body){
document.getElementById('message_from').innerHTML=from;
document.getElementById('message_time').innerHTML=date;
document.getElementById('message_body').innerHTML=body;
}