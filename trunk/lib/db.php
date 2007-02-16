<?

class db {
	function db(){
		$this->connection = mysql_connect("localhost","root");
		mysql_select_db("webtycoon");
	}

	function query($str){
		$this->str = $str;
		$this->res = mysql_query($str);
		$this->result = array();
		$this->errno = mysql_errno($this->connection);
		if($this->errno != 0){
			file_put_contents("error.txt",mysql_error($this->connection));
			return;
		}
		$this->num_rows = @mysql_num_rows($this->res);
		if($this->num_rows != 0) {
			if($this->num_rows > 1){
				while(($ar = mysql_fetch_assoc($this->res)) == true){
					$this->result[] = $ar;
				}
			} else {
				$this->result = mysql_fetch_assoc($this->res);
			}
		}
	}

	function resarray(){
		return $this->result;
	}

	function singleres($field){
		return $this->result[$field];
	}
}