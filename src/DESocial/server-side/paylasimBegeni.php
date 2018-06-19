<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
$db=db_con();

if(isset($_SESSION['user'])){

    if(isset($_POST['payId']) and !isset($_POST['durum'])){
        date_default_timezone_set('Asia/Kuwait');
        $tarih = date('Y-m-d H:i:s' );
        // user
        $user=$_SESSION['user'];
        // Begenilen paylaşım id
        $paylasim=mysqli_real_escape_string($db,$_POST['payId']);

        $sqlBegeni="insert into paylasim_begeni (bg_user_id,bg_tarihi,bg_pay_id)
                        VALUES ('$user','$tarih','$paylasim')   ";
        $sqlBegeniData=mysqli_query($db,$sqlBegeni);
        if ($sqlBegeniData==true) {
            $sqlGetPaylasim="select paylasim_begeni_sayisi,paylasim_id from paylasim where paylasim_id='$paylasim'";
            $sqlGetPaylasimData=mysqli_query($db,$sqlGetPaylasim);
            if($sqlGetPaylasimData==true){
                $getPaylasim=mysqli_fetch_assoc($sqlGetPaylasimData);
                $yeniBegeniSayisi=$getPaylasim['paylasim_begeni_sayisi']+1;
                $sqlPaylasim="update paylasim set paylasim_begeni_sayisi='$yeniBegeniSayisi' WHERE paylasim_id=$paylasim";
                $dataSet=mysqli_query($db,$sqlPaylasim);
                if ($dataSet) {
                    echo $yeniBegeniSayisi;

                    /*** beğeni sayisi arttır */
                    $sql = "select * from paylasim where paylasim_id='$paylasim'";
                    $data = mysqli_query($db, $sql);
                    if($data==true){
                        if (mysqli_num_rows($data)>0){
                            $uyeVeri=mysqli_fetch_assoc($data);
                            $uyeId=$uyeVeri['user_id'];
                            $baglanti=$uyeVeri['paylasim_url'];
                            $bildirimType='paybegeni';
                            if($user!=$uyeId){
                                $sqlBildirim="insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$user','$baglanti','$bildirimType','0','$uyeId','$tarih')";
                                if(mysqli_query($db,$sqlBildirim)!=true){
                                    echo mysqli_error($db);
                                }
                            }else{
                                echo mysqli_error($db);

                            }


                        }else{
                            echo 'yok';
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


        }else{
            echo mysqli_error($db);
        }
    }else if(isset($_POST['payId']) and isset($_POST['durum'])){

        // user
        $user=$_SESSION['user'];
        // Begenilen paylaşım id
        $paylasim=mysqli_real_escape_string($db,$_POST['payId']);

        $sqlBegeni="delete from paylasim_begeni where bg_user_id='$user' and bg_pay_id='$paylasim' ";
        $sqlBegeniData=mysqli_query($db,$sqlBegeni);
        if ($sqlBegeniData==true) {
            $sqlGetPaylasim="select paylasim_begeni_sayisi,paylasim_id from paylasim where paylasim_id='$paylasim'";
            $sqlGetPaylasimData=mysqli_query($db,$sqlGetPaylasim);
            if($sqlGetPaylasimData==true){
                $getPaylasim=mysqli_fetch_assoc($sqlGetPaylasimData);
                $yeniBegeniSayisi=$getPaylasim['paylasim_begeni_sayisi']-1;
                $sqlPaylasim="update paylasim set paylasim_begeni_sayisi='$yeniBegeniSayisi' WHERE paylasim_id=$paylasim";
                $dataSet=mysqli_query($db,$sqlPaylasim);
                if ($dataSet) {

                    echo $yeniBegeniSayisi;
                    /*** beğeni sayisi arttır */
                    $sql = "select * from paylasim where paylasim_id='$paylasim'";
                    $data = mysqli_query($db, $sql);
                    if($data==true){
                        if (mysqli_num_rows($data)>0){
                            $uyeVeri=mysqli_fetch_assoc($data);
                            $uyeId=$uyeVeri['user_id'];
                            $baglanti=$uyeVeri['paylasim_url'];
                            $bildirimType='paybegeni';
                            if($user!=$uyeId){
                                $sqlBildirim="delete from bildirimler WHERE user_gelen_id='$user' 
                                                                    and bildirim_baglanti='$baglanti' 
                                                                      and bildirim_type='paybegeni'";
                                if(mysqli_query($db,$sqlBildirim)!=true){
                                    echo mysqli_error($db);
                                }
                            }


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

    }else{
        echo '0';
    }



}else{
    echo 'gelen user yok';
}

