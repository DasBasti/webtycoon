<?
/*
 * Main entry point for Game
 */


include "lib/db.php";

$db = new db();

$fh = fopen("tpl/template.html","r");
$html = fread($fh,filesize("tpl/template.html"));

echo $html;

?>