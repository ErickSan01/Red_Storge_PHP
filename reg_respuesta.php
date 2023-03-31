<?php 
$servidor= "localhost";
$nombreusuario = "redstorge";
$db_password = "redstorge";
$db = "redstorge";

try{
    $conn = new mysqli($servidor, $nombreusuario, $db_password, $db);
    if(!$conn){
        echo '{"codigo":400,"mensaje":"Error intentando conectar","respuesta":""}';
    }else{
        //id_contestacion
        //id_estudiante
        //id_pregunta
        //id_respuesta
        //numero_intento
        if(isset($_POST["id_contestacion"]) && isset($_POST["id_estudiante"]) && isset($_POST["id_pregunta"]) && isset($_POST["id_respuesta"]) && isset($_POST["numero_intento"])){
            $errors = array();
            $id_contestacion = $_POST["id_contestacion"];
            $id_estudiante = $_POST["id_estudiante"];
            $id_pregunta = $_POST["id_pregunta"];
            $id_respuesta = $_POST["id_respuesta"];
            $numero_intento = $_POST["numero_intento"];

            if ($stmt = $mysqli_conection->prepare("INSERT INTO contestacion (ID_CONTESTACION, ID_ESTUDIANTE, ID_PREGUNTA, ID_RESPUESTA, NUMERO_INTENTO) VALUES(?, ?, ?, ?, ?, ?)")) {
                $stmt->bind_param('ssssss', $id_contestacion, id_estudiante, id_pregunta, id_respuesta, numero_intento);
                if($stmt->execute()){
                        
                    /* close statement */
                    $stmt->close();
                    
                }else{
                    $errors[] = "Hubo un error, por favor inténtalo de nuevo";
                }
            }else{
                $errors[] = "Hubo un error, por favor inténtalo de nuevo";
            }
        }else{
            echo "Missing data";
        }
    }

}catch(Exception $e){
    echo $e;
}
include 'footer.php';
?>
