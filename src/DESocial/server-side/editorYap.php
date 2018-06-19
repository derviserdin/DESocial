<?php

include_once 'db_con.php';
if(isset($_POST['term']) || !empty($_POST['term'])){

    $db = db_con();
    $ad = mysqli_real_escape_string($db,$_POST['term']);


    $sql = "select * from users where user_id='$ad'";
    $dataq=mysqli_query($db,$sql);
    if($dataq==true) {
        if(mysqli_num_rows($dataq)>0){
            $sqlUp="update users set user_type='editor' where user_id='$ad'";
            $dataset=mysqli_query($db,$sqlUp);
            if($dataset==true){
                echo 'ok';
            }else{
                echo 'hata'.mysqli_error($db);
            }
        }

    }else{
        echo 'hata'.mysqli_error($db);
    }
}else{
    echo '0';
}