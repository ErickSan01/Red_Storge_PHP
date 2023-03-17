<?php 
//include 'header.php';

$servidor= "localhost";
$nombreusuario = "redstorge";
$db_password = "redstorge";
$db = "redstorge";

$emailMaxLength = 254;
$nombre_usuarioMaxLength = 20;
$nombre_usuarioMinLength = 3;
$passwordMaxLength = 50;
$passwordMinLength = 5;

$id_user = 0;

try{
    $conn = new mysqli($servidor, $nombreusuario, $db_password, $db);
    if(!$conn){
        echo '{"codigo":400,"mensaje":"Error intentando conectar","respuesta":""}';
    }else{
        if(isset($_POST["nombre_usuario"]) && isset($_POST["nombre_completo"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["tipo_usuario"])){
            $errors = array();
            
            $nombre_usuario = strtolower($_POST["nombre_usuario"]);
            $nombre_completo = $_POST["nombre_completo"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $tipo_usuario = $_POST["tipo_usuario"];
            
            //Validate email
            if(preg_match('/\s/', $email)){
                echo '{"codigo":4000, "mensaje":"Email no puede tener espacios","respuesta":""}';
                $errors[] = "Email no puede tener espacios";
            }else{
                if(!validate_email_address($email)){
                    echo '{"codigo":4001, "mensaje":"Email invalido","respuesta":""}';
                    $errors[] = "Email inválido";
                }else{
                    if(strlen($email) > $emailMaxLength){
                        echo '{"codigo":4002, "mensaje":"Email demasiado largo, debe ser menor o igual a' . strval($emailMaxLength) . '","respuesta":""}';
                        $errors[] = "Email demasiado largo, debe ser menor o igual a " . strval($emailMaxLength) . " characters";
                    }
                }
            }
            
            //Validate username
            if(strlen($nombre_usuario) > $nombre_usuarioMaxLength || strlen($nombre_usuario) < $nombre_usuarioMinLength){
                echo '{"codigo":4003, "mensaje":"Tamaño de nombre de usuario invalido, debe estar entre' . strval($nombre_usuarioMinLength) . ' y ' . strval($nombre_usuarioMaxLength) . '  carácteres","respuesta":""}';
                $errors[] = "Nombre de usuario inválido, debe estar entre " . strval($nombre_usuarioMinLength) . " y " . strval($nombre_usuarioMaxLength) . " carácteres";
            }else{
                if(!ctype_alnum($nombre_usuario)){
                    echo '{"codigo":4004, "mensaje":"Nombre de usuario debe usar valores alfanuméricos","respuesta":""}';
                    $errors[] = "Nombre de usaro no debe usar carácteres especiales";
                }
            }
            
            //Validate password
            if(preg_match('/\s/', $password)){
                echo '{"codigo":4005, "mensaje":"La contraseña no puede tener espacios","respuesta":""}';
                $errors[] = "La contraseña no puede tener espacios";
            }else{
                if(strlen($password) > $passwordMaxLength || strlen($password) < $passwordMinLength){
                    echo '{"codigo":4006, "mensaje":"Tamaño de contraseña incorrecto, debe estar entre ' . strval($passwordMinLength) . ' y ' . strval($passwordMaxLength) . ' carácteres","respuesta":""}';
                    $errors[] = "Contraseña inválida, debe estar entre " . strval($passwordMinLength) . " y " . strval($passwordMaxLength) . " carácteres";
                }else{
                    if(!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)){
                        echo '{"codigo":4007, "mensaje":"La contraseña debe contener una letra y un número al menos","respuesta":""}';
                        $errors[] = "La contraseña debe contener al menos 1 letra y 1 número";
                    }
                }
            }
            
            //Check if there is user already registered with the same email or username
            if(count($errors) == 0){
                //Connect to database
                require dirname(__FILE__) . '/database.php';
                
                if ($stmt = $mysqli_conection->prepare("SELECT nombre_usuario, email FROM usuario WHERE email = ? OR nombre_usuario = ? LIMIT 1")) {
                    
                    /* bind parameters for markers */
                    $stmt->bind_param('ss', $email, $nombre_usuario);
                        
                    /* execute query */
                    if($stmt->execute()){
                        
                        /* store result */
                        $stmt->store_result();
    
                        if($stmt->num_rows > 0){
                        
                            /* bind result variables */
                            $stmt->bind_result($nombre_usuario_tmp, $email_tmp);
    
                            /* fetch value */
                            $stmt->fetch();
                            
                            if($email_tmp == $email){
                                $errors[] = "El email usado ya existe";
                            }
                            else if($nombre_usuario_tmp == $nombre_usuario){
                                $errors[] = "Nombre de usuario ya existe";
                            }
                        }
                        
                        /* close statement */
                        $stmt->close();
                        
                    }else{
                        $errors[] = "Hubo un error, por favor inténtalo de nuevo";
                    }
                }else{
                    $errors[] = "Hubo un error, por favor inténtalo de nuevo";
                }
            }
            
            //Finalize registration
            if(count($errors) == 0){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                if ($stmt = $mysqli_conection->prepare("INSERT INTO usuario (ID_USUARIO, NOMBRE_USUARIO, NOMBRE_COMPLETO, EMAIL, PASSWORD, TIPO_USUARIO) VALUES(?, ?, ?, ?, ?, ?)")) {
                    
                    /* bind parameters for markers */
                    $stmt->bind_param('ssssss', $id_user, $nombre_usuario, $nombre_completo, $email, $hashedPassword, $tipo_usuario);
                        
                    /* execute query */
                    if($stmt->execute()){
                        
                        /* close statement */
                        $stmt->close();
                        
                    }else{
                        $errors[] = "Hubo un error, por favor inténtalo de nuevo";
                    }
                }else{
                    $errors[] = "Hubo un error, por favor inténtalo de nuevo";
                }
            }
            
            if(count($errors) > 0){
                echo $errors[0];
            }else{
                echo "Success";
            }
        }else{
            echo "Missing data";
        }
    }

}catch (Exception $e){
    echo $e;
    //echo '{"codigo":400, "mensaje":"Error al conectar","respuesta":""}';
}

function validate_email_address($email) {
    return preg_match('/^([a-z0-9!#$%&\'*+-\/=?^_`{|}~.]+@[a-z0-9.-]+\.[a-z0-9]+)$/i', $email);
}

include 'footer.php';
?>


<!-- INSERT INTO `usuario` (`ID_USUARIO`, `NOMBRE_USUARIO`, `NOMBRE_COMPLETO`,
`EMAIL`, `PASSWORD`, `TIPO_USUARIO`) VALUES (NULL, 'KarenAdddfg',
'Karen Pastor Del Sinaloa', 'karenkokoro@gmail.com', 'kkren122', 'a'); -->