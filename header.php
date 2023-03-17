<?php
$servidor = "localhost";
$baseDatos = "redstorge";
$usuario = "root";
$pass = "RedStorge#2407";

try{
    $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if (!$conn) {
        echo '{"codigo":400,"mensaje":"Error intentando conectar con el servidor","respuesta":""}';
    }else{
        //echo '{"codigo":200,"mensaje":"Conexión exitosa","respuesta":""}';
    }
}catch (Exception $e){
    echo '{"codigo":400,"mensaje":"Error intentando conectar con el servidor","respuesta":""}';
}
?>