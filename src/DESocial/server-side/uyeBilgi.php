<?php
header('Content-Type: text/plain; charset=utf-8');
include_once 'db_con.php';
$connect=db_con();
mysqli_set_charset($connect,"utf8");
if(isset($_GET['Id'])){
    if(isset($_GET['Id'])==''){
        echo '0';
    }else{
        $yorumlar=array();
        $id=mysqli_real_escape_string($connect,$_GET['Id']);
        $sql="select * from users where user_id='$id'";
        $dataSet=mysqli_query($connect,$sql);
        if($dataSet==true){
            while($yorum=mysqli_fetch_assoc($dataSet)){
                $yorumlar[]=$yorum;
            }
        }else{
            echo 'hata'.mysqli_error($connect);
        }




//json çıktısı ike işlşem tamamlanıyor
        echo json_encode($yorumlar);
    }
}else{
    echo '0';
}
?>