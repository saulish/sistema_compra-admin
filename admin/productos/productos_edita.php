<?php
session_start();

if (!isset($_SESSION['nombre'])){
    header("Location:../index.php");
}
$nombre_tbl =$_SESSION['nombre'];
?>
<html>
    <head>
        <title>Edicion de productos
        </title>
        <?php
        require "../Funciones/conecta.php";
        $con =conecta();
        $id =$_REQUEST['id'];
        

        $res    =$con->query("SELECT * FROM productos
        WHERE  id='$id' AND status = 1 AND eliminado =0");
        $row = $res->fetch_array();
                          
        $nombre     =$row["nombre"];
        $codigo  =$row["codigo"];
        $descripcion     =$row["descripcion"];
        $costo     =$row["costo"];
        $stock     =$row["stock"];
          
    ?>
        <script src="Funciones/ajax/jquery-3.3.1.min.js"></script>
        <script>
            var id= <?php echo $id?>;
            var ban_correo;
            function valida_codigo(codigo) {
                $.ajax({
                        url: 'verifica_codigo.php?id='+id,
                        type    :'post',
                        dataType:'text',
                        data    :'codigo='+codigo,
                        success  :function(ban){
                            if(ban==1){
                                ban_codigo=1;
                                $('#mensaje').html('El codigo '+codigo+' ya existe');
                                setTimeout("$('#mensaje').html('');",5000);
                            }
                            if(ban==0){
                                ban_codigo=0;
                                $('#mensaje').html('');
                                setTimeout("$('#mensaje').html('');",5000);
                            }
                        }, error: function(){
                            alert('error archivo no encontrado');
                        }
                    })
            }
   
            function valida(){
                var nombre=document.datos.nombre.value;
                var codigo=document.datos.codigo.value;
                var descripcion=document.datos.descripcion.value;
                var costo=document.datos.costo.value;
                var stock=document.datos.stock.value;

                if (nombre=="" || codigo=="" || descripcion=="" || costo==0|| stock==0){
                    $('#mensaje').html('FALTAN DATOS POR LLENAR');
                    setTimeout("$('#mensaje').html('');",5000);
                    return false;
                }
                else if (ban_codigo==1){
                    $('#mensaje').html('EL CODIGO YA ESTA USADO');
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
                color:white;
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
                <td class="texto"><a href="productos_lista.php">Productos</a></td>
                <td class="texto"><a href="../banners/banners_lista.php">Banners</a></td>
                <td class="texto"><a href="../pedidos/lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="../salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #F05F57 10%, #360940 100%);">
            <div id="titulo">EDICION DE PRODUCTOS</div><br><br>
            <div class="subtitulos">Edita el campo que gustes:</div>
        <br>
        <br>
        <form name="datos" enctype="multipart/form-data" action="<?php echo "productos_actualiza.php?id=+$id" ?>" method="POST">
            <div class="subtitulos">
            INGRESA EL NOMBRE<br>          
            <input type="text" name="nombre" value="<?=$nombre;?>" id="nombre"placeholder="Nombre"><br><br>
            INGRESA EL CODIGO<br>
            <input  type="codigo" name="codigo"value="<?=$codigo;?>" id="codigo" onblur="valida_codigo(this.value);"placeholder="Codigo"><div id="codigo_conf"></div><br>
            INGRESA LA DESCRIPCION<br>
            <input type="text" name="descripcion"value="<?=$descripcion;?>"  id="descripcion"placeholder="Descripcion"><br><br>
            INGRESA EL COSTO<br>
            <input type="number" name="costo"value="<?=$costo;?>"  id="costo"placeholder="Costo"><br><br>
            INGRESA EL STOCK<br>
            <input type="number" name="stock" value="<?=$stock;?>" id="stock"placeholder="Stock"><br><br>

            <input type="file" id="archivo" name="archivo"><br><br>
            <input onClick=" return valida();" type="submit" value="Enviar">
        </div>
        </form>
        <div id="mensaje"></div>
        <div id="lista"><a href= productos_lista.php?>| REGRESAR |</a></div>
    </body>
</html>

