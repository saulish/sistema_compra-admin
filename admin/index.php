<?php
session_start();

if (isset($_SESSION['nombre']) ){  
         if($name=$_SESSION['nombre']!=""){
            header("Location: bienvenida.php");
         }
        
    }
    

?>
<html>
    <head>
        <title>LOGIN</title>
        <script src="Funciones/ajax/jquery-3.3.1.min.js"></script>
        <style>
            #titulo{
                color:crimson;
                font-size: 70px;
                text-align: center;
            }
            .texto{
                color: black;
                font-size: 35px;
            }
            #msj{
                color:darkred;
                font-size: 40px;
            }
        </style>
        <script>
            function validacion(){

                var usuario=document.Forma01.usuario.value;
                var pasw=document.Forma01.pasw.value;
                var posicion=document.Forma01.opcion.value;
                var mensaje="Faltan datos por llenar";
                if (usuario!="" && pasw!=""&&posicion!="0"){
            
                     $.ajax({
                        url:     'empleados/valida_usuario.php', 
                        type:    'post',
                        dataType: 'text',
                        data:    'user='+usuario+'&pass='+pasw,
                        success: function(res){
                            if(res==1){
                                window.location.href="bienvenida.php";
                            }
                            else{
                                $('#msj').html('Usuario no valido');
                                setTimeout("$('#msj').html('');",3000);                              
                            }
                        },error: function(){
                            alert("error en el servidor...");
                        }
                     }) ;
                }
                else{
                    //$("#msj").hide();
                    $('#msj').html('Datos faltantes');
                    setTimeout("$('#msj').html('');",3000);
                    }                    
                
                 }
              
        </script>
    </head>

    <body style="background-image: linear-gradient( 135deg, #92FFC0 10%, #002661 100%);">
        <div align="center">
            <div id="titulo">LOGIN</div>
            <br>
            <form name="Forma01" method="post" action="bienvenida.php" >
                <div class="texto">Usuario: </div>
                <input type="text" name="usuario" placeholder="INGRESA TU USUARIO">
                <br>
                <div class="texto">Contrasenia:</div>
                <input type="password" name=pasw>
                <div class="texto">Posicion</div>
                <select name="opcion">
                    <option value="0" selected>Selecciona</option>
                    <option value="1">Gerente</option>
                    <option value="2">Ejecutivo</option>
                </select>
                <br><br>
                <input onclick="validacion();return false" type="submit">
            </form>
            <div id="msj"></div>
        </div>
    </body>
</html>