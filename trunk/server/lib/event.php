<?
class Event {
	function Event() {
		$this->db = new DB();
		$this->buffer = new stdClass();
		$this->name="event";
	}

	function getDescription($id) {
		$this->db->query("SELECT `desc` FROM event WHERE id='$id'");
		$this->buffer->ticker=$this->db->singleres('desc');
		return true;
	}

	function doEvent($cmd) {
		// $cmd beinhaltet action:x:y
	}
}
?>