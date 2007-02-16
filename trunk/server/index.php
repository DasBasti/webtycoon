<?
/*
 * JSON-RPC Server
 */
ob_start();
session_start();
include("../lib/db.php");

function __autoload($class){
	require_once("lib/".strtolower(basename($class)).".php");
}

if(!extension_loaded('json')){
	die("Kein JSON verfügbar!");
}

$response = new stdClass;


	$payload=json_decode(file_get_contents('php://input'));
	if(!$payload){
		$response->error = 'Keine JSON Daten';
	}
	if(!isset($payload->method)|| empty($payload->method)){
		$response->error = 'Keine Methode definiert!';
	}
	if(strpos($payload->method,'::')===false){
		$response->error = 'Keine Klasse Definiert!';
	}

	list($class,$method)=explode('::',$payload->method,2);

	$obj=new $class();
	if(!$obj){
		$response->error = 'Ein Fehler beim Instanziieren der Klasse!';
	}
	if(!is_callable(array($obj,$method))){
		$response->error = 'Die Methode ist nicht definiert!';
	}
/*	echo "obj method\n";
	print_r(array($obj,$method));
	echo "params\n";
	print_r($payload->params);
	echo "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-\n";
	print_r($payload);
*/
	if(!call_user_func_array(array($obj,$method),$payload->params)){
		$response->error = "Die Ausfuehrung der Methode $method ist fehlgeschlagen!";
	}

	$response->result=$obj->buffer;

$response->id=$payload->id;

$fh=fopen("debug.txt","a+");
fwrite($fh,"\n--------------------------------\n");
fwrite($fh,ob_get_flush());
fclose($fh);

ob_start("ob_gzhandler");

echo json_encode($response);

?>