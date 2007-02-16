<?

function build_bottom($id,$x,$y){
	//
	$db->query("SELECT map FROM maps WHERE id='$_COOKIE[uid]'");
	$map=array();
	#echo "--- jo ---";
	foreach($db->singleres() as $inty => $line){
	#echo "--- eins ---";
		foreach(explode(":",$line) as $intx => $field){
			#echo "$intx/$inty = $field\n";
		}
	}
}
function build_top($id,$x,$y){
	//
	$db->query("SELECT buildings FROM maps WHERE id='$_COOKIE[uid]'");
}

?>