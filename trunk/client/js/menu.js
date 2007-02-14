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
 alert("Mache Event nummer "+id);
}