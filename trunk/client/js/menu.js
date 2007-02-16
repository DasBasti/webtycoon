var xhttp=null;
var actionid=null;

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
		xhttp.open("POST","../server/index.php",true);
		xhttp.onreadystatechange=callback;
		var request={
			method:func,
			params:[id],
			id:new Date().getTime()
		};
		xhttp.send(request.toJSONString());
	}
}

function callback() {
	if(xhttp.readyState==4) {
		var res = eval('('+xhttp.responseText+')');
		if(res.error) {
			alert(res.error);
			return;
		}
		document.getElementById('ticker').innerHTML=res.result.ticker;
	}
}


function showMenu(id) {
 hideMenu();
 document.getElementById(id).attributes[0].nodeValue="show-menu";
}
function hideMenu() {
 document.getElementById("landscape-menu").attributes[0].nodeValue="hidden-menu";
 document.getElementById("building-menu").attributes[0].nodeValue="hidden-menu";
 document.getElementById("playground-menu").attributes[0].nodeValue="hidden-menu";
 document.getElementById("message-menu").attributes[0].nodeValue="hidden-menu";
}

function menuClick(id){
 hideMenu();
 menuEvent(id);
}

function menuEvent(id){
 sende("Event::getDescription",id);
 actionid=id;
}

function action(x,y){
 if(actionid){
  sende("Event::doAction",[actionid,x,y]);
 }
 actionid=null;
}