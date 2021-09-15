<?php 
	
	
	//Llamada al modelo

	require_once "modelo/Alumnos_modelo.php";

	$alumno = new Alumnos_modelo();
	$matrizAlumnos = $alumno->get_alumnos();
	

//----------------------------------------------------

	//Llamada la vista

	require_once "vista/Alumno_view.php";


?>