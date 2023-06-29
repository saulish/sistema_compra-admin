<?php
session_start();

if (!isset($_SESSION['nombre'])){
    header("Location:../index.php");
}
$nombre_tbl =$_SESSION['nombre'];
?>
<html>
    <head>
        <title>Edicion de empleados</title>
        <?php
        require "../Funciones/conecta.php";
        $con =conecta();
        $id =$_REQUEST['id'];
        

        $res    =$con->query("SELECT * FROM empleados
        WHERE  id='$id' AND status = 1 AND eliminado =0");
        $row = $res->fetch_array();
                          
        $nombre     =$row["nombre"];
        $apellidos  =$row["apellidos"];
        $correo     =$row["correo"];
        $rol     =$row["rol"];
        $status     =$row["eliminado"];
        $estatus="";
        switch($status){
            case'0':$estatus="Activo";
            break;
            case'1': $estatus="Inactivo";
        }             
    ?>
        <script src="../Funciones/ajax/jquery-3.3.1.min.js"></script>
        <script>
            var id= <?php echo $id?>;
            var ban_correo;
            function valida_correo(correo) {
                $.ajax({
                        url: 'verifica_correo.php?id='+id,
                        type    :'post',
                        dataType:'text',
                        data    :'correo='+correo,
                        success  :function(ban){
                            if(ban==1){
                                ban_correo=1;
                                $('#correo_conf').html('El correo '+correo+' ya existe');
                                setTimeout("$('#correo_conf').html('');",5000);
                            }
                            if(ban==0){
                                ban_correo=0;
                                $('#correo_conf').html('');
                                setTimeout("$('#correo_conf').html('');",5000);
                            }
                        }, error: function(){
                            alert('error archivo no encontrado');
                        }
                    })
            }
   
            function valida(){
                var nombre=document.datos.nombre.value;
                var apellidos=document.datos.apellidos.value;
                var correo=document.datos.correo.value;
                var pasw=document.datos.pasw.value;
                var rol=document.datos.rol.value;
                if (nombre=="" || apellidos=="" || correo=="" || rol==0){
                    $('#mensaje').html('FALTAN DATOS POR LLENAR');
                    setTimeout("$('#mensaje').html('');",5000);
                    return false;
                }
                else if (ban_correo==1){
                    $('#mensaje').html('EL CORREO YA ESTA USADO');
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
                <td class="texto"><a href="empleados_lista.php">Empleados</a></td>
                <td class="texto"><a href="../productos/productos_lista.php">Productos</a></td>
                <td class="texto"><a href="../banners/banners_lista.php">Banners</a></td>
                <td class="texto"><a href="../pedidos/lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="../salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #F05F57 10%, #360940 100%);">
            <div id="titulo">EDICION DE EMPLEADOS</div><br><br>
            <div class="subtitulos">Edita el campo que gustes:</div>
        <br>
        <br>
        <form name="datos" enctype="multipart/form-data" action="<?php echo "empleados_actualiza.php?id=+$id" ?>" method="POST">
            <div class="subtitulos">
            INGRESA TU NOMBRE<br>
            <input type="text" name="nombre" value="<?=$nombre;?>" id="nombre"placeholder="Nombre"><br><br>
            INGRESA TUS APELLIDOS<br>
            <input type="text" name="apellidos"value="<?=$apellidos;?>"  id="apellidos"placeholder="apellidos"><br><br>
            INGRESA TU CORREO<br>
            <input  type="email" name="correo"value="<?=$correo;?>" id="correo" onblur="valida_correo(this.value);"placeholder="Correo"><div id="correo_conf"></div><br>
            Ingresa tu contraseña<br>
            <input type="password" name="pasw" id="pasw"placeholder="Contraseña"><br><br>
            Selecciona tu rol<br>
            <select name="rol">
            <option value="0" >Selecciona</option>
            <option value="1" <?php if ($rol==1) echo 'selected'; ?>>Gerente</option>
            <option value="2"<?php if ($rol==2) echo 'selected'; ?>>Ejectutivo</option>
            </select><br><br>
            <input type="file" id="archivo" name="archivo"><br><br>
            <input onClick=" return valida();" type="submit" value="Enviar">
        </div>
        </form>
        <div id="mensaje"></div>
        <div id="lista"><a href= empleados_lista.php?>| REGRESAR |</a></div>
    </body>
</html>

