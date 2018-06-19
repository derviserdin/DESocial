<?php
session_start();
if (isset($_SESSION['user'])) {
    die('<script type="text/javascript">window.open("index.php","_self");</script>');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>İkinci Osmanlı</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="plugins/jQueryUI/jquery-ui.css" type="text/css">
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="plugins/jQueryUI/jquery-ui.js"></script>
    <style>

        @media (max-width: 500px){
            #logohead{
                height:auto;
                margin-top: 33%;
                margin-left: 3%;
            }
        }
        @media (min-width: 501px)   and (max-width: 1920px) {
            #logohead{
                height:100%;
                margin-top: 2%;
                margin-left: 3%;
            };
        }
    </style>

    <script type="text/javascript">

        var $ = jQuery;
        $(document).ready(function (e) {

            setTimeout(function () {
                $("form input[name=user]").trigger("focus");
            }, 100);

            $("#form").on("submit", function (e) {
                var user = $.trim($(this).find("input[name=user]").val());
                var pass = $.trim($(this).find("input[name=pass]").val());
                if ((user == "") || (pass == "")) {
                    return false;
                }

            });
        });
    </script>
    <script>
        $(function () {
            $(".dogum-tarihi").datepicker();
            $("#usernameR").on("keydown", function (event) {
                if (event.which == 32) {
                    //alert('tıklandı');
                    return false;
                }
            });
        })
    </script>
    <style>
        .loginTable td {
            padding: 1%;
        }
    </style>
</head>
<body>
<div id="page">
    <div id="header" class="container-fluid" style="padding: 0;">
        <div class="col-md-3 col-sm-3 col-xs-3" style="height: 100%;">
            <img src="img/logo-2.png" alt="İkinci Osmanlı"
                 style="" id="logohead" class="img-responsive">

        </div>
        <div class="col-md-9 col-sm-9 col-xs-9" style="height: 100%;float: right;">

            <form id="form" action="server-side/logon.php" method="post">
                <table class="loginTable" style="float: right;">
                    <tr>
                        <td><label> E-Posta </label></td>
                        <td><label> Şifre </label></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="text" name="user"/></td>
                        <td><input class="form-control" type="password" name="pass"/></td>
                        <td>
                            <button type="submit" class="btn btn-default btn-block">Giriş Yap</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script>

    </script>
    <div class="container" style="margin-top: 5%;margin-bottom:5%">
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 7%;">
            <div><img class="img-responsive" src="img/sancak.png" alt="İkinci Osmanlı"></div>
            <div><img class="img-responsive" src="img/yazi.png" alt="İkinci Osmanlı"></div>
            <div style="margin-top: -5%;"><img class="img-responsive" src="img/islam.jpg" alt="İkinci Osmanlı"></div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="register-box-body">
                <p class="login-box-msg"><h2>Hesap Aç</h2></p>
                <?php

                if (isset($_GET['hata'])) {
                    echo '<div class="alert alert-warning" role="alert">' . $_GET['hata'] . '</div>';
                }
                ?>
                <form action="server-side/insertUser.php" method="post">
                    <div class="form-group has-feedback">
                        <input name="Ad" type="text" required class="form-control" value="<?php if(isset($_GET['ad'])) echo $_GET['ad'] ?>" placeholder="Adınız">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="Soyad" type="text" required class="form-control" value="<?php if(isset($_GET['soyad'])) echo $_GET['soyad'] ?>" placeholder="Soyadınız">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="usernameR" id="usernameR" type="text" value="<?php if(isset($_GET['username'])) echo $_GET['username'] ?>" required class="form-control"
                               placeholder="Kullanıcı Adınız">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="emailR" type="email" required class="form-control" value="<?php if(isset($_GET['email'])) echo $_GET['email'] ?>"  placeholder="E-posta">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="passR" type="password" required class="form-control" placeholder="Parola">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="repassR" type="password" required class="form-control" placeholder="Parola Tekrar">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <h5>Doğum Tarihi</h5>
                        <select style="width: 21%;float: left" aria-label="Gün" name="gun" id="day" title="Gün" class="form-control ">
                            <option value="0" selected="1">Gün</option>
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
                        <select style="width: 21%;float: left " aria-label="Ay" name="ay" id="month" title="Ay" class="form-control">
                            <option value="0" selected="1">Ay</option>
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
                        <select style="width: 21%;float: left" aria-label="Yıl" name="yil" id="year" title="Yıl" class="form-control">
                            <option value="0" selected="1">Yıl</option>
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
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false"
                                         style="position: relative;">
                                        <input required name="kosul" type="checkbox"></div>
                                    Kaydol'a Tıkladığınızda <a target="_blank" href="kosullar.php">Koşullarımızı</a>
                                    Kabul Etmiş Olursunuz.
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat kayit">Kaydol</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <div style="width: 100%;" id="tugraSag" class="col-md-6 col-sm-6 col-xs-12">
                <img style="margin-top: 8%;" class="img-responsive" src="img/Tughra_of_Mehmed_II.png"
                     alt="İkinci Osmanlı">
            </div>

        </div>
    </div>

    <div id="footer" style="line-height: 5">
        <strong>Copyright &copy;2016 </strong>
        reserved.
    </div>
</div>
<script>


</script>
<script>
    // $(".dogum-tarihi").datepicker();
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
</body>


</html>