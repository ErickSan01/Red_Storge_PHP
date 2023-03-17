<?php
include 'header.php';

try{
    $conexion = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if(!$conn) {
        echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta": ""}';
    } else {
        if(isset($_POST["nombre_usuario"]) && isset($_POST["password"])){
            $errors = array();
            
            $nombre_usuario = $_POST["nombre_usuario"];
            $password = $_POST["password"];
            
            //Connect to database
            require dirname(__FILE__) . '/database.php';
            
            if ($stmt = $mysqli_conection->prepare("SELECT nombre_usuario, email, password FROM usuario WHERE nombre_usuario = ? LIMIT 1")) {
                
                /* bind parameters for markers */
                $stmt->bind_param('s', $nombre_usuario);
                    
                /* execute query */
                if($stmt->execute()){
                    
                    /* store result */
                    $stmt->store_result();
    
                    if($stmt->num_rows > 0){
                        /* bind result variables */
                        $stmt->bind_result($username_tmp, $email_tmp, $password_hash);

                        
                        /* fetch value */
                        $stmt->fetch();

                        $valido = password_verify($password, $password_hash);
                        
                        if($valido){
                            echo "Success" . "|" . $username_tmp . "|" .  $email_tmp;
                            
                            return;
                        }else{
                            $errors[] = "Nombre de usuario o contraseña incorrecta";
                        }
                    }else{
                        $errors[] = "Nombre de usuario o contraseña incorrecta";
                    }
                    
                    /* close statement */
                    $stmt->close();
                    
                }else{
                    $errors[] = "Hubo un error, por favor inténtalo de nuevo";
                }
            }else{
                $errors[] = "Hubo un error, por favor inténtalo de nuevo";
            }
            
            if(count($errors) > 0){
                
                echo $errors[0];
            }
        }else{
            echo "Datos incompletos";
        }
    }
} catch(Exception $e){
    echo '{"codigo":400, "mensaje": "Error intentando conectar", "respuesta": ""}';
}

#include footer.php;

?>