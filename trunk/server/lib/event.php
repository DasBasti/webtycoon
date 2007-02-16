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

	function doAction($cmd) {
		print_r($cmd);
		$this->db->query("SELECT `file` FROM `event` WHERE id='$cmd[0]'");
		if(file_exists("event/".$this->db->singleres('file'))) {
			require_once "event/".$this->db->singleres('file');
		}
		$this->buffer->ticker="&nbsp;";
		return true;
	}
}
?>