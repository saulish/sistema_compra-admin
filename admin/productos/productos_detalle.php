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
        <title>Productos detalle</title>
        <script src="../Funciones/ajax/jquery-3.3.1.min.js"></script>
        <script>

        </script>
        <style>
            #titulo{
                text-align:center;
                font-size:50px;
                font-family:arial black;
                color:black;
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
                height:80%;
                left:30%;
            }
            #fondo_foto{
       
                background-color:white;
                text-align:center;
                width:25%;
                height:50%;
                float: right;

            }
            .subtitulo{
                color:blue;
                font-size:20px;
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
            <td class="texto"><a href="bienvenida.php">Inicio</a></td>
                <td class="texto"><a href="../empleados/empleados_lista.php">Empleados</a></td>
                <td class="texto"><a href="productos_lista.php">Productos</a></td>
                <td class="texto"><a href="../banners/banners_lista.php">Banners</a></td>
                <td class="texto"><a href="../pedidos/lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="../salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #FDD819 10%, #E80505 100%);">
    <div id="titulo"> DETALLE DE PRODUCTOS</div>
        <?php
            $res    =$con->query("SELECT * FROM productos
            WHERE  id='$id' AND status = 1 AND eliminado =0");
            $row = $res->fetch_array();
                
                


            $id         =$row["id"];              
            $nombre     =$row["nombre"];
            $codigo     =$row["codigo"];
            $descripcion     =$row["descripcion"];          
            $costo     =$row["costo"];
            $stock     =$row["stock"];
            $archivo_n  =$row["archivo_n"];
            $archivo    =$row["archivo"];
           $status     =$row["eliminado"];
           $estatus;
           switch($status){
            case'0':$estatus="Activo";
            break;
            case'1': $estatus="Inactivo";
        } 
        ?>
        <div id="fondo">
        <?php
        echo "<div class=\"subtitulo\">ID:</div> <br>";
        echo "<div class=\"texto\">$id</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Nombre:</div> <br>";
        echo "<div class=\"texto\">$nombre</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Codigo:</div> <br>";
        echo "<div class=\"texto\">$codigo</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Descripcion:</div> <br>";
        echo "<div class=\"texto\">$descripcion</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Costo:</div> <br>";
        echo "<div class=\"texto\">$costo</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Stock:</div> <br>";
        echo "<div class=\"texto\">$stock</div>";
        echo "<br>";
        echo "<div class=\"subtitulo\">Status:</div><br>";
        echo "<div class=\"texto\">$estatus</div>";
        echo "<br>";          

        echo "</div>";

        ?>

        <div id="fondo_foto">
        <?php
                echo "<div class=\"subtitulo\">Nombre de la imagen:</div><br>";
                echo "<div class=\"texto\">";
                if($archivo_n==""){
                    echo "No hay imagen disponible";
                }
                else{
                    echo $archivo_n;
                }
                echo"</div>";
                echo "<br>";
                echo "<div class=\"subtitulo\">Imagen:</div><br>";
                echo "<div class=\"texto\">";
                if($archivo==""){
                    echo "No hay imagen disponible";
                }
                else{
                    echo "<img src=\"../files/$archivo\" width=50% height=50%> ";
                }
                echo"</div>";
        ?>




        
        </div>
        <a href="productos_lista.php">
        <div id="regresar">REGRESA AL LISTADO</div>
        </a>
    </body>
</html>