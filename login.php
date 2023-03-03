<?php
include 'header.php';

try{
    $conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if(!$conn) {
        echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta": ""}';
    } else {
        if(isset($_POST['nombre_usuario']) && isset($_POST['password'])){
            $usuario = $_POST['nombre_usuario'];
            $pass =$_POST['password'];

            $usuario=limpiar_cadena($usuario);
            $pass=limpiar_cadena($pass);

            $sql = "SELECT * FROM 'usuario' WHERE nombre_usuario='".$usuario."' and password='".$pass."';";
            $resultado = $conn->query($sql);

            if($resultado->num_rows > 0){
                echo '{"codigo":205, "mensaje": "Inicio de sesión correcto", "respuesta": ""}';
            } else {
                echo '{"codigo":203, "mensaje": "El usuario NO existe en el sistema", "respuesta": "0"}';
            }
        } else {
            echo '{"codigo":402, "mensaje": "Faltan datos para ejecutar la accion solicitada", "respuesta": ""}';
        }
    }
} catch(Exception $e){
    echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta": ""}';
}

#include footer.php;

?>