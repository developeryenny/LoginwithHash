<?php
    $login=  htmlentities(addslashes($_POST["login"]));
    $password= htmlentities(addslashes($_POST["password"]));
    $pass_cifra= password_hash($password, PASSWORD_DEFAULT, array("cost"=>12));//TE ENCRIPTA EL PASSWORD
    $contador=0;
try {
    $base= new PDO("mysql:host=localhost; dbname=login", "root", "");
    //PDO::ATTR_ERRMODE: Reporte de errores.
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
    $sql = "select * from  usuarios_login where  usuarios =:log";
    $resultado=$base->prepare($sql); //function prepare de php Prepara una sentencia SQL para su ejecución

    $resultado->execute(array(":log" => $login));
    while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        //echo 'Usuario: ' . $registro['usuarios'] . " contraseña: " .$registro['PASSWORD']. "<br>";  
        //devuelve true si las dos contraseñas son iguales, false si no son iguales.
        if(password_verify($password, $registro['PASSWORD'])){ //1 formulario y el hash
            $contador++;
        }

    }
    if($contador >0){
        echo "Usuario Registrado";
    }
 else {
         echo "Usuario no Registrado";
    }
  
  $resultado->closeCursor();
}catch(Exception $e){
     die('Error:'. $e->GetMessage());
}finally{
    $conectar=null;
}
?>

