<?php
        require "../Funciones/conecta.php";
        $con =conecta();


            $codigo = $_REQUEST['codigo'];
            $id = $_REQUEST['id'];       
            $tx=    ($id>0)? "AND id != $id": '';   
            $sql    = "SELECT * FROM productos WHERE status = 1 AND eliminado =0 $tx";          
            $res    =$con->query($sql);
            $filas = $res->num_rows;
            $ban=0;
            while ($row = $res->fetch_array()){
                $codigo_base     =$row["codigo"];
                if($codigo==$codigo_base){
                    $ban=1;
                    break;
                }
            }
            echo $ban;
        
        ?>