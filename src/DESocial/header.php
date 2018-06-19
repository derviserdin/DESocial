<style>
    #paylasimYaziModal {

        resize: none;
    }
    #takipBirakk {
        background-color: #bec5ca;

    }
    #takipBirak {
        background-color: #bec5ca;

    }
    .sayac {
        float: right;
        position: relative;
        top: -23px;
        left: -10px;
    }

    #yorumPaylasim {
        width: 96%;
    }

    .profile-user-img {
        max-height: 100px;
    }

    @media (max-width: 827px) {

        .container {
            padding-top: 128px;
            min-height: 700px;
        }
    }

    @media (min-width: 827px) {
        .container {
            padding-top: 66px;
            min-height: 700px;
        }

    }

    @media (max-width: 991px) {
        .cubuk {
            position: relative;
            top: 19px;
        }

        .gizleUserBolge {
            display: none;
        }

        .kimiTakipEtmeli {
            display: none;
        }

    }

    @media (max-width: 600px) {
        div#sonuclar {
            padding: 10px;
            margin: 0 auto;
            border: 1px solid silver;
            background-color: rgb(255, 255, 255);
            display: none;
            position: absolute;
            width: 55%;
            z-index: 1;
        }

        .container {
            padding-top: 67px;
        }

    }

    @media (max-width: 500px) {
        #logohead {
            height: auto;
            margin-top: 33%;
            margin-left: 3%;
        }

    }

    @media (min-width: 501px)   and (max-width: 1920px) {
        #logohead {
            height: 100%;
            margin-top: 2%;
            margin-left: 3%;
        }

    ;
    }

    @media (min-width: 1200px)   and (max-width: 1920px) {
        #merkez.container {
            width: 1200px;
        }

    ;
    }

    .paylasimAlan .post .list-inline li a.yorumClick {
        font-size: 13px;
    }

    .paylasimAlan .post .list-inline li {
        margin-right: 4%;
    }

    .paylasimAlan .post .list-inline li i {
        font-size: 16px;
        color: #3c8dbc;
    }

    .paylasimAlan .post .list-inline li span {
        font-size: 13px;
    }

    @media (min-width: 601px) {
        div#sonuclar {
            padding: 10px;

            margin: 0 auto;
            border: 1px solid silver;
            background-color: rgb(255, 255, 255);
            display: none;
            position: absolute;
            width: 28.5%;
        }
    }

    #yukari {
        z-index: 100;
        position: fixed;
        bottom: 10px;
        right: 10px;
        display: none
    }

    #yukari_boyut {
        width: 70px;
        height: 70px
    }

    .heading {
        position: fixed;
        z-index: 1000;
        width: 100%;
        background: #2E3944;
        /*   padding-top: 12px;*/
    }

    .yorumBolum span.description {
        font-weight: initial;
    }

    .yorumBolum .description p {
        color: #666;
        font-size: 14px;

    }
</style>


<header class="main-header heading">

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="margin-left: 0;">
        <a href="index.php" style="margin-left: 3%;float: left;margin-top: 0.5%;">

            <img src="img/logo-2.png" id="logo" class="image-responsive" height="60" width="70"/>
        </a>

        <div class="form-ara">
            <form action="ara.php" method="post">
                <div class="form-group araText" style="width: 25%;float: left;margin-top: 1%;margin-left: 5%;">

                    <input type="text" class="form-control"  name="ara"  placeholder="Arkadaşlarını Ara..">



                    <div id="sonuclar" style=""></div>
                </div>

                <div class="form-group araBtn" style="float: left;margin-top: 1%">

                    <input type="submit" class="form-control"  id="gonder" value="Ara">
                </div>
            </form>

        </div>


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->

                <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
                <script src="js/genel.js"></script>
                <script src="plugins/lightbox/js/lightbox.js"></script>
                <link rel="stylesheet" href="plugins/lightbox/css/lightbox.css">
                <script>
                    $(document).ready(function () {
                        $('input[name="ara"]').keyup(function () {
                            var name=$(this).val();
                            if(name==''){
                                $('#sonuclar').css('display','none');
                                $('#sonuclar').html('');
                                return false
                            }else{
                                $.post('server-side/uyeAra.php',{ad:name},function (data) {
                                    $('#sonuclar').css('display','block');
                                    $('#sonuclar').html(data);
                                })
                            }

                        })
                        var divSayisi=$('#duvarAlani .paylasimAlan').size();
                        if(divSayisi==0){
                            $('.devamGor').remove();
                        }
                        // var id = $("#duvarAlani .nav-tabs-custom:last").attr("data-num");
                        //   alert(id);

                        var sayfaAdi = window.location.href;

                        $(document).on('click', '.devamGor', function (e) {

                            var id = $("#duvarAlani .nav-tabs-custom:last").attr("data-num");
                            //alert(id);
                            if (id > 1) {
                                $.ajax({
                                    type: "POST",
                                    url: "server-side/views/kayitGoster.php",
                                    data: "id=" + id + '&sayfa=' + sayfaAdi, beforeSend: function () {
                                        $(".sonPayId").remove();
                                        $('#sayfaYukle').show();
                                        e.stopPropagation();
                                    },
                                    success: function (gelen) { //Başarılı olursa,
                                        if(gelen=="yok" || gelen==" "){
                                            $('.devamGor').remove();
                                        }else{
                                            $("#duvarAlani").append(gelen);

                                        }


                                    }, complete: function () {

                                        //id -= 10
                                        //  alert(id);
                                        // if (id < 1) {
                                        //   id = 0;
                                        // }
                                        //  alert(id);
                                        $('#sayfaYukle').hide();
                                    }

                                });

                            }

                            return false;
                        });
                    });

                </script>
                <!--yorum göster scripti-->
                <script>
                    $(function () {


                        $(document).off('click', '.yorumGoster').on('click', '.yorumGoster', function () {

                            var id = $('.yorumGoster input:first').val();
                            //alert(sip_no);
                            $.ajax({
                                type: "POST",
                                url: "server-side/yorumGoster.php",
                                data: "yorumId=" + id,
                                success: function (gelen) { //Başarılı olursa,
                                    $('.yorumAnaBolum' + id).html(' ').html(gelen);

                                }

                            });
                            return false;
                        })
                        $(document).off('click', '.yorumGizle').on('click', '.yorumGizle', function () {


                            var id = $('.yorumGizle input:first').val();
                            // alert( $('.yorumGizle input:first').val());
                            //alert(sip_no);
                            $('.yorumAnaBolum' + id).html(' <a class="yorumGoster"  id=""  ' +
                                'href="" style="text-align: center"> <input id="veriPay"  type="hidden" value="' + id + '">  ' +
                                'Tüm yorumları görmek için tıklayınız</a> ');
                            return false;
                        })
                    })
                </script>
                <!--yorum göster scripti biter/-->

                <script>


                    $(window).scroll(function () {
                        if ($(this).scrollTop() > 300)    // Sayfa ne kadar aşağı kayarsa buton görünsün. 100 sayısı = Kaydırma çubuğunun piksel konumu. Bu sayı değiştirilebilir.
                            $("#yukari").fadeIn(500);    // Yukarı çık butonu ne kadar hızla ortaya çıksın. 500 milisaniye = 0,5 saniye. Bu sayı değiştirilebilir.
                        else
                            $("#yukari").fadeOut(500);    // Yukarı çık butonu ne kadar hızla ortadan kaybolsun. 500 milisaniye = 0,5 saniye. Bu sayı değiştirilebilir.
                    });
                    $(document).ready(function () {
                        $(document).off('click', '.yorumClick').on('click', '.yorumClick', function () {
                            var veri = $(this).closest('li');

                            var id = $('input:eq(0)', veri).val();

                            // alert(id);
                            $.ajax({
                                type: "POST",
                                url: "server-side/yorumGoster.php",
                                data: "yorumId=" + id,
                                success: function (gelen) { //Başarılı olursa,
                                    $('.yorumAnaBolum' + id).html(' ').html(gelen);

                                }

                            });
                            return false;
                        })


                        $('#paylasimYaziModal').val('').autoGrow().css('height', '50');
                   /**     $('#paylasimYazi').bind('keydown keyup keypress change', function () {
                            var uzunluk = $(this).val().length;
                            var sonuc = 298 - uzunluk;
                            if (uzunluk > 298) {
                                $('#paylasLi').css('display', 'none');
                            } else {
                                $('#paylasLi').css('display', 'block');
                            }
                            $('.sayac').html(sonuc);

                        });*/
                        $('.yorumPaylasim').bind('keydown keyup keypress change', function (e) {
                            //   alert("oldu");
                            var uzunluk = $(this).val().length;
                            var sonuc = 298 - uzunluk;
                            if (uzunluk > 298) {
                                if (e.which != 8) return false;
                            }


                        });
                      /**  $('#paylasimYaziModal').bind('keydown keyup keypress change', function () {
                            //   alert("oldu");
                            var uzunluk = $(this).val().length;
                            var sonuc = 298 - uzunluk;
                            if (uzunluk > 298) {
                                //     alert('oldu');
                                $('#paylasimModal').css('display', 'none');
                            } else {
                                $('#paylasimModal').css('display', 'block').css("float", 'right');
                            }
                            $('.sayacPa').html(sonuc);

                        });*//

                        $("#yukari").click(function () {    // Yukarı çık butonuna tıklanıldığında aşağıdaki satır çalışır.
                            $("html, body").animate({scrollTop: "0"}, 500);    // Sayfa ne kadar hızla en yukarı çıksın.
                            // 0 sayısı sayfanın en üstüne çıkılacağını belirtir.
                            // 500 sayısı ne kadar hızla çıkılacağını belirtir. 500 milisaniye = 0,5 saniye. Bu sayı değiştirilebilir.
                            return false;
                        });
                    });
                </script>
                <script>
                    $(document).on('ready', function () {


                        var id = $('.sonId').val();

                        /**      setInterval(function() { //100 milisaniyede bir bildirim.php'de bulunan değeri kontrol ettik.
                         //   alert("head kısım"+id);
                            $.get( "server-side/bildirimControl.php?sonId="+id, function(data) {
                              //  $('.sonId').remove();
                                $('#bildirimBolum').html(data);

                            });
                        },10000);

                         setInterval(function() { //100 milisaniyede bir bildirim.php'de bulunan değeri kontrol ettik.
                            $.get( "server-side/bildirimSayiAl.php", function(data) {
                                $('#bildirimSayi').html(" ").prepend(data);

                            });
                        },10000);->*/

                        $("#bildirim").click(function () { //Bildirime tıklandığında,
                            $.ajax({ //bildirim.php'ye "sifirla" işlemini Post ediyoruz.
                                type: "POST",
                                url: "server-side/bildirimControl.php",
                                data: "islem=sifirla",
                                success: function (gelen) { //Başarılı olursa,
                                    $("#bildirimSayi").remove(); //Bildirimi sıfırlıyoruz.

                                }

                            });
                        });

                    });
                </script>
                <script>
                    $(document).ready(function () {
                        var genislik = $(window).width();
                        if (genislik <= 665) {
                            $('.araText').css('margin-left', '0px').css('width', '20%');
                            $('.messages-menu a').css('padding-left', '0px').css('padding-right', '0px');
                            $('.user-menu-responsive  a').css('color', '#000').css('font-size', '20px');
                            $('.user-btn').css('display', 'none');
                            $('.takip-menu').css('display', 'none');
                            $('.user-menu-normal').css('display', 'none');
                            $('.user-menu-responsive').css('display', 'block');
                            $('.alert').css('display', 'none');
                        } else {
                            $('.araText').css('margin-left', '5%').css('width', '25%');
                            $('.user-btn').css('display', 'block');
                            $('.takip-menu').css('display', 'block');
                            $('.user-menu-responsive').css('display', 'none');
                            $('.user-menu-normal').css('display', 'block');
                            $('.alert').css('display', 'block');

                        }
                    })
                    $(window).resize(function () {
                        var genislik = $(window).width();

                        if (genislik <= 665) {
                            $('.araText').css('margin-left', '0px').css('width', '20%');
                            $('.messages-menu a').css('padding-left', '0px').css('padding-right', '0px');
                            $('.user-btn').css('display', 'none');
                            $('.takip-menu').css('display', 'none');
                            $('.user-menu-responsive  a').css('color', '#000').css('font-size', '20px');
                            $('.user-menu-normal').css('display', 'none');
                            $('.user-menu-responsive').css('display', 'block');
                            $('.gundemLi .list-group-item:gt(4)').css("display","none");
                            $('.alert').css('display', 'none');

                        } else {
                            $('.araText').css('margin-left', '5%').css('width', '25%');
                            $('.user-btn').css('display', 'block');
                            $('.takip-menu').css('display', 'block');
                            $('.user-menu-responsive').css('display', 'none');
                            $('.user-menu-normal').css('display', 'block');
                            $('.gundemLi .list-group-item:gt(4)').css("display","block");
                            $('.alert').css('display', 'block');
                        }
                    });
                </script>
                <li class="dropdown messages-menu" id="bildirim">
                    <?php
                    $userId = $uye[0]['user_id'];

                    $sql = "select * from bildirimler where bildirim_giden_user='$userId' AND okundu_bilgisi='0'    ORDER  by tarih desc";
                    $dataSet = mysqli_query($db, $sql);
                    if ($dataSet != true) {
                        echo mysqli_error($db);
                    }
                    $sayi = mysqli_num_rows($dataSet);
                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-bell-o"></i>';
                    if ($sayi != 0) {
                        echo '

                    <span class="label label-success" id="bildirimSayi">' . $sayi . '</span>
                    ';
                    }
                    echo ' </a>';
                    ?>


                    <?php

                    $userId = $uye[0]['user_id'];

                    $sql = "select * from bildirimler where bildirim_giden_user='$userId'     ORDER  by tarih desc";
                    $dataSet = mysqli_query($db, $sql);/**  $v= mysqli_fetch_assoc($dataSet);
                     * $son=$v['id'];
                     * echo '<input type="hidden" class="sonId" value="'.$son.'"  name="sonId"  />'*/; ?>
                    <ul class="dropdown-menu" id="bildirimBolum">
                        <?php

                        $userId = $uye[0]['user_id'];

                        $sql = "select * from bildirimler where bildirim_giden_user='$userId' ORDER  by tarih desc";
                        $dataSet = mysqli_query($db, $sql);

                        $bildirimSayi = mysqli_num_rows($dataSet);
                        if ($bildirimSayi == 0) {

                            echo '<li><h5 style="text-align: center">Henüz bildirim almadınız</h5></li>';

                        }
                        echo '
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                ';
                        while ($row = mysqli_fetch_assoc($dataSet)) {
                            //gelen user bilgilerini al
                            $userGelen = uyeBul($row['user_gelen_id']);
                            //bildirim tipi bulma
                            $tip = $row['bildirim_type'];

                            switch ($tip) {
                                case 'paylasim':
                                    $type = 'Seni paylaşımına etiketledi';
                                    break;
                                case 'yorum':
                                    $type = 'Seni paylaşımında bir yoruma etiketledi';
                                    break;
                                case 'yorumEtiketsiz':
                                    $type = 'Senin paylaşımına yorum yaptı';
                                    break;
                                case 'takip':
                                    $type = 'Seni takip etmeye başladı';
                                    break;
                                case 'paybegeni':
                                    $type = 'Senin paylaşımını beğendi';
                                    break;
                                case 'yorumbegeni':
                                    $type = 'Senin yorumunu beğendi';
                                    break;
                            }


                            echo '
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            ';
                            ?>

                            <?php
                            if ($tip == 'takip') {
                                echo '  <a href="user.php?id=' . $userGelen[0]['username'] . '">';
                            } else {
                                echo '  <a href="post.php?post=' . $row['bildirim_baglanti'] . '">';
                            }

                            echo '   <div class="pull-left">';

                            if ($userGelen[0]['user_profil_resim'] != '') {
                                echo '<img src="uploads/user/' . $userGelen[0]['user_profil_resim'] . '"  class="img-circle ">';
                            } else {
                                echo '<img src="dist/img/profil-resim.png"  class="img-circle" >';

                            }
                            echo '

                                                </div>
                                                <h4>
                                                    ' . $userGelen[0]['user_adi'] . ' ' . $userGelen[0]['user_soyadi'] . '
                                                    <small><i class="fa fa-clock-o"></i> ' . zaman($row['tarih']) . '</small>
                                                </h4>
                                                <p>' . $type . '</p>
                                            </a>
                                        </li>
                                        <!-- end message -->

                                    </ul>
                                </li>';
                        }
                        echo '</ul>
                        </li></ul>';
                        ?>


                        <!--   <li class="footer"><a href="#">See All Messages</a></li>-->

                        </li>


                        <li class="dropdown user user-menu user-btn">
                            <a href="user.php?id=<?php echo $uye[0]['username'] ?>">
                                <?php
                                if ($uye[0]['user_profil_resim'] != '') {
                                    echo '<img src="uploads/user/' . $uye[0]['user_profil_resim'] . '" class="user-image" alt="User Image">';
                                } else {
                                    echo '<img src="dist/img/profil-resim.png" class="user-image" alt="User Image">';

                                }
                                echo '<span class="hidden-xs">' . $uye[0]['user_adi'] . ' ' . $uye[0]['user_soyadi'] . '</span>';
                                ?>


                            </a>

                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li class="dropdown user user-menu user-menu-normal ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="true">
                                <i class="fa fa-gears"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="edit-profile.php" class="btn btn-default btn-flat">Ayarlar</a>
                                    </div>

                                    <div class="pull-right">
                                        <a href="server-side/logout.php" class="btn btn-default btn-flat">Çıkış Yap</a>
                                    </div>


                                </li>
                            </ul>
                        </li>


                        <li style="display: none" class="dropdown user user-menu-responsive ">
                            <a href="server-side/logout.php" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="true">
                                <i class="fa fa-gears"></i>
                            </a>
                            <ul class="dropdown-menu">

                                <li style="    height: 32px;">
                                    <a style="    height: 100%;" class="btn btn-default btn-flat"
                                       href="user.php?id=<?php echo $uye[0]['username'] ?>">
                                        <?php
                                        if ($uye[0]['user_profil_resim'] != '') {
                                            echo '<img style="    margin-right: 8px;height: 100%; border-radius: 140px;" src="uploads/user/' . $uye[0]['user_profil_resim'] . '" class="user-image" alt="User Image">';
                                        } else {
                                            echo '<img style="    margin-right: 8px;height: 100%; border-radius: 140px;"  src="dist/img/profil-resim.png" class="user-image" alt="User Image">';

                                        }
                                        echo '' . $uye[0]['user_adi'] . ' ' . $uye[0]['user_soyadi'] . '';
                                        ?>


                                    </a>
                                </li>

                                <li>
                                    <a class="btn btn-default btn-flat" href="arkadasBul.php">
                                        Kimi Takip Etmeli


                                    </a>
                                </li>
                                <?php
                                    if($_SESSION['user_type']!='uye'){
                                        echo '
                                        <li>
                                    <a class="btn btn-default btn-flat" href="sikayetler.php">
                                        Şikayet Listesi


                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-default btn-flat" href="eskiUye.php">
                                        Silinen Kullanıcı Listesi


                                    </a>
                                </li>';
                                    }
                                ?>
                                <li>
                                    <a href="edit-profile.php" class="btn btn-default btn-flat">Ayarlar</a>
                                </li>
                                <li style="background: #f39c12 !important">
                                    <a href="kayitMailGonder.php" class="btn-default btn-flat" style="color:black">Doğrulamayı yeniden gönder</a>                                </li>
                                <li>
                                    <a href="server-side/logout.php" class="btn btn-default btn-flat">Çıkış Yap</a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown user user-menu " style="margin-top: 2%;margin-right: 5px">
                            <a data-toggle="modal" data-target="#paylasModal" style=" color: #000; font-weight: bold;"
                               href="#" class="dropdown-toggle btn btn-default" aria-expanded="true">Paylaş
                            </a>
                        </li>
                    </ul>
        </div>
    </nav>
</header>
<?php
if ($uye[0]['user_aktivasyon'] == 0) {
    ?>
    <div class="container" style="min-height: 50px;">
        <div class="alert alert-warning">
            <strong>Dikkat</strong> E-Posta Aktivasyon İşleminiz Tamamlanmamış ( Lütfen kayıtlı olduğunuz E-Posta
            adresini kontrol ediniz.
            ) <a href="kayitMailGonder.php" class="btn small " style="color:black">Doğrulamayı yeniden gönder</a>
        </div>
    </div>
<?php } ?>
<script></script>

<script type="text/javascript">

    $(document).off('click', '.sil').on('click', '.sil', function () {
        var id=$(this).attr("data-id");

        $('.paylasimbtnler').html('<a style="margin-right:5px"  target="_blank" class="btn btn-info btn-xs" href="https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fabout.twitter.com%2Ftr%2Fresources%2Fbuttons&ref_src=twsrc%5Etfw&text=siteadi&tw_p=tweetbutton&url=https%3A%2F%2Fsiteadi.com%2Fpost.php%3Fpost='+id+'" >Tweet</a>'+

            '<a target="_blank" class="btn btn-primary btn-xs" href="http://www.facebook.com/share.php?u=https://siteadi/post.php?post=' +id+ '">Paylaş</a>')

    });


    $(document).off('click', '.yorumSil').on('click', '.yorumSil', function () {
        var veri = $(this).closest('span');
        var id = $('input:eq(0)', veri).val();
        var id2 = $('input:eq(1)', veri).val();
        // alert(id +' '+id2 );

        var r = confirm("Yorumu Silmek İstediğinize Emin misiniz?");
        if (r == true) {
            $.ajax(
                {
                    url: 'server-side/silYorum.php',
                    type: 'POST',
                    data: 'yorumId=' + id + '&userYorum=' + id2,
                    success: function (gelen) {
                        //console.log(gelen);
                        if (gelen == 'ok') {
                            $(".yorumBolum" + id).remove();

                        } else {
                            alert('Paylaşım Silinirken Bir Sorun Oluştu');
                        }
                    }
                }
            )
        }
        return false;
    });
</script>

<div class="modal fade" id="paylasModal" tabindex="-1" role="dialog" aria-labelledby="paylasModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Paylaşim</h4>
            </div>
            <div class="modal-body">
                <div class="post">
                    <div class="user-block">
                        <?php
                        if ($uye[0]['user_profil_resim'] != '') {
                            echo '<img src="uploads/user/' . $uye[0]['user_profil_resim'] . '"  class="img-circle img-bordered-sm">';
                        } else {
                            echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                        }

                        ?>
                        <form id="paylasForm" action="" method="post" enctype="multipart/form-data">

                                        <span class="username">
                                            <span class="username" style="float:left; margin:0;">

                                            <a href="#"
                                               onclick="return false"><?php echo $uye[0]['user_adi'] . ' ' . $uye[0]['user_soyadi'] ?></a>

                                         </span>
                                            <textarea id="paylasimYaziModal" name="nameModal" cols="1" rows="1"
                                                      class="form-control paylasimYazi "
                                                      required placeholder="Birşeyler Yaz" style="height: 50px;">

                                            </textarea>
                                             <span style="float: right;" class="sayacPa">&nbsp;</span>
                                                <style>
                                                .keySonuc {
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
                                <ul class="list-inline">
                                    <li style="margin-left: 5%;" id="resimPaylasimAlanModal">
                                        <a href="#" class="link-black text-sm">

                                            <i class="fa fa-camera  margin-r-5">
                                                <input required id="resimModal" name="resimModal"
                                                       class="dosyaYukle required resim" type="file">

                                            </i>
                                        </a>
                                    </li>


                                </ul>
                            </div>

                            <div class="col-md-11" style="margin-left: 4%;">
                                <span class="hata"></span>

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
                <button type="button" class="btn btn-default" id="PaylasVazgecModal" data-dismiss="modal">Vazgeç
                </button>
                <button type="button" class="btn btn-primary" id="paylasimModal">Paylaş</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="payKisiGoster" tabindex="-1" role="dialog" aria-labelledby="payKisiGoster">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="PaylasVazgecModal" data-dismiss="modal">Vazgeç
                </button>
            </div>
        </div>
    </div>
</div>

