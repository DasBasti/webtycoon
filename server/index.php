<?
/*
 * JSON-RPC Server
 */
ob_start();
session_start();

include("set/costs.php");

//$_COOKIE['uid']=1;

$db = new db();

function __autoload($class){
	if(file_exists("lib/".strtolower(basename($class)).".php"))
	  require_once("lib/".strtolower(basename($class)).".php");
}

if(!extension_loaded('json')){
	die("Kein JSON verf�gbar!");
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
echo "suche nach session ".$payload->session."<br>";
$db->query("SELECT id FROM user WHERE session='".$payload->session."'");
$GLOBALS['uid'] = $db->singleres('id');
echo "habe id: ".$GLOBALS['uid']."<br>";

	list($class,$method)=explode('::',$payload->method,2);

	$obj=new $class();
	if(!$obj){
		$response->error = 'Ein Fehler beim Instanziieren der Klasse!';
	}
	if(!is_callable(array($obj,$method))){
		$response->error = 'Die Methode ist nicht definiert!';
	}
	if(!call_user_func_array(array($obj,$method),$payload->params)){
		$response->error = "Die Ausfuehrung der Methode $method ist fehlgeschlagen!";
	}

	$response->result=$obj->buffer;

if(empty($response->result->error) && empty($response->result->auth)){
 $db->query("SELECT money FROM user WHERE id='$GLOBALS[uid]'");
 $response->result->money=$db->singleres('money');
}

$response->id=$payload->id;

$out=ob_get_clean();

//uncomment to make html output
file_put_contents(microtime()."html.txt",$out);


ob_start("ob_gzhandler");
echo json_encode($response);

?>