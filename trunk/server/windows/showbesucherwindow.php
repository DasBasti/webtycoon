<?

$this->db->query("SELECT `day`,`count` FROM visitors WHERE uid='$GLOBALS[uid]' ORDER BY day DESC LIMIT 10");

$html="<table style='padding:25px'><tr><td><b>Tag</b></td><td><b>Besucher</b></td></tr>";
foreach($this->db->resarray() as $line){
	$html.="<tr>";
	foreach($line as $field){
		$html.="<td>$field</td>";
	}
	$html.="</tr>";
}
$html.="</table>";

$this->buffer->window="<h1>Besucher</h1>
<p>$html</p>
<form>
<input type='submit' value='Schlie&szlig;en' id='button' onclick='document.getElementById(\"windowbox\").attributes[0].nodeValue=\"window-hidden\";document.getElementById(\"windowbox\").innerHTML=null;'/>
</form>
";

?>