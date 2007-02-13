<?

class db {
	function db(){
		mysql_connect("localhost","root");
		mysql_select_db("webtycoon");
	}

	function query($str){
		//echo $str."<br/>";
		$this->res = mysql_query($str);
		$this->result = array();
		if(mysql_num_rows($this->res) > 1){
			while(($ar = mysql_fetch_assoc($this->res)) == true){
				$this->result[] = $ar;
			}
		} else {
			$this->result = mysql_fetch_assoc($this->res);
		}
	}

	function resarray(){
		return $this->result;
	}

	function singleres($field){
		return $this->result[$field];
	}
}