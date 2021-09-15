<?php 

	session_start(); //Continuamos la sesion abierta en registro.php y verificamos que exista, de lo contrario redireccionamos a login.php
	if(!isset($_SESSION['usuario'])){
		$_SESSION['usuario'] = "<b style=color:green>Cerraste sesion correctamente<b>";
		header("location: modelo/login.php");
		return;
	}else{

	echo "Hola: " ."<b style=color:blue>". $_SESSION['usuario']."</b>" ."<br>";
	}
?>	 

<a href="cerrar_sesion.php"><button>Cerrar Session</button></a>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<style type="text/css">
		
		h1{

			text-align: center;
			background-color: white;
		}

	</style>
</head>
<body>
	<h1 style="font-family: cursive;">MODELO VISTA CONTROLADOR CON POO</h1>
	<br>

<?php 

	require_once "controlador/alumnos_controlador.php";
?>
<br>
<br>

<br>
<br>
<p>Todos los derechos reservados, <b>Ingeniero Diego Herrera</b></p>

</body>
</html>