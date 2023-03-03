<?php
include 'header.php';

try{
	$conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
	if (!$conn) {
		echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta":""}';
	}else{
		echo '{"codigo":200, "mensaje": "Conectado correctamente", "respuesta":""}';
	}
}catch (Exception $e){
	echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta":""}';
}

include 'footer.php';
