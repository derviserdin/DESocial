<?php
session_start();

include_once 'db_con.php';
$connect = db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
require 'class.upload.php';

header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($connect, "utf8");
date_default_timezone_set('Asia/Kuwait');
$tarih = date("Y-m-d H:i:s");
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; //


    $islem = mysqli_real_escape_string($connect, $_POST['islem']);


    if ($islem == 'add') {
        if (isset($_FILES['resim'])) {
            $dosya_adi = $_FILES["resim"]["name"];
            $uzantir = substr($dosya_adi, -4, 4);
            $uretResim = array("res", "pic", "atr", "gds", "cgf");
            $sayi_tut_resim = rand(1, 10000000);
            $uzantiResim = $uretResim[rand(0, 4)] . $sayi_tut_resim . '.' . $uzantir;
            $handle = new upload($_FILES['resim']);
            if ($handle->uploaded) {


                $handle->process('../uploads/slider/');
                if ($handle->processed) {

                    $sql = "insert into slider (resim_url) VALUES ('$dosya_adi')";
                    $data = mysqli_query($connect, $sql);
                    if ($data == true) {
                        echo 'Resim Yükleme Tamam';
                    } else {
                        echo 'Bir sorun oluştu ! Lütfen yetkiliye haber verin';
                    }

                } else {
                    echo 'error : ' . $handle->error;
                }
            }

        } else {
            echo 'Lütfen REsim Ekleyiniz !';
        }

    } else if ($islem == 'delete') {
        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $sql = "delete from slider where resim_id='$id' ";
        $data = mysqli_query($connect, $sql);
        if ($data == true) {
            echo 'ok';
        } else {
            echo 'no';
        }

    } else {
        echo '0';
    }


} else {
    echo '0';
}

