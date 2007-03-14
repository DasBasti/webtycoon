<?
	$x=$cmd[1];
	$y=$cmd[2];

	$this->db->query("SELECT map FROM maps WHERE uid='$GLOBALS[uid]'");
	$map = unserialize(gzuncompress(base64_decode($this->db->singleres('map'))));
	if($this->costMoney($GLOBALS['costs']['wasser'])){
		$map[($y-1)][($x-1)]['field']=0;// setze gebäude auf 0 (leer)
	}
	$mapcode = base64_encode(gzcompress(serialize($map),9));
	$this->db->query("UPDATE maps SET map='$mapcode' WHERE uid='$GLOBALS[uid]'");

?>