<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
include_once 'views/paylasimView.php';
$connect= db_con();
date_default_timezone_set('Asia/Kuwait');
$tarih= date("Y-m-d H:i:s");
if (isset($_SESSION['user'])) {

    if (isset($_POST['id']) and isset($_POST['text']) ){
        $icerik=mysqli_real_escape_string($connect,$_POST['text']);
        $id=mysqli_real_escape_string($connect,$_POST['id']);

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
        if(isset($_POST['text']) and !isset($_FILES['resim']) ){
            if(empty($_POST['text'])){
                echo 'boş';
            }else{


                $eklePaylasim="update paylasim set paylasim_icerik='$icerik' , paylasim_guncelleme_tarihi='$tarih' where paylasim_id='$id'";
                $dataSet=mysqli_query($connect,$eklePaylasim);
                if($dataSet==true){
                   // $id=mysqli_insert_id($connect);
                    hashtagInsert($icerik);
                    echo paylasimSonucDuzenle($id);
                }else{
                    echo 'hata'.mysqli_error($connect);
                }
            }
            //sadece Resim paylaşımı var ise
        }else if(isset($_FILES['resim']) and !isset($_POST['name'])){
            if($_FILES["resim"]["size"]<5000*5000){//boyut kontrol
                if ($_FILES["resim"]["type"]=="image/png"
                    || $_FILES["resim"]["type"]=="image/jpg"
                    || $_FILES["resim"]["type"]=="image/jpeg"
                    || $_FILES["resim"]["type"]=="image/gif") {/// eğere resim dosya tipi  uygun ise



                    $eklePaylasim="update paylasim set  paylasim_guncelleme_tarihi='$tarih' ,  paylasim_resim_id='$uzantiResim' where paylasim_id='$id'";
                    $dataSet=mysqli_query($connect,$eklePaylasim);
                    if($dataSet==true){


                        $target_dir = "../uploads/paylasim/".$uzantiResim;
                        //////////////////////////////////////////////////
                        //   Resim Yükleme Alanı
                        /////////////////////////////////////////////////
                        if($_FILES["resim"]["size"]>1024){
                            $tmp=$_FILES['resim']['tmp_name'];
                            $name=$_FILES['resim']['name'];
                            $size=$_FILES['resim']['size'];

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
                                    imagejpeg($hedef,$yeniResim,50);
                                }else if($_FILES["resim"]["type"]=="image/png"){
                                    $kaynak=imagecreatefrompng($name);
                                    imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                                    $yeniResim= "../uploads/paylasim/".$uzantiResim;
                                    imagepng($hedef,$yeniResim,50);
                                }
                                imagedestroy($hedef);
                                unlink($name);

                            }
                        }else{
                            move_uploaded_file($_FILES["resim"]["tmp_name"], $target_dir);
                        }
                        /////////////////////////////////////////////////



                      //  $id=mysqli_insert_id($connect);
                        hashtagInsert($icerik);
                        echo paylasimSonucDuzenle($id);
                    }else{
                        echo 'hata'.mysqli_error($connect);
                    }


                }else{
                    echo 'sadece PNG , JPG formatında dosya yükleye bilirsiniz';
                }
            }else{
                echo 'Resim 2 MB  geçemez ';
            }
            //eğer resim ve  yazı birlikte ise
        }else if (isset($_FILES['resim']) and isset($_POST['name'])){


            $eklePaylasim="update paylasim set paylasim_icerik='$icerik' , paylasim_guncelleme_tarihi='$tarih' ,  paylasim_resim_id='$uzantiResim' where paylasim_id='$id'";

            $dataSet=mysqli_query($connect,$eklePaylasim);
            if($dataSet==true){


                $target_dir = "../uploads/paylasim/".$uzantiResim;
                //////////////////////////////////////////////////
                //   Resim Yükleme Alanı
                /////////////////////////////////////////////////
                if($_FILES["resim"]["size"]>1024*1024){
                    $tmp=$_FILES['resim']['tmp_name'];
                    $name=$_FILES['resim']['name'];
                    $size=$_FILES['resim']['size'];

                    if (move_uploaded_file($_FILES["resim"]["tmp_name"], $name)) {
                        $dosya="../uploads/paylasim/".$uzantiResim;
                        //resimden istediğimiz verileri list şeklinde alalım
                        list($mevcutGenislik,$mevcutYukseklik)=getimagesize($name);
                        $katSayi=0.7;
                        $yukseklik=$katSayi*$mevcutYukseklik;
                        $genislik=$katSayi*$mevcutGenislik;
                        $hedef=imagecreatetruecolor($genislik,$yukseklik);
                        if($_FILES["resim"]["type"]=="image/jpeg"){
                            $kaynak=imagecreatefromjpeg($name);
                            imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                            $yeniResim= "../uploads/paylasim/".$uzantiResim;
                            imagejpeg($hedef,$yeniResim,50);
                        }else if($_FILES["resim"]["type"]=="image/png"){
                            $kaynak=imagecreatefrompng($name);
                            imagecopyresampled($hedef,$kaynak,0,0,0,0,$genislik,$yukseklik,$mevcutGenislik,$mevcutYukseklik);
                            $yeniResim= "../uploads/paylasim/".$uzantiResim;
                            imagepng($hedef,$yeniResim,50);
                        }
                        imagedestroy($hedef);
                        unlink($name);

                    }
                }else{
                    move_uploaded_file($_FILES["resim"]["tmp_name"], $target_dir);
                }
                /////////////////////////////////////////////////

              //  $id=mysqli_insert_id($connect);
                hashtagInsert($icerik);
                echo paylasimSonucDuzenle($id);

            }else{
                echo 'hataaaaaaaaa'.mysqli_error($connect);
            }

        }else{
            echo 'Hata Oluştu';
        }


    }
    else{
        echo 'eksikbilgi';
    }
} else {
    echo 'gelen user yok';
}

