<?php

include_once 'db_con.php';


//üye bilgileri bul

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
    $isim = $sonuc['user_adi'] . ' ' . $sonuc['user_soyadi'] .'  <span style="font-size: 13px;color: #8899a6;">@'.$sonuc['username']. '</span>';
    echo $isim;


}

//zaman
function zaman($zaman)
{

    date_default_timezone_set("Europe/Istanbul");
    $onceBol = explode(" ", $zaman);
    $gay = explode("-", $onceBol[0]);
    $sds = explode(":", $onceBol[1]);
    $zaman = mktime($sds[0], $sds[1], $sds[2], $gay[1], $gay[2], $gay[0]);
    $zaman_farki = time() + 3600 - $zaman ;
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

//begeni durum

function begeniDurum($user, $paylasim)
{
    $con = db_con();
    $sql = "select * from paylasim_begeni  where bg_user_id='$user' and bg_pay_id='$paylasim' ";
    $data = mysqli_query($con, $sql);
    if ($data == true) {
        mysqli_num_rows($data);
    }

    if (mysqli_num_rows($data) == 0) {
        $sql = "select * from paylasim where paylasim_id=$paylasim";
        $dataSet = mysqli_query($con, $sql);
        $paylasim = mysqli_fetch_assoc($dataSet);
        echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniArttir">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniSayi' . $paylasim['paylasim_id'] . '"> Beğen (' . $paylasim['paylasim_begeni_sayisi'] . ')</span>
                                            </a>';
    } else {
        $sql = "select * from paylasim where paylasim_id=$paylasim";
        $dataSet = mysqli_query($con, $sql);
        $paylasim = mysqli_fetch_assoc($dataSet);
        echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniAzalt">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniSayi' . $paylasim['paylasim_id'] . '"> Beğenmekten vazgeç (' . $paylasim['paylasim_begeni_sayisi'] . ')</span>
                                            </a>';
    }
}

function yorumDurum($user, $paylasim, $yorum)
{

    $con = db_con();
     $sql = "select * from paylasim_yorum_begeni  where paylasim_yorum_user='$user' and paylasim_id='$paylasim' and paylasim_yorum_id='$yorum' ";
    $data = mysqli_query($con, $sql);
    if ($data != true) {
       mysqli_error($con);
    }else{

    }
     $sayi=mysqli_num_rows($data);

    if (mysqli_num_rows($data) == 0) {
        $sql = "select * from paylasim_yorum where yorum_id=$yorum";
        $dataSet = mysqli_query($con, $sql);
        $paylasim = mysqli_fetch_assoc($dataSet);
        echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumArttir">
                                                <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <span class="yorumId' . $paylasim['yorum_id'] . '" style="display:none">' . $paylasim['yorum_id'] . '</span>
                                                <i class="fa fa-star "></i>
                                                <span class="begeniYorumSayi' . $paylasim['yorum_id'] . '"> Beğen (' . $paylasim['yorum_begeni_sayisi'] . ')</span>
                                            </a>';
    } else {
        $sql = "select * from paylasim_yorum where yorum_id=$yorum";
        $dataSet = mysqli_query($con, $sql);
        $paylasim = mysqli_fetch_assoc($dataSet);
        echo '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumAzalt">
                                               <span class="payId' . $paylasim['paylasim_id'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>
                                                <span class="yorumId' . $paylasim['yorum_id'] . '" style="display:none">' . $paylasim['yorum_id'] . '</span>
                                                <i class="fa fa-star"></i>
                                                <span class="begeniYorumSayi' . $paylasim['yorum_id'] . '"> Beğenmenten Vazgeç (' . $paylasim['yorum_begeni_sayisi'] . ')</span>
                                            </a>';
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
       <div class="paylasilanAlan" style="width: 90%;margin-left: 52px;border: 1px solid blue;padding: 3%;margin-top: 3%;margin-bottom: 3%;">
         <div class="user-block">
         ';
            if ($uyePaylasim[0]['user_profil_resim'] != '') {
                echo '<img src="uploads/user/' . $uyePaylasim[0]['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
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
            ' . $veri['paylasim_icerik'] . '';
            if ($veri['paylasim_resim_id'] != '') {
                echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
                                            <img class="img-responsive" style="    width: 60%;" src="uploads/paylasim/' . $veri['paylasim_resim_id'] . '" >
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
    echo $islem = $durum;
    $db = db_con();
    $sql = "select * from users where user_id='$id'";
    $data = mysqli_query($db, $sql);
    if ($data) {
        $veri = mysqli_fetch_assoc($data);
        echo 'oturum :' . $id;
        echo 'arrtırılan kullanıcı' . $id2;
        if ($islem == 'follow') {
            echo 'eski' . $arttir = $veri['user_takip_edilen_sayi'];
            echo 'yeni' . $arttir = $veri['user_takip_edilen_sayi'] + 1;
            $sqls = "update users set user_takip_edilen_sayi='$arttir' where user_id='$id'";
            $datas = mysqli_query($db, $sqls);
            if ($datas) {
                $sqla = "select * from users where user_id='$id2'";
                $dataa = mysqli_query($db, $sqla);
                $veri = mysqli_fetch_assoc($dataa);
                echo 'eski' . $veri['user_takipci_sayi'];
                echo $arttir = $veri['user_takipci_sayi'] + 1;
                $sqlss = "update users set user_takipci_sayi='$arttir' where user_id='$id2'";
                $datass = mysqli_query($db, $sqlss);

            }
        } else if ($islem == 'unfollow') {
            echo 'eski' . $eksilt = $veri['user_takip_edilen_sayi'];
            echo $eksilt = $veri['user_takip_edilen_sayi'] - 1;
            $sqls = "update users set user_takip_edilen_sayi='$eksilt' where user_id='$id'";
            $datas = mysqli_query($db, $sqls);
            if ($datas) {
                $sqla = "select * from users where user_id='$id2'";
                $dataa = mysqli_query($db, $sqla);
                $veri = mysqli_fetch_assoc($dataa);
                echo 'eski' . $veri['user_takipci_sayi'];
                echo $arttir = $veri['user_takipci_sayi'] - 1;
                $sqlss = "update users set user_takipci_sayi='$arttir' where user_id='$id2'";
                $datass = mysqli_query($db, $sqlss);
            }
        }

    }
}


function bildirimPay($str,$baglanti,$bildirimType){
    date_default_timezone_set('Istanbul');
    $tarih = date('Y-m-d H:i:s' , time() + 3600);
    $db=db_con();
    $id=$_SESSION['user'];
    $htag = '**';
    $user='@';
    $arr = explode(" ", $str);
    $arrc = count($arr);
    $i = 0;



    while($i<$arrc){
        if(substr($arr[$i],0,1)==$user){
            $kAdi=substr($arr[$i],1);
            $parcala=explode('@',$kAdi);
            //var_dump($parcala);
            $gidenUser=$parcala[0];


            $sql = "select * from users where username='$gidenUser'";
            $data = mysqli_query($db, $sql);
            if($data==true){
                if (mysqli_num_rows($data)>0){
                    $uyeVeri=mysqli_fetch_assoc($data);
                    $uyeId=$uyeVeri['user_id'];
                    $sqlBildirim="insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$id','$baglanti','$bildirimType','0','$uyeId','$tarih')";
                    if(mysqli_query($db,$sqlBildirim)!=true){
                        echo mysqli_error($db);
                    }

                }
            }else{
                echo mysqli_error($db);
            }

          //  $arr[$i]='<a href="user.php?id='.$kAdi.'">'.$arr[$i].'</a>';
        }else{

            $sql = "select * from paylasim where paylasim_url='$baglanti'";
            $data = mysqli_query($db, $sql);
            if($data==true){
                if (mysqli_num_rows($data)>0){
                    $payVeri=mysqli_fetch_assoc($data);
                    $userPayId=$payVeri['user_id'];
                    if($id==$userPayId){
                        return false;
                    }

                }
            }
            $sql = "select * from paylasim where paylasim_url='$baglanti'";
            $data = mysqli_query($db, $sql);
            if($data==true){
                if (mysqli_num_rows($data)>0){
                    $uyeVeri=mysqli_fetch_assoc($data);
                    $uyeId=$uyeVeri['user_id'];
                    $sqlBildirim="insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$id','$baglanti','yorumEtiketsiz','0','$uyeId','$tarih')";
                    if(mysqli_query($db,$sqlBildirim)!=true){
                        echo mysqli_error($db);
                    }else{
                        break;
                    }

                }
            }else{
                echo mysqli_error($db);
            }
        }
        $i++;

    }
    $string=implode(" ",$arr);
    return $string;
}



function hashtag($str)
{




    $htag = '**';
    $user='@';
    $video='https://www';
    $arr = explode(" ", $str);
    $arrc = count($arr);
    $i = 0;
    while($i<$arrc){
        if(substr($arr[$i],0,2)==$htag){
            $arr[$i]='<a href="hashtag.php?kelime='. $arr[$i].'">'.$arr[$i].'</a>';
        }else if(substr($arr[$i],0,1)==$user){
            $kAdi=substr($arr[$i],1);


            $arr[$i]='<a href="user.php?id='.$kAdi.'">'.$arr[$i].'</a>';
        }else if(substr($arr[$i],0,11)==$video){
            //$metin=str_replace('watch?v=','embed/',$arr[$i]);
            $parcala=explode('/watch?v=',$arr[$i]);
            $arr[$i]='<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$parcala[1].'" frameborder="0" allowfullscreen></iframe>';
        }
        $i++;

    }
    $string=implode(" ",$arr);
    return nl2br($string);
}

function devamOku($metin){

}