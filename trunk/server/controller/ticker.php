<?
// Hier startet jeder Berechnungstick
include("attraction.php");
function __autoload($class){
	if(file_exists("../lib/".strtolower(basename($class)).".php"))
	  require_once("../lib/".strtolower(basename($class)).".php");
}

$db = new DB();

//blockiere Eingaben
touch("calculation.lock");

sleep(2); // warte auf unfertige aktionen

$tc=intval(file_get_contents("tickcount.txt"));
$tc++;
file_put_contents("tickcount.txt",$tc);

// Generiere Besucherstrom
$dayval=rand(1,3); //zufall ob guter oder schlechter tag

$db->query("SELECT user.id, maps.map FROM user, maps WHERE user.id = maps.uid");
foreach($db->resarray() as $user){
	$map = unserialize(gzuncompress(base64_decode($user['map'])));
	$mapsize = 0; // berechne 'Mapgröße' (Anzahl der Gebäude)
	$mapattr = 0; // berechne die Karten Atraktivität
	$money = 0; // berechne das verdiente Geld
	foreach($map as $line) foreach($line as $field){
		if($field['build'] != 0)$mapsize++;
		$mapattr += $attr[$field['build']]*$dayval;
		$money += $attr[$field['build']]*$cost[$field['build']]*$dayval;
	}
	// berechne aktuellen Besucherstrom
	$besucher=$mapattr+$mapsize;
	$db->query("UPDATE `user` SET money=money+'$money' WHERE id='".$user['id']."'");
	$db->query("INSERT INTO transactions (`uid`,`amount`,`desc`) VALUES('$user[id]', '$money', 'Abrechnung Tag $tc')");
}






//erlaube eingaben
unlink("calculation.lock");

?>