<?php 
if (isset($_REQUEST['cal'])) {
$cal =$_REQUEST['cal'];
$ban=0;

if($cal >=60){ 
    $ban=1;
} 
echo $ban;
}
?>
<html>
    <head>
        <title>Prueba ajax</title>
        <style>
            #mensaje{
                color:#F00;
            }
        </style> 
        <script src="jquery-3.3.1.min.js"></script>
        <script>
            function ejecutarAjax(){
                var cal= $('#calificacion').val();
                if(cal){
                    $.ajax({
                        url     :'idk.php',
                        type    :'post',
                        dataType:'text',
                        data    :'cal='+cal,
                        success  :function(res){//MAS BIEN TRATA SOBRE QUE SALIO BIEN LA CONEXION
                            if(res==1){
                                $('#mensaje').html('Aprobaste');
                            }else{
                                $('#mensaje').html('Reprobaste');
                            }
                            setTimeout("$('mensaje').html('');",8000);

                            //ENCONTRO EL ARCHIVO Y PUEDE LEER UNA POSIBLE RESPUESTA
                            //QUE FUE enviada desde el archivo
                        }, error: function(){
                            alert('error archivo no encontrado');
                        }
                    })




                    //$('#mensaje').html('Campo lleno');
                    //setTimeout("$('#mensaje').html('');",5000);
                } else{
                    $('#mensaje').html('Llena el campo');
                    setTimeout("$('#mensaje').html('');",5000);

                }
            }
            function dentroFoco(){
                $('#mensaje').html('Acabas de dar click DENTRO del campo');
                setTimeout("$('#mensaje').html('');",8000);
            }
            function fueraFoco(){
                $('#mensaje').html('Acabas de dar click FUERA del campo');
                setTimeout("$('#mensaje').html('');",8000);
            }
        </script>
    </head>

    <body>
        <input onfocus="dentroFoco();" onblur="fueraFoco();" type="text" name="calificacion" id="calificacion" placeholder="Escribe un numero"/>
        <a href="javascript:void(0);"onclick="ejecutarAjax();">
            click para calificar</a>
    <br><br>
    <div id= "mensaje"></div>
    </body>
</html>