<?php

    session_start();
    
    if (!isset($_SESSION['nombre'])){
        header("Location:../index.php");
    }
    $nombre =$_SESSION['nombre'];   

    require "../Funciones/conecta.php";
    $con =conecta();
    $id =$_REQUEST['id']; 
?>
<html>
    <head>
        <title>Banners detalle</title>
        <script src="../Funciones/ajax/jquery-3.3.1.min.js"></script>
        <script>

        </script>
        <style>
            #titulo{
                text-align:center;
                font-size:50px;
                font-family:arial black;
                color:red;
            }
            #regresar{
                text-align:right;
                font-size:40px;
                font-family: arials black;
                position: absolute;
                z-index: 1;
                bottom:0;
            }
            #fondo{
                position:absolute;
                float: left;
                background-color:white;
                margin:auto;
                text-align:center;
                width:35%;
                height:35%;
                left:5%;
            }
            #fondo_foto{
                position:absolute;
                background-color:white;
                text-align:center;
                width:50%;
                height:50%;
                
                float: right;
                right:5%;
            }
            .subtitulo{
                color:blue;
                font-size:30px;
                font-family:verdana;
            }
            .texto{
                color:black;
                font-size:20px;
                font-family:verdana;

            }
        </style>
                <table border="3" div align="center" bgcolor="#AED6F1">
            <tr>
            <td class="texto"><a href="../bienvenida.php">Inicio</a></td>
                <td class="texto"><a href="../empleados/empleados_lista.php">Empleados</a></td>
                <td class="texto"><a href="../productos/productos_lista.php">Productos</a></td>
                <td class="texto"><a href="banners_lista.php">Banners</a></td>
                <td class="texto"><a href="../pedidos/lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="../salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #FFA8A8 10%, #FCFF00 100%);">
    <div id="titulo"> DETALLE DE BANNERS</div>
        <?php
            $res    =$con->query("SELECT * FROM banners
            WHERE  id='$id' AND status = 1 AND eliminado =0");
            $row = $res->fetch_array();
                
                


            $id         =$row["id"];              
            $nombre     =$row["nombre"];
            $archivo    =$row["archivo"];
            
        ?>
        <div id="fondo">
        <?php 
        echo "<div class=\"subtitulo\">ID:</div> <br>";
        echo "<div class=\"texto\">$id</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Nombre:</div> <br>";
        echo "<div class=\"texto\">$nombre</div>";
        echo "<br>";        

        echo "</div>";

        ?>

        <div id="fondo_foto">
        <?php

                echo "<br>";
                echo "<div class=\"subtitulo\">Banner:</div><br>";
                echo "<div class=\"texto\">";

                echo "<img src=\"../files/$archivo\" width=50% height=50%> ";
                echo"</div>";
        ?>




        
        </div>
        <a href="banners_lista.php">
        <div id="regresar">REGRESA AL LISTADO</div>
        </a>
    </body>
</html>