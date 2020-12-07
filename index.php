<?php

header('Content-Type: application/json; charset=utf-8');

define("SITE_ROOT", "C:/wamp64/www/API/");

require_once(SITE_ROOT . "classes/produtos.php");
require_once(SITE_ROOT . "classes/categorias.php");
//require_once(SITE_ROOT . "classes/vendas.php");
//require_once(SITE_ROOT . "classes/vendas_produtos.php");

class Rest{

	public static function get($requisicao){
		
		$url = explode('/', $requisicao['url']);

		$classe = ucfirst($url[0]);
		array_shift($url);
		try{
			$parametro = $url[0];
			array_shift($url);
		} catch (Exception $e){
			$parametro = Array();
		}


		$consulta = Array();
		$consulta['classe'] = $classe;
		$consulta['parametro'] = $parametro;
		
		try {
			if (class_exists($consulta['classe'])) {
				if (method_exists($consulta['classe'], 'get')) {
					$retorno = call_user_func_array(array(new $consulta['classe'], 'get'), array());
					return $retorno;

				} else {
					return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
				}
			} else {
				return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
		}
	}

	public static function post($requisicao, $body){
		
		$url = explode('/', $requisicao['url']);

		$classe = ucfirst($url[0]);
		array_shift($url);
		try{
			$parametro = $url[0];
			array_shift($url);
		} catch (Exception $e){
			$parametro = Array();
		}


		$consulta = Array();
		$consulta['classe'] = $classe;
		$consulta['parametro'] = $parametro;
		
		try {
			if (class_exists($consulta['classe'])) {
				if (method_exists($consulta['classe'], 'post')) {
					$retorno = call_user_func_array(array(new $consulta['classe'], 'post'), array($body));
					return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
				} else {
					return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
				}
			} else {
				return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
		}
	}
}

if (isset($_REQUEST)) {
	
	#print_r($_SERVER['REQUEST_METHOD']);

	
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		echo (Rest::get($_REQUEST));
	}elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
		echo Rest::post($_REQUEST,file_get_contents('php://input'));
	}
	/*

	//print_r(Rest::explodeUrl($_REQUEST));
	print_r(file_get_contents('php://input'));

	//echo Rest::open($_REQUEST);
	*/
}