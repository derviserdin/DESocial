<?php session_start();  ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Üyelik Aktivasyon - DE Social</title>
</head>
<body>
<?php

if (isset($_GET['id'])) {
    $user=$_GET['id'];
    include_once 'server-side/db_con.php';
    require_once 'server-side/fonksiyon.php';
//require_once 'views/paylasimView.
    $db = db_con();
    $sql = "select user_id from users where user_id='$user' and user_aktivasyon='0'";
    $dataSet = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($dataSet);
    $userId = $row['user_id'];
    if ($dataSet == true) {
        if (mysqli_num_rows($dataSet) > 0) {
            $sqlAktivite = "update users set user_aktivasyon='1' where user_id='$userId'";
            $aktiviteData = mysqli_query($db, $sqlAktivite);
            if ($aktiviteData == true) {
                echo('<script type="text/javascript">alert("Aktivasyon işleminiz tamamlanmıştır.") ;window.open("index.php","_self");</script>');

            } else {
                echo('<script type="text/javascript">alert("Bir sorun oluştu!!") ;window.open("index.php","_self");</script>');

            }
        } else {
            echo('<script type="text/javascript">alert("Aktivasyonunuz Zaten Tamamlanmış") ;window.open("index.php","_self");</script>');

        }
    } else {
        echo('<script type="text/javascript">alert("Bir sorun oluştu!!") ;window.open("index.php","_self");</script>');

    }

} else {
    echo('<script type="text/javascript">alert("Lütfen giriş  yapıp  mail adresinizde ki  aktivasyon linkine tıklayınız!!") ;window.open("index.php","_self");</script>');
}

 ?>

</body>
</html>