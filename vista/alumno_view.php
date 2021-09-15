<?php

	
 ?>

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
			margin: auto;
			border: 2px dotted;
			text-align: center;
			width: 940px;
			background-color: pink;
			font-family: cursive;
				
			}

		img{
				
			width: 30%;

			}
		button{
			font-family: cursive;
			color: blue;
			background-color: white;
		}

	</style>		
		
</head>
<body>

<?php 

	require_once "controlador/alumnos_controlador.php";

?>	
	<table>
	<tr><td><b>ID</b></td>
	<td><b>Nombre Alumno</b></td>
	<td><b>Correo</b></td>
	<td><b>Contraseña</b></td>
	<td><b>Foto</b></td></tr>

<?php 

	if(isset($_SESSION['actualizar'])){

		echo $_SESSION['actualizar'];
		unset($_SESSION['actualizar']);
	}

	if(isset($_SESSION['borrar'])){

		echo $_SESSION['borrar'];
		unset($_SESSION['borrar']);
	}

	if(isset($_SESSION['insertar'])){

		echo $_SESSION['insertar'];
		unset($_SESSION['insertar']);
	}





	foreach ($matrizAlumnos as $alumno) :
?>		
		<tr>
		<?php $nombre_foto = $alumno['foto']?>
		<td><?php echo $alumno['id_alumno']?></td>
		<td><?php echo $alumno['nombre']?></td>
		<td><?php echo $alumno['correo']?></td>
		<td><?php echo $alumno['contrasena']?></td>
		<td><img src="/upload/<?php echo $nombre_foto?>"></td>
		<td><a href="modelo/borrar.php?id=<?php echo $alumno['id_alumno']?>"><button>Eliminar</button></a></td>
		<td><a href="modelo/editar.php?id=<?php echo $alumno['id_alumno']?>&nombre=<?php echo $alumno['nombre']?>&correo=<?php echo $alumno['correo']?>&password=<?php echo $alumno['contrasena']?>"><button>Editar</button></a></td></tr>


<?php

	endforeach;

 ?>

 	<form method="post" action="modelo/datosAlumno.php" enctype="multipart/form-data">
	 	<tr><td><input type="hidden" name="id"></td>
	 	<td><input type="text" name="nombre"></td>
	 	<td><input type="email" name="correo"></td>
	 	<td><input type="password" name="password"></td>
	 	<td><input type="submit" name="enviar" value="Agregar Alumno"></td></tr>
	 	
	 	</table><br>

	 	<input type="file" name="archivo"  size="20">
 	
 	
 	</form>

 	

</body>
</html>