<?php session_start(); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DE Social | Üye Giriş</title>

</head>

<body>

<?php
if (isset($_POST['user']) && isset($_POST['pass'])) {
    include("db_con.php");
    include("fonksiyon.php");
    $db = db_con();

    date_default_timezone_set('Asia/Kuwait');
    $tarih= date("Y-m-d H:i:s");
    if (!$db) {
        die('<script type="text/javascript">alert("Bağlantı hatası!");window.open("index.php","_self");</script>');
    }

    $admin = mysqli_real_escape_string($db, $_POST['user']);
    $sifre = mysqli_real_escape_string($db, $_POST['pass']);

    $sorgu = "SELECT * FROM users WHERE (user_email = '" . $admin . "')AND(password = '" . $sifre . "')";
    $userTablo = mysqli_query($db, $sorgu);

    if (mysqli_num_rows($userTablo) == 1) {

        ///ip bul
        $ip = GetIP();

        //güncelle
        $userKayit = mysqli_fetch_array($userTablo);
        $id = $userKayit['user_id'];
        $sorgu2 = "update users set user_ip='$ip',user_giris_tarih='$tarih' where user_id=$id" ;
        $userTablo2 = mysqli_query($db, $sorgu2);
        if ($userKayit['user_type'] == 'yetkili') {
            $_SESSION['user_type'] = 'yetkili';
            $_SESSION['user_typeAd'] = 'yetkili';
        } else if ($userKayit['user_type'] == 'superAd') {
            $_SESSION['user_type'] = 'yetkili';
            $_SESSION['user_typeAd'] = 'superAd';
        }else if ($userKayit['user_type'] == 'editor') {
            $_SESSION['user_type'] = 'yetkili';
            $_SESSION['user_typeAd'] = 'editor';
        } else {
            $_SESSION['user_typeAd'] = 'uye';
            $_SESSION['user_type'] = 'uye';
        }
        $_SESSION['user'] = $userKayit['user_id'];
        setcookie("userc",  $userKayit['user_id'], time() + (60*60*24));

    } else {
        mysqli_close($db);
        die('<script type="text/javascript">alert("Girişler yanlış!"); window.open("../index.php","_self");</script>');
    }

    if (isset($_SESSION['user'])) {
        mysqli_close($db);
        die('<script type="text/javascript">window.open("../index.php","_self");</script>');
    }
    mysqli_close($db);
} else die('<script type="text/javascript">alert("Hatalı giriş!");window.open("../index.php","_self");</script>');
?>

</body>
</html>