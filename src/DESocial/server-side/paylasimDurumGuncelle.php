<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
$db = db_con();
if (isset($_SESSION['user'])) {

    if (isset($_POST['durum'])) {
        if (!empty($_POST['durum'])) {
            // Begenilen paylaşım id
            $durum = mysqli_real_escape_string($db, $_POST['durum']);
            $user = $_SESSION['user'];
            $sqlGetPaylasim = "update users set  user_pay_gizle='$durum' where user_id='$user' ";
            $sqlGetPaylasimData = mysqli_query($db, $sqlGetPaylasim);
            if ($sqlGetPaylasimData == true) {
                echo 'Değişiklikler kaydedildi. ';
            } else {
                echo 'Bir sorun oluştu';
            }
        } else {
            echo 'Boş veri gönderdiniz';
        }

    } else {
        echo 'Gönderilecek veri yok';
    }
} else {
    echo 'Üye Yok';
}

