<?php
require "../Funciones/conecta.php";
$con =conecta();
$ban;
$id =$_REQUEST['id']; 

//$sql    = "DELETE FROM empleados WHERE id=$id"; NO TOCAR A MENOS QUE SEAS EL INGENIRO O EL BECARIO
$sql= "UPDATE productos SET eliminado =1 WHERE id =$id";    
$con ->query($sql);
$ban=1;



echo $ban;
exit;
header("Location: productos_lista.php");


?>