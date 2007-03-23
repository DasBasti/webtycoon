<?
class Event {
	function Event() {
		$this->db = new DB();
		$this->buffer = new stdClass();
		$this->name="event";
	}

	function getDescription($id) {
		$this->db->query("SELECT `desc`,`cost` FROM events WHERE id='$id'");
		$this->buffer->ticker=$this->db->singleres('desc')." (".$this->db->singleres('cost')."&euro;)";
		return true;
	}

	function doAction($cmd) {
		global $GLOBALS;
		include "../../client/res/fields.php";

		if($cmd!=null){
			$this->db->query("SELECT `file` FROM `events` WHERE id='$cmd[0]'");
			if(file_exists("../event/".$this->db->singleres('file'))) {
				include "../event/".$this->db->singleres('file');
			}
		}
		$this->db->query("SELECT map FROM maps WHERE uid='$GLOBALS[uid]'");
		$map = unserialize(gzuncompress(base64_decode($this->db->singleres('map'))));
		$maphtml='<table border="0" cellspacing="0" cellpadding="0">';
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

		$this->buffer->field=$maphtml;
		return true;
	}

	function renderWindow($cmd) {
		if(file_exists("../windows/show".$cmd."window.php")) include "../windows/show".$cmd."window.php";
		return true;
	}

	function doNothing($id) {
		return true;
	}

	function costMoney($amount) {
		$this->db->query("SELECT money FROM user WHERE id='$GLOBALS[uid]'");
		$money = $this->db->singleres();
		if($money >= $amount){
			$newmoney = $money - $amount;
			$this->db->query("UPDATE user SET money='$newmoney' WHERE id='$GLOBALS[uid]'");
			return true;
		} else {
			$this->renderWindow("nomoney");
			return false;
		}

	}
}
?>