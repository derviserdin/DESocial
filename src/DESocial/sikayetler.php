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
if($_SESSION['user_type']!='yetkili'){
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
                                    <h3 class="box-title">Şikayet Listesi</h3>
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
                                                          Şikayet Edilen  Hesap
                                                        </th>

                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Şikayet Eden Hesap
                                                        </th >
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Engine version: activate to sort column ascending">
                                                            İşlemler
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                        $sql="select * from sikayet WHERE sikayet_type='sikayet'";
                                                        $dataSet=mysqli_query($db,$sql);
                                                        if($dataSet==true){
                                                            if(mysqli_num_rows($dataSet)>0){
                                                               while($row=mysqli_fetch_assoc($dataSet)){
                                                                   $sikayetEdenUser=uyeBul($row['sikayet_eden_id']);
                                                                   $sikayetEdilenUser=uyeBul($row['sikayet_user_id']);
                                                                   echo ' <tr role="row" class="odd">
                                                                                
                                                                           <td>'.$sikayetEdilenUser[0]['user_adi'].'  '.$sikayetEdilenUser[0]['user_soyadi'].'</td>
                                                                           <td>'.$sikayetEdenUser[0]['user_adi'].'  '.$sikayetEdenUser[0]['user_soyadi'].'</td>
                                                                           <td>
                                                                             <button  data-num="'.$row['paylasim_id'].'"   data-toggle="modal" data-target=".myModall"  id="payDetay'.$row['paylasim_id'].'" type="button" class="payDetay btn btn-primary">Paylaşımı Gör</button>
                                                                             <button data-num="'.$row['paylasim_id'].'"   id="paySikayetSil'.$row['paylasim_id'].'" type="button" class="paySikayetSil btn btn-danger">Paylaşımı Sil</button>
                                                                             <button  data-num="'.$row['paylasim_id'].'"  id="sikayetSil'.$row['paylasim_id'].'" type="button" class="sikayetSil btn btn-danger">Şikayeti Sil</button>
                                                                          
                                                                           </td> 
                                                                       </tr>';
                                                               }
                                                            }else{
                                                                echo '<h4>Şuan Hiçbir Şikayet Bulunamadı</h4>';
                                                            }
                                                        }


                                                    ?>


                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                      <!--  <div class="row">
                                            <div class="col-sm-5">
                                                <div class="dataTables_info" id="example2_info" role="status"
                                                     aria-live="polite">Showing 1 to 10 of 57 entries
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                     id="example2_paginate">
                                                    <ul class="pagination">
                                                        <li class="paginate_button previous disabled"
                                                            id="example2_previous"><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="0" tabindex="0">Previous</a>
                                                        </li>
                                                        <li class="paginate_button active"><a href="#"
                                                                                              aria-controls="example2"
                                                                                              data-dt-idx="1"
                                                                                              tabindex="0">1</a></li>
                                                        <li class="paginate_button "><a href="#"
                                                                                        aria-controls="example2"
                                                                                        data-dt-idx="2"
                                                                                        tabindex="0">2</a></li>
                                                        <li class="paginate_button "><a href="#"
                                                                                        aria-controls="example2"
                                                                                        data-dt-idx="3"
                                                                                        tabindex="0">3</a></li>
                                                        <li class="paginate_button "><a href="#"
                                                                                        aria-controls="example2"
                                                                                        data-dt-idx="4"
                                                                                        tabindex="0">4</a></li>
                                                        <li class="paginate_button "><a href="#"
                                                                                        aria-controls="example2"
                                                                                        data-dt-idx="5"
                                                                                        tabindex="0">5</a></li>
                                                        <li class="paginate_button "><a href="#"
                                                                                        aria-controls="example2"
                                                                                        data-dt-idx="6"
                                                                                        tabindex="0">6</a></li>
                                                        <li class="paginate_button next" id="example2_next"><a href="#"
                                                                                                               aria-controls="example2"
                                                                                                               data-dt-idx="7"
                                                                                                               tabindex="0">Next</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>-->
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
                                    <h4 class="modal-title">Paylaşım</h4>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                                </div>
                            </div>

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
                                    <button type="button" class="btn btn-default" id="payPaylasVazgec"
                                            data-dismiss="modal">Vazgeç
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
                                    <button type="button" class="btn btn-default" style="float: left;"
                                            id="silPaylasVazgec" data-dismiss="modal">Vazgeç
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
        $(document).off('click','.paySikayetSil').on('click','.paySikayetSil',function () {
            var tr = $(this).closest('tr');
            var url=$(this).attr("data-num");
            var r = confirm("Şikayet edilen paylaşımı silmek istediğinizden emin misiniz!");
            if (r == true) {
                $.ajax(
                    {
                        url:'server-side/silPaylasim.php',
                        type:'POST',
                        data:'payId='+url+'&durum=paySil&userPaylasim=',
                        success:function (gelen) {
                            console.log(gelen);
                            if(gelen=='ok'){
                                tr.remove();
                                alert('Paylaşım Silindi');
                            }


                        }


                    }
                )
            }


        });
        $(document).off('click','.payDetay').on('click','.payDetay',function () {
            var tr = $(this).closest('tr');
            var url=$(this).attr("data-num");

            $('#myModall .modal-body').html(" ");
            $.ajax(
                {
                    url:'server-side/views/sikayetPaylasimView.php',
                    type:'POST',
                    data:'url='+url,

                    success:function (gelen) {
                        $('#myModall .modal-body').html(gelen);
                    }
                }
            )
        })

        $(document).off('click','.sikayetSil').on('click','.sikayetSil',function () {
            var tr = $(this).closest('tr');
            var url=$(this).attr("data-num");
            var r = confirm("Şikayeti silmek istediğinizden emin misiniz!");
            if (r == true) {
                $.ajax(
                    {
                        url:'server-side/silPaylasim.php',
                        type:'POST',
                        data:'payId='+url+'&durum=sSil&userPaylasim=',
                        success:function (gelen) {
                            console.log(gelen);
                            if(gelen=='ok'){
                                tr.remove();
                                alert('Şikayet Silindi');
                            }


                        }


                    }
                )
            }


        });
    })
</script>
</body>
</html>
