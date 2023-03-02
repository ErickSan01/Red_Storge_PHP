<?php
include 'header.php';

try {
    $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if(!$conn) {
        echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta": ""}';
    } else {
        if(isset($_GET['nombre_usuario']) &&
           isset($_GET['nombre_completo'])&& 
           isset($_GET['email'])&&
           isset($_GET['password'])&&
           isset($_GET['password2'])&&
           isset($_GET['tipo_usuario'])){

            $NOMBRE_USUARIO = $_GET['nombre_usuario'];
            $NOMBRE_COMPLETO = $_GET['nombre_completo'];
            $EMAIL = $_GET['email'];
            $PASSWORD = $_GET['password'];
            $PASSWORD2 = $_GET['password2'];
            $TIPO_USUARIO = $_GET['tipo_usuario'];

            

            $sql = "SELECT * FROM usuario WHERE nombre_usuario='".$NOMBRE_USUARIO."' and password='".$PASSWORD."';";
            $resultado = $conn->query($sql);

            if($resultado->num_rows > 0){

                $sql = "UPDATE usuario SET 'nombre_usuario' = '".$NOMBRE_USUARIO."', 'nombre_completo'='".$NOMBRE_COMPLETO."', 'email'='".$EMAIL."', 'password'='".$PASSWORD2."', 'tipo_usuario'='".$TIPO_USUARIO."' WHERE nombre_usuario='".$NOMBRE_USUARIO."' and password='".$PASSWORD."';";

                echo '{"codigo":206, "mensaje": "Usuario editado exitosamente.", "respuesta": ""}';
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

include 'footer.php';
?>