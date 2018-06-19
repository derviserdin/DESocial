<?php
session_start();

if (!isset($_POST['user_id']) ||
    !isset($_POST['user_adi']) ||
    !isset($_POST['user_soyadi']) ||
    !isset($_POST['username']) ||
    !isset($_POST['password']) ||
    !isset($_POST['user_sehir']) ||
    !isset($_POST['user_dogum_tarih']) ||
    !isset($_POST['user_ulke'])||
    !isset($_POST['user_mail'])
) {
   echo 'HATA!Veri Hatası...';
} else if (empty($_POST['user_id']) ||
    empty($_POST['user_adi']) ||
    empty($_POST['user_soyadi']) ||
    empty($_POST['username']) ||
    empty($_POST['password']) ||
    empty($_POST['user_sehir']) ||
    empty($_POST['user_dogum_tarih']) ||
    empty($_POST['user_ulke']) ||
    empty($_POST['user_mail'])

) {
    echo 'HATA! Lütfen Tüm Alanları Doldurunuz...';
} else {

    include("../server-side/db_con.php");
    $db = db_con();
    ob_clean();
    header('Content-Type: text/plain; charset=utf-8');

    $user_id = $_POST["user_id"];
      $user_adi = $_POST["user_adi"];
      $user_soyadi = $_POST["user_soyadi"];
      $username = $_POST["username"];
      $password = $_POST["password"];
      $passwordR = $_POST["passwordR"];
      $user_sehir = $_POST["user_sehir"];
      $user_ulke = $_POST["user_ulke"];
     $user_mail = $_POST["user_mail"];
     $user_mailR = $_POST["user_mailR"];


    $user_dogum_tarih = $_POST["user_dogum_tarih"];
    $yeniAd= preg_replace('/[^a-zA-Z0-9]/s', '', $username);


    if($yeniAd!=$username) {
        die ('Lütfen Kullanıcı Adında Özel Karakterleri Kullanmayınız (Sadece harf ve rakam kullanabilirsin)');


    }
    $eklePaylasim="select * from users where username='$username' and user_id!=$user_id";
    $dataSet=mysqli_query($db,$eklePaylasim);
    if($dataSet==true){
        if(mysqli_num_rows($dataSet)>0){
           echo 'HATA! Bu Kullanıcı Adı Kullanılıyor. Lütfen Başka bir Kullanıcı adı deneyiniz..';
        }
        $eklePaylasim="select * from users where user_email='$user_mail' and user_id!=$user_id";
        $dataSet=mysqli_query($db,$eklePaylasim);
        if(mysqli_num_rows($dataSet)>0){
            echo 'HATA!Bu Email Adı Kullanılıyor. Lütfen Başka bir Email adı deneyiniz..';
        }




    }else{
       echo 'HATA! Bir sorun oluştu..';
    }

    if ($password != $passwordR) {
       echo 'Şifreler Aynı Değil...';
    }

    $user_adi = mysqli_real_escape_string($db, $user_adi);
    $user_soyadi = mysqli_real_escape_string($db, $user_soyadi);
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);
    $user_sehir = mysqli_real_escape_string($db, $user_sehir);
    $user_dogum_tarih = mysqli_real_escape_string($db, $user_dogum_tarih);
    $user_ulke = mysqli_real_escape_string($db, $user_ulke);
    $user_mail = mysqli_real_escape_string($db, $user_mail);

    $sql = "UPDATE users set user_adi='$user_adi' ,  user_soyadi='$user_soyadi'  , username='$username'  , password='$password' ,user_email='$user_mail',  user_sehir='$user_sehir'  , user_dogum_tarih='$user_dogum_tarih'  , user_ulke='$user_ulke' WHERE user_id='$user_id'";
    $sorgu = mysqli_query($db, $sql);
    if ($sorgu==true) {

        if($user_mail!=$user_mailR){



            require 'phpmailer/PHPMailerAutoload.php';
            require 'phpmailer/vmd.config.php';
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
            $mail->AddAddress($user_mail, $user_adi.' '.$user_soyadi);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Üye Kayıt';
            $mail->MsgHTML('<p>DE Social kayıt işleminiz başarıyla tamamlanmıştır.</p>
                                      <p><a href="http://siteadi.com/aktivasyonUser.php?id='.$user_id.'"">Buraya Tıklayarak  Mail Aktivasyonunuzu Tamamlayabilirsiniz</a> .</p>
                                      <table border="1" cellpadding="10">
                                        <tr>
                                          <th align="right">Adı Soyadı : </th><td>'. $user_adi . '  '.$user_soyadi.'</td>
                                        </tr>
                                        <tr>
                                          <th align="right">E-Posta Adresi : </th><td>'. $user_mail .'</td>
                                        </tr>
                                        <tr>
                                          <th align="right">Şifre : </th><td>'. $password .'</td>
                                        </tr>
                                      </table>');
            if($mail->Send()) {
                $sql = "UPDATE users set user_aktivasyon='0' WHERE user_id='$user_id'";
                $sorgu = mysqli_query($db, $sql);
                if($sorgu==true){
                    echo 'ok';
                }else{
                    echo mysqli_error($db);
                }
            } else {
                echo '0';
                echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
            }

            $sql = "UPDATE users set user_akticasyon='0' WHERE user_id='$user_id'";
            $sorgu = mysqli_query($db, $sql);

        }else{
            echo 'ok2';
        }
    }else{
        echo 'HATA! Kayıt Eklemede Bir Sorun İle Karşılaşıldı';
    }





}

?>
