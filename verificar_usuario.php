<?php
include 'header.php';

try{
	$conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
	if (!$conn) {
		echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta":""}';
	}else{
		if(isset($_GET['nombre_usuario'])){
			$usuario = $_GET['nombre_suario'];
			$sql = "SELECT * FROM 'usuario' WHERE nombre_usuario='".$usuario."';";
			$resultado = $conn->query($sql);

			if ($resultado->num_rows >0) {
				echo '{"codigo":202, "mensaje": "El usuario existe en el sistema", "respuesta":"'.$resultado->num_rows.'"}';
			}else{
				echo '{"codigo":401, "mensaje": "Error intentando crear el usuario", "respuesta":""}';
			}
		}else{
			echo '{"codigo":402, "mensaje": "Faltan datos para ejecutar la accion solicitada", "respuesta":""}';
		}
	}
}catch (Exception $e){
	echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta":""}';
}

include 'footer.php';