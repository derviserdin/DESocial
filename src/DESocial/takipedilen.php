<?php
//oturum kontrol
if (!isset($_GET['user']) || empty($_GET['user'])) {
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}
include_once 'server-side/durumKontrol.php';
include_once 'server-side/fonksiyon.php';

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
        .dosyaYukle {
            opacity: 0;
            background: black;
            position: absolute;
            margin-top: -10px;
            cursor: pointer;
        }

        #paylasimYazi {

            resize: none;
        }

        #yorumPaylasim {
            resize: none;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php
include_once 'server-side/db_con.php';

$db = db_con();
$user = $_SESSION['user'];
$uye = array();
if (uyeBul($user) == '0') {
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}
// üye bilgilerini diziye atalım
$uye = uyeBul($user);

$uyeGelen = array();
$uyeGelen = uyeBulProfil(mysqli_real_escape_string($db, $_GET['user']));
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

    <?php include_once 'header.php' ?>
    <!-- Left side column. contains the logo and sidebar -->

    <div class="container">


        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile  -->
                    <!-- Hashtaglar bölümü -->
                    <?php include_once 'hashtageWiew.php' ?>
                    <!-- /.son -->
                    <!-- /.son -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <!-- Paylaşım alanı-->

                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="share">
                                <!--  Post Paylaşım alanı-->
                                <div class="post">
                                    <h4>Takip Edilenler </h4>

                                </div>
                                <!--  / Post Paylaşım alanı-->
                            </div>
                        </div>
                    </div>


                    <!-- Paylaşımlar Alanı-->
                    <div id="duvarAlani" class="col-md-12" style="padding: 0">
                        <?php
                        $uyeId = $uyeGelen[0]['user_id'];
                        //  PAylaşım göstermek için öncelikle  üyenin takip ettiği kişileri  bulalım
                        $output = array();
                        //üyenin kendi id sini bir diziye atalım sonrada  takip ettiği kişilerin
                        //array_push($output, $user);
                        $query = "SELECT * FROM takip where user_id='$uyeId'";
                        $result = mysqli_query($db, $query);
                        //  var_dump(mysqli_fetch_assoc($result));
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // takip ettiği kişileri diziye atıyoruz
                                array_push($output, $row['takip_edilen_id']);
                                // var_dump($output);
                            }
                        }
                        if (count($output) > 0) {
                            $sql = "select * from users  ";
                            $dataSet = mysqli_query($db, $sql);
                            while ($paylasim = mysqli_fetch_assoc($dataSet)) {
                                $aranacak = $paylasim['user_id'];
                                $gonderiDurum = 0;


                                if (in_array($aranacak, $output) == true) {
                                    //üye  oturum açmış kullanıcı tarafından engellimi değilmi bulup  kontrol ettirelim
                                    $kontrokPaylasimEngel = paylasimEngelKontrol($_SESSION['user'], $paylasim['user_id'], 'engel');
                                    if ($kontrokPaylasimEngel == 1) {
                                        $gonderiDurum = 1;
                                    }
                                    if ($gonderiDurum == 0) { ?>

                                    <div class="col-md-4  userBolum<?php echo $paylasim['user_id'] ?>">
                                        <!-- Profile  -->
                                        <div class="box box-primary">
                                            <div class="box-body box-profile">
                                                <?php
                                                if ($paylasim['user_profil_resim'] != '') {
                                                    echo '<img src="uploads/user/' . $paylasim['user_profil_resim'] . '" class="profile-user-img img-responsive img-circle">';
                                                } else {
                                                    echo '<img src="dist/img/profil-resim.png" class="profile-user-img img-responsive img-circle" >';

                                                }

                                                ?>


                                                <h3 class="profile-username text-center">
                                                    <a href="user.php?id=<?php echo $paylasim['username'] ?>"><?php echo $paylasim['user_adi'] . ' ' . $paylasim['user_soyadi'] ?></a>
                                                    <?php
                                                    if($paylasim['user_type']=='yetkili' || $paylasim['user_type']=='superAd'){
                                                        echo '<img src="img/superAd.png" style="height: 30px;width: 30px;" >';
                                                    }
                                                    ?>
                                                    <br>
                                                    <a style="font-size: 15px;color: #8899a6;" href="user.php?id=<?php echo $paylasim['username'] ?>">@<?php echo $paylasim['username'] ?></a>
                                                </h3>
                                            <!--    <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">

                                                        <a href="takipciler.php?user=<?php echo $paylasim['username'] ?>"  id="takipciSayi<?php echo $paylasim['user_id']  ?>" >
                                                            <b style="color:#333">Takipçiler</b>
                                                            <span class="pull-right"> <?php takipSayi($paylasim['user_id'],'takipci') ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <a href="takipedilen.php?user=<?php echo $paylasim['username'] ?>" id="takipEdilenSayi<?php echo $paylasim['user_id']  ?>" >
                                                            <b style="color:#333">Takip Edilen</b>
                                                            <span class="pull-right"> <?php takipSayi($paylasim['user_id'],'takipedilen')  ?></span>
                                                        </a>
                                                    </li>

                                                </ul> -->
                                                <div
                                                    class="islemlerUser islemlerUser<?php echo $paylasim['user_id'] ?>">
                                                    <?php
                                                    if ($paylasim['user_id'] != $_SESSION['user']) {
                                                        $takipci = $_SESSION['user'];
                                                        $takipEdilen = $paylasim['user_id'];
                                                        $sql = "select * from takip where user_id='$takipci' and takip_edilen_id='$takipEdilen'";
                                                        $data = mysqli_query($db, $sql);
                                                        if ($data) {
                                                            if (mysqli_num_rows($data) > 0) {
                                                                echo '<a href="#" onclick="return false" id="takipBirak" class="takipBirak' . $paylasim['user_id'] . ' btn btn-primary btn-block ">Takip Ediyorsun</a>
                                             <input type="hidden" name="idTakip" id="idTakip" value="' . $paylasim['user_id'] . '">';
                                                            } else {
                                                                echo '<a href="#" onclick="return false" id="takipEt" class="takipEt' . $paylasim['user_id'] . ' btn btn-primary btn-block">Takip Et</a>
                                            <input type="hidden" name="idTakip" id="idTakip" value="' . $paylasim['user_id'] . '">';
                                                            }
                                                        }
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
                                        </div><?php
                                    }
                                }
                            }


                        } else {
                            echo ' <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="share">
                                <!--  Post Paylaşım alanı-->
                                <div class="post">
                                    <h4>Henüz Takip Ettiğiniz Kimse Yok</h4>

                                </div>
                                <!--  / Post Paylaşım alanı-->
                            </div>
                        </div>
                    </div>
                    ';
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
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Paylasim</h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="payPaylasVazgec" data-dismiss="modal">
                                    Vazgeç
                                </button>
                                <button type="button" class="btn btn-primary" id="paylasimSonuc">Paylaş</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="silModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Paylasim Seçenek</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alanRadio">


                                </div>


                                <input type="hidden" name="paySilID" id="paySilID" value="">
                                <input type="hidden" name="paySilUserID" id="paySilUserID" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" style="float: left;" id="silPaylasVazgec"
                                        data-dismiss="modal">Vazgeç
                                </button>
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
    <footer class="main-footer" style="margin-left: 0px;max-height: 50px">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy;2016 .</strong>
        reserved.
    </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="js/arkadas.js"></script>
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
        var durum =<?php echo paylasimEngelKontrol($_SESSION['user'], $uye[0]['user_id'], 'engel') ?>;
        var profilId =<?php echo $uye[0]['user_id'] ?>;
        var oturumId =<?php echo $_SESSION['user'] ?>;
        if (profilId != oturumId) {
            console.log(durum);
            if (durum == 1) {
                //$('#duvarAlani').hide();
                $('.engelle').html('asdasd').html('' +
                    ' <a href="#" onclick="return false" id="engelKaldir" class="btn btn-primary btn-block ">Engeli Kaldır</a>' +
                    ' ');
            } else {
                $('.engelle').html('asdasd').html('' +
                    ' <a href="#" onclick="return false" id="engelle" class="btn btn-primary btn-block ">Engelle</a>' +
                    ' ');
            }
        }
    })
</script>
</body>
</html>

