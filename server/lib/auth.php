<?
class Auth {
	function Auth() {
		$this->db = new DB();
		$this->buffer = new stdClass();
	}

	function Login($val){
		$session = md5(time().microtime().$_SERVER['REMOTE_ADDR']);
		$this->db->query("UPDATE user SET session='$session' WHERE username='$val[0]' AND password=MD5('$val[1]')");
		if($this->db->aff_rows != 1) $this->buffer->error="Falscher Login!";
		else {
			$this->buffer->auth=$session;
		}
		return true;
	}

	function Logout($sessid){
		$this->db->query("UPDATE user SET session='' WHERE session='$sessid'");
		return true;
	}
}
?>