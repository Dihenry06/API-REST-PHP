<?php 

	class Estoque 
	{

		public function mostrar()
		{
			$con = new PDO('mysql: host=localhost; dbname=filial','root','');

			$query = "SELECT nome,preco FROM estoque";
			$query = $con->prepare($query);
			$query->execute();

			$resultados = array();

			while ($row = $query->fetch(PDO::FETCH_ASSOC)){
				$resultados[]= $row;
			}

			unset($query);

			if (!$resultados) {
				throw new Exception("Nenhum produto encontrado");	
			}

			return $resultados;
		}
	}

?>