<?php

include_once 'db_con.php';


function paylasimPAySayiBul($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "select * from users where user_id='$id'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $uye[] = $row;
        }
        return $uye;
    } else {
        return "0";
    }


}


//üye bilgileri bul

function uyeKadiBul($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "select user_id,username from users where user_id='$id'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $uye[] = $row;
        }
        return $uye;
    } else {
        return "0";
    }


}

function uyeBul($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "select * from users where user_id='$id'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $uye[] = $row;
        }
        return $uye;
    } else {
        return "0";
    }


}

function uyeBulProfil($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "select * from users where username='$id'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $uye[] = $row;
        }
        return $uye;
    } else {
        return "0";
    }


}


function paylasimDetay($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "select * from paylasim where paylasim_id='$id'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $uye[] = $row;
        }
        return $uye;
    } else {
        return "0";
    }


}

// PAylaşım sayısı bulma

function paylasimSayiBul($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "SELECT COUNT(*) FROM paylasim where user_id=1 ";
    $data = mysqli_query($con, $sql);
    $sayi = mysqli_fetch_assoc($data);
    //var_dump(mysqli_fetch_assoc($data));


}


//Üye Ad-soyad getir
function isimBul($id)
{
    //bağlantı
    $con = db_con();
    //geri döndürülecek dizi bilgisi
    $uye = array();
    //sorgu ve  değeri geri döndürme
    $sql = "Select * From users where user_id='$id'";
    $data = mysqli_query($con, $sql);
    $sonuc = mysqli_fetch_assoc($data);
    $isim = $sonuc['user_adi'] . ' ' . $sonuc['user_soyadi'] . '  <span style="font-size: 13px;color: #8899a6;">@' . $sonuc['username'] . '</span>';
    echo $isim;


}

//zaman
function zaman($zaman)
{

    date_default_timezone_set('Asia/Kuwait');
    $onceBol = explode(" ", $zaman);
    $gay = explode("-", $onceBol[0]);
    $sds = explode(":", $onceBol[1]);
    $zaman = mktime($sds[0], $sds[1], $sds[2], $gay[1], $gay[2], $gay[0]);
    $zaman_farki = time() - $zaman;
    $saniye = $zaman_farki;
    $dakika = round($zaman_farki / 60);
    $saat = round($zaman_farki / 3600);
    $gun = round($zaman_farki / 86400);
    $hafta = round($zaman_farki / 604800);
    $ay = round($zaman_farki / 2419200);
    $yil = round($zaman_farki / 29030400);
    if ($saniye < 60) {
        if ($saniye == 0) {
            return "Az Önce";
        } else {
            return $saniye . ' sn önce';
        }
    } else if ($dakika < 60) {
        return $dakika . ' dk önce';
    } else if ($saat < 24) {
        return $saat . ' saat önce';
    } else if ($gun < 7) {
        return $gun . ' gün önce';
    } else if ($hafta < 4) {
        return $hafta . ' hafta önce';
    } else if ($ay < 12) {
        return $ay . ' ay önce';
    } else {
        return $yil . ' yıl önce';
    }
}

function yorumSayi($id)
{
    $con = db_con();
    $sql = mysqli_query($con, "select yorum_id,paylasim_id from paylasim_yorum where paylasim_id='$id'");
    if ($sql == true) {
        return mysqli_num_rows($sql);
    } else {
        echo 'yok';
    }

}


//begeni durum

function begeniDurum($user, $paylasim)
{
    $con = db_con();
    $sql = "select * from paylasim_begeni  where bg_user_id='$user' and bg_pay_id='$paylasim' ";
    $data = mysqli_query($con, $sql);
    if ($data == true) {
        mysqli_num_rows($data);
    }
    $veri = paylasimDetay($paylasim);

    if ($veri[0]['user_id'] == $user) {
        if (mysqli_num_rows($data) == 0) {
            $sql = "select * from paylasim where paylasim_id=$paylasim";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniArttir">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniSayi' . $paylasim['paylasim_id'] . '"> 
                                                Beğen
                                                 <a href="#" data-num="' . $paylasim['paylasim_id'] . '" data-toggle="modal" data-target="#payKisiGoster" class="gosterBegSayi"> 
                                                 (' . $paylasim['paylasim_begeni_sayisi'] . ')
                                                </a>
                                                </span>
                                            </a>';
        } else {
            $sql = "select * from paylasim where paylasim_id=$paylasim";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniAzalt">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniSayi' . $paylasim['paylasim_id'] . '"> 
                                                Beğenmekten vazgeç  
                                                </span>
                                                <a href="#" data-num="' . $paylasim['paylasim_id'] . '" data-toggle="modal" data-target="#payKisiGoster" class="gosterBegSayi">
                                                 (' . $paylasim['paylasim_begeni_sayisi'] . ')
                                                </a>
                                                
                 </a>
                                                ';

        }
    } else {
        if (mysqli_num_rows($data) == 0) {
            $sql = "select * from paylasim where paylasim_id=$paylasim";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniArttirr">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniSayi' . $paylasim['paylasim_id'] . '"> Beğen (' . $paylasim['paylasim_begeni_sayisi'] . ')</span>
                                            </a>';
        } else {
            $sql = "select * from paylasim where paylasim_id=$paylasim";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniAzaltt">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniSayi' . $paylasim['paylasim_id'] . '"> Beğenmekten vazgeç (' . $paylasim['paylasim_begeni_sayisi'] . ')</span>
                                            </a>';
        }
    }


}

function yorumDurum($user, $paylasim, $yorum)
{

    $con = db_con();
    $sql = "select * from paylasim_yorum_begeni  where paylasim_yorum_user='$user' and paylasim_id='$paylasim' and paylasim_yorum_id='$yorum' ";
    $data = mysqli_query($con, $sql);
    if ($data != true) {
        mysqli_error($con);
    } else {

    }
    $sayi = mysqli_num_rows($data);

    $veri = paylasimDetay($paylasim);

    if ($_SESSION['user'] == $veri[0]['user_id']) {
        if (mysqli_num_rows($data) == 0) {
            $sql = "select * from paylasim_yorum where yorum_id=$yorum";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumArttir">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <span class="yorumId' . $paylasim['yorum_id'] . '" style="display:none">' . $paylasim['yorum_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniYorumSayi' . $paylasim['yorum_id'] . '"> Beğen  <a href="#" data-num="' . $paylasim['yorum_id'] . '" data-toggle="modal" data-target="#payKisiGoster" class="gosterYoBegSayi">
                                                 (' . $paylasim['yorum_begeni_sayisi'] . ')
                                                </a></span>
                                            </a>';
        } else {
            $sql = "select * from paylasim_yorum where yorum_id=$yorum";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumAzalt">
                                               <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <span class="yorumId' . $paylasim['yorum_id'] . '" style="display:none">' . $paylasim['yorum_id'] . '</span>
                                                <i class="fa fa-star"></i>
                                                <span class="begeniYorumSayi' . $paylasim['yorum_id'] . '">
                                                Beğenmenten Vazgeç
                                                <a href="#" data-num="' . $paylasim['yorum_id'] . '" data-toggle="modal" data-target="#payKisiGoster" class="gosterYoBegSayi">
                                                 (' . $paylasim['yorum_begeni_sayisi'] . ')
                                                </a></span>
                                            </a>';
        }
    } else {
        if (mysqli_num_rows($data) == 0) {
            $sql = "select * from paylasim_yorum where yorum_id=$yorum";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumArttirr">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <span class="yorumId' . $paylasim['yorum_id'] . '" style="display:none">' . $paylasim['yorum_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniYorumSayi' . $paylasim['yorum_id'] . '"> Beğen (' . $paylasim['yorum_begeni_sayisi'] . ')</span>
                                            </a>';
        } else {
            $sql = "select * from paylasim_yorum where yorum_id=$yorum";
            $dataSet = mysqli_query($con, $sql);
            $paylasim = mysqli_fetch_assoc($dataSet);
            echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumAzaltt">
                                               <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <span class="yorumId' . $paylasim['yorum_id'] . '" style="display:none">' . $paylasim['yorum_id'] . '</span>
                                                <i class="fa fa-star"></i>
                                                <span class="begeniYorumSayi' . $paylasim['yorum_id'] . '"> Beğenmenten Vazgeç (' . $paylasim['yorum_begeni_sayisi'] . ')</span>
                                            </a>';
        }
    }


}

function paylasimSahibDurum($id)
{
    $con = db_con();
    $sql = "select * from paylasim where paylasim_id='$id'";
    $data = mysqli_query($con, $sql);
    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $veri = mysqli_fetch_assoc($data);
            $uyePaylasim = array();
            $uyePaylasim = uyeBul($veri['user_id']);
            echo '
       <div class="paylasilanAlan" style="width: 90%;margin-left: 26px;border: 1px solid blue;padding: 3%;margin-top: 3%;margin-bottom: 3%;">
         <div class="user-block">
         ';
            if ($uyePaylasim[0]['user_profil_resim'] != '') {
                echo '<img  src="uploads/user/' . $uyePaylasim[0]['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
            } else {
                echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

            }
            echo '
             <span class="username">
               <a href="user.php?id=' . $uyePaylasim[0]['username'] . '">' . $uyePaylasim[0]['user_adi'] . ' ' . $uyePaylasim[0]['user_soyadi'] . '</a>
              
             </span>
           <span class="description">Paylaşım tarihi ' . zaman($veri['paylasim_tarihi']) . '</span>
          </div>
          <!-- /.user-block -->
           <p>
            ' . hashtag($veri['paylasim_icerik']) . '';
            if ($veri['paylasim_resim_id'] != '') {
                echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
                                         <a href="uploads/paylasim/' . $veri['paylasim_resim_id'] . '" data-lightbox="image-1" >
                                    <img style="width: 64%;margin: 0px auto;" src="uploads/paylasim/' . $veri['paylasim_resim_id'] . '" class="img-responsive ">
                                    </a>
                                         </div>
                                      </div>';
            }
            echo '
           </p>
        </div>
        ';
        }
    }


}

function paylasimSayiArttir($id)
{
    $db = db_con();
    $sql = "select * from paylasim where paylasim_id='$id'";
    $data = mysqli_query($db, $sql);
    if ($data) {
        $veri = mysqli_fetch_assoc($data);
        $arttir = $veri['paylasim_sahibi'] + 1;
        $sqls = "update paylasim set paylasim_sayisi='$arttir' where paylasim_id='$id'";
        $datas = mysqli_query($db, $sqls);
        if ($datas == false) {
            echo mysqli_error($db);
        }
    }
}

function paylasimYorumArttir($id)
{
    $db = db_con();
    $sql = "select * from paylasim where paylasim_id='$id'";
    $data = mysqli_query($db, $sql);
    if ($data) {
        $veri = mysqli_fetch_assoc($data);
        $arttir = $veri['paylasim_sahibi'] + 1;
        $sqls = "update paylasim set paylasim_yorum_sayisi='$arttir' where paylasim_id='$id'";
        $datas = mysqli_query($db, $sqls);
    }
}

function paylasimSikayetKontrol($id, $id2, $pay, $durum)
{


    $con = db_con();
    $sql = "select * from sikayet where sikayet_eden_id='$id' and sikayet_user_id='$id2'and paylasim_id='$pay' and sikayet_type='sikayet'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        return '1';
    } else {
        return '0';
    }
}

function paylasimGizleKontrol($id, $id2, $pay, $durum)
{


    $con = db_con();
    $sql = "select * from sikayet where sikayet_eden_id='$id' and sikayet_user_id='$id2'and paylasim_id='$pay' and sikayet_type='gizle'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        return '1';
    } else {
        return '0';
    }
}

function paylasimEngelKontrol($id, $id2, $durum)
{


    $con = db_con();
    $sql = "select * from sikayet where sikayet_eden_id='$id' and sikayet_user_id='$id2' and sikayet_type='engel'";
    $data = mysqli_query($con, $sql);
    if (mysqli_num_rows($data) > 0) {
        return '1';
    } else {
        return '0';
    }
}

function takipciArttir($id, $id2, $durum)
{
    $islem = $durum;
    $db = db_con();
    $sql = "select user_id,user_takipci_sayi,user_takip_edilen_sayi from users where user_id='$id'";
    $data = mysqli_query($db, $sql);
    if ($data) {
        $veri = mysqli_fetch_assoc($data);
        if ($islem == 'follow') {
            $arttir = $veri['user_takip_edilen_sayi'] + 1;
            $sqls = "update users set user_takip_edilen_sayi='$arttir' where user_id='$id'";
            $datas = mysqli_query($db, $sqls);
            if ($datas) {
                $sqla = "select user_id,user_takipci_sayi,user_takip_edilen_sayi from users where user_id='$id2'";
                $dataa = mysqli_query($db, $sqla);
                $veri = mysqli_fetch_assoc($dataa);
                $arttir = $veri['user_takipci_sayi'] + 1;
                $sqlss = "update users set user_takipci_sayi='$arttir' where user_id='$id2'";
                $datass = mysqli_query($db, $sqlss);

            }
        } else if ($islem == 'unfollow') {
            $eksilt = $veri['user_takip_edilen_sayi'] - 1;
            $sqls = "update users set user_takip_edilen_sayi='$eksilt' where user_id='$id'";
            $datas = mysqli_query($db, $sqls);
            if ($datas) {
                $sqla = "select user_id,user_takipci_sayi,user_takip_edilen_sayi from users where user_id='$id2'";
                $dataa = mysqli_query($db, $sqla);
                $veri = mysqli_fetch_assoc($dataa);
                $arttir = $veri['user_takipci_sayi'] - 1;
                $sqlss = "update users set user_takipci_sayi='$arttir' where user_id='$id2'";
                $datass = mysqli_query($db, $sqlss);
            }
        }

    }
}

function takipciDuzenle($id)
{
    $db = db_con();
    $sqla = "select user_id,user_takipci_sayi,user_takip_edilen_sayi from users where user_id='$id'";
    $dataa = mysqli_query($db, $sqla);
    if($dataa==true){
        $veri = mysqli_fetch_assoc($dataa);
     echo   $arttir = $veri['user_takipci_sayi'] - 1;
        $sqlss = "update users set user_takipci_sayi='$arttir' where user_id='$id'";
        $datass = mysqli_query($db, $sqlss);
        if($datass==true){
            echo 'ok';
        }else{
            echo 'yok';
        }
    }else{
        echo 'yok';
    }
}

function bildirimPay($str, $baglanti, $bildirimType)
{
    date_default_timezone_set('Asia/Kuwait');
    $tarih = date("Y-m-d H:i:s");
    $db = db_con();
    $id = $_SESSION['user'];
    $htag = '**';
    $user = '@';
    $arr = explode(" ", $str);
    $arrc = count($arr);
    $i = 0;


    while ($i < $arrc) {
        if (substr($arr[$i], 0, 1) == $user) {
            $kAdi = substr($arr[$i], 1);
            $parcala = explode('@', $kAdi);
            //var_dump($parcala);
            $gidenUser = $parcala[0];


            $sql = "select * from users where username='$gidenUser'";
            $data = mysqli_query($db, $sql);
            if ($data == true) {
                if (mysqli_num_rows($data) > 0) {
                    $uyeVeri = mysqli_fetch_assoc($data);
                    $uyeId = $uyeVeri['user_id'];
                    $sqlBildirim = "insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$id','$baglanti','$bildirimType','0','$uyeId','$tarih')";
                    if (mysqli_query($db, $sqlBildirim) != true) {
                        echo mysqli_error($db);
                    }

                }
            } else {
                echo mysqli_error($db);
            }

            //  $arr[$i]='<a href="user.php?id='.$kAdi.'">'.$arr[$i].'</a>';
        } else {

            $sql = "select * from paylasim where paylasim_url='$baglanti'";
            $data = mysqli_query($db, $sql);
            if ($data == true) {
                if (mysqli_num_rows($data) > 0) {
                    $payVeri = mysqli_fetch_assoc($data);
                    $userPayId = $payVeri['user_id'];
                    if ($id == $userPayId) {
                        return false;
                    }

                }
            }
            $sql = "select * from paylasim where paylasim_url='$baglanti'";
            $data = mysqli_query($db, $sql);
            if ($data == true) {
                if (mysqli_num_rows($data) > 0) {
                    $uyeVeri = mysqli_fetch_assoc($data);
                    $uyeId = $uyeVeri['user_id'];
                    $sqlBildirim = "insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$id','$baglanti','yorumEtiketsiz','0','$uyeId','$tarih')";
                    if (mysqli_query($db, $sqlBildirim) != true) {
                        echo mysqli_error($db);
                    } else {
                        break;
                    }

                }
            } else {
                echo mysqli_error($db);
            }
        }
        $i++;

    }
    $string = implode(" ", $arr);
    return $string;
}


function paySayiBul($id)
{
    $db = db_con();
    $result = mysqli_query($db, "SELECT COUNT(paylasim_id) FROM paylasim WHERE paylasim_sahibi='$id'");

    $data = mysqli_fetch_row($result);

    return $data[0];
}

function hashtageSorgula($str)
{

    $db = db_con();

    $sql = mysqli_query($db, "select * from hashtage where adi='$str'");
    if ($sql == true) {

        if (mysqli_num_rows($sql) > 0) {
            return 'ok';
        } else {
            return 'no';
        }
    } else {
        return mysqli_error($db);
    }
}

function hashtagInsert($str)
{

    date_default_timezone_set('Asia/Kuwait');
    $tarih = date("Y-m-d H:i:s");
    $db = db_con();
    $text = $str;
    $htag = '**';
    $user = '@';
    $video = 'https://www';
    $arr = explode(" ", $text);
    $arrc = count($arr);
    $i = 0;
    //var_dump($arr);
    $mesaj = "";
    while ($i < $arrc) {
        //kelimede ** karakteri geçen yeri alıyoruz
        $ikinciKelime = strstr($arr[$i], '**');

        if (substr($ikinciKelime, 0, 2) == $htag) {
            if (hashtageSorgula($ikinciKelime) == 'no') {
                $sql = mysqli_query($db, "insert into hashtage (adi,sayi,tarih) VALUES ('$ikinciKelime','1','$tarih')");
                if ($sql == true) {
                    $mesaj = 'ekılendi';
                } else {
                    $mesaj = mysqli_error($db);
                }

            } else if (hashtageSorgula($ikinciKelime) == 'ok') {
                $sql = mysqli_query($db, "select * from hashtage where adi='$ikinciKelime'");
                if ($sql == true) {
                    if (mysqli_num_rows($sql) > 0) {
                        $veri = mysqli_fetch_assoc($sql);
                        $sayi = $veri['sayi'] + 1;
                        $sql = mysqli_query($db, "update hashtage set adi='$ikinciKelime',sayi='$sayi',tarih='$tarih' where adi='$ikinciKelime'");
                        if ($sql == true) {
                            $mesaj = 'güncellendi';
                        } else {
                            $mesaj = mysqli_error($db);
                        }

                    }
                }

            }
        }
        //
        $i++;

    }

}

function hashtag($str)
{

    $text = $str;

    //   echo $str;
    // Links
    $link_regex = '/(http\:\/\/|https\:\/\/|www\.)([^\ ]+)/i';
    $i = 0;
    preg_match_all($link_regex, $text, $matches);

    foreach ($matches[0] as $match) {
        $match_url = strip_tags($match);
        $parcala = explode('/watch?v=', $match_url);

        if (count($parcala) > 1) {
            // $parcala[1];
            $syntax = '<br><iframe width="100%" height="400" src="https://www.youtube.com/embed/' . $parcala[1] . '" frameborder="0" allowfullscreen></iframe><br>';
            //   $syntax = '<a href="' . $match_url . '">aaa</a>';

        } else {
            $syntax = '<a href="' . $match_url . '" >' . $match_url . '</a>';

        }
        $text = str_replace($match, $syntax, $text);

    }
    // @Mentions
    $mention_regex = '/@([A-Za-z0-9_]+)/i';
    preg_match_all($mention_regex, $text, $matches);

    foreach ($matches[1] as $match) {
        $match_search = '@' . $match;
        $match_replace = '<a href="user.php?id=' . $match . '">@' . $match . '</a>';
        $text = str_replace($match_search, $match_replace, $text);
    }
    $htag = '**';
    $user = '@';
    $video = 'https://www';
    $arr = explode(" ", $text);
    $arrc = count($arr);
    $i = 0;
    //var_dump($arr);
    while ($i < $arrc) {
        //kelimede ** karakteri geçen yeri alıyoruz
        $ikinciKelime = strstr($arr[$i], '**');
        if (strlen(trim($arr[$i])) > 2) {
            if (substr($ikinciKelime, 0, 2) == $htag) {
                //   echo $arr[$i];
                $yeni = '<a href="hashtag.php?kelime=' . trim($ikinciKelime) . '">' . trim($ikinciKelime) . '</a>';
                $text = str_replace($ikinciKelime, $yeni, $text);
            }
        }
        $i++;
    }
    return nl2br($text);
    /**
     *$htag = '**';
     * $user = '@';
     * $video = 'https://www';
     * $arr = explode(" ", $str);
     * $arrc = count($arr);
     * $i = 0;
     * while ($i < $arrc) {
     * if (substr($arr[$i], 0, 1) == $user) {
     * $kAdi = substr($arr[$i], 1);
     * $arr[$i] = '<a href="user.php?id=' . $kAdi . '">' . $arr[$i] . '</a>';
     * } else if (substr($arr[$i], 0, 11) == $video) {
     * //$metin=str_replace('watch?v=','embed/',$arr[$i]);
     * $parcala = explode('/watch?v=', $arr[$i]);
     * $arr[$i] = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $parcala[1] . '" frameborder="0" allowfullscreen></iframe>';
     * }
     * $i++;
     *
     * }
     * $string = implode(" ", $arr);
     * return nl2br($string);*/
}


function GetIP()
{
    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

function paylasimGormeKontrol($userG)
{
    $durum = '';
    date_default_timezone_set('Asia/Kuwait');
    $tarih = date("Y-m-d H:i:s");
    $db = db_con();
    $user = $_SESSION['user'];
    $gelenUser = $userG;

    if ($user == $gelenUser) {

        $durum = "ok";
    } else {

        $sqlUyeBilgi = "select user_id , user_pay_gizle from users where  user_id='$gelenUser'";
        $dataSet = mysqli_query($db, $sqlUyeBilgi);

        if ($dataSet == true) {
            $veri = mysqli_fetch_assoc($dataSet);
            $gonderiVeri = $veri['user_pay_gizle'];
            if ($gonderiVeri == "a") {

                $durum = "ok";
            } elseif ($gonderiVeri == "b") {
                $sqlUyeBilgi = "select user_id,takip_edilen_id,id from takip where user_id='$user' and  takip_edilen_id='$gelenUser' ";
                $dataSet = mysqli_query($db, $sqlUyeBilgi);

                if ($dataSet == true) {
                    if (mysqli_num_rows($dataSet) == 1) {
                        $durum = "ok";
                    } else {
                        $durum = "no";
                    }
                } else {
                    echo mysqli_error($db);
                }
            }
        } else {

            echo mysqli_error($db);
        }
    }
    return $durum;
}

function gundemAl($type)
{   // $zaman = "2017-02-24 12:12:12";
    date_default_timezone_set('Asia/Kuwait');
    $zaman = date('Y-m-d H:i:s');
    $onceBol = explode(" ", $zaman);
    $gay = explode("-", $onceBol[0]);
    $gun = $gay[2];
    $ay = $gay[1];
    $yil = $gay[0];
    $tarih = "";
    switch ($type) {
        case "hafta";
            if ($gun < 8) {
                $gunSayi = 7 - $gun;
                $gun = 30 - $gunSayi;
                if ($ay < 2) {
                    $yil -= 1;
                    $ay = 12;
                    return $tarih = $yil . "-" . $ay . "-" . $gun;
                } else {
                    $ay -= 1;
                    return $tarih = $yil . "-" . $ay . "-" . $gun;
                }
            } else {
                $gun -= 7;
                return $tarih = $yil . "-" . $ay . "-" . $gun;
            }
            break;
        case "ay":
            if ($ay < 2) {
                $ay = 12;
                $yil -= 1;
                return $tarih = $yil . "-" . $ay . "-" . $gun;
            } else {
                $ay -= 1;
                return $tarih = $yil . "-" . $ay . "-" . $gun;
            }
            break;
        case "yil":
            $yil -= 1;
            return $tarih = $yil . "-" . $ay . "-" . $gun;
            break;
        default:
            return $tarih = $yil . "-" . $ay . "-" . $gun;

    }
}

function takipSayi($id,$durum){
    $db=db_con();
    if($durum=='takipci'){
        $sql=mysqli_query($db,"SELECT * FROM takip WHERE takip_edilen_id=$id");
        echo mysqli_num_rows($sql);
    }elseif ($durum=='takipedilen'){
        $sql=mysqli_query($db,"SELECT * FROM takip WHERE user_id=$id");
        echo mysqli_num_rows($sql);
    }else{
        echo '';
    }

}

function yeniUyeGetir(){
$db=db_con();
$uye=uyeBul($_SESSION['user']);
            //oturum açmış kullanıcı
            $gelenKulID=$_SESSION['user'];
            //bütün Kullanıcılarun user_idlerini alıyoruz
            $sql = mysqli_query($db, "select user_id from  users ");
            if ($sql == true) echo mysqli_error($db);
            if ($sql == true){
                if (mysqli_num_rows($sql) > 0) {
                    //Tüm kullanıcı sayısını alıyoruz
                    $maxSayi = mysqli_num_rows($sql);
                    // dizi oluşturuyoruz
                    $dizi=array();
            //takip tablosunda  oturum açan kullanıcısının bütün  takip ettiği kişilerin bilgilerini alıyoruz
                    $sqli = mysqli_query($db, "select user_id,takip_edilen_id from  takip WHERE user_id='$gelenKulID' ");
                    while($row=mysqli_fetch_assoc($sqli)){
                        //diye atıyoruz
                        array_push($dizi,$row['takip_edilen_id']) ;
                    }
                    // 3  defa dönen bir döngü yapıyoruz sql kodu 17 satırda
                    for ($i = 1;$i <= 1;$i++){
                        // tüm kullanıcıların aidlerini çekiyoruz
                        $dbId=mysqli_fetch_assoc($sql);
                        $durum="";
                      //  while( in_array( ($id = rand(1,$maxSayi)), $dizi ) );
                        if($maxSayi<=$uye[0]['user_takip_edilen_sayi'] ){
                            //üye sayısı   oturum a.mış kişininkinden  küçük ve eişt ise  random bir üyenin id al
                            $id = rand(1, $maxSayi);
                        }else{
                            do{
                                //şart ne olursa olsun 1 defa random üye çekip
                                $id = rand(1, $maxSayi);
                                //Kullanıcının takip ettiği kişi mi değilmi diye kontrol ediyoruz ve ona göre
                                // $durum değişkenine ok yada  yok diye yezıyoruz

                                if (array_search($id, $dizi)) {
                                    $durum="ok";
                                }else{
                                    $durum="yok";
                                }
                                //şart olarak rastgele seçilen id   oturum açmış kişinin  takip ettikleri arasında değilse
                                // devam etsin döngü dursun
                            }while($durum=='ok');
                        }
                        //bu satıra bak sonra
                        $sqlKontrolTakip = mysqli_query($db, "select user_id from users ");
                        //random  çekilen üyenin bilgilerini veri tabanından çek
                        $sql = mysqli_query($db, "select * from users where user_id=$id ");
            //sql doğru ise sonraki aşamaya geç
                        if ($sql == true){
                        //dönen sonuç varsa sonraki aşamaya geç
                            if (mysqli_num_rows($sql) == 1){
                                //sonuçları döndür $row  değişkenine dizi şekilinde at
                                $row = mysqli_fetch_assoc($sql);
                                //oturum açmış kullanıcı id ile eşit değilse işlemlere başla
                                 if ($_SESSION['user'] != $row['user_id']){
                                    echo '
                                                    <div class="user-block alan'.$row['user_id'].'" style="margin-bottom: 5%">
                                                        ';
                                    if ($row['user_profil_resim'] != '') {
                                        echo '<img src="uploads/user/' . $row['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
                                    } else {
                                        echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                    }
                                    echo '
                                                        <span class="username username7">
                                                                                <a href="user.php?id=' . $row['username'] . '">' . $row['user_adi'] . ' ' . $row['user_soyadi'] . '  </a>
                                                                              <a href="#" data-id="' . $row['user_id'] . '" class="pull-right btn-box-tool tBaska"><i class="fa fa-times"></i></a>
                                                                                <a style="font-size: 13px;color: #8899a6;">
                                                                                @' . $row['username'] . '
                                                                                </a>

                                                                               <br>
                                                                               <div class="islemlerUser islemlerUser' . $row['user_id'] . '">


                                                                             ';
                                    if ($row['user_id'] != $_SESSION['user']) {
                                        $takipci = $_SESSION['user'];
                                        $takipEdilen = $row['user_id'];
                                        $sql = "select * from takip where user_id='$takipci' and takip_edilen_id='$takipEdilen'";
                                        $data = mysqli_query($db, $sql);
                                        if ($data) {
                                            if (mysqli_num_rows($data) > 0) {
                                                echo '<a href="#" onclick="return false" id="takipBirakk" class="takipBirak' . $row['user_id'] . ' btn btn-primary btn-sm ">Takip Ediyorsun</a>
                                                                                                 <input type="hidden" name="idTakip" id="idTakip" value="' . $row['user_id'] . '">';
                                            } else {
                                                echo '<a href="#" onclick="return false" id="takipEtt" class="takipEt' . $row['user_id'] . ' btn btn-primary btn-sm">Takip Et</a>
                                                                                                <input type="hidden" name="idTakip" id="idTakip" value="' . $row['user_id'] . '">';
                                            }
                                        }
                                    }
                                    ?>
                                </div>

                                </span>

                            </div>
                            <?php
                            } else {
                                $i--;
                            }
                        }
                        else {
                            $i--;
                        }
                    }
                }
            }
    }

}