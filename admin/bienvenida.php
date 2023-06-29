<?php
session_start();
if (!isset($_SESSION['nombre']) and $nombre=!""){
    
    header("Location:index.php");
}
$nombre =$_SESSION['nombre'];

?>

<html>
    <head>
        <title>BIENVENIDO</title>
        
        <style>
            .texto{
                color:black;
                font-size:20px;
                font-family:verdana;
            }
            #titulo{
                font-size:50px;
                text-align:center;
                color:black;
                font-family:arial black;
            }

        </style>
        <table border="3" div align="center" bgcolor="#AED6F1">
            <tr>
            <td class="texto"><a href="bienvenida.php">Inicio</a></td>
                <td class="texto"><a href="empleados/empleados_lista.php">Empleados</a></td>
                <td class="texto"><a href="productos/productos_lista.php">Productos</a></td>
                <td class="texto"><a href="banners/banners_lista.php">Banners</a></td>
                <td class="texto"><a href="pedidos/lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #52E5E7 10%, #130CB7 100%);">
    <br>
        <div id="titulo">Bienvenido al sistema de administracion!!</div>

    </body>
</html>