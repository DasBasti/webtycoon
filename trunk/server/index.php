<?
/*
 * JSON-RPC Server
 */

session_start();
incude("../lib/db.php");

function __autoload($class){
	require_once("rpc/".strtolower(basename($class)).".php");
}

if(!extension_loaded('json')){
	die("Kein JSON verfügbar!");
}

$response = new stdClass;

try {
	$payload=json_decode(file_get_contents('php://input'));
	if(!$payload){
		throw new Exeption('Keine JSON Daten');
	}
	if(!isset($payload->method)|| empty($payload->method)){
		throw new Exeption('Keine Methode definiert!');
	}
	if(strpos($payload->method,'::')===false){
		throw new Exeption('Keine Klasse Definiert!');
	}

	list($class,$method)=explode('::',$payload->method,2);

	$obj=new $class();
	if(!obj){
		throw new Exeption('Ein Fehler beim Instanziieren der Klasse!');
	}
	if(!is_callable(array($obj,$method))){
		throw new Exeption('Die MEthode ist nicht definiert!');
	}
	if(!call_user_func_array(array($obj,$method),$payload->params)){
		throw new Exeption('Die Ausführung der MEthode ist fehlgeschlagen!');
	}

	$response->result=$obj->buffer;

} catch (Exeption $e) {
	$err=new stdClass;

	$err->message=$e->getMessage();
	$err->line=$e->getLine();
	$err->file=$e->getFile();
	$err->trace=$e->getTraceAsString();

	$response->error=$err;
}

$response->id=$payload->id;

ob_start("ob_gzhandler");

echo json_encode($response);

?>