<?php 
	session_start();
	if(!isset($_SESSION['usuario'])){
		$_SESSION['usuario'] = "<b style=color:green>Cerraste sesion correctamente<b>";
		header("location: login.php");
		return;
	}else{

	echo "Hola: " ."<b style=color:blue>". $_SESSION['usuario']."</b>" ."<br>";
	}

	require_once "conexion.php";

	$pdo = Conexion::conexion();

	$nombre = $_GET['nombre'];
	$correo = $_GET['correo'];
	$password = $_GET['password'];
	$id = $_GET['id'];
	

	if (isset($_POST['actualizar']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['id'])) {
		
		$sql ="UPDATE alumnos SET nombre = :nombre, correo = :correo, contrasena = :contrasena WHERE id_alumno = :id_alumno";

		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":nombre"=>$_POST['nombre'], ":correo"=>$_POST['correo'], "contrasena"=>$_POST['password'], ":id_alumno"=>$_POST['id']));

		$_SESSION['actualizar'] = "<p style='color:blue'>Datos de alumno actualizados</p>";
		header("location: ../index.php");
		return;
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<style type="text/css">
	
	table{
		border: 2px dotted;
		margin:auto;
		font-family: cursive;
		background-color: pink;
		text-align: center;
	}
	body{
			background-color: gray;
		}



	</style>

</head>
<body>
	<form method="post">

		<table>

		<tr><td><b>Nombre Alumno</td>
		<td><b>Correo</td>
		<td><b>Contraseña</td></tr>
		<tr><td><input type="text" name="nombre" value="<?php echo htmlentities($nombre) ?>"></td>
		
		<td><input type="text" name="correo" value="<?php echo htmlentities($correo) ?>"></td>
		
		<td><input type="text" name="password" value="<?php echo htmlentities($password) ?>"></td>
		<td><input type="hidden" name="id" value="<?php echo htmlentities($id) ?>"></td>
		<td><input type="submit" name="actualizar" value="Actualizar">

		<a href="../index.php">Regresar</a></td></tr>
			
		</table>

	</form>

	<br>


</body>
</html>
