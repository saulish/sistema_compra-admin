<?php
session_start();
require "../Funciones/conecta.php";
$con =conecta();
 
$ban=0;
$mail = $_REQUEST['user'];
$pasw = $_REQUEST['pass'];
$paswenc =md5($pasw);

$sql    = "SELECT * FROM empleados
           WHERE correo = '$mail' AND pass= '$paswenc' AND status = 1 AND eliminado =0";       
$ban=0;
$res=$con->query($sql);
$num=$res->num_rows;
if ($num==1){
    $row=$res->fetch_assoc();
    $idU=$row["id"];
    $nombre=$row["nombre"].' '.$apellidos=$row["apellidos"];
    $correo=$row["correo"];
    $_SESSION['idU']=$idU;
    $_SESSION['nombre']= $nombre;
    $_SESSION['correo']= $correo;
    $ban=1;
}


echo $ban;


?>