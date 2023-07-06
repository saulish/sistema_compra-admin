<?php
require "../Funciones/conecta.php";
$con =conecta();
$nombre= $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock =$_REQUEST['stock'];


$archivo_n=$_FILES['archivo']['name'];
$archivo=$_FILES['archivo']['tmp_name'];


$cadena     = explode (".",$archivo_n);
$pos     =count ($cadena)-1;
$ext        =$cadena[$pos];
$dir        ="../files/";
$file_enc   =md5_file($archivo);
$passEnc = md5($pasw);

if($archivo_n!=''){//CREAR CARPETA LLAMADA ARCHIVOS
        $archivo_1 ="$file_enc.$ext";
        copy($archivo, $dir.$archivo_1);
    }



$sql= "INSERT INTO productos
       (nombre, codigo, descripcion, costo, stock , archivo_n,archivo)
        VALUES ('$nombre', '$codigo', '$descripcion', '$costo', $stock, '$archivo_n','$archivo_1')";
$res = $con->query($sql);

header("Location: productos_lista.php");
?>