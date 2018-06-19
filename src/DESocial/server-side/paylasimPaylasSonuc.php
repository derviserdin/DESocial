<?php
session_start();

include_once 'db_con.php';
$connect=db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($connect,"utf8");
date_default_timezone_set('Asia/Kuwait');
$tarih= date("Y-m-d H:i:s");
if(isset($_SESSION['user'])){
    $user=$_SESSION['user']; // şuan için oturum kontrolü yapamıyorum
    if(isset($_POST['payId'])){
        $text=mysqli_real_escape_string($connect,$_POST['text']);
        $payId=mysqli_real_escape_string($connect,$_POST['payId']);
        //link için harf rakam karışımı uzantı üretelim

        $urett=array("asd","fgh","jkl","lşi","ıop");
        $sayi_tut=rand(1,10000000);
        $uzanti=$urett[rand(0,4)].$sayi_tut;
        $sql="insert into paylasim (user_id,paylasim_icerik,paylasim_url,paylasim_sahibi,paylasim_tarihi,paylasim_guncelleme_tarihi)
                  VALUES ('$user','$text','$uzanti','$payId','$tarih','$tarih')";
        $dataSet=mysqli_query($connect,$sql);
        if ($dataSet) {
            $id=mysqli_insert_id($connect);
            echo paylasimSonuc($id);
            paylasimSayiArttir($payId);
        }else{
            echo 'Bir Sorun Oluştu';
        }

    }else{
        echo '0';
    }




}else{
    echo '0';
}
