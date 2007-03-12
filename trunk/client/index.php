<?
/*
 * The Webtycoon Client
 */

include "../lib/db.php";
include "res/fields.php";

$db=new db();

$map = array();

if(isset($_POST['login'])){
	$db->query("SELECT id FROM `user` WHERE username='$_POST[username]' AND password=MD5('$_POST[password]')",true);
	$userid = $db->singleres();
	if($db->num_rows == 0){
		die("Login Error");
	} else {
		$db->query("UPDATE user SET session='$_COOKIE[PHPSESSID]' WHERE id='$userid'",true);
	}
}

if(isset($_REQUEST['logout'])){
	// session löschen
	header("Location: http://localhost/webtycoon");
}

$db->query("SELECT id FROM user WHERE session='$_COOKIE[PHPSESSID]'");
$_GLOBALS['uid'] = $db->singleres();

if(isset($_GLOBALS['uid'])){

	$db->query("SELECT map FROM maps WHERE uid='$_GLOBALS[uid]'");

	$map = unserialize(gzuncompress(base64_decode($db->singleres('map'))));

	$maphtml="<table border='0' cellspacing='0' cellpadding='0'>";
	foreach($map as $inty => $line){
		$maphtml.="<tr>\n";
		foreach($line as $intx => $field){
			$f=intval($field['field']);
			$b=intval($field['build']);
			$maphtml.="<td background='$bfield[$f]' width='32' height='32'><img src='$build[$b]' alt='".($intx+1)."/".($inty+1).
   	               "' onclick='action(".($intx+1).",".($inty+1).")' /></td>\n";

		}
		$maphtml.="</tr>\n";
	}
	$maphtml.="</table>";
	$fh = fopen("html/main.html","r");
	$tplhtml = fread($fh,filesize("html/main.html"));

	echo str_replace("<%map%>",$maphtml,$tplhtml);

} else {
	die("Login Error");
}

?>