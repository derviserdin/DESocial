<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
//veri tabanı sınıfı
$db = db_con();
//oturum varmı yokmu kontrol
if (isset($_SESSION['user'])) {
    //oturum varise post method kontrol
    if (isset($_POST['durum'])) {
        //post method boş mu değil mi kontrol
        if (!empty($_POST['durum'])) {
            // Begenilen paylaşım id
            //post verilerini değişkene atama
            $durum = mysqli_real_escape_string($db, $_POST['durum']);
            //oturum kullanıcısını bul
            $user = $_SESSION['user'];
            //sorguyu yaz
            $sqlGetPaylasim = "update users set  user_mesaj_durum='$durum' where user_id='$user' ";
            //sql sorgusu değişkene aktarıldı
            $sqlGetPaylasimData = mysqli_query($db, $sqlGetPaylasim);
            //// altta true eşitse denks yapmana gerek yok direk ismi yazdıgında true ise diye dönüyo
            // ben öyle alışmıuşım yav biliyom
            //normalde double değişken öyle konrol ediliyor
            if ($sqlGetPaylasimData) {
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

