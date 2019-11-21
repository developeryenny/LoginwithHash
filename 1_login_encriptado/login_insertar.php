<?php
    $login=$_POST["login"];
    $password= $_POST["password"];
    $pass_cifra= password_hash($password, PASSWORD_DEFAULT);//TE ENCRIPTA EL PASSWORD
try {
    $base= new PDO("mysql:host=localhost; dbname=login", "root", "");
    //PDO::ATTR_ERRMODE: Reporte de errores.
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
    $sql = "INSERT INTO usuarios_login (usuarios, PASSWORD) VALUES (:log, :pass)";
    $resultado=$base->prepare($sql); //function prepare de php Prepara una sentencia SQL para su ejecución

    $resultado->execute(array(":log" => $login, ":pass"=> $pass_cifra));
    echo "Registro insertado";
  $resultado->closeCursor();
}catch(Exception $e){
     die('Error:'. $e->GetMessage());
}finally{
    $conectar=null;
}
?>

