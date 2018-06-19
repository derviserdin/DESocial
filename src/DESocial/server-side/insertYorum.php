<?php
include_once 'durumKontrol.php';

include_once 'db_con.php';
$connect=db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($connect,"utf8");
$user=$_SESSION['user']; // şuan için oturum kontrolü yapamıyorum

date_default_timezone_set('Asia/Kuwait');
$tarih= date("Y-m-d H:i:s");



if(isset($_POST['payId'])){
    $payId=mysqli_real_escape_string($connect,$_POST['payId']);
    if (isset($_POST['name'])  || isset($_FILES['resim'])){
        $icerik=mysqli_real_escape_string($connect,$_POST['name']);
        //link için harf rakam karışımı uzantı üretelim

        $urett=array("asd","fgh","jkl","lşi","ıop");
        $sayi_tut=rand(1,10000000);
        $uzanti=$urett[rand(0,4)].$sayi_tut;

//Resim için harf rakam karışımı uzantı üretelim
        if ( isset($_FILES['resim'])){
            $dosya_adi=$_FILES["resim"]["name"];
            $uzantir=substr($dosya_adi,-4,4);
            $uretResim=array("res","pic","atr","gds","cgf");
            $sayi_tut_resim=rand(1,10000000);
            $uzantiResim=$uretResim[rand(0,4)].$sayi_tut_resim.$uzantir;


        }

        // Sadece  Yazı paylaşımı var ise
        if(isset($_POST['name'])  and !isset($_FILES['resim']) ){


         if(empty($_POST['name'])){
            echo 'boş';
         }else{
             $eklePaylasim="insert into paylasim_yorum (paylasim_id,paylasim_yorum_user,yorum_icerik,yorum_tarih)
                        VALUES ('$payId','$user','$icerik','$tarih')";
             $dataSet=mysqli_query($connect,$eklePaylasim);
             if($dataSet==true){
                 $id=mysqli_insert_id($connect);
                 echo paylasimYorum($id);
                 echo paylasimYorumArttir($id);
             }else{
                 echo 'hata'.mysqli_error($connect);
             }
         }
            //sadece Resim paylaşımı var ise
        }else if(isset($_FILES['resim']) and !isset($_POST['name'])){
            if($_FILES["resim"]["size"]<2024*2024){//boyut kontrol
                if ($_FILES["resim"]["type"]=="image/png"
                    || $_FILES["resim"]["type"]=="image/jpg"
                    || $_FILES["resim"]["type"]=="image/jpeg"
                    ) {/// eğere resim dosya tipi  uygun ise

                    $eklePaylasim="insert into paylasim_yorum (paylasim_id,paylasim_yorum_user,yorum_resim_id,yorum_tarih) 
                        VALUES ('$payId','$user','$uzanti','$uzantiResim','$tarih')";
                    $dataSet=mysqli_query($connect,$eklePaylasim);
                    if($dataSet==true){

                        //////////////////////////////////////////////////
                        //   Resim Yükleme Alanı
                        /////////////////////////////////////////////////
                          $tmp=$_FILES['resim']['tmp_name'];
                          $name=$_FILES['resim']['name'];
                         $size=$_FILES['resim']['size'];

                         $target_dir = "../uploads/paylasim/".$uzantiResim;
                        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $name)) {
                            $dosya="../uploads/paylasim/".$uzantiResim;
                            //resimden istediğimiz verileri list şeklinde alalım
                            list($mevcutGenislik,$mevcutYukseklik)=getimagesize($name);
                            $katSayi=0.5;
                            $yukseklik=$katSayi*$mevcutYukseklik;
                            $genislik=$katSayi*$mevcutGenislik;
                            $hedef=imagecreatetruecolor($genislik,$yukseklik);
                            if($_FILES["resim"]["type"]=="image/jpeg"){
                                $kaynak=imagecreatefromjpeg($name);
                                imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                                $yeniResim= "../uploads/paylasim/".$uzantiResim;
                                imagejpeg($hedef,$yeniResim,9);
                            }else if($_FILES["resim"]["type"]=="image/png"){
                                $kaynak=imagecreatefrompng($name);
                                imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                                $yeniResim= "../uploads/paylasim/".$uzantiResim;
                                imagepng($hedef,$yeniResim,9);
                            }
                            imagedestroy($hedef);
                            unlink($name);

                        }
                        /////////////////////////////////////////////////

                        $id=mysqli_insert_id($connect);
                        echo paylasimYorum($id);
                        echo paylasimYorumArttir($id);
                    }else{
                        echo 'hata'.mysqli_error($connect);
                    }


                }else{
                    echo 'sadece PNG , JPG , JPEG , GİF  formatında dosya yükleye bilirsiniz';
                }
            }else{
                echo 'Resim 2 MB  geçemez ';
            }
            //eğer resim ve  yazı birlikte ise
        }else if (isset($_FILES['resim']) and isset($_POST['name'])){


            $eklePaylasim="insert into paylasim_yorum (paylasim_id,paylasim_yorum_user,yorum_icerik,yorum_resim_id,yorum_tarih) 
                        VALUES ('$payId','$user','$icerik','$uzantiResim','$tarih')";
            $dataSet=mysqli_query($connect,$eklePaylasim);
            if($dataSet==true){

                //////////////////////////////////////////////////
                //   Resim Yükleme Alanı
                /////////////////////////////////////////////////
                  $tmp=$_FILES['resim']['tmp_name'];
                  $name=$_FILES['resim']['name'];
                  $size=$_FILES['resim']['size'];

                 $target_dir = "../uploads/paylasim/".$uzantiResim;
                if (move_uploaded_file($_FILES["resim"]["tmp_name"], $name)) {
                    $dosya="../uploads/paylasim/".$uzantiResim;
                    //resimden istediğimiz verileri list şeklinde alalım
                    list($mevcutGenislik,$mevcutYukseklik)=getimagesize($name);
                    $katSayi=0.5;
                    $yukseklik=$katSayi*$mevcutYukseklik;
                    $genislik=$katSayi*$mevcutGenislik;
                    $hedef=imagecreatetruecolor($genislik,$yukseklik);
                    if($_FILES["resim"]["type"]=="image/jpeg"){
                        $kaynak=imagecreatefromjpeg($name);
                        imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                        $yeniResim= "../uploads/paylasim/".$uzantiResim;
                        imagejpeg($hedef,$yeniResim,9);
                    }else if($_FILES["resim"]["type"]=="image/png"){
                        $kaynak=imagecreatefrompng($name);
                        imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                        $yeniResim= "../uploads/paylasim/".$uzantiResim;
                        imagepng($hedef,$yeniResim,9);
                    }
                    imagedestroy($hedef);
                    unlink($name);

                }
                /////////////////////////////////////////////////
                $id=mysqli_insert_id($connect);
                echo paylasimYorum($id);
                echo paylasimYorumArttir($id);

            }else{
                echo 'hataaaaaaaaa'.mysqli_error($connect);
            }

        }else{
            echo 'Hata Oluştu';
        }


    }
    else{
        echo '0';
    }


}else{
    echo 'Kısıtlı İçerik';
}