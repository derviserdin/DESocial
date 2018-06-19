<?php
///otorum başlatıcı
session_start();
//veri tabanı dosyaları
include_once 'server-side/db_con.php';
//resim yükleme sıfımız
include_once 'server-side/class.upload.php';
if (isset($_POST['resimLink'])) {
    //veritabanı bağlantısı
    $db = db_con();

    //gelen resmi al
    $resim = $_POST['resimLink'];
    //uzantısını bulmak için paçrçala
    $parcala = explode(".", $resim);
    $uzanti = $parcala[1];

    //resim adını bulmak için / işaretinden ayırıp diziye atıyoruz
    // $parçala[1] örnek olarak  uploads/user/123kalsdias123
    //son kısım  resim adı  o yüzden  $parcalaAd[2]  sonucu verecektir
    $parcalaAd=explode("/",$parcala[0]);
 //resim veritabanı kayıt adı
    $resimAd=$parcalaAd[2].'.'.$parcala[1];
    //parçalanan resmin boyutu ve kalitesi
    $targ_w = $targ_h = 280;
    $jpeg_quality = 100;
    //uzantı
    $src = $_POST['resimLink'];
    if ($uzanti == 'jpeg' || $uzanti == 'jpg') {
        $img_r = imagecreatefromjpeg($src);
        $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'],
            $targ_w, $targ_h, $_POST['w'], $_POST['h']);
        //header('Content-type: image/jpeg');
        imagejpeg($dst_r, $src, $jpeg_quality);
        echo 'Profil Resminiz Değiştirildi.';
        $durum=1;
    } else if ($uzanti == 'png') {
        $pngKalite=9;
        $img_r = imagecreatefrompng($src);
        $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'],
            $targ_w, $targ_h, $_POST['w'], $_POST['h']);
        //header('Content-type: image/jpeg');
        imagepng($dst_r, $src, $pngKalite);
        echo 'Profil Resminiz Değiştirildi.';
        $durum=1;
    }else{
        echo 'Uzantı  hatası nedeniyle resim değiştirilemedi!!';
        $durum=0;
    }
    if($durum==1){
        $userId=$_SESSION['user'];
        $sql="update users set user_profil_resim='$resimAd' where user_id='$userId' ";
        $myData=mysqli_query($db,$sql);
        if ($myData==true){
            echo 'Bilgiler güncellendi';
        }
    }

}else{
    echo 'Eksik bilgi nedeniyle resim değiştirilemedi';
}


