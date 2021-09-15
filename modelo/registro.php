<?php 
	session_start();
	require_once "conexion.php";

	$pdo = Conexion::conexion();

	if(isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['nombre'])){
		
		$nombre = $_POST['nombre'];
		$usuario = $_POST['usuario'];

		//Encriptamos en algortimo hash(blowfish) la contraseña que digita el usuario y la almacenamos en la variable $password
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);		

		}	
	
	if(isset($_POST['nombre']) && isset($usuario) && isset($password) && isset($_POST['registro'])){

		//Si el usuario o la contraseña es menor que 4 en terminos de longitud se cumple la condicion
		
		if (strlen($usuario) < 4 OR strlen($password) < 4) {

			$_SESSION['no_registro'] = "<b style=color:green>Usuario o contraseña demasiado corto</b>";
			header("location: registro.php");
			return;

			//Comprobamos que el usuario no exista

		}	if ($sql = "SELECT * FROM usuarios WHERE usuario = :usuario"){

				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(":usuario"=>$usuario));

				if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){

					$_SESSION['usuario_existe'] = "El usuario ya existe";
					header("location: registro.php");
					return;

				}else{
			

				//En caso de que el usuario NO EXISTA, ejecutamos la consulta y enviamos los datos del usuario y contraseña encriptada a la BD

				$sql = "INSERT INTO usuarios (nombre, usuario, contrasena) VALUES(:nombre , :usuario, :contrasena)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(":nombre"=>$nombre, ":usuario"=>$usuario,":contrasena"=>$password));
				//$registro = $stmt->rowCount();
				header("location: login.php");
				return;
			}
		}
			
	}
	
		
	if (isset($_SESSION['no_registro'])) {

		echo $_SESSION['no_registro'];
		unset($_SESSION['no_registro']);
	}


	if (isset($_SESSION['usuario_existe'])) {

		echo $_SESSION['usuario_existe'];
		unset($_SESSION['usuario_existe']);
	}
					
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		
	table{
		margin: auto;
		border: 2px dotted red;
		background-color: gray;
		text-align: center;
		color: white;
	}
	body{

		background-color: pink;
	}

	</style>
			
</head>
<body>

	<table>
		<form method="post">
		<tr><td>Nombre:<input type="text" name="nombre">
		<tr><td>Usuario<input type="text" name="usuario"></td></tr>
		<tr><td>Contraseña<input type="password" name="password"></td></tr>
		<tr><td colspan="2"><input type="submit" name="registro" value="Registrarse"></td></tr><tr><td><a href="login.php">Ya estas registrado?...Clic Aqui!!</a></td></tr>

		</form>
	</table>

</body>
</html>