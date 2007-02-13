<?
/*
 * The Webtycoon Client
 */

 $_COOKIE['uid']=1;

include "../lib/db.php";
include "res/fields.php";

$db=new db();

$map = array();

$db->query("SELECT map FROM maps WHERE user_id='$_COOKIE[uid]'");
$maparray = $db->singleres("map");
$maplines = explode("\n",$maparray);
foreach($maplines as $inty => $line){
	foreach(explode(":",$line) as $intx => $field){
		$map[$inty][$intx]['field']=$field;
	}
}


$db->query("SELECT map FROM buildings WHERE user_id='$_COOKIE[uid]'");
$bldarray = $db->singleres("map");
$bldlines = explode("\n",$bldarray);
foreach($bldlines as $inty => $line){
	foreach(explode(":",$line) as $intx => $field){
		$map[$inty][$intx]['build']=$field;
	}
}

$maphtml="";
foreach($map as $line){
	$maphtml.="<tr>\n";
	foreach($line as $field){
		$f=intval($field['field']);
		$b=intval($field['build']);
		$maphtml.="<td background='$bfield[$f]' width='32' height='32'><img src='$build[$b]' /></td>\n";
	}
	$maphtml.="</tr>\n";
}

$fh = fopen("html/main.html","r");
$tplhtml = fread($fh,filesize("html/main.html"));

//echo "<pre>";
//print_r($map);
//exit;

echo str_replace("<%map%>",$maphtml,$tplhtml);

?>