<?php
session_start();

if (!isset($_SESSION['nombre'])){
    header("Location:../index.php");
}
$nombre_tbl =$_SESSION['nombre'];
?>
<html>
    <head>
        <title>Edicion de banners</title>
        <?php
        require "../Funciones/conecta.php";
        $con =conecta();
        $id =$_REQUEST['id'];
        

        $res    =$con->query("SELECT * FROM banners
        WHERE  id='$id' AND status = 1 AND eliminado =0");
        $row = $res->fetch_array();
                          
        $nombre     =$row["nombre"];
           
    ?>
        <script src="../Funciones/ajax/jquery-3.3.1.min.js"></script>
        <script>
            var id= <?php echo $id?>;
   
            function valida(){
                var nombre=document.datos.nombre.value;

                if (nombre==""){
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
                text-align:left;
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

    <body style="background-image: linear-gradient( 135deg, #FFF6B7 10%, #F6416C 100%);">
            <div id="titulo">EDICION DE BANNERS</div><br><br>
            <div class="subtitulos">Edita el campo que gustes:</div>
        <br>
        <br>
        <form name="datos" enctype="multipart/form-data" action="<?php echo "banners_actualiza.php?id=+$id" ?>" method="POST">
            <div class="subtitulos">
            INGRESA EL NOMBRE<br>
            <input type="text" name="nombre" value="<?=$nombre;?>" id="nombre"placeholder="Nombre"><br><br>
            INGRESA EL ARCHIVO<br><br>
            <input type="file" id="archivo" name="archivo"><br><br>
            <input onClick=" return valida();" type="submit" value="Enviar">
        </div>
        </form>
        <div id="mensaje"></div>
        <div id="lista"><a href= banners_lista.php?>| REGRESAR |</a></div>
    </body>
</html>

