<?php
session_start();
include_once ('../db_con.php');
include_once ('../fonksiyon.php');

if(isset($_POST['url'])){
    $db=db_con();

                    $url=mysqli_real_escape_string($db,$_POST['url']);

                        $sql="select * from paylasim where  paylasim_id='$url'  ";
                        $dataSet=mysqli_query($db,$sql);
                    // var_dump(mysqli_fetch_assoc($dataSet));
                        while($paylasim=mysqli_fetch_assoc($dataSet)){
                            //Gelen user id yi takipçiler dizisi içöinde karşılaştıralım
                            $aranacak=$paylasim['user_id'];




                                    echo '<div class="nav-tabs-custom paylasimAlan'.$paylasim['paylasim_id'].'">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">';
                                    //paylaşimsahibi üyenin bilgileri
                                    $uyePaylasim=array();
                                    $uyePaylasim=uyeBul($paylasim['user_id']);
                                    if($uyePaylasim[0]['user_profil_resim']!=''){
                                        echo '<img src="uploads/user/'.$uyePaylasim[0]['user_profil_resim'].'"   class="img-circle img-bordered-sm">';
                                    }else{
                                        echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                    }
                                    echo '      <span class="username username'.$uyePaylasim[0]['user_id'].'">
                                          <a href="user.php?id='.$uyePaylasim[0]['username'].'">'.$uyePaylasim[0]['user_adi'].' '.$uyePaylasim[0]['user_soyadi']. '
                                           <a style="font-size: 13px;color: #8899a6;">@'.$uyePaylasim[0]['username']. '</a></a>
                                         ';

                                    echo '
                                           <span class="silId" style="display:none;">'.$paylasim['paylasim_id'].'</span>
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
                                            <img class="img-responsive" style="width: 64%;margin: 0px auto;" src="uploads/paylasim/'.$paylasim['paylasim_resim_id'].'" >
                                         </div>
                                      </div>';
                                    }
                                    if($paylasim['paylasim_sahibi']!='0'){
                                        paylasimSahibDurum($paylasim['paylasim_sahibi']);
                                    }
                                    echo '
                                    </p>
                                    <ul class="list-inline">
                                        <li>
                                            <a id="" href="#" onclick="return false" data-toggle="modal" data-target="#myModal" class="link-black text-sm payPaylas">
                                               <span class="payPayId'.$paylasim['paylasim_id'].'" style="display:none">'.$paylasim['paylasim_id'].'</span>
                                              
                                                <i class="fa fa-moon-o"></i>
                                                <span class="payPaylasimSayisi'.$paylasim['paylasim_id'].'"> Paylaş 
                                              
                                            
                                         
                                            </a>
                                        </li>
                                        <li class="begeniLi'.$paylasim['paylasim_id'].'">
                                            ';
                                    echo begeniDurum($_SESSION['user'],$paylasim['paylasim_id']);
                                    echo '
                                        </li>
                                        <a class="pull-right">
                                            <a href="#"   class="link-black text-sm"><i class="fa fa-comments-o "></i> Yorumlar </a></li>

                                    </ul>
                                        <div >
                                          <input id="paylasimID" class="paylasimID" type="hidden" value="'.$paylasim['paylasim_id'].'"/>
                                        
                                         <input id="yorumPaylasim" name="yorum"  class="form-control yorumPaylasim"
                                          required     placeholder="Birşeyler Yaz....">
                                           <div style="float: right;position: relative;top:-28px;z-index: 1;left: 4%">
                                             <i  class=" fa fa-picture-o  margin-r-5 "></i>       
                                             <div class="yorumResimInput">
                                              <input  style="float: right;position: relative;width: 50px;z-index: 0;left: -35px;"   required id="resimYorum" name="resimYorum" class="dosyaYukle fa fa-picture-o  margin-r-5 " type="file">

                                             </div>   
                                      
                                           </div>
                                          
                                        </div>
                                          ';

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
                                    <div   class="yorumBolum" style="padding: 0;margin-top: 3%;margin-left:5%; border-top:1px solid">
                                        <div class="user-block" style=" padding: 0;margin-top: 3%;">'; ?>
                                            <?php
                                            if ($uyeYorum[0]['user_profil_resim']!= '') {
                                                echo '<img src="uploads/user/' . $uyeYorum[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
                                            } else {
                                                echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                            }
                                            echo '  <span class="username">
                                                      ';
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



}else{
    echo '0';
}

                    ?>