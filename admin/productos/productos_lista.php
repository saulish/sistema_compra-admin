<?php
session_start();

if (!isset($_SESSION['nombre'])){
    header("Location:../index.php");
}
$nombre =$_SESSION['nombre'];
?>

<html>
    <head>
        <title>Lista de productos</title>
        <script src="../Funciones\ajax\jquery-3.3.1.min.js"></script>
        <script>
            function confirmacion(id){
                var conf= confirm("Deseas eliminar este producto?");
                if(conf==true){
                    $.ajax({
                        url: 'productos_elimina.php?id='+id,
                        type    :'post',
                        dataType:'text',
                        data    :'id='+id,
                        success  :function(ban){//MAS BIEN TRATA SOBRE QUE SALIO BIEN LA CONEXION
                            if(ban==1){
                               eliminar(id); 
                            }
                            else{
                                alert("Algo salio mal");
                            }
                            
                            //ENCONTRO EL ARCHIVO Y PUEDE LEER UNA POSIBLE RESPUESTA
                            //QUE FUE enviada desde el archivo
                        }, error: function(){
                            alert('error archivo no encontrado');
                        }
                    })

                }
            }/*
            function alta(){
                $.ajax({
                        url: 'todos_alta.php?',
                        type    :'post',
                        dataType:'text',
                        data    :0,
                        success  :function(ban){//MAS BIEN TRATA SOBRE QUE SALIO BIEN LA CONEXION
                            alert("listo");
                            
                            
                            //ENCONTRO EL ARCHIVO Y PUEDE LEER UNA POSIBLE RESPUESTA
                            //QUE FUE enviada desde el archivo
                        }, error: function(){
                            alert('error archivo no encontrado');
                        }
                    })
            }*/
            function eliminar(id){               
                $("#fila_"+id).hide();

                //setTimeout("$().html('');",5000);
                mensaje(id);

            }
            function mensaje(id){
                $('#mensaje').html('Acabas de eliminar el id: '+id);
                setTimeout("$('#mensaje').html('');",2000);
            }
        </script>
        <style>
            
            #titulo{
                text-align:center;
                font-size: 50px;
                color:black;
                font-family:arial, sans-serif;
            }
            #nuevo_registro{

                background-image: linear-gradient( 135deg, #FEC163 10%, #DE4313 100%);
                text-align:center;
                font-size: 30px;
                color:blue;
                font-family:arial, sans-serif;

            }
            #tabla{
                font-size:30px;
                margin: 0 auto;
                display: table;
                border:3px solid;            
                text-align: center;
                width:95%;
                background-color:white;

            }
            .fila{
                display:table-row;
            }
            .fila_titulo{
                background-image: linear-gradient( 135deg, #3B2667 10%, #BC78EC 100%);
                color:white;
                display:table-row;
            }
            .columna{
                border:1px solid;
                border-color:black;
                position:relative;
                display:table-cell;
                
            }
            #mensaje{
                text-align:center;
                background-color:white;
                
                color:red;
                font-size:30px;
                font-family:Arial;
            }
            #return{
                position:absolute;
                font-size:50px;
                text-align:left;
                bottom:10%;
                color:crimson;
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
                <td class="texto"><a href="productos_lista.php">Productos</a></td>
                <td class="texto"><a href="../banners/banners_lista.php">Banners</a></td>
                <td class="texto"><a href="../pedidos/lista_pedidos.php">Pedidos</a></td>
                <td class="texto">Bienvenido <?php echo $nombre; ?></td>
                <td class="texto"><a href="../salir.php">Cerrar sesion</a></td>
            </tr>
        </table>
    </head>

    <body style="background-image: linear-gradient( 135deg, #FFD26F 10%, #3677FF 100%);">
        <?php
            require "../Funciones/conecta.php";
            $con =conecta();


            $sql    = "SELECT * FROM productos
                    WHERE status = 1 AND eliminado =0";          
            $res    =$con->query("SELECT * FROM productos
            WHERE status = 1 AND eliminado =0");
            $filas = $res->num_rows;


            echo "<div id= \"titulo\">Listado de productos</div> <br>";
            echo " <a href= \"productos_nuevo.php? 
            \" <span id=\"nuevo_registro\">Nuevo producto</span>  </a><br>";
             echo"<br><div id=\"tabla\">
                <div class= \"fila_titulo\">
                    <div class= \"columna\">ID</div>
                    <div class= \"columna\">Nombre</div>
                    <div class= \"columna\">Codigo</div>
                    <div class= \"columna\">Costo</div>
                    <div class= \"columna\">Stock</div>
                    <div class= \"columna\"></div>
                    <div class= \"columna\"></div>
                    <div class= \"columna\"></div>
                </div>";


            while ($row = $res->fetch_array()){
                
                


                $id         =$row["id"];              
                $nombre     =$row["nombre"];
                $codigo  =$row["codigo"];
                $costo     =$row["costo"];
                $stock        =$row["stock"];
                echo "<div id=\"fila_$id\"class= \"fila\">";
                echo "<div class= \"columna\">$id</div>
                <div class= \"columna\">$nombre </div>
                <div class= \"columna\">$codigo</div>
                <div class= \"columna\">$costo </div>
                <div class= \"columna\">$stock </div>             
                <div class= \"columna\">|<a href= \"productos_detalle.php?id=+$id\" data-id=\"$id\" >Ver detalles</a><br></div>
                <div class= \"columna\">|<a href= \"productos_edita.php?id=+$id\" data-id=\"$id\" >Editar</a><br></div>
                <div class= \"columna\">|<a href= \"javascript:confirmacion($id)\"  class=\"idr\" data-id=\"$id\" >Eliminar</a><br></div>";
             echo "</div> ";   
             
            }
            
            
            echo "</div><br>";
            echo "<div align=\"center\" id=\"mensaje\"></div><br><br>";
            //echo "<button onclick=\"javascript:alta()\"  align =\"center\"id=\"alta\">ALTA</button>";
            
        ?>
                <div id="return"><a href="../bienvenida.php">REGRESAR</a></div>
    </body>
</html>
