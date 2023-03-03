<?php 
   include 'header.php';
   //$conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
   $conexion = mysqli_connect($servidor, $usuario, $pass);
   if($conexion -> connect_error){
    die("Conexion fallida: " . $conexion-> connect_error);
   }
   
   $query = "SHOW DATABASEs LIKE 'redstorge'";
     //Consulta para saber si existe la BD
   $res= mysqli_query($conexion,$query);

   //Si la consulta llega vacia no hay bd aun así que la crea con todo
   if($res->num_rows === 0){
    $sql_crear_bd = "CREATE DATABASE redstorge";
    if($conexion->query($sql_crear_bd) === true){
        echo "BD creada";
    }else{
        die("Error al crear bd" . $conexion->error);
    }
    $conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    $sql = file_get_contents('redstorge.sql');    
    if($conexion->multi_query($sql) === true){
        echo "BD con tablas lista";
    }else{
        die("Error al crear las tablas" . $conexion->error);
    }
   //Si ya existe no hace nada
   }else{
    echo "Ya existe la bd";
   }
    
  
  
  



  

    
?>