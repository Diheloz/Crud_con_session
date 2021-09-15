<?php
	session_start();
	require_once "conexion.php";

	$pdo = Conexion::conexion();
		
	//Recibimos los datos de usuario y datos del archivo desde el formulario

	$nombre_archivo = $_FILES['archivo']['name'];
	$tipo_archivo = $_FILES['archivo']['type'];
	$tamano_archivo = $_FILES['archivo']['size'];
	$nombre_alumno = $_POST['nombre'];
	$correo_alumno = $_POST['correo'];
	$password_alumno = $_POST['password'];


	//Condicionamos el tamaño de la foto(medido en bytes), en el condicional menor a 16mb

	if ($tamano_archivo < 16000000) {

			//Ruta de la carpeta destino en el servidor

			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

			
			//Movemos la imagen del directorio temporal al directorio escogido

			move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta_destino .$nombre_archivo);

	}else{

		echo "El tamaño es demasiado grande";

	}

	

	//$archivo_objetivo = fopen ($carpeta_destino .$nombre_archivo, "r");
	//$contenido_archivo = fread($archivo_objetivo, $tamano_archivo);	
	//fclose($archivo_objetivo);

	$sql = "INSERT INTO alumnos (nombre, correo, contrasena, foto) VALUES( :nombre, :correo, :password, :archivo)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":nombre"=>$nombre_alumno, ":correo"=>$correo_alumno, "password"=>$password_alumno, ":archivo" => $nombre_archivo));
	$_SESSION['insertar'] = "<p style=color:blue>Registro insertado</p>";
	header("location: ../index.php");
	return;
	

	/*if($filas = $stmt->rowCount() > 0){

		echo "Numero de registros afectados" .$filas;
		$_SESSION['exito'] = "<b style='color:green'>Se ha insertado el registro y el archivo con exito</b>";
		
		
	}else{
		$_SESSION['error'] = "<b style='color:red'>algo salio mal</b>";
	}*/

	
 ?>



</body>
</html>