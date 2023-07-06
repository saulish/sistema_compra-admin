<?php
require "../Funciones/conecta.php";
$con =conecta();
$nombre= $_REQUEST['nombre'];
$archivo_n=$_FILES['archivo']['name'];
$archivo=$_FILES['archivo']['tmp_name'];


$cadena     = explode (".",$archivo_n);
$pos     =count ($cadena)-1;
$ext        =$cadena[$pos];
$dir        ="../files/";
$file_enc   =md5_file($archivo);

if($archivo_n!=''){
        $archivo_1 ="$file_enc.$ext";
        copy($archivo, $dir.$archivo_1);
    }



$sql= "INSERT INTO banners
       (nombre,archivo)
        VALUES ('$nombre','$archivo_1')";
$res = $con->query($sql);

header("Location: banners_lista.php");
?>