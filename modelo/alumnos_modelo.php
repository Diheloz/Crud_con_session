<?php 
	
	class Alumnos_modelo {

		private $db;
		private $alumnos;

		public function __construct() {
 
			require_once "conexion.php";

			$this->db = Conexion::conexion();
			$this->alumnos = array();

		}

		public function get_alumnos(){

			$sql = "SELECT * FROM alumnos";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
				
				$this->alumnos[] = $fila;
			}
			return $this->alumnos;

		}
	}


?>