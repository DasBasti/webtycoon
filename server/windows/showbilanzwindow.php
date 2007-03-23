<?

$this->db->query("SELECT `desc`,`amount` FROM transactions WHERE uid='$GLOBALS[uid]' LIMIT 17");

$bilanzhtml="<table style='padding:25px'><tr><td><b>Beschreibung</b></td><td><b>Betrag</b></td></tr>";
foreach($this->db->resarray() as $line){
	$bilanzhtml.="<tr>";
	foreach($line as $field){
		$bilanzhtml.="<td>$field</td>";
	}
	$bilanzhtml.="</tr>";
}
$bilanzhtml.="</table>";

$this->buffer->window="<h1>Bilanz</h1>
<p>$bilanzhtml</p>
<form>
<input type='submit' value='Schlie&szlig;en' id='button' onclick='document.getElementById(\"windowbox\").attributes[0].nodeValue=\"window-hidden\";document.getElementById(\"windowbox\").innerHTML=null;'/>
</form>
";

?>