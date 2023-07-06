<?php
        require "../Funciones/conecta.php";
        $con =conecta();


            $codigo = $_REQUEST['codigo'];          
            $sql    = "SELECT * FROM productos WHERE status = 1 AND eliminado =0";          
            $res    =$con->query($sql);
            $filas = $res->num_rows;
            $ban=0;
            while ($row = $res->fetch_array()){
                $codigo_en_base     =$row["codigo"];
                if($codigo==$codigo_en_base){
                    $ban=1;
                    break;
                }
            }
            echo $ban;
        
        ?>