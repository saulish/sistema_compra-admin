<?php
require "../Funciones/conecta.php";
$con =conecta();

$id =$_REQUEST['id']; 
$nombre= $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pasw = $_REQUEST['pasw'];
$rol =$_REQUEST['rol'];


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

 


if ($pasw!="" && $archivo_n!=""){
    $passEnc = md5($pasw);
    $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol', archivo_n ='$archivo_n', archivo='$archivo_1' pass='$passEnc' WHERE id='$id'";
}
else if($pasw !=""){
        $passEnc = md5($pasw);
        $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol', pass='$passEnc' WHERE id='$id'";
}
else if($archivo_n !=""){
    $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol', archivo_n ='$archivo_n', archivo='$archivo_1' WHERE id='$id'";
}
else{
    $passEnc = md5($pasw);
    $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol' WHERE id='$id'";

}
$res = $con->query($sql);
header("Location: empleados_lista.php"); 
?>