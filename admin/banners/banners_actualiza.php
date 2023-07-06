<?php
require "../Funciones/conecta.php";
$con =conecta();

$id =$_REQUEST['id']; 
$nombre= $_REQUEST['nombre'];


$archivo_n=$_FILES['archivo']['name'];
$archivo=$_FILES['archivo']['tmp_name'];




if($archivo_n!=''){//CREAR CARPETA LLAMADA ARCHIVOS
        $cadena     = explode (".",$archivo_n);
        $pos     =count ($cadena)-1;
        $ext        =$cadena[$pos];
        $dir        ="../files/";
        $file_enc   =md5_file($archivo);

        $archivo_1 ="$file_enc.$ext";
        copy($archivo, $dir.$archivo_1);
    }

 


if($archivo_n !=""){
    $sql = "UPDATE banners SET nombre='$nombre', archivo='$archivo_1' WHERE id='$id'";
}
else{
    $sql = "UPDATE banners SET nombre='$nombre' WHERE id='$id'";

}
$res = $con->query($sql);
header("Location: banners_lista.php"); 
?>