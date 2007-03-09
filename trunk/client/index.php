<?
/*
 * The Webtycoon Client
 */

//$_COOKIE['uid']=1;

include "../lib/db.php";
include "res/fields.php";

$db=new db();

$map = array();

if(isset($_COOKIE['uid'])){

	$db->query("SELECT map FROM maps WHERE user_id='$_COOKIE[uid]'");

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
	die("Not loged in!");
}

?>