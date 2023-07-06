<?php
require "../Funciones/conecta.php";
$con =conecta();
$ban;


//$sql    = "DELETE FROM empleados WHERE id=$id"; NO TOCAR A MENOS QUE SEAS EL INGENIRO O EL BECARIO
$sql= "UPDATE empleados SET eliminado =0 ";    
$con ->query($sql);
$ban=1;



echo $ban;
exit;
header("Location: empleados_lista.php");


?>