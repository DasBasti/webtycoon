<?
	$x=$cmd[1];
	$y=$cmd[2];

	$this->db->query("SELECT map FROM maps WHERE uid='$_GLOBALS[uid]'");
	$map = unserialize(gzuncompress(base64_decode($this->db->singleres('map'))));
	$map[($y-1)][($x-1)]['field']=1;// setze feld auf 1 (gras)
	$mapcode = base64_encode(gzcompress(serialize($map),9));
	$this->db->query("UPDATE maps SET map='$mapcode' WHERE uid='$_GLOBALS[uid]'");

?>