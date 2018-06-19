<?php



function paylasimSonuc($id){
    $db=db_con();


    $uye=array();
    $uye=uyeBul($_SESSION['user']);
    $sql="select * from paylasim where paylasim_id='$id'";
    $dataSet=mysqli_query($db,$sql);
    //echo mysqli_error($db);
    while($paylasim=mysqli_fetch_assoc($dataSet)){

        //bildirim fonsiyonu
        bildirimPay($paylasim['paylasim_icerik'],$paylasim['paylasim_url'],'paylasim');


        echo '<div class="nav-tabs-custom paylasimAlan'.$paylasim['paylasim_id'].'">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">';

        if($uye[0]['user_profil_resim']!=''){
            echo '<img src="uploads/user/'.$uye[0]['user_profil_resim'].'"  class="img-circle img-bordered-sm">';
        }else{
            echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

        }
        echo '      <span class="username username'.$uye[0]['user_id'].'">
                                          <a href="user.php?id='.$uye[0]['username'].'">'.$uye[0]['user_adi'].' '.$uye[0]['user_soyadi']. '
                                          <a style="font-size: 13px;color: #8899a6;">@'.$uye[0]['username']. '</a></a>
                                         ';

        echo '
                                            <a href="#" data-toggle="modal" data-target="#silModal"  id="silPayID' . $uye[0]['user_id'] . '"" class="pull-right btn-box-tool sil"><i class="fa fa-times"></i></a>
                                            <span class="silId" style="display:none;">' . $paylasim['paylasim_id'] . '</span>
                                            <span class="silUserId" style="display:none;">'.$paylasim['user_id'].'</span>
                                            
                                         </span>
                                        <span class="description">Paylaşım tarihi '.zaman($paylasim['paylasim_tarihi']).'</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                      '.hashtag($paylasim['paylasim_icerik']).'
                                     ';
                        if($paylasim['paylasim_resim_id']!=''){
                            echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
<a href="uploads/paylasim/'.$paylasim['paylasim_resim_id'].'" data-lightbox="image-1" >
                                    <img style="width: 64%;margin: 0px auto;" src="uploads/paylasim/'.$paylasim['paylasim_resim_id'].'" class="img-responsive ">
                                    </a>                                         </div>
                                      </div>';
                         }
                                    echo ' 
                                    </p>
                                    ';
                                    if($paylasim['paylasim_sahibi']!='0'){
                                        paylasimSahibDurum($paylasim['paylasim_sahibi']);
                                    }
                                echo '
                                    <ul class="list-inline">
                                        <li>
                                           <a id="" href="#" onclick="return false" data-toggle="modal" data-target="#myModal" class="link-black text-sm payPaylas">
                                               <span class="payPayId'.$paylasim['paylasim_id'].'" style="display:none">'.$paylasim['paylasim_id'].'</span>
                                              
                                                <i class="fa fa-moon-o "></i>
                                                <span class="payPaylasimSayisi'.$paylasim['paylasim_id'].'"> Paylaş</span>
                                            
                                         
                                            </a>
                                        </li>
                                        <li class="begeniLi'.$paylasim['paylasim_id'].'">
                                           ';
                                        echo begeniDurum($_SESSION['user'],$paylasim['paylasim_id']);
                                        echo '
                                        </li>
                                        <li class="pull-right">
                                            <a href="#" id="yorumSayi'.$paylasim['paylasim_yorum_sayisi'].'" class="link-black text-sm">
                                            <i class="fa fa-comments-o "></i> Yorumlar</a></li>

                                    </ul>

                                      <div>
                                          <input id="paylasimID" class="paylasimID" type="hidden" value="'.$paylasim['paylasim_id'].'"/>
                                        
                                         <input id="yorumPaylasim" name="yorum"  class="form-control yorumPaylasim"
                                          required     placeholder="Birşeyler Yaz....">
                                           <div style="float: right;position: relative;top:-28px;z-index: 1;left: 4%">
                                             <i  class=" fa fa-picture-o  "></i>       
                                              <div class="yorumResimInput">
                                              <input  style="float: right;position: relative;width: 50px;z-index: 0;left: -35px;"   required id="resimYorum" name="resimYorum" class="dosyaYukle fa fa-picture-o  margin-r-5 " type="file">
                                              </div>  
                                            
                                      
                                           </div>
                                          
                                        </div>';
        echo '<div class="yorumAnaBolum'.$paylasim['paylasim_id'].'">';
        $paylasimId=$paylasim['paylasim_id']; // paylasim idsi
        $sqlYorum="select * from paylasim_yorum where paylasim_id=$paylasimId ";
        $dataYorum=mysqli_query($db,$sqlYorum);
        if ($dataYorum==true){
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
                    echo '<img src="uploads/user/' . $uyeYorum[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
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

function paylasimYorum($id){
    $connect=db_con();
    $yorumlar=array();
    $idSet=mysqli_real_escape_string($connect,$id);
    $sql="select * from paylasim_yorum where yorum_id='$idSet'";
    $dataSet=mysqli_query($connect,$sql);

    if($dataSet==true){
        while($yorum=mysqli_fetch_assoc($dataSet)){
            //bildirim fonsiyonu
            $sql="select * from paylasim where paylasim_id='".$yorum['paylasim_id']."'";
            $dataSet=mysqli_query($connect,$sql);
            $veriPaylasimGetir=mysqli_fetch_assoc($dataSet);
            $url=$veriPaylasimGetir['paylasim_url'];
            bildirimPay($yorum['yorum_icerik'],$url,'yorum');

            $uyeYorum=array();
            $uyeYorum=uyeBul($yorum['paylasim_yorum_user']);
            // var_dump($uyeYorum);
            echo ' 
                                        <!-- Yorum bölümü başlar -->        
                                    <div   class="yorumBolum yorumBolum'.$yorum['yorum_id'].'" style="padding: 0;margin-top: 3%;margin-left:5%; border-top:1px solid">
                                        <div class="user-block" style=" padding: 0;margin-top: 3%;">'; ?>
            <?php
            if ($uyeYorum[0]['user_profil_resim']!= '') {
                echo '<img src="uploads/user/' . $uyeYorum[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
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
                                                </span>';
            echo'
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
        }
    }else{
        echo 'hata'.mysqli_error($connect);
    }

}

