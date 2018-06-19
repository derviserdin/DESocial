<?php

include_once 'db_con.php';
if(isset($_GET['term']) || !empty($_GET['term'])){

    $db = db_con();
    $ad = mysqli_real_escape_string($db,$_GET['term']);


    $sql = "select * from users where username LIKE '%$ad%'";
    $dataq=mysqli_query($db,$sql);
    if($dataq==true) {
        $data = Array();
        while ($row = mysqli_fetch_assoc($dataq)) {

            $data = array(

                'username' => $row['username'],

            );
        }
        echo json_encode($data);
    }else{
        echo 'hata'.mysqli_error($db);
    }
}else{
    echo '0';
}