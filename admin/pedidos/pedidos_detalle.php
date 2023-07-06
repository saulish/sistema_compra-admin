<?php
session_start();
require "../Funciones/conecta.php";
$con =conecta();
if (!isset($_SESSION['nombre']) and $nombre=!""){
    
    header("Location:index.php");
}

$id = $_GET['id'];
$nombre =$_SESSION['nombre'];

$sql="SELECT * FROM pedidos_productos WHERE id_pedido =$id";
$res=$con->query($sql);


?>
<html>
    <head>
        <title>Lista pedidos</title>
        <script>
            
        </script>
        <style>
            .texto{
                color:black;
                font-size:20px;
                font-family:verdana;
            }
            #tabla{
                position:absolute;
                left:25%;
                top:10%;
                background-color:#8E44AD;
            }
            .td_tit{
                font-size:30px;
                text-align:Center;
                font-family: verdana;
            }
            .td{
                font-size:20px;
                text-align:Center;
                font-family: verdana;
            }
            #back{
                font-size:30px;
                color:red;
                font-family:arial black;
            }
        </style>
        <table border="3" div align="center" bgcolor="#AED6F1">
            <tr>
                <td class="texto"><a href="../bienvenida.php">Inicio</a></td>
                <td class="texto"><a href="../empleados/empleados_lista.php">Empleados</a></td>
                <td class="texto"><a href="../productos/productos_lista.php">Productos</a></td>
                <td class="texto"><a href="../banners/banners_lista.php">Banners</a></td>
                <td class="texto"><a href="lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="../salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #FFF5C3 10%, #9452A5 100%);">
        <div id="tabla">
            <table border=1>
                <tr>
                    <td class="td_tit">ID</td>
                    <td class="td_tit">ID PEDIDO</td>
                    <td class="td_tit">ID PRODUCTO</td>
                    <td class="td_tit">CANTIDAD</td>
                    <td class="td_tit">PRECIO</td>
                </tr>
                
            <?php

                while ($row = $res->fetch_array()){
                   $id_ped_prod    =$row["id"];
                    $id_ped       =$row["id_pedido"];       
                    $id_prod      =$row["id_producto"];              
                    $cant     =$row["cantidad"];
                    $precio  =$row["precio"];

                    echo"
                    <tr>
                    <td class=\"td\">$id_ped_prod</td>
                    <td class=\"td\"> $id </td>
                    <td class=\"td\"> $id_prod</td>
                    <td class=\"td\"> $cant </td>
                    <td class=\"td\"> $precio</td>
                    </tr>
                    ";

                }
               
            ?>
         
            </table>
            
        </div>
        <div id="back"><a href="lista_pedidos.php">VOLVER</a></div>
    </body>
</html>