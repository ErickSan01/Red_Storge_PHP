<?php 
   $servidor= "localhost";
   $nombreusuario = "root";
   $password = "RedStorge#2407";
   $db = "redstorge";
   $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

   if($conexion -> connect_error){
    die("Conexion fallida: " . $conexion-> connect_error);
   }

   
   $sql = "CREATE DATABASE RedStorge" ;
      if($conexion->query($sql) === true){
      echo "Base de datos creada";
      }else{
      die("Error al crear bd" . $conexion->error);
      }
   

   $sql = "CREATE TABLE USUARIO (
      ID_USUARIO INT(11) AUTO_INCREMENT PRIMARY KEY, 
      NOMBRE_USUARIO VARCHAR(50) NOT NULL, 
      NOMBRE_COMPLETO VARCHAR(100) NOT NULL, 
      EMAIL VARCHAR(50) NOT NULL, 
      PASSWORD VARCHAR(50) NOT NULL, 
      TIPO_USUARIO CHAR(1) NOT NULL
      )
      ";


   $sql = "CREATE TABLE GRUPO (
      ID_GRUPO INT(8) AUTO_INCREMENT PRIMARY KEY,
      GRADO INT(2) NOT NULL, 
      LETRA CHAR(1) NOT NULL,
      ID_PLANTEL INT(8) NOT NULL,
      CONSTRAINT fk_grupo_plantel
         FOREIGN KEY (id_plantel) REFERENCES plantel (id_plantel)
   
   )";

   $sql = "CREATE TABLE PREGUNTA (
      ID_PREGUNTA INT(8) AUTO_INCREMENT PRIMARY KEY,
      PREGUNTA VARCHAR(200) NOT NULL, 
      MODULO INT(1) NOT NULL
   )";

   $sql = "CREATE TABLE ENCARGADO_PLANTEL(
      ID_ENCARGADO INT(1) AUTO_INCREMENT PRIMARY KEY,
      ID_USUARIO INT(1) NOT NULL,
      ID_PLANTEL INT(1) NOT NULL,
      NUMERO_TELEFONO VARCHAR(10) NOT NULL,
      CONSTRAINT fk_encargado_usuario
         FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO(ID_USUARIO),
      CONSTRAINT fk_encargado_plantel
         FOREIGN KEY (ID_PLANTEL) REFERENCES PLANTEL(ID_PLANTEL)
   )";

   $sql = "CREATE TABLE RESPUESTA(
      ID_RESPUESTA INT(8) AUTO_INCREMENT PRIMARY KEY,
      ID_PREGUNTA INT(8) NOT NULL,
      INCISO VARCHAR(1) NOT NULL,
      RESPUESTA VARCHAR(200) NOT NULL,
      CONSTRAINT fk_respuesta_pregunta
         FOREIGN KEY (ID_PREGUNTA) REFERENCES PREGUNTA (ID_PREGUNTA) 
   )";

   $sql = "CREATE TABLE ESTUDIANTE ( 
      ID_ESTUDIANTE INT(8) AUTO_INCREMENT PRIMARY KEY,    
      ID_USUARIO INT(8) NOT NULL, 
      SEXO CHAR(1) NOT NULL, 
      EDAD INT(3) NOT NULL, 
      CONTEXTO VARCHAR(200) NOT NULL, 
      TIPO_FAMILIA VARCHAR(50) NOT NULL, 
      ID_GRUPO INT(8) NOT NULL,
      CONSTRAINT fk_estudiante_usuario
         FOREIGN KEY (ID_USUARIO) REFERENCES USUARIO (ID_USUARIO),
      CONSTRAINT fk_estudiante_grupo
         FOREIGN KEY (ID_GRUPO) REFERENCES GRUPO (ID_GRUPO)
   )";

   $sql = "CREATE TABLE CONTESTACION(
      ID_CONTESTACION INT(8) AUTO_INCREMENT PRIMARY KEY,
      ID_ESTUDIANTE INT(8) NOT NULL,
      ID_PREGUNTA INT(8) NOT NULL,
      ID_PRIMERA_RESPUESTA INT(8) NOT NULL,
      CONSTRAINT fk_contestacion_estudiante
      FOREIGN KEY (ID_ESTUDIANTE) REFERENCES ESTUDIANTE (ID_ESTUDIANTE),
      CONSTRAINT fk_contestacion_pregunta
      FOREIGN KEY (ID_PREGUNTA) REFERENCES PREGUNTA (ID_PREGUNTA),
      CONSTRAINT fk_contestacion_respuesta
      FOREIGN KEY (ID_PRIMERA_RESPUESTA) REFERENCES RESPUESTA (ID_RESPUESTA)
   )"; 
  
   
   if($conexion->query($sql) === true){
    echo "Tabla creada";
   }else{
    die("Error al crear bd" . $conexion->error);
   }


?>