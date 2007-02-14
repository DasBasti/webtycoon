var xhttp;

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

function sende(msg){
	if(http) {
		xhttp.open("GET","../server/index.php",true);
		xhttp.onreadystatechange=callback;
		xhttp.send(msg);
	}
}

function callback() {
	if(xhttp.readyState==4) {
		var res = eval('('+xhttp.responseText+')');
		if(res.error) {
			alert(res.error.message);
			return;
		}

		document.getElementById('ticker').innerHTML=res.result.ticker;
	}
}
