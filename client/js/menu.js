var xhttp=null;
var actionid=null;
var sessionid;
var loggedin=false;

document.oncontextmenu = unselectaction;

function init() {
	if(window.ActiveXObject){
		try {
			//Internet Explorer 6.x
			xhttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			//IE 5.5
			try {
				xhttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xhttp=false;
			}
		}
	} else if(window.XMLHttpRequest) {
		//F?r Mozilla und die anderen
		try {
			xhttp= new XMLHttpRequest();
		} catch (e) {
			xhttp = false;
		}
	}
}

function sende(func,id){
	if(xhttp) {
		xhttp.open("POST","http://localhost/server/html/index.php",true);
		xhttp.onreadystatechange=callback;
		var request={
			method:func,
			params:[id],
			id:new Date().getTime(),
			session:sessionid,
		};
		xhttp.send(request.toJSONString());
	}
}

function callback() {
	if(xhttp.readyState==4) {
		var res = xhttp.responseText.parseJSON();
		if(res){
			if(res.error) {
				alert(res.error);
				return;
			}
			if(res.result.money) {
				document.getElementById('money').innerHTML="Verm�gen: <b>"+res.result.money+"</b>&euro;";
				document.getElementById('ticker').innerHTML="";
			}
			if(res.result.window) {
				document.getElementById('windowbox').innerHTML=res.result.window;
				document.getElementById('windowbox').attributes[0].nodeValue="windowb";
				stopAction();
				return true;
			}
			if(res.result.ticker) {
				document.getElementById('ticker').innerHTML=res.result.ticker;
			}
			if(res.result.field) {
				document.getElementById('field').innerHTML=res.result.field;
			}
			if(res.result.auth) {
				sessionid=res.result.auth;
				userid=res.result.uid;
				loggedin=true;
				sende("Event::DoAction",null);
			}
		}
	}
}


function showMenu(id) {
 if(loggedin){
  hideMenu();
  document.getElementById(id).attributes[0].nodeValue="show-menu";
 }
}

function hideMenu() {
 document.getElementById("landscape-menu").attributes[0].nodeValue="hidden-menu";
 document.getElementById("building-menu").attributes[0].nodeValue="hidden-menu";
 document.getElementById("playground-menu").attributes[0].nodeValue="hidden-menu";
 document.getElementById("message-menu").attributes[0].nodeValue="hidden-menu";
}

function menuClick(id){
 if(loggedin){
  hideMenu();
  menuEvent(id);
 }
}

function menuEvent(id){
 document.getElementById("buildbutton").attributes[1].nodeValue="menubutton-right";
 sende("Event::getDescription",id);
 actionid=id;
 if(id==16){
   document.getElementById("mapbody").attributes[0].nodeValue="demolishmode";
 } else {
   document.getElementById("mapbody").attributes[0].nodeValue="buildmode";
 }
}

function action(x,y){
 if(actionid){
  sende("Event::doAction",[actionid,x,y]);
 }
}

function ShowWindow(id){
 if(loggedin){
  hideMenu();
  sende("Event::renderWindow",id);
 }
}

function stopAction(){
 document.getElementById("buildbutton").attributes[1].nodeValue="menubutton-right-hidden";
 actionid=null;
 document.getElementById('ticker').innerHTML="&nbsp;";
 document.getElementById("mapbody").attributes[0].nodeValue="none";
}

function unselectaction(e){
 if(e && e.which == 3) {
  stopAction();
  hideMenu();
 }
 return false;
}