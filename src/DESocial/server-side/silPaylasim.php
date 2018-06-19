<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
$db = db_con();
if (isset($_SESSION['user'])) {

    if (isset($_POST['payId'])) {
        $paylasim = mysqli_real_escape_string($db, $_POST['payId']);
        $user = $_SESSION['user'];
        $userPaylasim = mysqli_real_escape_string($db, $_POST['userPaylasim']);
        $durum = mysqli_real_escape_string($db, $_POST['durum']);
        $payBilgi = paylasimDetay($paylasim);
        if ($durum == "karsilastir") {
            if ($user == $userPaylasim) {
                echo 'ok';
            } else if ($_SESSION['user_type'] == 'yetkili' || $_SESSION['user_type'] == 'editor') {
                echo 'yetki';
            } else {
                if ($userPaylasim == $user) {
                    echo 'ok';
                } else {
                    echo 'no';
                }
            }


        } else if ($durum == 'paySil') {
            // Begenilen paylaşım id
            $paylasim = mysqli_real_escape_string($db, $_POST['payId']);

            $sqlBegeni = "delete from paylasim where paylasim_id='$paylasim' ";
            $sqlBegeniData = mysqli_query($db, $sqlBegeni);
            if ($sqlBegeniData == true) {
                $sqlGetPaylasim = "delete from paylasim_yorum where paylasim_id='$paylasim' ";
                $sqlGetPaylasimData = mysqli_query($db, $sqlGetPaylasim);
                if ($sqlGetPaylasimData == true) {
                    $sqlPaylasim = "delete from paylasim_begeni where bg_pay_id='$paylasim'";
                    $dataSet = mysqli_query($db, $sqlPaylasim);
                    if ($dataSet) {
                        $sqlPaylasim = "delete from paylasim_yorum_begeni where paylasim_id='$paylasim'";
                        $dataSet = mysqli_query($db, $sqlPaylasim);
                        if ($dataSet == true) {
                            //paylaşım bilgileri bul


                            $payBildirimId = $payBilgi[0]['paylasim_url'];

                            $sqlBildirim = "delete from bildirimler where bildirim_baglanti='$payBildirimId'";
                            $dataSetBildirim = mysqli_query($db, $sqlBildirim);
                            if ($dataSetBildirim == true) {
                                $sqlSikayet = "delete from sikayet where paylasim_id='$paylasim'";
                                $dataSetSikayet = mysqli_query($db, $sqlSikayet);
                                if ($dataSetSikayet == true) {
                                    echo 'ok';
                                } else {
                                    echo mysqli_error($db);
                                }
                            } else {
                                echo mysqli_error($db);
                            }
                        }

                    } else {
                        echo '0';
                    }
                } else {
                    echo '0';
                }


            } else {
                echo '0';
            }

        } else if ($durum == 'payGizle') {
            $sqlBegeni = "insert into sikayet (sikayet_eden_id,sikayet_user_id,paylasim_id,sikayet_type)
                                  VALUES ('$user','$userPaylasim','$paylasim','gizle') ";
            $sqlBegeniData = mysqli_query($db, $sqlBegeni);
            if ($sqlBegeniData == true) {
                echo 'ok';
            }

        } else if ($durum == 'userEngelle') {
            $sqlBegeni = "insert into sikayet (sikayet_eden_id,sikayet_user_id,paylasim_id,sikayet_type)
                                  VALUES ('$user','$userPaylasim','$paylasim','engel') ";
            $sqlBegeniData = mysqli_query($db, $sqlBegeni);
            if ($sqlBegeniData == true) {
                echo 'ok';
            }

        } else if ($durum == 'userSikayet') {

            $sqlKontrolSikayet = "select * from sikayet where paylasim_id='$paylasim'";
            $dataKontrolSikayet = mysqli_query($db, $sqlKontrolSikayet);
            if ($dataKontrolSikayet == true) {
                if (mysqli_num_rows($dataKontrolSikayet) > 0) {
                    echo 'sikayet';
                } else {
                    $sqlBegeni = "insert into sikayet (sikayet_eden_id,sikayet_user_id,paylasim_id,sikayet_type)
                                  VALUES ('$user','$userPaylasim','$paylasim','sikayet') ";
                    $sqlBegeniData = mysqli_query($db, $sqlBegeni);
                    if ($sqlBegeniData == true) {
                        echo 'sikayet';
                    }
                }
            }


        } else if ($durum == 'payDuz') {
            $sqlKontrolSikayet = "select * from paylasim where paylasim_id='$paylasim'";
            $dataKontrolSikayet = mysqli_query($db, $sqlKontrolSikayet);
            if ($dataKontrolSikayet == true) {
                if (mysqli_num_rows($dataKontrolSikayet) > 0) {
                    while ($satir = mysqli_fetch_assoc($dataKontrolSikayet)) {
                        $uye = uyeBul($satir['user_id']);
                        echo '
                               <div class="post">
                    <div class="user-block">';

                        if ($uye[0]['user_profil_resim'] != '') {
                            echo '<img src="uploads/user/' . $uye[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
                        } else {
                            echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                        }
                        echo '
                       
                        <form id="paylasForm" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="payIdDuzenle" id="payIdDuzenle" value="' . $satir['paylasim_id'] . '">
                                        <span class="username">
                                            <span class="username" style="float:left; margin:0;">

                                            <a href="#"  onclick="return false">' . $uye[0]['user_adi'] . ' ' . $uye[0]['user_soyadi'] . '</a>

                                         </span>
                                            <textarea id="paylasimYaziModaldu" name="nameModal" cols="1" rows="1"
                                                      class="form-control paylasimYazi "
                                                      required placeholder="Birşeyler Yaz" style="height: 50px;">' . $satir['paylasim_icerik'] . '</textarea>
                                             <span style="float: right;" class="sayacPa">&nbsp</span>
                                                <style>
                                                .keySonuc {
                                                    padding: 10px;
                                                    margin: 0 auto;
                                                    border: 1px solid silver;
                                                    background-color: rgb(255, 255, 255);

                                                    position: absolute;
                                                    width: 28.5%;
                                                }
                                               </style>
                                            <div id="keySonuc">

                                            </div>
                                        </span>
                            <div class="col-md-12" style="margin-top: 3%;">
                                <ul class="list-inline">
                                    <li style="margin-left: 5%;" id="resimPaylasimAlanModalDu">
                                    
                                        ';
                        if ($satir['paylasim_resim_id'] == '') {
                            echo '<a href="#" class="link-black text-sm">

                                            <i class="fa fa-camera  margin-r-5">
                                                <input required id="resimModaldu" name="resimModal"
                                                       class="dosyaYukle required resimdu" type="file">

                                            </i>
                                        </a>';
                        } else {
                            echo '<div class="col-sm-12">
                                        <a href="" id="duzenleReSil">Resmi Sil</a>
                                        <br>
                                         <a href="uploads/paylasim/' . $satir['paylasim_resim_id'] . '" data-lightbox="image-1" >
                                    <img style="width: 81%;margin: 0px auto;"  src="uploads/paylasim/' . $satir['paylasim_resim_id'] . '" class="img-responsive ">
                                    </a>
                                         </div>';
                        }

                        echo '
                                    </li>


                                </ul>
                                <div id="duResimGoster"></div>
                            </div>

                            <div class="col-md-11" style="margin-left: 4%;">
                                <span class="hata"></span>

                            </div>
                            <div class="col-md-11" style="margin-left: 4%;">
                                                <span class="loadBolum" style="display: none;">
                                                    <img src="img/begen-load.gif" alt="">
                                                   <div style="margin-top: 1%;margin-left: 8%;">
                                                        <span style="line-height: 5%;">Lütfen Bekleyin...</span>
                                                   </div>
                                                </span>

                            </div>
                        </form>
                    </div>
                    <!-- /.user-block -->


                </div>
                        ';
                    }
                } else {
                    echo 'kayityok';
                }
            }
        }else if ($durum == 'sSil') {
            if(isset($_POST['payId'])){
                if (!empty($_POST['payId'])){
                    $id=mysqli_real_escape_string($db,$_POST['payId']);
                    $sqlSikayet = "delete from sikayet where paylasim_id='$id'";
                    $dataSetSikayet = mysqli_query($db, $sqlSikayet);
                    if ($dataSetSikayet == true) {
                        echo 'ok';
                    } else {
                        echo mysqli_error($db);
                    }
                }
            }

        } else {

        }


    } else {
        echo '0';
    }


} else {
    echo 'gelen user yok';
}

