<?php
session_start();
/**     $ayirSayfa=explode('/',$sayfa);
// var_dump($ayirSayfa);
$bulSayfa=explode('?',$ayirSayfa[3]);
$sayfaAdi=$bulSayfa[0]; */
if (isset($_POST['id'])) {
    include("../db_con.php");
    include("../fonksiyon.php");
    $db = db_con();

    ob_clean();
    $user = $_SESSION['user'];
    $sayfa=mysqli_real_escape_string($db,$_POST['sayfa']);
    $ayirSayfa=explode('/',$sayfa);
// var_dump($ayirSayfa);
    $bulSayfa=explode('?',$ayirSayfa[3]);
    $sayfaAdi=$bulSayfa[0];

    header('Content-Type: text/plain; charset=utf-8');
    $id=mysqli_real_escape_string($db,$_POST['id']);
    //  PAylaşım göstermek için öncelikle  üyenin takip ettiği kişileri  bulalım
    $output = array();
    //üyenin kendi id sini bir diziye atalım sonrada  takip ettiği kişilerin
    array_push($output, $user);
    $query = "SELECT * FROM takip where user_id='$user'";
    $result = mysqli_query($db, $query);
    if($result!=true)
    {
        echo 'hata'.mysqli_error($db);
    }else{
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // takip ettiği kişileri diziye atıyoruz
                array_push($output, $row['takip_edilen_id']);
            }
        }else{
            echo ' ';
        }
    }

    //  var_dump($output);
    if($sayfaAdi=="index.php"){
        $sql = "select * from paylasim where paylasim_id <$id ORDER BY paylasim_id DESC   ";

    }else if ($sayfaAdi=="user.php"){
        $kelimeBul=explode("=",$bulSayfa[1]);
        $veriUye=uyeBulProfil($kelimeBul[1]);
        $sql = "select * from paylasim where paylasim_id <$id and user_id=".$veriUye[0]['user_id']." ORDER BY  paylasim_id DESC  ";
    }else if($sayfaAdi=="hashtag.php"){
        $kelimeBul=explode("=",$bulSayfa[1]);

        $sql = "select * from paylasim where paylasim_id <$id and paylasim_icerik like   '%$kelimeBul[1]%' ORDER BY  paylasim_id DESC ";
    }

    $dataSet = mysqli_query($db, $sql);
    if($dataSet!=true)
    {
        //echo 'hata'.mysqli_error($db);
    }
    else{
        if(mysqli_num_rows($dataSet)>0){

            $kayitSayi=mysqli_num_rows($dataSet);


            if($kayitSayi>0){
                $sayacPay=1;
                $sayacLimit=0;
                while ($paylasim = mysqli_fetch_assoc($dataSet)) {
                    $sayacPay=$paylasim['paylasim_id'];


                    //Gelen user id yi takipçiler dizisi içöinde karşılaştıralım
                    $aranacak = $paylasim['user_id'];
                    if($sayacLimit==10) break;
                    if (in_array($aranacak, $output) && $sayfaAdi=="index.php") {

                        $sayacLimit++;
                        $kontrokPaylasimSikayet = paylasimSikayetKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'sikayet');
                        $kontrokPaylasimEngel = paylasimEngelKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'engel');
                        $kontrokPaylasimGizle = paylasimGizleKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'gizle');
                        if ($kontrokPaylasimEngel == 1) {
                            $gonderiDurum = '1';
                        } elseif ($kontrokPaylasimGizle == 1) {
                            $gonderiDurum = '1';
                        } else {
                            $gonderiDurum = '0';
                        }

                        if ($gonderiDurum == 0) {


                            echo '
                            <div data-num="' . $paylasim['paylasim_id'] . '" class="nav-tabs-custom paylasimAlan paylasimAlan' . $paylasim['paylasim_id'] . '">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">';
                            //paylaşimsahibi üyenin bilgileri
                            $uyePaylasim = array();
                            $uyePaylasim = uyeBul($paylasim['user_id']);
                            if ($uyePaylasim[0]['user_profil_resim'] != '') {
                                echo '<img src="uploads/user/' . $uyePaylasim[0]['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
                            } else {
                                echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                            }
                            echo '      <span class="username username' . $uyePaylasim[0]['user_id'] . '">
                                          <a href="user.php?id=' . $uyePaylasim[0]['username'] . '">' . $uyePaylasim[0]['user_adi'] . ' ' . $uyePaylasim[0]['user_soyadi'] .
                                ' <a style="font-size: 13px;color: #8899a6;">@' . $uyePaylasim[0]['username'] . '</a></a>
                                         ';

                            echo '<a href="#" data-toggle="modal" data-id="' . $paylasim['paylasim_id'] . '" data-target="#silModal"  id="silPayID' . $uyePaylasim[0]['user_id'] . '"" class="pull-right btn-box-tool sil"><i class="fa fa-times"></i></a>
                                            <span class="silId" style="display:none;">' . $paylasim['paylasim_id'] . '</span>
                                            <span class="silUserId" style="display:none;">' . $paylasim['user_id'] . '</span>
                                         </span>
                                        <span class="description">Paylaşım tarihi ' . zaman($paylasim['paylasim_tarihi']) . '</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                      ' . hashtag($paylasim['paylasim_icerik']) . '
                                     ';
                            if ($paylasim['paylasim_resim_id'] != '') {
                                echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
                                         <a href="uploads/paylasim/' . $paylasim['paylasim_resim_id'] . '" data-lightbox="image-1" >
                                    <img style="width: 64%;margin: 0px auto;"  src="uploads/paylasim/' . $paylasim['paylasim_resim_id'] . '" class="img-responsive ">
                                    </a>
                                         </div>
                                      </div>';
                            }
                            if ($paylasim['paylasim_sahibi'] != '0') {
                                paylasimSahibDurum($paylasim['paylasim_sahibi']);
                            }
                            echo '
                                    </p>
                                    <ul class="list-inline">
                                        <li>
                                            <input type="hidden" value="'. $paylasim['paylasim_id'].'">
                                            <a id="" href="#" onclick="return false" data-toggle="modal" data-target="#myModal" class="link-black text-sm payPaylas">
                                            ';
                            if ($paylasim['paylasim_sahibi'] > 0) {
                                echo '<span class="payPayId' . $paylasim['paylasim_sahibi'] . '" style="display:none">' . $paylasim['paylasim_sahibi'] . '</span>';

                            }else{
                                echo '<span class="payPayId' . $paylasim['paylasim_sahibi'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>';

                            }
                            echo '
                                                <i class="fa fa-moon-o"></i>
                                                <span class="payPaylasimSayisi' . $paylasim['paylasim_id'] . '"> Paylaş 
                                               <a href="#" data-toggle="modal"  data-num="' . $paylasim['paylasim_id'] . '" data-target="#payKisiGoster" class="gosterPaySayi"> 
                                               ('.paySayiBul($paylasim['paylasim_id']).')
                                                </a>
                                            
                                         
                                            </a>
                                        </li>
                                        <li class="begeniLi' . $paylasim['paylasim_id'] . '">
                                            ';
                            echo begeniDurum($_SESSION['user'], $paylasim['paylasim_id']);
                            $place="Yorum yap, paylaşmak için Enter'e bas";
                            echo '
                                        </li>
                                        <li>
                                              <input type="hidden" value="' . $paylasim['paylasim_id'] . '" class="yorumClickID">
                                            <a href="#"    class="yorumClick link-black text-sm">
                                                <i class="fa fa-comments-o "> </i> Yorumlar('.yorumSayi($paylasim['paylasim_id']).')
                                            </a>
                                            
                                            </li>
                                    </ul>
                                        <div >
                                          <input id="paylasimID" class="paylasimID" type="hidden" value="' . $paylasim['paylasim_id'] . '"/>
                                        
                                         
                                        <textarea id="yorumPaylasim" name="yorum"  class="form-control yorumPaylasim"
                                          required     placeholder="'.$place.'" ></textarea>
                                          <div class="col-sm-3">
                     <!--   <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>-->
                      </div>
                                           <div style="float: right;position: relative;top:-28px;z-index: 1;left: 7%">
                                             <i  class=" fa fa-picture-o  margin-r-5 "></i>       
                                             <div class="yorumResimInput">
                                              <input  style="float: right;position: relative;width: 50px;z-index: 0;left: -35px;"   required id="resimYorum" name="resimYorum" class="dosyaYukle fa fa-picture-o  margin-r-5 " type="file">

                                             </div>   
                                      
                                           </div>
                                          
                                        </div>
                                          ';

                            echo '<div class="yorumAnaBolum' . $paylasim['paylasim_id'] . '">';
                            $paylasimId = $paylasim['paylasim_id']; // paylasim idsi
                            $sayac = 1;
                            $sqlYorum = "select paylasim_id from paylasim_yorum where paylasim_id=$paylasimId ";
                            $dataYorum = mysqli_query($db, $sqlYorum);
                            $sayi = mysqli_num_rows($dataYorum);
                            $sqlYorum = "select * from paylasim_yorum where paylasim_id=$paylasimId  ORDER by yorum_tarih ASC  limit 2";
                            $dataYorum = mysqli_query($db, $sqlYorum);
                            if ($dataYorum == true) {

                                while ($yorum = mysqli_fetch_assoc($dataYorum)) {
                                    $uyeYorum = array();
                                    $uyeYorum = uyeBul($yorum['paylasim_yorum_user']);
                                    // var_dump($uyeYorum);
                                    echo ' 
                                        <!-- Yorum bölümü başlar -->        
                                    <div  class="yorumBolum yorumBolum' . $yorum['yorum_id'] . '" style="padding: 0;margin-top: 3%;margin-left:5%; border-top:1px solid">
                                        <div class="user-block" style=" padding: 0;margin-top: 3%;">'; ?>
                                    <?php
                                    if ($uyeYorum[0]['user_profil_resim'] != '') {
                                        echo '<img src="uploads/user/' . $uyeYorum[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
                                    } else {
                                        echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                    }
                                    echo '  <span class="username">
                                                             <input  class="yorumSilID" type="hidden" value="' . $yorum['yorum_id'] . '"/> 
                                                            <input class="yorumSilUserID" type="hidden" value="' . $yorum['paylasim_yorum_user'] . '"/> 
                                                           '; ?>
                                    <?php
                                    if ($_SESSION['user_type'] == 'yetkili') {
                                        echo '     <a href="" onclick="return false"    class="pull-right btn-box-tool yorumSil">
                                                         
                                                       
                                                              <i class="fa fa-times"></i>
                                                          </a>
                                                      ';
                                    } else if ($_SESSION['user'] == $yorum['paylasim_yorum_user']) {
                                        echo '     <a href="" onclick="return false"     class="pull-right btn-box-tool yorumSil">
                                                         
                                                       
                                                              <i class="fa fa-times"></i>
                                                          </a>
                                                      ';
                                    }
                                    ?>
                                    <a href="user.php?id=<?php echo $uyeYorum[0]['username'] ?>"><?php echo isimBul($yorum['paylasim_yorum_user']) ?></a>
                                    <?php
                                    echo ' <span style="margin-left: 0px;" class="description">Yorum tarihi ' . zaman($yorum['yorum_tarih']) . '</span>
                                                </span>
                                               
                                            <span class="description ng-binding" style="margin-top: 3%;">
                                             <p >' . hashtag($yorum['yorum_icerik']) . '</p>
                                             ';
                                    if ($yorum['yorum_resim_id'] != '') {
                                        echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12" style="margin-bottom: 3%;">
                                            <img style="width: 50%;height: 50%;" class="img-responsive" src="uploads/paylasim/' . $yorum['yorum_resim_id'] . '" >
                                         </div>
                                      </div>';
                                    }
                                    echo '
                                                  <ul class="list-inline">
                                           
                                            <li class="yorumBegeniLi' . $yorum['yorum_id'] . '">
                                                 ';
                                    echo yorumDurum($_SESSION['user'], $yorum['paylasim_id'], $yorum['yorum_id']);
                                    echo '
                                            </li>

                                                 </ul>
                                                </span>
                                        </div>
                                    </div>
                                     <!-- Yorum bölümü biter -->
                                    
                    
                                     ';
                                    if ($sayi > 2) {
                                        if ($sayac >= 2) {
                                            echo '<a class="yorumGoster"  id="' . $yorum['paylasim_id'] . '"  href="" style="text-align: center">  <input id="veriPay"  type="hidden" value="' . $yorum['paylasim_id'] . '"> Tüm yorumları görmek için tıklayınız</a>
';
                                        }
                                    }
                                    $sayac++;
                                }

                            }

                            echo '
                                    
                                    
                                 </div>    
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                           
                        </div>
                        <!-- /.tab-content -->
                    </div>';

                        }

                    }else if($sayfaAdi=="user.php" || $sayfaAdi=="hashtag.php"){

                        $kontrokPaylasimSikayet = paylasimSikayetKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'sikayet');
                        $kontrokPaylasimEngel = paylasimEngelKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'engel');
                        $kontrokPaylasimGizle = paylasimGizleKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'gizle');
                        if ($kontrokPaylasimEngel == 1) {
                            $gonderiDurum = '1';
                        } elseif ($kontrokPaylasimGizle == 1) {
                            $gonderiDurum = '1';
                        } else {
                            $gonderiDurum = '0';
                        }

                        if ($gonderiDurum == 0) {


                            echo '
                            <div data-num="' . $paylasim['paylasim_id'] . '" class="nav-tabs-custom paylasimAlan paylasimAlan' . $paylasim['paylasim_id'] . '">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">';
                            //paylaşimsahibi üyenin bilgileri
                            $uyePaylasim = array();
                            $uyePaylasim = uyeBul($paylasim['user_id']);
                            if ($uyePaylasim[0]['user_profil_resim'] != '') {
                                echo '<img src="uploads/user/' . $uyePaylasim[0]['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
                            } else {
                                echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                            }
                            echo '      <span class="username username' . $uyePaylasim[0]['user_id'] . '">
                                          <a href="user.php?id=' . $uyePaylasim[0]['username'] . '">' . $uyePaylasim[0]['user_adi'] . ' ' . $uyePaylasim[0]['user_soyadi'] .
                                ' <a style="font-size: 13px;color: #8899a6;">@' . $uyePaylasim[0]['username'] . '</a></a>
                                         ';

                            echo '<a href="#" data-id="' . $paylasim['paylasim_id'] . '" data-toggle="modal" data-target="#silModal"  id="silPayID' . $uyePaylasim[0]['user_id'] . '"" class="pull-right btn-box-tool sil"><i class="fa fa-times"></i></a>
                                            <span class="silId" style="display:none;">' . $paylasim['paylasim_id'] . '</span>
                                            <span class="silUserId" style="display:none;">' . $paylasim['user_id'] . '</span>
                                         </span>
                                        <span class="description">Paylaşım tarihi ' . zaman($paylasim['paylasim_tarihi']) . '</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                      ' . hashtag($paylasim['paylasim_icerik']) . '
                                     ';
                            if ($paylasim['paylasim_resim_id'] != '') {
                                echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
                                         <a href="uploads/paylasim/' . $paylasim['paylasim_resim_id'] . '" data-lightbox="image-1" >
                                    <img style="width: 64%;margin: 0px auto;"  src="uploads/paylasim/' . $paylasim['paylasim_resim_id'] . '" class="img-responsive ">
                                    </a>
                                         </div>
                                      </div>';
                            }
                            if ($paylasim['paylasim_sahibi'] != '0') {
                                paylasimSahibDurum($paylasim['paylasim_sahibi']);
                            }
                            echo '
                                    </p>
                                    <ul class="list-inline">
                                        <li>
                                            <input type="hidden" value="'. $paylasim['paylasim_id'].'">
                                            <a id="" href="#" onclick="return false" data-toggle="modal" data-target="#myModal" class="link-black text-sm payPaylas">
                                            ';
                            if ($paylasim['paylasim_sahibi'] > 0) {
                                echo '<span class="payPayId' . $paylasim['paylasim_sahibi'] . '" style="display:none">' . $paylasim['paylasim_sahibi'] . '</span>';

                            }else{
                                echo '<span class="payPayId' . $paylasim['paylasim_sahibi'] . '" style="display:none">' . $paylasim['paylasim_id'] . '</span>';

                            }
                            echo '
                                                <i class="fa fa-moon-o"></i>
                                                <span class="payPaylasimSayisi' . $paylasim['paylasim_id'] . '"> Paylaş 
                                               <a href="#" data-toggle="modal"  data-num="' . $paylasim['paylasim_id'] . '" data-target="#payKisiGoster" class="gosterPaySayi"> 
                                               ('.paySayiBul($paylasim['paylasim_id']).')
                                                </a>
                                            
                                         
                                            </a>
                                        </li>
                                        <li class="begeniLi' . $paylasim['paylasim_id'] . '">
                                            ';
                            echo begeniDurum($_SESSION['user'], $paylasim['paylasim_id']);
                            echo '
                                        </li>
                                        <li>
                                              <input type="hidden" value="' . $paylasim['paylasim_id'] . '" class="yorumClickID">
                                            <a href="#"    class="yorumClick link-black text-sm">
                                                 <i class="fa fa-comments-o "> </i> Yorumlar('.yorumSayi($paylasim['paylasim_id']).')
                                            </a>
                                            
                                            </li>
                                    </ul>
                                        <div >
                                          <input id="paylasimID" class="paylasimID" type="hidden" value="' . $paylasim['paylasim_id'] . '"/>
                                        
                                         
                                         <textarea id="yorumPaylasim" name="yorum"  class="form-control yorumPaylasim"
                                          required     placeholder="Birşeyler ve Entere bas..." ></textarea>
                                          <div class="col-sm-3">
                     <!--   <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>-->
                      </div>
                                           <div style="float: right;position: relative;top:-28px;z-index: 1;left: 4%">
                                             <i  class=" fa fa-picture-o  margin-r-5 "></i>       
                                             <div class="yorumResimInput">
                                              <input  style="float: right;position: relative;width: 50px;z-index: 0;left: -35px;"   required id="resimYorum" name="resimYorum" class="dosyaYukle fa fa-picture-o  margin-r-5 " type="file">

                                             </div>   
                                      
                                           </div>
                                          
                                        </div>
                                          ';

                            echo '<div class="yorumAnaBolum' . $paylasim['paylasim_id'] . '">';
                            $paylasimId = $paylasim['paylasim_id']; // paylasim idsi
                            $sayac = 1;
                            $sqlYorum = "select paylasim_id from paylasim_yorum where paylasim_id=$paylasimId ";
                            $dataYorum = mysqli_query($db, $sqlYorum);
                            $sayi = mysqli_num_rows($dataYorum);
                            $sqlYorum = "select * from paylasim_yorum where paylasim_id=$paylasimId  ORDER by yorum_tarih ASC  limit 2";
                            $dataYorum = mysqli_query($db, $sqlYorum);
                            if ($dataYorum == true) {

                                while ($yorum = mysqli_fetch_assoc($dataYorum)) {
                                    $uyeYorum = array();
                                    $uyeYorum = uyeBul($yorum['paylasim_yorum_user']);
                                    // var_dump($uyeYorum);
                                    echo ' 
                                        <!-- Yorum bölümü başlar -->        
                                    <div  class="yorumBolum yorumBolum' . $yorum['yorum_id'] . '" style="padding: 0;margin-top: 3%;margin-left:5%; border-top:1px solid">
                                        <div class="user-block" style=" padding: 0;margin-top: 3%;">'; ?>
                                    <?php
                                    if ($uyeYorum[0]['user_profil_resim'] != '') {
                                        echo '<img src="uploads/user/' . $uyeYorum[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
                                    } else {
                                        echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                    }
                                    echo '  <span class="username">
                                                             <input  class="yorumSilID" type="hidden" value="' . $yorum['yorum_id'] . '"/> 
                                                            <input class="yorumSilUserID" type="hidden" value="' . $yorum['paylasim_yorum_user'] . '"/> 
                                                           '; ?>
                                    <?php
                                    if ($_SESSION['user_type'] == 'yetkili') {
                                        echo '     <a href="" onclick="return false"    class="pull-right btn-box-tool yorumSil">
                                                         
                                                       
                                                              <i class="fa fa-times"></i>
                                                          </a>
                                                      ';
                                    } else if ($_SESSION['user'] == $yorum['paylasim_yorum_user']) {
                                        echo '     <a href="" onclick="return false"     class="pull-right btn-box-tool yorumSil">
                                                         
                                                       
                                                              <i class="fa fa-times"></i>
                                                          </a>
                                                      ';
                                    }
                                    ?>
                                    <a href="user.php?id=<?php echo $uyeYorum[0]['username'] ?>"><?php echo isimBul($yorum['paylasim_yorum_user']) ?></a>
                                    <?php
                                    echo ' <span style="margin-left: 0px;" class="description">Yorum tarihi ' . zaman($yorum['yorum_tarih']) . '</span>
                                                </span>
                                               
                                            <span class="description ng-binding" style="margin-top: 3%;">
                                             <p >' . hashtag($yorum['yorum_icerik']) . '</p>
                                             ';
                                    if ($yorum['yorum_resim_id'] != '') {
                                        echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12" style="margin-bottom: 3%;">
                                            <img style="width: 50%;height: 50%;" class="img-responsive" src="uploads/paylasim/' . $yorum['yorum_resim_id'] . '" >
                                         </div>
                                      </div>';
                                    }
                                    echo '
                                                  <ul class="list-inline">
                                           
                                            <li class="yorumBegeniLi' . $yorum['yorum_id'] . '">
                                                 ';
                                    echo yorumDurum($_SESSION['user'], $yorum['paylasim_id'], $yorum['yorum_id']);
                                    echo '
                                            </li>

                                                 </ul>
                                                </span>
                                        </div>
                                    </div>
                                     <!-- Yorum bölümü biter -->
                                    
                    
                                     ';
                                    if ($sayi > 2) {
                                        if ($sayac >= 2) {
                                            echo '<a class="yorumGoster"  id="' . $yorum['paylasim_id'] . '"  href="" style="text-align: center">  <input id="veriPay"  type="hidden" value="' . $yorum['paylasim_id'] . '"> Tüm yorumları görmek için tıklayınız</a>
';
                                        }
                                    }
                                    $sayac++;
                                }

                            }

                            echo '
                                    
                                    
                                 </div>    
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                           
                        </div>
                        <!-- /.tab-content -->
                    </div>';

                        }


                    }
                }
                echo '<input type="hidden" class="sonPayId" value="'.$sayacPay.'">';
            }else{
                echo ' ';
            }

        }else{
            echo ' ';
        }
    }






}else{
    echo ' ';
}



?>