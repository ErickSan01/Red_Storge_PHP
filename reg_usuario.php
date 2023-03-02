<?php 
//include 'header.php';

$servidor= "localhost";
$nombreusuario = "root";
$password = "RedStorge#2407";
$db = "redstorge";


try{
    $conn = new mysqli($servidor, $nombreusuario, $password, $db);
    if(!$conn){
        echo '{"codigo":400,"mensaje":"Error intentando conectar","respuesta":""}';
    }else{
        if(isset($_POST['nombre_usuario']) &&
           isset($_POST['nombre_completo'])&& 
           isset($_POST['email'])&&
           isset($_POST['password'])&&
           isset($_POST['tipo_usuario'])){

            $NOMBRE_USUARIO = $_POST['nombre_usuario'];
            $NOMBRE_COMPLETO = $_POST['nombre_completo'];
            $EMAIL = $_POST['email'];
            $PASSWORD = md5($_POST['password']);
            $TIPO_USUARIO = $_POST['tipo_usuario'];


            $sql = "INSERT INTO usuario (ID_USUARIO, NOMBRE_USUARIO, NOMBRE_COMPLETO, EMAIL, PASSWORD, TIPO_USUARIO)
                    VALUES (NULL, '$NOMBRE_USUARIO','$NOMBRE_COMPLETO','$EMAIL','$PASSWORD','$TIPO_USUARIO');";
            if($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM usuario WHERE NOMBRE_USUARIO='.$NOMBRE_USUARIO.';";
                $resultado = $conn->query($sql);
                $texto = '';

                while ($row = $resultado->fetch_assoc()){
                    $texto =
                    "{#ID_USUARIO#:}".$row['ID_USUARIO'].
                    "{,#NOMBRE_COMPLETO#:#}".$row['NOMBRE_USUARIO'].
                    "{,#EMAIL#:#}".$row['EMAIL'].
                    "{,#PASSWORD#:#}".$row['PASSWORD'].
                    "{,#TIPO_USUARIO#:#}".$row['TIPO_USUARIO'].
                    "}";
                }

                echo '{"codigo":201, "mensaje":"Usuario creado correctamente","respuesta":"'.$texto.'"}';
            }else{
                echo '{"codigo":401, "mensaje":"Error al intentar crear el usuario","respuesta":""}';
            }
                
        }else{
            echo '{"codigo":402, "mensaje":"Faltaron datos para crear el usuario","respuesta":""}';
        }
    }

}catch (Exception $e){
    echo $e;
    //echo '{"codigo":400, "mensaje":"Error al conectar","respuesta":""}';
}

include 'footer.php';
?>


<!-- INSERT INTO `usuario` (`ID_USUARIO`, `NOMBRE_USUARIO`, `NOMBRE_COMPLETO`,
`EMAIL`, `PASSWORD`, `TIPO_USUARIO`) VALUES (NULL, 'KarenAdddfg',
'Karen Pastor Del Sinaloa', 'karenkokoro@gmail.com', 'kkren122', 'a'); -->