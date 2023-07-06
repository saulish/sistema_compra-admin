<?php
session_start();

if (!isset($_SESSION['nombre'])){
    header("Location:../index.php");
}
$nombre =$_SESSION['nombre'];
?>
<html>
    <head>
        <title>Alta de empleados</title>
        <?php
        require "../Funciones/conecta.php";
        $con =conecta();
        ?>

        <script src="../Funciones/ajax/jquery-3.3.1.min.js"></script>
        <script>
   
            function valida(){
                var nombre=document.datos.nombre.value;
 
                var archivo=document.datos.archivo.value;
                if (nombre=="" ||  archivo==""){
                    $('#mensaje').html('FALTAN DATOS POR LLENAR');
                    setTimeout("$('#mensaje').html('');",5000);
                    return false;
                }
                return true;
            }   
        </script>
        <style>
            #lista{
                color:red;
                text-align:right;
                font-size:30px;
            }
            #titulo{
                color:black;
                text-align:center;
                font-size:50px;
                font-family:arial black;
            }
            .subtitulos{
                color:black;
                text-align:center;
                font-size:20px;
                font-family:arial black           
            }
            #correo_conf{
               position:relative;
                color:red;
            }
            #mensaje{
                text-align:center;
                color:red;
                font-family:arial black;
                font-size:30px;
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

    <body style="background-image: linear-gradient( 135deg, #81FFEF 10%, #F067B4 100%);">
            <div id="titulo">ALTA DE BANNERS</div><br><br>
            <div class="subtitulos">Llena los siguientes datos:</div>
        <br>
        <br>
        <form enctype="multipart/form-data" name="datos" action="banners_salva.php" method="POST">
            <div class="subtitulos">
            INGRESA EL NOMBRE<br>
            <input type="text" name="nombre" id="nombre"placeholder="Nombre"><br><br>
            INGRESA TU BANNER<BR><BR>
            <input type="file" id="archivo" name="archivo"><br><br>
            <input onClick=" return valida();" type="submit" value="Enviar">
        </div>
        </form>
        <div id="mensaje"></div>
    <div id="lista"><a href= banners_lista.php?>| REGRESAR A LA LISTA|</a></div>
    </body>
</html>

