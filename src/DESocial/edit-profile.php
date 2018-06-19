<?php
include_once 'server-side/durumKontrol.php';
include_once 'server-side/db_con.php';
include_once 'server-side/fonksiyon.php';

$db = db_con();
if (!$db) die("<p>Veritabanına bağlanılamadı. Kayıtlar gösterilemiyor!</p></body></html>");

$user_id = $_SESSION['user'];
$sorgu = mysqli_query($db, "select * from users where user_id='$user_id'");
$str = mysqli_fetch_array($sorgu);

//yıl formatı yyyy-aa-gg  bunu oarçalayıp select box'a Yerleştir.
$parçalaYil=explode('-',$str['user_dogum_tarih']);

//3 elemanlı bir dizi oluşucaktır bunları sırayla değişkenlere at

$yil=$parçalaYil[0];
$ay=$parçalaYil[1];
$gun=$parçalaYil[2];
$db = db_con();

$uye = array();
if (uyeBul($user_id) == '0') {
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}
// üye bilgilerini diziye atalım
$uye = uyeBul($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DE Social</title>
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

    <link rel="shortcut icon" href="img/logo-2.png" />
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php include_once 'header.php' ?>
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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
                <button style="display: none" type="button" class="btn btn-danger" id="resimVazgecTamam"
                        data-dismiss="modal">Tamam
                </button>
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
                if ($str["user_profil_resim"] == '') {
                    echo '<img src="dist/img/profil-resim.png" alt="İkinci Osmanlı" width="200" height="200">';
                } else {
                    echo ' <img src="uploads/user/' . $str["user_profil_resim"] . '" alt="İkinci Osmanlı" width="200" height="200">';

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
                <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary"
                        id="btn_resim_guncelle" data-id="<?php echo $str["user_id"]; ?>">Resmi Değiştir
                </button>
                <!-- Button trigger modal -->

            </div>
        </div>

        <div class="col-md-8">

            <div class="row">
                <div class="col-xs-3 lbl">Adı</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_adi" maxlength="50"
                                             value="<?php echo $str["user_adi"]; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Soyadı</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_soyadi" maxlength="50"
                                             value="<?php echo $str["user_soyadi"]; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Kullanıcı Adı</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" id="username" class="form-control" name="username"
                                             maxlength="50" value="<?php echo $str["username"]; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">E-Posta Adresi</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="email" id="email" class="form-control" name="email"
                                             value="<?php echo $str["user_email"]; ?>"></div>
                <div class="col-xs-8"><input required type="hidden" id="emailR" class="form-control" name="emailR"
                                             value="<?php echo $str["user_email"]; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Şifre Yenile</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="password" class="form-control" name="password"
                                             maxlength="50" value=""></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Şifre Yenile Tekrar</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="password" class="form-control" name="passwordR"
                                             maxlength="50" value=""></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Yaşadığı Şehir</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_sehir" maxlength="50"
                                             value="<?php echo $str["user_sehir"]; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Doğum Tarihi</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8">
                    <select style="width: 21%;float: left" aria-label="Gün" name="gun" id="day" title="Gün"
                            class="form-control ">
                        <option value="<?php echo  $gun ?>" selected="1"><?php echo  $gun ?></option>
                        <option value="0" >Gün</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select style="width: 21%;float: left " aria-label="Ay" name="ay" id="month" title="Ay"
                            class="form-control">
                        <option value="<?php echo  $ay ?>" selected="1"><?php echo  $ay ?></option>

                        <option value="0">Ay</option>
                        <option value="1">Oca</option>
                        <option value="2">Şub</option>
                        <option value="3">Mar</option>
                        <option value="4">Nis</option>
                        <option value="5">Mayıs</option>
                        <option value="6">Haz</option>
                        <option value="7">Tem</option>
                        <option value="8">Ağu</option>
                        <option value="9">Eyl</option>
                        <option value="10">Eki</option>
                        <option value="11">Kas</option>
                        <option value="12">Ara</option>
                    </select>
                    <select style="width: 21%;float: left" aria-label="Yıl" name="yil" id="year" title="Yıl"
                            class="form-control">
                        <option value="<?php echo  $yil ?>" selected="1"><?php echo  $yil ?></option>

                        <option value="0" >Yıl</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                        <option value="1989">1989</option>
                        <option value="1988">1988</option>
                        <option value="1987">1987</option>
                        <option value="1986">1986</option>
                        <option value="1985">1985</option>
                        <option value="1984">1984</option>
                        <option value="1983">1983</option>
                        <option value="1982">1982</option>
                        <option value="1981">1981</option>
                        <option value="1980">1980</option>
                        <option value="1979">1979</option>
                        <option value="1978">1978</option>
                        <option value="1977">1977</option>
                        <option value="1976">1976</option>
                        <option value="1975">1975</option>
                        <option value="1974">1974</option>
                        <option value="1973">1973</option>
                        <option value="1972">1972</option>
                        <option value="1971">1971</option>
                        <option value="1970">1970</option>
                        <option value="1969">1969</option>
                        <option value="1968">1968</option>
                        <option value="1967">1967</option>
                        <option value="1966">1966</option>
                        <option value="1965">1965</option>
                        <option value="1964">1964</option>
                        <option value="1963">1963</option>
                        <option value="1962">1962</option>
                        <option value="1961">1961</option>
                        <option value="1960">1960</option>
                        <option value="1959">1959</option>
                        <option value="1958">1958</option>
                        <option value="1957">1957</option>
                        <option value="1956">1956</option>
                        <option value="1955">1955</option>
                        <option value="1954">1954</option>
                        <option value="1953">1953</option>
                        <option value="1952">1952</option>
                        <option value="1951">1951</option>
                        <option value="1950">1950</option>
                        <option value="1949">1949</option>
                        <option value="1948">1948</option>
                        <option value="1947">1947</option>
                        <option value="1946">1946</option>
                        <option value="1945">1945</option>
                        <option value="1944">1944</option>
                        <option value="1943">1943</option>
                        <option value="1942">1942</option>
                        <option value="1941">1941</option>
                        <option value="1940">1940</option>
                        <option value="1939">1939</option>
                        <option value="1938">1938</option>
                        <option value="1937">1937</option>
                        <option value="1936">1936</option>
                        <option value="1935">1935</option>
                        <option value="1934">1934</option>
                        <option value="1933">1933</option>
                        <option value="1932">1932</option>
                        <option value="1931">1931</option>
                        <option value="1930">1930</option>
                        <option value="1929">1929</option>
                        <option value="1928">1928</option>
                        <option value="1927">1927</option>
                        <option value="1926">1926</option>
                        <option value="1925">1925</option>
                        <option value="1924">1924</option>
                        <option value="1923">1923</option>
                        <option value="1922">1922</option>
                        <option value="1921">1921</option>
                        <option value="1920">1920</option>
                        <option value="1919">1919</option>
                        <option value="1918">1918</option>
                        <option value="1917">1917</option>
                        <option value="1916">1916</option>
                        <option value="1915">1915</option>
                        <option value="1914">1914</option>
                        <option value="1913">1913</option>
                        <option value="1912">1912</option>
                        <option value="1911">1911</option>
                        <option value="1910">1910</option>
                        <option value="1909">1909</option>
                        <option value="1908">1908</option>
                        <option value="1907">1907</option>
                        <option value="1906">1906</option>
                        <option value="1905">1905</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Ülke</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8"><input required type="text" class="form-control" name="user_ulke" maxlength="50"
                                             value="<?php echo $str["user_ulke"]; ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-3 lbl">Paylaşım Gizliliği</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8">
                    <select name="gizli" id="payGizleDurum" class="form-control">
                        <?php
                            $user_pay_gizle=$str['user_pay_gizle'];

                            if($user_pay_gizle=='0'){
                                echo '  <option value="0" selected>Lütfen Seçiniz</option>
                                   <option value="a">Herkese Açık</option>
                                    <option value="b">Sadece Takipçiler</option>';
                            }else if($user_pay_gizle=='a'){
                                echo '
                                   <option value="a" selected>Herkese Açık</option>
                                    <option value="b">Sadece Takipçiler</option>';
                            }else if($user_pay_gizle=='b'){
                                echo '
                                   <option value="a">Herkese Açık</option>
                                    <option value="b" selected>Sadece Takipçiler</option>';
                            }
                        ?>


                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-3 lbl">Kimler Takip Edebilir</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8">
                    <select name="takipDurum" id="takipDurum" class="form-control">
                        <?php
                        $user_takip=$str['user_takip_durum'];

                        if($user_takip=='0'){
                            echo '  <option value="0" selected>Lütfen Seçiniz</option>
                                   <option value="a">Herkese Açık</option>
                                    <option value="b">Sadece Takipçiler</option>';
                        }else if($user_takip=='a'){
                            echo '
                                   <option value="a" selected>Herkese Açık</option>
                                    <option value="b">Sadece Takipçiler</option>';
                        }else if($user_takip=='b'){
                            echo '
                                   <option value="a">Herkese Açık</option>
                                    <option value="b" selected>Sadece Takipçiler</option>';
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-3 lbl">Kimler  Mesaj Gönderebilir</div>
                <div class="col-xs-1 lbl">:</div>
                <div class="col-xs-8">
                    <select name="mesajDurum" id="mesajDurum" class="form-control">

                        <?php
                        $user_mesaj=$str['user_mesaj_durum'];

                        if($user_mesaj=='0'){
                            echo '  <option value="0"  selected>Lütfen Seçiniz</option>
                                   <option value="a">Herkese Açık</option>
                                    <option value="b">Sadece Takipçiler</option>';
                        }else if($user_mesaj=='a'){
                            echo '
                                   <option value="a" selected>Herkese Açık</option>
                                    <option value="b">Sadece Takipçiler</option>';
                        }else if($user_mesaj=='b'){
                            echo '
                                   <option value="a">Herkese Açık</option>
                                    <option value="b" selected>Sadece Takipçiler</option>';
                        }
                        ?>

                    </select>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-4"></div>
                <div class="col-xs-8">
                    <button style="margin-bottom: 3%;" class="btn btn-primary" id="btn_bilgi_guncelle"
                            data-id="<?php echo $str["user_id"]; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <span class="text">Güncelle</span>
                    </button>
                    <button style="margin-bottom: 3%;float: right;" class="btn btn-danger" id="btn_bilgi_sil"
                            data-id="<?php echo $str["user_id"]; ?>">

                        <span class="text">Hesabı Sil</span>
                    </button>
                    <input type="hidden" name="user_id" value="<?php echo $str["user_id"]; ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer" style="margin-left: 0px;">

    <strong>Copyright &copy;2016 .</strong>
    reserved.
</footer>


</body>
</html>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.css">

<script type="text/javascript" src="plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="js/jquery.Jcrop.min.js"></script>
<script src="js/plugins/jquery.imgareaselect.pack.js"></script>
<script src="js/jquery.autogrowtextarea.min.js"></script>
<script>
    $(document).ready(function () {
        $('#day').mousedown(function () {
           $('#day option:first').hide();
        });
        $('#month').mousedown(function () {
            $('#month option:first').hide();
        });
        $('#year').mousedown(function () {
            $('#year option:first').hide();
        });

        $('#ladybug_ant').imgAreaSelect({maxWidth: 200, maxHeight: 150, handles: true});
    });
</script>


<script src="js/edit-profile.js" type="text/javascript">

</script>

<script>
    $(".dogum-tarihi").datepicker();
    ( function (factory) {
        if (typeof define === "function" && define.amd) {

            // AMD. Register as an anonymous module.
            define(["../widgets/datepicker"], factory);
        } else {

            // Browser globals
            factory(jQuery.datepicker);
        }
    }(function (datepicker) {

        datepicker.regional.tr = {
            closeText: "kapat",
            prevText: "&#x3C;geri",
            nextText: "ileri&#x3e",
            currentText: "bugün",
            monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",
                "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
            monthNamesShort: ["Oca", "Şub", "Mar", "Nis", "May", "Haz",
                "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
            dayNames: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"],
            dayNamesShort: ["Pz", "Pt", "Sa", "Ça", "Pe", "Cu", "Ct"],
            dayNamesMin: ["Pz", "Pt", "Sa", "Ça", "Pe", "Cu", "Ct"],
            weekHeader: "Hf",
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""
        };
        datepicker.setDefaults(datepicker.regional.tr);

        return datepicker.regional.tr;

    }) );


</script>


