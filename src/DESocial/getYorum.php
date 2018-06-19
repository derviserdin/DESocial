<?php
include_once ('durumKontrol.php');
include_once ('db_con.php');
include_once ('fonksiyon.php');
header('Content-Type: text/plain; charset=utf-8');
$connect=db_con();
if(isset($_GET['yorumId'])){
    if(isset($_GET['yorumId'])==''){
        echo '0';
    }else{





    }
}else{
    echo '0';
}
?>