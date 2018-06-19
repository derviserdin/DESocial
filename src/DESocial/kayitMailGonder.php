<?php session_start();  ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Üyelik Aktivasyon - DE Social</title>
</head>
<body>
<?php

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    include_once 'server-side/db_con.php';
    require_once 'server-side/fonksiyon.php';
//require_once 'views/paylasimView.
    $db = db_con();
    $sql = "select * from users where user_id='$user' and user_aktivasyon='0'";
    $dataSet = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($dataSet);
    $email=$row['user_email'];
    $ad=$row['user_adi'];
    $soyadi=$row['user_soyadi'];
    $pass=$row['password'];
    $userId = $row['user_id'];
    if ($dataSet == true) {
        if (mysqli_num_rows($dataSet) > 0) {
            require 'server-side/phpmailer/PHPMailerAutoload.php';
            require 'server-side/phpmailer/vmd.config.php';


            $mail = new PHPMailer();
            //$mail->IsSMTP();  server29. satırdaki mail->isSMTP () kodu için serverda ssl
            // olması gerekiyor galiba. Onu comment yapıp yeniden yükledim dosyayı. Aklında olsun
            $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
            $mail->SMTPSecure = 'ssl'; // Güvenli baglanti icin ssl normal baglanti icin tls
            $mail->SMTPAuth = true;
            $mail->Host = 'siteadres';
            $mail->IsHTML(true);
            $mail->Port = 465;
            $mail->SetLanguage("tr", "phpmailer/language");
            $mail->Username = 'mail adres';
            $mail->Password = 'password';
            $mail->SetFrom($mail->Username, 'DE Social Aktivasyon Maili');
            $mail->AddAddress($email, $ad . ' ' . $soyadi);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Üye Kayıt';
            $mail->MsgHTML('<p>DE Social kayıt işleminiz başarıyla tamamlanmıştır.</p>
                                      <p><a href="http://siteadi.com/aktivasyonUser.php?id=' . $row['user_id'] . '">Buraya Tıklayarak  Mail Aktivasyonunuzu Tamamlayabilirsiniz</a> .</p>
                                      <table border="1" cellpadding="10">
                                        <tr>
                                          <th align="right">Adı Soyadı : </th><td>' . $row['user_adi'] . '  ' . $row['user_soyadi'] . '</td>
                                        </tr>
                                        <tr>
                                          <th align="right">E-Posta Adresi : </th><td>' . $row['user_email'] . '</td>
                                        </tr>
                                        <tr>
                                          <th align="right">Şifre : </th><td>' . $row['password'] . '</td>
                                        </tr>
                                      </table>');
            if ($mail->Send()) {
                echo('<script type="text/javascript">alert("Aktivasyon Mailiniz Gönderildi.") ;window.open("index.php","_self");</script>');
            } else {
                echo '0';
                echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
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
