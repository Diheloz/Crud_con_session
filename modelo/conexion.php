<?php 
	
	
	class Conexion{

		public static function conexion(){

			try{

				$pdo= new PDO('mysql:host=localhost; dbname=pruebabd', 'root', '');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec("SET CHARACTER SET UTF8"); 

			}catch (Exception $e){

				die("Error".$e->getMessage());
				echo "Linea del error" .$e->getLine();

			}

			return $pdo;
		}


	}


?>