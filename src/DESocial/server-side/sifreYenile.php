<?php

if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    include_once 'db_con.php';
    require_once 'fonksiyon.php';
//require_once 'views/paylasimView.
    $db = db_con();
    $sql = "select user_email,user_id from users where user_email='$mail'";
    $dataSet = mysqli_query($db, $sql);
    if (mysqli_num_rows($dataSet) == 1) {
        $sql = "select user_email,user_id,user_adi,user_soyadi,password from users where user_email='$mail'";
        $dataSet = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($dataSet);
        $email = $row['user_email'];
        $ad = $row['user_adi'];
        $soyadi = $row['user_soyadi'];
        $pass = $row['password'];
        $userId = $row['user_id'];
        require 'phpmailer/PHPMailerAutoload.php';
        require 'phpmailer/vmd.config.php';


        $mail = new PHPMailer();
        //$mail->IsSMTP();  server29. satırdaki mail->isSMTP () kodu için serverda ssl
        // olması gerekiyor galiba. Onu comment yapıp yeniden yükledim dosyayı. Aklında olsun
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPSecure = 'tls'; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.yandex.com';
        $mail->IsHTML(true);
        $mail->Port = 587;
        $mail->SetLanguage("tr", "phpmailer/language");
        $mail->Username = 'mail adres';
        $mail->Password = 'password';
        $mail->SetFrom($mail->Username, 'DE Social Üyelik Bilgileri Hatırlatma');
        $mail->AddAddress($email, $ad . ' ' . $soyadi);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Üye Kayıt';
        $mail->MsgHTML('<p>Üyelik Bilgileri</p>
                                      <p><a href="http://siteadi.com/login.php">Buraya Tıklayarak  Giriş Yapabilirsiniz</a> .</p>
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
            echo '1';
        } else {
            echo '0';
            //  echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
        }
    }else{
        echo 'kayit';
    }

} else {
    echo 'eksik';
}

?>

