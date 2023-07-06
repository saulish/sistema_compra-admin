<?php 
$cal =$_REQUEST['cal'];
$ban=0;

if($cal >=60){ 
    $ban=1;
} 
echo $ban;
?>