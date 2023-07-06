<?php
session_start();
require "../Funciones/conecta.php";
$con =conecta();
if (!isset($_SESSION['nombre']) and $nombre=!""){
    
    header("Location:index.php");
}
$nombre =$_SESSION['nombre'];
$sql="SELECT * FROM pedidos WHERE status =1";
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
                background-color:#EDBB99;
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
        </style>
            <table border="3" align="center" bgcolor="#AED6F1">
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

    <body style="background-image: linear-gradient( 135deg, #FFA8A8 10%, #FCFF00 100%);">
        <div id="tabla">
            <table border=1>
                <tr>
                    <td class="td_tit">PEDIDO ID</td>
                    <td class="td_tit">FECHA</td>
                    <td class="td_tit">ID_CLIENTE</td>
                    <td class="td_tit">DETALLES</td>
                </tr>
                
            <?php
                while ($row = $res->fetch_array()){
                    $id         =$row["id"];              
                    $fecha      =$row["fecha"];
                    $id_cliente  =$row["id_cliente"];

                    echo"
                    <tr>
                    <td class=\"td\">PEDIDO $id</td>
                    <td class=\"td\"> $fecha</td>
                    <td class=\"td\"> $id_cliente</td>
                    <td class=\"td\"> <a href=\"pedidos_detalle.php?id=+$id\" data-id=\"$id\">DETALLES</a></td>
                    </tr>
                    ";

                }
                echo "";
            ?>
            </table>
        </div>
    </body>
</html>