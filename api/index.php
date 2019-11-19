<?php 

header('Content-Type: application/json; charset: utf-8');

require_once 'classes/Estoque.php';

class Rest{

	public function open($requisicao)
	{
		$url = explode("/", $requisicao['url']);

		$classe = ucfirst($url[0]); 
		$funcao = $url[1];

		$paramentros = $url;

		unset($url);

		try {

			if (class_exists($classe) ) {

				if (method_exists($classe,$funcao)) {
					
					$retorno = call_user_func_array(array( new $classe, $funcao), $paramentros);

					return json_encode(array(
						'status' => "Success",
						'dados'  => $retorno
					));	

				}

				throw new Exception("Método não encontrado", 1);
			}

			throw new Exception("Classe não encontrada", 1);

		} catch (Exception $e) {

			return json_encode(array(
				'status' => "Error",
				'dados'  => $e->getMessage()
			));
		}
	}
}

if (isset($_REQUEST)) {
	echo Rest::open($_REQUEST);
}
