<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
$db=db_con();
date_default_timezone_set('Asia/Kuwait');
$tarih= date("Y-m-d H:i:s");
if(isset($_SESSION['user'])){

    if(isset($_POST['payId']) and isset($_POST['yorumId']) and !isset($_POST['durum'])){

        // user
        $user=$_SESSION['user'];
        // Begenilen paylaşım id
        $paylasim=mysqli_real_escape_string($db,$_POST['payId']);
        $yorum=mysqli_real_escape_string($db,$_POST['yorumId']);


        $sqlBegeni="insert into paylasim_yorum_begeni (paylasim_yorum_user,paylasim_id,paylasim_yorum_id,yorum_bg_tarih)
                        VALUES ('$user','$paylasim','$yorum','$tarih')   ";
        $sqlBegeniData=mysqli_query($db,$sqlBegeni);
        if ($sqlBegeniData==true) {
            $sqlGetPaylasim="select yorum_begeni_sayisi,yorum_id from paylasim_yorum where yorum_id='$yorum'";
            $sqlGetPaylasimData=mysqli_query($db,$sqlGetPaylasim);
            if($sqlGetPaylasimData==true){
                $getPaylasim=mysqli_fetch_assoc($sqlGetPaylasimData);
                $yeniBegeniSayisi=$getPaylasim['yorum_begeni_sayisi']+1;
                $sqlPaylasim="update paylasim_yorum set yorum_begeni_sayisi='$yeniBegeniSayisi' WHERE  yorum_id='$yorum'";
                $dataSet=mysqli_query($db,$sqlPaylasim);
                if ($dataSet) {
                    echo $yeniBegeniSayisi;
                    /*** beğeni sayisi arttır */
                    $sql = "select * from paylasim_yorum where yorum_id='$yorum'";
                    $data = mysqli_query($db, $sql);
                    if($data==true){
                        if (mysqli_num_rows($data)>0){
                            $uyeVeri=mysqli_fetch_assoc($data);
                            $uyeId=$uyeVeri['paylasim_yorum_user'];
                            $sql = "select * from paylasim where paylasim_id='$paylasim'";
                            $data = mysqli_query($db, $sql);
                            $uyeVeriPay=mysqli_fetch_assoc($data);
                            $baglanti=$uyeVeriPay['paylasim_url'];
                            $bildirimType='yorumbegeni';
                            if($user!=$uyeId) {
                                $sqlBildirim = "insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$user','$baglanti','$bildirimType','0','$uyeId','$tarih')";
                                $queryBildirim = mysqli_query($db, $sqlBildirim);
                                if ($queryBildirim != true) {
                                    echo mysqli_error($db);
                                }

                            }

                        }else{
                            echo '0 dan büyük değil';
                        }
                    }else{
                        echo mysqli_error($db);
                    }
                }else{
                    echo '0';
                }
            }else{
                echo '0';
            }


        }
    }else if(isset($_POST['payId']) and isset($_POST['yorumId']) and isset($_POST['durum'])){

        // user
        $user=$_SESSION['user'];
        // Begenilen paylasim id
        $paylasim=mysqli_real_escape_string($db,$_POST['payId']);
        $yorum=mysqli_real_escape_string($db,$_POST['yorumId']);

        $sqlBegeni="delete from paylasim_yorum_begeni where paylasim_yorum_user='$user' and paylasim_id='$paylasim' and paylasim_yorum_id='$yorum' ";
        $sqlBegeniData=mysqli_query($db,$sqlBegeni);
        if ($sqlBegeniData==true) {
            $sqlGetPaylasim="select yorum_begeni_sayisi,yorum_id from paylasim_yorum where yorum_id='$yorum'";
            $sqlGetPaylasimData=mysqli_query($db,$sqlGetPaylasim);
            if($sqlGetPaylasimData==true){
                $getPaylasim=mysqli_fetch_assoc($sqlGetPaylasimData);
                $yeniBegeniSayisi=$getPaylasim['yorum_begeni_sayisi']-1;
                $sqlPaylasim="update paylasim_yorum set yorum_begeni_sayisi='$yeniBegeniSayisi' WHERE  yorum_id='$yorum'";
                $dataSet=mysqli_query($db,$sqlPaylasim);
                if ($dataSet) {
                    echo $yeniBegeniSayisi;

                    /*** beğeni sayisi arttır */
                    $sql = "select * from paylasim_yorum where yorum_id='$yorum'";
                    $data = mysqli_query($db, $sql);
                    if($data==true){
                        if (mysqli_num_rows($data)>0){
                            $uyeVeri=mysqli_fetch_assoc($data);
                            $uyeId=$uyeVeri['paylasim_yorum_user'];
                            $sql = "select * from paylasim where paylasim_id='$paylasim'";
                            $data = mysqli_query($db, $sql);
                            $uyeVeriPay=mysqli_fetch_assoc($data);
                            $baglanti=$uyeVeriPay['paylasim_url'];
                            $bildirimType='paybegeni';
                            if($user!=$uyeId){
                                $sqlBildirim="delete from bildirimler WHERE user_gelen_id='$user' 
                                                                    and bildirim_baglanti='$baglanti' 
                                                                      and bildirim_type='yorumbegeni'";
                                $queryBildirim= mysqli_query($db,$sqlBildirim);
                                if($queryBildirim!=true){
                                    echo mysqli_error($db);
                                }
                            }


                        }
                    }else{
                        echo mysqli_error($db);
                    }


                }else{
                    echo mysqli_error($db);
                }
            }else{
                echo mysqli_error($db);
            }


        }else{
            echo mysqli_error($db);
        }

    }else{
        echo 'gelmedi';
    }



}else{
    echo 'gelen user yok';
}

