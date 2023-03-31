<?php 
   include 'header.php';
   //$conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
   $conexion = mysqli_connect($servidor, $usuario, $pass);

   if($conexion -> connect_error){
    die("Conexion fallida: " . $conexion-> connect_error);
   }
   
?>