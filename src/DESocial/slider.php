<?php

include_once 'server-side/durumKontrol.php';


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DE Social</title>
    <link rel="shortcut icon" href="img/logo-2.png"/>

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
include_once 'server-side/fonksiyon.php';
if ($_SESSION['user_type'] != 'yetkili') {
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}
$db = db_con();
$user = $_SESSION['user'];
$uye = array();
// üye bilgilerini diziye atalım
$uye = uyeBul($user);
// üye bilgileri ne $uye[0][tablodaki alanı ile ulaşabiliriz]
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
                    <div class="box box-primary">
                        <div class="box-body box-profile" style="padding: 0;">
                            <div class="userImage" style="  background: #3c8dbc;height: 110px;">
                                <?php
                                if ($uye[0]['user_profil_resim'] != '') {
                                    echo '<img src="uploads/user/' . $uye[0]['user_profil_resim'] . '" class="profile-user-img img-responsive img-circle">';
                                } else {
                                    echo '<img src="dist/img/profil-resim.png" class="profile-user-img img-responsive img-circle" >';
                                }

                                ?>

                            </div>

                            <h3 class="profile-username text-center">
                                <a href="user.php?id=<?php echo $uye[0]['username'] ?>"><?php echo $uye[0]['user_adi'] . ' ' . $uye[0]['user_soyadi'] ?>
                                    <?php
                                    if ($uye[0]['user_type'] == 'yetkili' || $uye[0]['user_type'] == 'superAd') {
                                        echo '<img src="img/superAd.png" style="height: 30px;width: 30px;" >';
                                    }
                                    ?>

                                </a>
                            </h3>

                            <ul class="list-group list-group-unbordered" style="padding: 10px;">
                                <li class="list-group-item">
                                    <b>Takipçiler</b> <a href="takipciler.php?user=<?php echo $uye[0]['username'] ?>"
                                                         class="pull-right"><?php echo $uye[0]['user_takipci_sayi'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Takip Edilen</b> <a href="takipedilen.php?user=<?php echo $uye[0]['username'] ?>"
                                                           class="pull-right"><?php echo $uye[0]['user_takip_edilen_sayi'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Paylaşımlar</b> <a class="pull-right paylasimSayiUyeGoster"><?php ?></a>
                                    <input type="hidden" name="paylasimSayiUye" id="paylasimSayiUye"
                                           value="<?php paylasimSayiBul($user) ?>">
                                </li>

                                <?php
                                if ($uye[0]['user_type'] == 'yetkili') {
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


                    <!-- Paylaşımlar Alanı-->
                    <div id="duvarAlani">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Resim Listesi</h3>
                                    <button class="btn btn-success" data-toggle="modal" data-target=".myModall"
                                            style="float:right">Ekle
                                    </button>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example2" class="table table-bordered table-hover dataTable"
                                                       role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1" aria-sort="ascending"
                                                            aria-label="Rendering engine: activate to sort column descending">
                                                            Resim Numarası
                                                        </th>

                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Resim Uzantısı
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Resim Önizleme
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            İşlemler
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                    $sql = "select * from slider  ORDER BY resim_id DESC ";
                                                    $dataSet = mysqli_query($db, $sql);
                                                    if ($dataSet == true) {
                                                        if (mysqli_num_rows($dataSet) > 0) {
                                                            while ($row = mysqli_fetch_assoc($dataSet)) {

                                                                echo ' <tr role="row" class="odd satir'.$row['resim_id'].'">
                                                                                
                                                                           <td>' . $row['user_id'] . '</td>
                                                                           <td>' . $row['resim_url'] . '</td>
                                                                           <td> <a target="blank" href="uploads/slider/' . $row['resim_url'] . '">Ön İzleme İçin Tıklayınız</a>    </td>
                                                                           <td>
                                                                             <button  data-num="' . $row['resim_id'] . '"   type="button" class="resimSil btn btn-primary">Resmi Sil</button>

                                                                           </td>

                                                                     </tr>';
                                                            }
                                                        } else {
                                                            echo '<h4>Şuan Hiçbir Resim Bulunamadı</h4>';
                                                        }
                                                    }


                                                    ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                    <div id="myModall" class="modal fade myModall" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Resim Ekle</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <label for="resim">
                                            Resim Seçiniz
                                        </label>
                                        <input type="file" name="resim" id="resim">
                                        <br>
                                        <input type="submit" value="Ekle" class="btn btn-success ekleResimS">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
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
    <footer class="main-footer" style="margin-left: 0px;">

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


<script>

    $(function () {
        $(document).off('click', '.ekleResimS').on('click', '.ekleResimS', function () {

            var data;

            data = new FormData();
            data.append('resim', $('#resim')[0].files[0]);
            data.append('islem', 'add');
            console.log(data);
            $.ajax({
                url: "server-side/resimIslem.php",  //php dosyasının yolu
                type: 'POST',

                data: data,
                cache: false,
                contentType: false,
                processData: false,

                success: function (e) {
                    alert(e);
                }
            });
return false;
        });
        $(document).off('click', '.resimSil').on('click', '.resimSil', function () {

            var islem = confirm("Resim silmek istiyor musunuz?");
            if (r == true) {
                var id = $(this).attr("data-num");

                $.ajax(
                    {
                        url: 'server-side/resimIslem.php',
                        type: 'POST',
                        data: 'id=' + id+"&islem=delete",

                        success: function (gelen) {
                            if(gelen=="ok"){
                                $('.satir'+id).remove();
                            }else{
                                alert("Resim Silmede Bir Hata Oluştu !");
                            }
                        }
                    }
                )
            }

        });

    });
</script>
</body>
</html>
