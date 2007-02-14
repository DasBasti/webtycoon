<?
class Event {

	function Event(){
		$this->db = new DB();
		$this->buf = new stdClass();
	}

	function getDescription($id){
		$this->db->query("SELECT `desc` FROM event WHERE id='$id'");
		$this->buf->ticker=$this->db->singleres('desc');
	}

}
?>