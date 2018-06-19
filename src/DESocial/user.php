<?php
//oturum kontrol
include_once 'server-side/durumKontrol.php';
include_once 'server-side/fonksiyon.php';
if(!isset($_GET['id'])){


    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}else if(empty($_GET['id'])){
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}

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
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


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
$user=mysqli_real_escape_string($db,$_GET['id']);

$uyeGelen=array();
if(uyeBulProfil($user)=='0'){
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}
// üye bilgilerini diziye atalım
$uyeGelen=uyeBulProfil($user);

$uye=array();
$uye=uyeBul($_SESSION['user']);
// üye bilgileri ne $uye[0][tablodaki alanı ile ulaşabiliriz]

/*üye engellimi kontrol
 $kontrokPaylasimEngel=paylasimEngelKontrol($_SESSION['user'],$uye[0]['user_id'],'engel');
if($kontrokPaylasimEngel>0){
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}else if(paylasimEngelKontrol($uye[0]['user_id'],$_SESSION['user'],'engel')>0){
    die('<script type="text/javascript">alert("Bu kullanıcı sizi engellediği için profilini göremessiniz.");window.open("index.php","_self");</script>');
}else{*/
?>
<div class="" style="background: #ecf0f5">
    <style>

        @media (max-width: 600px) {
            div#sonuclar{
                padding: 10px;

                margin: 0 auto;
                border: 1px solid silver;
                background-color: rgb(255, 255, 255);
                display: none;
                position: absolute;
                width: 55%;
                z-index: 1;
            }
        }
        @media (min-width: 601px) {
            div#sonuclar{
                padding: 10px;

                margin: 0 auto;
                border: 1px solid silver;
                background-color: rgb(255, 255, 255);display: none;position: absolute;width: 28.5%;
            }
        }

    </style>
  <?php  include_once 'header.php'  ?>
    <!-- Left side column. contains the logo and sidebar -->
    <div class="modal fade" id="paylasModal" tabindex="-1" role="dialog" aria-labelledby="paylasModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Paylasim</h4>
                </div>
                <div class="modal-body">
                    <div class="post">
                        <div class="user-block">
                            <?php
                            if($uyeGelen[0]['user_profil_resim']!=''){
                                echo '<img src="uploads/user/'.$uyeGelen[0]['user_profil_resim'].'"  class="img-circle img-bordered-sm">';
                            }else{
                                echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                            }

                            ?>
                            <form id="paylasForm" action="" method="post" enctype="multipart/form-data">

                                        <span  class="username">
                                            <span class="username" style="float:left; margin:0;">

                                            <a  href="#" onclick="return false"><?php echo $uyeGelen[0]['user_adi'].' '.$uyeGelen[0]['user_soyadi'] ?></a>

                                         </span>
                                              <span class="sayac">298</span>
                                            <textarea  id="paylasimYaziModal"  name="nameModal" cols="1" rows="1" class="form-control paylasimYazi "
                                                       required   placeholder="Birşeyler Yaz">

                                            </textarea>

                                                <style>
                                                .keySonuc{
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
                                    <ul class="list-inline" >
                                        <li style="margin-left: 5%;" id="resimPaylasimAlanModal">
                                            <a href="#" class="link-black text-sm">

                                                <i class="fa fa-camera  margin-r-5">
                                                    <input required id="resimModal" name="resimModal" class="dosyaYukle required resim" type="file">

                                                </i>
                                            </a>
                                        </li>



                                    </ul>
                                </div>

                                <div class="col-md-11" style="margin-left: 4%;">
                                    <span class="hata"></span>
                                    <div id="yuklemeAlan"></div>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="PaylasVazgecModal" data-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn btn-primary" id="paylasimModal">Paylaş</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container" >


        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile  -->
                    <!-- Profile  -->
                    <div class="box box-primary">
                        <div class="box-body box-profile" style="padding: 0;">
                            <div class="userImage" style="  background: #3c8dbc;height: 110px;">
                            <?php
                            if($uyeGelen[0]['user_profil_resim']!=''){
                                echo '<a href="uploads/user/'.$uyeGelen[0]['user_profil_resim'].'" data-lightbox="image-1" >
                                    <img src="uploads/user/'.$uyeGelen[0]['user_profil_resim'].'" class="profile-user-img img-responsive img-circle">
                                    </a>';                            }else{
                                echo '<img src="dist/img/profil-resim.png" class="profile-user-img img-responsive img-circle" >';

                            }

                            ?>


                            </div>

                            <h3 class="profile-username text-center">
                                <a href="user.php?id=<?php echo $uyeGelen[0]['username'] ?>"><?php echo $uyeGelen[0]['user_adi'].' '.$uyeGelen[0]['user_soyadi'] ?>
                                <?php
                                if($uyeGelen[0]['user_type']=='yetkili' || $uyeGelen[0]['user_type']=='superAd'){
                                    echo '<img src="img/superAd.png" style="height: 30px;width: 30px;" >';
                                }
                                ?>
                                    <br>
                                    <span style="font-size: 15px;color: #8899a6;">@<?php echo $uyeGelen[0]['username'] ?></span>
                                </a>
                           </h3>

                            <ul class="list-group list-group-unbordered" style="padding: 10px;">
                                <li class="list-group-item">

                                    <a id="takipciSayi<?php echo $uyeGelen[0]['user_id']  ?>" href="takipciler.php?user=<?php echo $uyeGelen[0]['username'] ?>" >
                                        <b style="color:#333">Takipçiler</b>
                                        <span class="pull-right"><?php takipSayi($uyeGelen[0]['user_id'],'takipci') ?> </span>
                                    </a>

                                </li>
                                <li class="list-group-item">
                                    <a id="takipEdilenSayi<?php echo $uyeGelen[0]['user_id'] ?>" href="takipedilen.php?user=<?php echo $uyeGelen[0]['username'] ?>">
                                        <b style="color:#333">Takip Edilen</b>
                                        <span class="pull-right"><?php takipSayi($uyeGelen[0]['user_id'],'takipedilen')  ?> </span>
                                    </a>
                                </li>


                                <?php
                                if($_SESSION['user']=='yetkili'){
                                    echo ' <li class="list-group-item">
                                          <a href="sikayetler.php"  id="siklayetList" class="btn btn-primary btn-block ">Şikayet Listesi</a>

                                          </li>';
                                }
                                ?>
                            </ul>
                            <div class="islemlerUser">
                            <?php
                            $durum= paylasimEngelKontrol($_SESSION['user'],$uyeGelen[0]['user_id'],'engel');
                            if($durum!=1){
                                if($uyeGelen[0]['user_id']!=$_SESSION['user']){
                                    $takipci=$_SESSION['user'];
                                    $takipEdilen=$uyeGelen[0]['user_id'];
                                    $sql="select * from takip where user_id='$takipci' and takip_edilen_id='$takipEdilen'";
                                    $data=mysqli_query($db,$sql);
                                    if($data){
                                        if(mysqli_num_rows($data)>0){
                                            echo '<a href="#" onclick="return false" id="takipBirak" class="btn btn-primary btn-block ">Takip Ediyorsun</a>
                                             <input type="hidden" name="idTakip" id="idTakip" value="'.$uyeGelen[0]['user_id'].'">';
                                        }else{
                                            echo '<a href="#" onclick="return false" id="takipEt" class="btn btn-primary btn-block">Takip Et</a>
                                            <input type="hidden" name="idTakip" id="idTakip" value="'.$uyeGelen[0]['user_id'].'">';
                                        }
                                    }
                                }
                            }else{
                                echo '<input type="hidden" name="idTakip" id="idTakip" value="'.$uyeGelen[0]['user_id'].'">';
                            }

                            ?>
                            </div>
                            <br>


                            <div class="engelle">

                            </div>
                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Takip Et</b></a> -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.son -->

                    <!-- Hashtaglar bölümü -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Hakkında</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Yaşadığı Ülke :</b> <a class="pull-right"><?php echo $uyeGelen[0]['user_ulke'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Yaşadığı Şehir :</b> <a class="pull-right" ><?php echo $uyeGelen[0]['user_sehir'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Kayıt Tarihi :</b> <a class="pull-right paylasimSayiUyeGoster">
                                        <?php echo $tarih=$uyeGelen[0]['user_kayit_tarih'];?></a>
                                    <input type="hidden" name="paylasimSayiUye" id="paylasimSayiUye" value="<?php  paylasimSayiBul($user) ?>">
                                </li>
                                <li class="list-group-item">
                                    <b>Yetki Derecesi :</b> <a class="pull-right ">
                                        <?php  $yetki=$uyeGelen[0]['user_type'];
                                                if($yetki=='superAd'){
                                                    echo ' Admin';
                                                }else if($yetki=='yetkili'){
                                                    echo  'Yönetici';
                                                }else if($yetki=='editor'){
                                                    echo  'Editör';
                                                }else if($yetki=='uye'){
                                                    echo  'Üye';
                                                }

                                        ?></a>
                                    <input type="hidden" name="paylasimSayiUye" id="paylasimSayiUye" value="<?php  paylasimSayiBul($user) ?>">
                                </li>

                                <li class="list-group-item">
                                   <?php
                                   echo '<input type="hidden" value="'.$uyeGelen[0]['user_id'].'" name="user_id" /> ';

                                        if($uyeGelen[0]['user_id']==$_SESSION['user']){

                                            echo '<a href="edit-profile.php" class="btn btn-primary btn-block"><b>Ayarlar</b></a>';
                                            echo '<a href="engelUser.php" class="btn btn-primary btn-block"><b>Engellenen Kullanıcılar</b></a>';
                                        }


                                   if($_SESSION['user_typeAd']=='superAd' and $uyeGelen[0]['user_id']!=$_SESSION['user']){

                                       if($uyeGelen[0]['user_type']!='superAd'){
                                           echo '<a href="" id="uyeSil" class="btn btn-primary btn-block"><b>Üyeyi Sil</b></a>';
                                       }
                                       if($uyeGelen[0]['user_type']=='yetkili'){
                                           echo '<a href="" id="editorYap" class="btn btn-primary btn-block"><b>Editör Yap</b></a>';
                                           echo '<a href="" id="kaldirYetki" class="btn btn-primary btn-block"><b>Yetkileri Kaldır</b></a>';
                                       }else if($uyeGelen[0]['user_type']=='editor'){
                                           echo '<a href="" id="adminYap" class="btn btn-primary btn-block"><b>Yönetici Yap</b></a>';
                                           echo '<a href="" id="kaldirYetki" class="btn btn-primary btn-block"><b>Yetkileri Kaldır</b></a>';
                                       }else if($uyeGelen[0]['user_type']=='uye'){
                                           echo '<a href="" id="adminYap" class="btn btn-primary btn-block"><b>Yönetici Yap</b></a>';
                                           echo '<a href="" id="editorYap" class="btn btn-primary btn-block"><b>Editör Yap</b></a>';
                                       }else if($uyeGelen[0]['user_type']=='superAd'){
                                           echo '<a href="" id="adminYap" class="btn btn-primary btn-block"><b>Yönetici Yap</b></a>';
                                           echo '<a href="" id="editorYap" class="btn btn-primary btn-block"><b>Editör Yap</b></a>';
                                           echo '<a href="" id="kaldirYetki" class="btn btn-primary btn-block"><b>Yetkileri Kaldır</b></a>';

                                       }
                                   }else if($_SESSION['user_typeAd']=='yetkili' and $uyeGelen[0]['user_id']!=$_SESSION['user']){
                                       if($uyeGelen[0]['user_type']!='superAd'){
                                         if($uyeGelen[0]['user_type']!='editor'){
                                             echo '<a href="" id="editorYap" class="btn btn-primary btn-block"><b>Editör Yap</b></a>';
                                             echo '<a href="" id="uyeSil" class="btn btn-primary btn-block"><b>Üyeyi Sil</b></a>';
                                             echo '<a href="" id="kaldirYetki" class="btn btn-primary btn-block"><b>Yetkileri Kaldır</b></a>';

                                         }else{
                                             echo '<a href="" id="uyeSil" class="btn btn-primary btn-block"><b>Üyeyi Sil</b></a>';
                                             echo '<a href="" id="kaldirYetki" class="btn btn-primary btn-block"><b>Yetkileri Kaldır</b></a>';

                                         }
                                       }

                                   }

                                   ?>


                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.son -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <!-- Paylaşım alanı-->
                    <?php
                    if($uyeGelen[0]['user_id']==$_SESSION['user']){


                    ?>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="share">
                                <!--  Post Paylaşım alanı-->
                                <div class="post">
                                    <div class="user-block">
                                        <?php
                                        if($uyeGelen[0]['user_profil_resim']!=''){
                                            echo '<img src="uploads/user/'.$uyeGelen[0]['user_profil_resim'].'"  class="img-circle img-bordered-sm">';
                                        }else{
                                            echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                        }

                                        ?>
                                        <form id="paylasForm" action="" method="post" enctype="multipart/form-data">

                                        <span  class="username">
                                            <span class="username" style="float:left; margin:0;">

                                            <a  href="#" onclick="return false"><?php echo $uyeGelen[0]['user_adi'].' '.$uyeGelen[0]['user_soyadi'] ?></a>

                                         </span>
                                            <textarea  id="paylasimYazi" name="name" cols="1" rows="1" class="form-control "
                                                       required   placeholder="Birşeyler Yaz">

                                            </textarea>
  <span class="sayac">298</span>
                                             <style>
                                                .keySonuc{
                                                    padding: 10px;
                                                    margin: 0 auto;
                                                    border: 1px solid silver;
                                                    background-color: rgb(255, 255, 255);

                                                    position: absolute;
                                                    width: 28.5%;
                                                }
                                                </style>
                                        </span>
                                            <div class="col-md-12 cubuk "  >
                                                <ul class="list-inline" >
                                                    <li style="margin-left: 5%;" id="resimPaylasimAlan">
                                                        <a href="#" class="link-black text-sm">

                                                            <i class="fa fa-camera">
                                                                <input style="max-width: 50px;" required id="resim" name="resim" class="dosyaYukle required" type="file">

                                                            </i>
                                                        </a>
                                                    </li>


                                                    <?php
                                                    if ($uye[0]['user_aktivasyon'] == 1 || $uye[0]['user_aktivasyon'] == 0) {
                                                        echo ' <li class="pull-right" id="paylasLi">
                                                        <a id="paylas" onclick="return false" href="#"
                                                           class="link-black text-sm">
                                                          Paylaş
                                                        </a>
                                                    </li>
                                                    ';
                                                    }else{
                                                        echo '<li class="pull-right" id="paylasLi">
                                                       Lütfen paylaşım yapmak için aktivasyon işleminizi yapınız
                                                    </li>';
                                                    }

                                                    ?>


                                                </ul>
                                            </div>
                                            <div class="col-md-11" style="margin-left: 4%;">
                                                <span class="hata"></span>

                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.user-block -->



                                </div>
                                <!--  / Post Paylaşım alanı-->
                            </div>
                        </div>
                    </div>
                    <?php }else{

                     ?>
                   <?php } ?>
                    <!-- /.son -->



                    <!-- Paylaşımlar Alanı-->
                    <div id="duvarAlani">
                        <?php
                            if( paylasimGormeKontrol($uyeGelen[0]['user_id'])=="no"){
                                echo '<h2>Bu kullanıcının paylaşımlarını sadece takipçileri görebilir</h2>';
                            }else{
                                $id=$uyeGelen[0]['user_id'];

                                $sql="select * from paylasim where user_id='$id' ORDER BY paylasim_tarihi DESC limit 10 ";
                                $dataSet=mysqli_query($db,$sql);
                                while($paylasim=mysqli_fetch_assoc($dataSet)) {
                                    $kontrokPaylasimSikayet = paylasimSikayetKontrol($id, $paylasim['user_id'], $paylasim['paylasim_id'], 'sikayet');
                                    $kontrokPaylasimEngel = paylasimEngelKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'engel');
                                    $kontrokPaylasimGizle = paylasimGizleKontrol($_SESSION['user'], $paylasim['user_id'], $paylasim['paylasim_id'], 'gizle');
                                    if ($kontrokPaylasimGizle == 1) {
                                        $gonderiDurum = '1';
                                    } else {
                                        $gonderiDurum = '0';
                                    }

                                    if ($gonderiDurum == 0) {


                                        echo '<div data-num="' . $paylasim['paylasim_id'] . '" class="nav-tabs-custom paylasimAlan paylasimAlan' . $paylasim['paylasim_id'] . '">
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

                                        echo '<a href="#" data-toggle="modal" data-target="#silModal" data-id="' . $paylasim['paylasim_id'] . '" id="silPayID' . $uyePaylasim[0]['user_id'] . '" class="pull-right btn-box-tool sil"><i class="fa fa-times"></i></a>
                                            <span class="silId" style="display:none;">' . $paylasim['paylasim_id'] . '</span>
                                            <span class="silUserId" style="display:none;">' . $paylasim['user_id'] . '</span>
                                         </span>
                                        <span class="description">Paylaşım tarihi ' . zaman($paylasim['paylasim_tarihi']) . '</span>
                                   ';
                                        $paylasim_tarih=$paylasim['paylasim_tarihi'];
                                        echo $paylasim_tarih!=$paylasim['paylasim_guncelleme_tarihi']?' <span class="description">Düzeltildi</span>':'';
                                        echo '
                                    </div>
                                    <!-- /.user-block -->
                                    <p class="text'.$paylasim['paylasim_id'].'">


                                        ';
                                        $metin=$paylasim['paylasim_icerik'];
                                        $say=strlen($metin); // $metin değişkenininj kaç karekterden olustugunu bulduk.
                                        if($say <= 299)
                                        {
                                            echo hashtag($paylasim['paylasim_icerik']);
                                        }
                                        else
                                        {
                                            echo  hashtag(substr($metin, 0,299)).'...'.'<br><br><a class="devamOku" data-id="'.$paylasim['paylasim_id'].'" href="#">Devamını Oku</a>';
                                        }
                                        // echo substr($metin, 0,100)."..."."<a href='url'>Devamını Oku</a>";

                                        if ($paylasim['paylasim_resim_id'] != '') {
                                            echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
                                         <a href="uploads/paylasim/' . $paylasim['paylasim_resim_id'] . '" data-lightbox="image-1" >
                                    <img style="width: 81%;margin: 0px auto;"  src="uploads/paylasim/' . $paylasim['paylasim_resim_id'] . '" class="img-responsive ">
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
                                             ';
                                        if($_SESSION['user']==$paylasim['user_id']){
                                            echo '  <a href="#" data-toggle="modal"  data-num="' . $paylasim['paylasim_id'] . '" data-target="#payKisiGoster" class="gosterPaySayi">
                                               ('.paySayiBul($paylasim['paylasim_id']).')
                                                </a>';
                                        }else{
                                            echo '('.paySayiBul($paylasim['paylasim_id']).')';
                                        }
                                        echo '


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
                                           <div style="float: right;position: relative;top:-28px;z-index: 1;left: 4%;">
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




                        ?>

                    </div>
                    <!-- /.col -->
                    <div style="float:right;font-size: 18px;text-decoration: underline" class="col-md-9  col-xs-12">

                        <a class="devamGor" href="#">Daha Fazla Paylaşım Gör </a>
                    </div>
                    <?php } ?>
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
                                <div class="paylasimbtnler"></div>

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
<script src="js/profile.js"></script>
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
<script>
    $(function () {
        var durum=<?php echo  paylasimEngelKontrol($_SESSION['user'],$uyeGelen[0]['user_id'],'engel') ?>;
        var profilId=<?php echo $uyeGelen[0]['user_id'] ?>;
        var oturumId=<?php echo $_SESSION['user'] ?>;
        if(profilId!=oturumId){

            if(durum==1){
                $('#duvarAlani').hide();
                $('.engelle').html('asdasd').html('' +
                    ' <a href="#" onclick="return false" id="engelKaldir" class="btn btn-primary btn-block ">Engeli Kaldır</a>'+
                    ' ');
            }else{
                $('.engelle').html('asdasd').html('' +
                    ' <a href="#" onclick="return false" id="engelle" class="btn btn-primary btn-block ">Engelle</a>'+
                    ' ');
            }
        }
    })
</script>
</body>
</html>

