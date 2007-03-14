<?
class Auth {
	function Auth() {
		$this->db = new DB();
		$this->buffer = new stdClass();
	}

	function Login($user,$password){
		$session = md5(time().microtime().$_SERVER['REMOTE_ADDR']);
		$this->db->query("UPDATE user SET session='$session' WHERE username='$user' AND password=MD5('$password')",true);
		if($this->db->aff_rows != 1) $this->buffer->error="Falscher Login!";
		else $this->buffer->auth=$session;
		return true;
	}
}
?>