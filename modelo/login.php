<?php
	session_start();

	require_once "conexion.php";

	$pdo = Conexion::conexion();
	
	if(isset($_POST['usuario']) && isset($_POST['contrasena']) && isset($_POST['dale'])){

		$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":usuario"=>$_POST['usuario']));

		if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){	

				//En caso de que $fila nos devuelve algo, verificamos la contraseña digitada por el usuario y la comparamos con la contraseña encríptada en la BD.

				if(password_verify($_POST['contrasena'], $fila['contrasena'])){
					
					$_SESSION['usuario'] = $_POST['usuario'];
					header("location: ../index.php");
					return;

				}else{
					
					$_SESSION['no_login'] = "Contraseña Incorrecta";
					header("location: login.php");
					return;
				}

		}else{

			$_SESSION['no_login'] = "usuario no existe";
			header("location: login.php");
			return;
		}
	}

		
	if(isset($_SESSION['usuario'])){

		echo $_SESSION['usuario'];
		unset($_SESSION['usuario']);
	}

	if (isset($_SESSION['no_login'])) {
		echo $_SESSION['no_login'];
		unset($_SESSION['no_login']);
	}		

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../estilos.css" />
	
</head>
<body >
	<form method="post">
		<table>
			<tr><td colspan="2">Bienvenido...Por favor inicie sesion</td></tr>
			<tr><td>Usuario: <input type="text" name="usuario"></td></tr>
			<tr><td>Contraseña: <input type="password" name="contrasena"></td></tr>
			<tr><td colspan="2"><input type="submit" name="dale" value="Iniciar Sesion"></td></tr>
			<tr><td colspan="2"><a href="registro.php">Registrarse</a></td></tr>
		</table><br>
	</form>

</body>
</html>