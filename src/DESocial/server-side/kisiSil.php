<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
$db = db_con();
if (isset($_SESSION['user'])) {

    if (isset($_POST['user_id']) and isset($_POST['sifre'])) {
        $paylasim = mysqli_real_escape_string($db, $_POST['user_id']);
        $sifre = mysqli_real_escape_string($db, $_POST['sifre']);
        $sqlBegeni = "select password , user_id from users where user_id='$paylasim'  and password='$sifre'";
        $sqlBegeniData = mysqli_query($db, $sqlBegeni);
        if ($sqlBegeniData == true) {
            if (mysqli_num_rows($sqlBegeniData) < 1) {
                die('sifre');
            }
        }
        $user = $_SESSION['user'];

        $sqlDonusum=mysqli_query($db,"select * from users where user_id='$paylasim'");
        if ($sqlDonusum==true) {
            if (mysqli_num_rows($sqlDonusum)>0) {
                $rowDonusum=mysqli_fetch_array($sqlDonusum);
                $eski_id=$rowDonusum['user_id']; $ad=$rowDonusum['user_adi'];
                $soyad=$rowDonusum['user_soyadi'];$username=$rowDonusum['username'];
                $password=$rowDonusum['password'];$user_email=$rowDonusum['user_email'];
                $user_kayit_tarih=$rowDonusum['user_kayit_tarih'];$user_giris_tarih=$rowDonusum['user_giris_tarih'];
                $user_type=$rowDonusum['user_type'];$user_ulke=$rowDonusum['user_ulke'];
                $user_sehir=$rowDonusum['user_sehir'];$user_profil_resim=$rowDonusum['user_profil_resim'];
                $user_dogum_tarih=$rowDonusum['user_dogum_tarih'];$user_takipci_sayi=$rowDonusum['user_takipci_sayi'];
                $user_takip_edilen_sayi=$rowDonusum['user_takip_edilen_sayi'];$user_ip=$rowDonusum['user_ip'];
                $user_aktivasyon=$rowDonusum['user_aktivasyon'];$user_pay_gizle=$rowDonusum['user_pay_gizle'];


                $sqlEkle=mysqli_query($db,"insert into users_delete (eski_id,user_adi,
user_soyadi,username,
password,user_email,
            user_kayit_tarih,user_giris_tarih,
            user_type,user_ulke,
            user_sehir,user_profil_resim,
            user_dogum_tarih,user_takipci_sayi,
            user_takip_edilen_sayi,user_ip,
            user_aktivasyon,user_pay_gizle)
VALUES('$eski_id','$ad',
'$soyad','$username',
'$password','$user_email',
'$user_kayit_tarih','$user_giris_tarih',
'$user_type','$user_ulke',
'$user_sehir','$user_profil_resim',
'$user_dogum_tarih','$user_takipci_sayi',
'$user_takip_edilen_sayi','$user_ip',
'$user_aktivasyon','$user_pay_gizle')");

                if($sqlEkle!=true){
                    die(mysqli_error($db));
                }

            }
        }else{
            die();
        }



        $sqlBegeni = "delete from paylasim where user_id='$paylasim' ";
        $sqlBegeniData = mysqli_query($db, $sqlBegeni);
        if ($sqlBegeniData == true) {
            $sqlGetPaylasim = "delete from paylasim_yorum where paylasim_yorum_user='$paylasim' ";
            $sqlGetPaylasimData = mysqli_query($db, $sqlGetPaylasim);
            if ($sqlGetPaylasimData == true) {
                $sqlPaylasim = "delete from paylasim_begeni where bg_user_id='$paylasim'";
                $dataSet = mysqli_query($db, $sqlPaylasim);
                if ($dataSet) {
                    $sqlPaylasim = "delete from paylasim_yorum_begeni where paylasim_yorum_user='$paylasim'";
                    $dataSet = mysqli_query($db, $sqlPaylasim);
                    if ($dataSet == true) {
                        //paylaşım bilgileri bul
                        $sqlBildirim = "delete from bildirimler where bildirim_giden_user='$paylasim' or user_gelen_id='$paylasim'";
                        $dataSetBildirim = mysqli_query($db, $sqlBildirim);
                        if ($dataSetBildirim == true) {
                            $sqlSikayet = "delete from sikayet where sikayet_user_id='$paylasim'";
                            $dataSetSikayet = mysqli_query($db, $sqlSikayet);
                            if ($dataSetSikayet == true) {
                                $sqlTakip = "delete from takip where user_id='$paylasim' ";
                                $sqlTakipData = mysqli_query($db, $sqlTakip);
                                $sqlTakip="delete from takip where takip_edilen_id='$paylasim' ";
                                $sqlTakipData=mysqli_query($db,$sqlTakip);
                                if ($sqlTakipData == true) {
                                    $sqlUser = "delete from users where user_id='$paylasim' ";
                                    $sqlUserData = mysqli_query($db, $sqlUser);
                                    if ($sqlUserData == true) {
                                        echo 'ok';
                                    }
                                }

                            } else {
                                echo mysqli_error($db);
                            }
                        } else {
                            echo mysqli_error($db);
                        }
                    }

                } else {
                    echo mysqli_error($db);
                }
            } else {
                echo mysqli_error($db);
            }


        } else {
            echo mysqli_error($db);
        }

    } else {
        echo 'yetki';
    }
} else {
    echo 'yetki';
}

