<?php
include_once 'server-side/durumKontrol.php';
include_once 'server-side/db_con.php';
include_once 'server-side/fonksiyon.php';

$db = db_con();
if (!$db) die("<p>Veritabanına bağlanılamadı. Kayıtlar gösterilemiyor!</p></body></html>");

$user_id=$_SESSION['user'];
$sorgu=mysqli_query($db,"select * from users where user_id='$user_id'");
$str=mysqli_fetch_array($sorgu);
$db=db_con();

$uye=array();
if(uyeBul($user_id)=='0'){
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}
// üye bilgilerini diziye atalım
$uye=uyeBul($user_id);
?>

<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/imgareaselect-default.css" type="text/css" media="screen">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/main.css" type="text/css">


</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php include_once 'header.php'?>
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Resim Kırpma</h4>
            </div>
            <div class="modal-body" id="resimYeri">
				<span class="loadResim" style="display: none">
						   <img src="img/begen-load.gif" alt="">
						   <div>
							   <span style="line-height: 5%;">Lütfen Bekleyin...</span>
						   </div>
					   </span>

                <div id="crop_wrapper">

                </div>


            </div>
            <div class="modal-footer">
                <button style="display: none" type="button" class="btn btn-danger" id="resimVazgecTamam" data-dismiss="modal">Tamam</button>
                <div class="gizleBtn">
                    <button type="button" class="btn btn-default" id="resimVazgec" data-dismiss="modal">Vazgeç</button>
                    <button type="button" id="resimCropSonuc" class="btn btn-primary">Resmi Kırp</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="container" style="background: #fff;margin-top: 2%;margin-bottom: 2%;">
        <div class="col-md-4">
            <div id="profile_img">
                <?php
                if($str["user_profil_resim"]==''){
                    echo '<img src="dist/img/profil-resim.png" alt="DE Social" width="200" height="200">';
                }else{
                    echo ' <img src="uploads/user/'.$str["user_profil_resim"].'" alt="DE Social" width="200" height="200">';

                }

                ?>

                <input type="file" class="filestyle" data-buttonText="Resim Seç" name="lokasyon">
                <br>

                <div class="col-md-11" style="margin-left: 4%;">
					   <span class="loadBolum" style="display: none">
						   <img src="img/begen-load.gif" alt="">
						   <div style="margin-top: 1%;margin-left: 8%;">
							   <span style="line-height: 5%;">Lütfen Bekleyin...</span>
						   </div>
					   </span>
                </div>
                <button data-toggle="modal" data-target="#myModal"	 type="button" class="btn btn-primary" id="btn_resim_guncelle" data-id="<?php echo $str["user_id"];?>">Resmi Değiştir</button>
                <!-- Button trigger modal -->

            </div>
        </div>
        <form method="POST" action="server-side/editProfile.php">
        <div class="col-md-8">
            <div class="row">

                <div class="col-xs-3 lbl">Adı</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_adi" maxlength="50" value="<?php echo $str["user_adi"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Soyadı</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_soyadi" maxlength="50" value="<?php echo $str["user_soyadi"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Kullanıcı Adı</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" id="username" class="form-control" name="username" maxlength="50" value="<?php echo $str["username"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">E-Posta Adresi</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="email" id="email" class="form-control" name="email"  value="<?php echo $str["user_email"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Şifre Yenile</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="password" class="form-control" name="password" maxlength="50" value=""></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Şifre Yenile Tekrar</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input  required type="password"  class="form-control" name="passwordR" maxlength="50" value=""></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Yaşadığı Şehir</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_sehir" maxlength="50" value="<?php echo $str["user_sehir"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Doğum Tarihi</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control dogum-tarihi" name="user_dogum_tarih" maxlength="50" value="<?php echo $str["user_dogum_tarih"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Ülke</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_ulke" maxlength="50" value="<?php echo $str["user_ulke"];?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-4"></div>
                <div class="col-xs-8">
                    <button type="submit" style="margin-bottom: 3%;" class="btn btn-primary" id="btn_bilgi_guncelle"">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <span class="text">Güncelle</span>
                    </button>
                    <button type="submit" style="margin-bottom: 3%;" class="btn btn-danger" id="btn_bilgi_sil" data-id="<?php echo $str["user_id"];?>">

                        <span class="text">Hesabı Sil</span>
                    </button>
                    <input type="hidden" name="user_id" value="<?php echo $str["user_id"];?>">
                </div>
            </div>



        </div>
        </form>
    </div>

</div>

<footer class="main-footer"  style="margin-left: 0px;">

    <strong>Copyright &copy;2016 .</strong>
    reserved.
</footer>




</body>
</html>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

<script type="text/javascript" src="plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="js/jquery.Jcrop.min.js"></script>
<script src="js/plugins/jquery.imgareaselect.pack.js"></script>
<script>
    $(document).ready(function () {
        $('#ladybug_ant').imgAreaSelect({ maxWidth: 200, maxHeight: 150, handles: true });
    });
</script>

</script>




