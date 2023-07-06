<?php
require "../Funciones/conecta.php";
$con =conecta();

$id =$_REQUEST['id']; 
$nombre= $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock =$_REQUEST['stock'];


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
$sql = "UPDATE productos SET nombre='$nombre', codigo='$codigo', descripcion='$descripcion', costo='$costo',stock='$stock'WHERE id='$id'";

if($archivo_n !=""){
    $sql = "UPDATE productos SET nombre='$nombre', codigo='$codigo', descripcion='$descripcion', costo='$costo',stock='$stock', archivo_n ='$archivo_n', archivo='$archivo_1' WHERE id='$id'";
}

$res = $con->query($sql);
header("Location: productos_lista.php"); 
?>