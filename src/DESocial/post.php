<?php

include_once 'server-side/durumKontrol.php';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DE Social</title>
    <link rel="shortcut icon" href="img/logo-2.png" />
   <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/mention/css/bootstrap-suggest.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script>

    </script>
    <style>


        .dosyaYukle{
            opacity: 0;
            background:black ;
            position: absolute;
            margin-top: -10px;
            cursor: pointer;
        }
        #paylasimYazi{

            resize: none;
        }
        #yorumPaylasim{
            resize: none;
        }
    </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php
include_once 'server-side/db_con.php';
include_once 'server-side/fonksiyon.php';

$db=db_con();
$user=$_SESSION['user'];
$uye=array();
// üye bilgilerini diziye atalım
$uye=uyeBul($user);
// üye bilgileri ne $uye[0][tablodaki alanı ile ulaşabiliriz]
?>
<div class="" style="background: #ecf0f5">

    <?php include_once 'header.php'?>
    <!-- Left side column. contains the logo and sidebar -->

    <div class="container" >


        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile  -->
                    <div class="box box-primary">
                        <div class="box-body box-profile" style="padding: 0;">
                            <div class="userImage" style="  background: #3c8dbc;height: 110px;">
                                <?php
                                if($uye[0]['user_profil_resim']!=''){
                                    echo '<img src="uploads/user/'.$uye[0]['user_profil_resim'].'" class="profile-user-img img-responsive img-circle">';
                                }else{
                                    echo '<img src="dist/img/profil-resim.png" class="profile-user-img img-responsive img-circle" >';
                                }

                                ?>

                            </div>

                            <h3 class="profile-username text-center">
                                <a href="user.php?id=<?php echo $uye[0]['username'] ?>"><?php echo $uye[0]['user_adi'].' '.$uye[0]['user_soyadi'] ?>
                                    <?php
                                    if($uye[0]['user_type']=='yetkili' || $uye[0]['user_type']=='superAd'){
                                        echo '<img src="img/superAd.png" style="height: 30px;width: 30px;" >';
                                    }
                                    ?>
                                    <br>
                                    <a style="font-size: 15px;color: #8899a6;" href="user.php?id=<?php echo $uye[0]['username'] ?>">@<?php echo $uye[0]['username'] ?></a>
                                </a>
                            </h3>

                            <ul class="list-group list-group-unbordered" style="padding: 10px;">
                                <li class="list-group-item">

                                    <a href="takipciler.php?user=<?php echo $uye[0]['username'] ?>" >
                                        <b style="color:#333">Takipçiler</b>
                                        <span class="pull-right"><?php echo $uye[0]['user_takipci_sayi'] ?> </span>
                                    </a>

                                </li>
                                <li class="list-group-item">
                                    <a href="takipedilen.php?user=<?php echo $uye[0]['username'] ?>" >
                                        <b style="color:#333">Takip Edilen</b>
                                        <span class="pull-right"><?php echo $uye[0]['user_takip_edilen_sayi'] ?> </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Paylaşımlar</b> <a class="pull-right paylasimSayiUyeGoster"><?php   ?></a>
                                    <input type="hidden" name="paylasimSayiUye" id="paylasimSayiUye" value="<?php  paylasimSayiBul($user) ?>">
                                </li>

                                <?php
                                if($uye[0]['user_type']=='yetkili' || $uye[0]['user_type']=='superAd'){
                                    echo ' <li class="list-group-item">
                                          <a href="sikayetler.php"  id="siklayetList" class="btn btn-primary btn-block ">Şikayet Listesi</a>
      
                                          </li>';
                                }
                                ?>
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Takip Et</b></a> -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.son -->

                    <!-- Hashtaglar bölümü -->
                    <?php include_once 'hashtageWiew.php' ?>
                    <!-- /.son -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <!-- Paylaşım alanı-->

                    <!-- /.son -->

                    <!-- Paylaşımlar Alanı-->
                    <div id="duvarAlani">
                        <?php
                        if(!isset($_GET['post']) || empty($_GET['post'])){
                            die('<script type="text/javascript">alert("Paylaşıma Ulaşılamıyor");window.open("index.php","_self");</script>');

                        }
                        $paylasimUrl=$_GET['post'];



                        $sql="select * from paylasim  where  paylasim_url='$paylasimUrl'";
                        $dataSet=mysqli_query($db,$sql);
                        while($paylasim=mysqli_fetch_assoc($dataSet)){
                            //Gelen user id yi takipçiler dizisi içöinde karşılaştıralım
                            $aranacak=$paylasim['user_id'];

                                $kontrokPaylasimSikayet=paylasimSikayetKontrol($_SESSION['user'],$paylasim['user_id'],$paylasim['paylasim_id'],'sikayet');
                                $kontrokPaylasimEngel=paylasimEngelKontrol($_SESSION['user'],$paylasim['user_id'],$paylasim['paylasim_id'],'engel');
                                $kontrokPaylasimGizle=paylasimGizleKontrol($_SESSION['user'],$paylasim['user_id'],$paylasim['paylasim_id'],'gizle');
                                if($kontrokPaylasimEngel==1){
                                    $gonderiDurum='1';
                                }elseif ($kontrokPaylasimGizle==1){
                                    $gonderiDurum='1';
                                }else{
                                    $gonderiDurum='0';
                                }

                                if($gonderiDurum==0){


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
                                          <a href="user.php?id='.$uyePaylasim[0]['username'].'">'.$uyePaylasim[0]['user_adi'].' '.$uyePaylasim[0]['user_soyadi'].
                                        ' <a style="font-size: 13px;color: #8899a6;">@'.$uyePaylasim[0]['username']. '</a></a>
                                         ';

                                    echo '<a href="#" data-toggle="modal" data-target="#silModal"  id="silPayID'.$uyePaylasim[0]['user_id'].'"" class="pull-right btn-box-tool sil"><i class="fa fa-times"></i></a>
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
                                            <img class="img-responsive" style="width: 75%;" src="uploads/paylasim/'.$paylasim['paylasim_resim_id'].'" >
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


                        ?>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- duvar biter -->
                <!-- Button trigger modal
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    Launch demo modal
                </button>-->

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Paylasim</h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="payPaylasVazgec" data-dismiss="modal">Vazgeç</button>
                                <button type="button" class="btn btn-primary" id="paylasimSonuc">Paylaş</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="silModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Seçenekler</h4>
                            </div>
                            <div class="modal-body">
                            <span class="loadPayPaylas" style="display: none">
                               <img src="img/begen-load.gif" alt="">
                               <div>
                                   <span style="line-height: 5%;">Lütfen Bekleyin...</span>
                               </div>
                           </span>

                                <div class="alanRadio">


                                </div>


                                <input type="hidden" name="paySilID" id="paySilID" value="">
                                <input type="hidden" name="paySilUserID" id="paySilUserID" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" style="float: left;" id="silPaylasVazgec" data-dismiss="modal">Vazgeç</button>
                                <button type="button" class="btn btn-danger " id="silPaylasimSonuc">Gönder</button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- Content Wrapper. Contains page content -->

    <!-- /.content-wrapper -->
    <footer class="main-footer"  style="margin-left: 0px;">

        <strong>Copyright &copy;2016 .</strong>
        reserved.
    </footer>



</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<script src="plugins/mention/js/bootstrap-suggest.js"></script>

<script src="js/index.js"></script>
<script src="js/jquery.autogrowtextarea.min.js"></script>
<script src="js/plugins/jquery.validate.min.js"></script>
<script src="js/plugins/additional-methods.min.js"></script>


<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
