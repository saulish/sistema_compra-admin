<?php
        require "../Funciones/conecta.php";
        $con =conecta();


            $correo = $_REQUEST['correo'];
            $id = $_REQUEST['id'];       
            $tx=    ($id>0)? "AND id != $id": '';   
            $sql    = "SELECT * FROM empleados WHERE status = 1 AND eliminado =0 $tx";          
            $res    =$con->query($sql);
            $filas = $res->num_rows;
            $ban=0;
            while ($row = $res->fetch_array()){
                $correo_base     =$row["correo"];
                if($correo==$correo_base){
                    $ban=1;
                    break;
                }
            }
            echo $ban;
        
        ?>