<?php
session_start();
//include_once 'durumKontrol.php';

include_once 'db_con.php';
$db=db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($db,"utf8");


if(isset($_POST['yorumId']) || !empty($_POST['yorumId'])){
    $idSet=mysqli_real_escape_string($db,$_POST['yorumId']);
    $yorumlar=array();
    $sayac=1;
   // $paylasimId=$paylasim['paylasim_id']; // paylasim idsi
    $sqlYorum="select * from paylasim_yorum where paylasim_id=$idSet  ORDER by yorum_tarih ASC  ";
    $dataYorum=mysqli_query($db,$sqlYorum);
    if ($dataYorum==true){
      //  var_dump(mysqli_fetch_assoc($dataYorum));
        $sayi= mysqli_num_rows($dataYorum);
        while($yorum=mysqli_fetch_assoc($dataYorum)){
            $uyeYorum=array();
            $uyeYorum=uyeBul($yorum['paylasim_yorum_user']);
            // var_dump($uyeYorum);
            echo ' 
                                        <!-- Yorum bölümü başlar -->        
                                    <div  class="yorumBolum yorumBolum'.$yorum['yorum_id'].'" style="padding: 0;margin-top: 3%;margin-left:5%; border-top:1px solid">
                                        <div class="user-block" style=" padding: 0;margin-top: 3%;">'; ?>
            <?php
            if ($uyeYorum[0]['user_profil_resim']!= '') {
                echo '<img src="uploads/user/'.$uyeYorum[0]['user_profil_resim'].'"  class="img-circle img-bordered-sm">';
            } else {
                echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

            }
            echo '  <span class="username">
                                                             <input  class="yorumSilID" type="hidden" value="'.$yorum['yorum_id'].'"/> 
                                                            <input class="yorumSilUserID" type="hidden" value="'.$yorum['paylasim_yorum_user'].'"/> 
                                                           '; ?>
            <?php
            if($_SESSION['user_type']=='yetkili' ) {
                echo '     <a href="" onclick="return false"    class="pull-right btn-box-tool yorumSil">
                                                         
                                                       
                                                              <i class="fa fa-times"></i>
                                                          </a>
                                                      ';
            }else if($_SESSION['user']==$yorum['paylasim_yorum_user']){
                echo '     <a href="" onclick="return false"     class="pull-right btn-box-tool yorumSil">
                                                         
                                                       
                                                              <i class="fa fa-times"></i>
                                                          </a>
                                                      ';
            }
            ?>
            <a href="user.php?id=<?php echo $uyeYorum[0]['username'] ?>" ><?php echo  isimBul($yorum['paylasim_yorum_user']) ?></a>
            <?php
            echo' <span style="margin-left: 0px;" class="description">Yorum tarihi '.zaman($yorum['yorum_tarih']).'</span>
                                                </span>
                                               
                                            <span class="description ng-binding" style="margin-top: 3%;">
                                             <p >'.hashtag($yorum['yorum_icerik']).'</p>
                                             ';
            if($yorum['yorum_resim_id']!=''){
                echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12" style="margin-bottom: 3%;">
                                            <img style="width: 50%;height: 50%;" class="img-responsive" src="uploads/paylasim/'.$yorum['yorum_resim_id'].'" >
                                         </div>
                                      </div>';}
            echo '
                                                  <ul class="list-inline">
                                           
                                            <li class="yorumBegeniLi'.$yorum['yorum_id'].'">
                                                 ';
            echo yorumDurum($_SESSION['user'],$yorum['paylasim_id'],$yorum['yorum_id']);
            echo '
                                            </li>

                                                 </ul>
                                                </span>
                                        </div>
                                    </div>
                                     <!-- Yorum bölümü biter -->
                                                                   
                                     ';
            if($sayac==$sayi){
                echo '     
                     <a class="yorumGizle"  id="'.$idSet.'"  href="#" style="text-align: center">   <input  type="hidden" value="'.$idSet.'"> Tüm yorumları gizle</a>
';
            }
            $sayac++;
        }

    }else{
        echo 'sorun var';
    }

}else{
    echo 'boş';
}

