<?
	$x=$cmd[1];
	$y=$cmd[2];

	$this->db->query("SELECT map FROM maps WHERE user_id='$_COOKIE[uid]'");
	$map = unserialize(gzuncompress(base64_decode($this->db->singleres('map'))));
	$map[($y-1)][($x-1)]['build']=2;// setze gebäude auf 2 (feuer)
	$mapcode = base64_encode(gzcompress(serialize($map),9));
	$this->db->query("UPDATE maps SET map='$mapcode' WHERE user_id='$_COOKIE[uid]'");

?>