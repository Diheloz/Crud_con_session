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

	$id_alumno = $_GET['id'];

	$sql = "SELECT id_alumno, nombre, correo, contrasena  FROM alumnos WHERE id_alumno = :id_alumno";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":id_alumno"=>$id_alumno));
	$fila = $stmt->fetch(PDO::FETCH_ASSOC);

	
	if (isset($_POST['eliminar']) && isset($_POST['id_alumno'])) {
		$sql = "DELETE FROM alumnos WHERE id_alumno = :id_alumno";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":id_alumno"=>$_POST['id_alumno']));

		$_SESSION['borrar'] = "<p style='color:blue'>Alumno eliminado<p>";
		header("location: ../index.php");
		return;

	}



?>	<table>
	<tr><td>Esta seguro que desea eliminar a: <b style='color:green'><?php echo $fila['nombre']?></b></td></tr>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<style type="text/css">
		body{
			background-color: gray;
		}

		table{

			background-color: pink;
			margin: auto;
			border: 2px dotted;
			text-align: center;
		}

	</style>
</head>
<body>

	<form method="post">
		
		<tr><td><input type="hidden" name="id_alumno" value="<?php echo $fila['id_alumno']?>"></td></tr>
		<tr><td><input type="submit" value="Eliminar" name="eliminar">
		<a href="../index.php">Regresar</a></td></tr>

		</table>
	</form>
	
	
	



</body>
</html>

