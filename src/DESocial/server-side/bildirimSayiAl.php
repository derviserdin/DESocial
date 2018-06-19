<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
$db=db_con();
if(isset($_SESSION['user'])){

        $userId=$_SESSION['user'];
        $sql="select id from bildirimler where bildirim_giden_user='$userId' and okundu_bilgisi='0'";
        $dataSet=mysqli_query($db,$sql);
        $bildirimSayi= mysqli_num_rows($dataSet);


        if($bildirimSayi!=0){
            echo $bildirimSayi;
        }




}else{
    echo '0';
}

