<?php
session_start();
//include_once 'durumKontrol.php';

include_once 'db_con.php';
$connect=db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($connect,"utf8");
date_default_timezone_set('Istanbul');
$tarihh = date('Y-m-d H:i:s' , time() + 3600);




if(isset($_POST['usernameR']) && isset($_POST['emailR'])
    &&  isset($_POST['passR'])
    && isset($_POST['repassR'])
    && isset($_POST['Ad'])
    && isset($_POST['Soyad'])  ){
    if(empty($_POST['usernameR']) || empty($_POST['emailR'])
        ||  empty($_POST['passR'])
        || empty($_POST['repassR'])
        || empty($_POST['Ad'])
        || empty($_POST['Soyad'])  ){
        header('Location: ../login.php?hata=Lütfen Tüm alanları doldurunuz ');
    }else{
        //post verileri
        $username=mysqli_real_escape_string($connect,$_POST['usernameR']);
        $email=mysqli_real_escape_string($connect,$_POST['emailR']);
        $pass=mysqli_real_escape_string($connect,$_POST['passR']);
        $ad=mysqli_real_escape_string($connect,$_POST['Ad']);
        $soyad=mysqli_real_escape_string($connect,$_POST['Soyad']);
        $gun=mysqli_real_escape_string($connect,$_POST['gun']);
        $ay=mysqli_real_escape_string($connect,$_POST['ay']);
        $yil=mysqli_real_escape_string($connect,$_POST['yil']);
        $tarih=$yil.'-'.$ay.'-'.$gun;
        $yeniAd= preg_replace('/[^a-zA-Z0-9]/s', '', $username);
        $ip=GetIP();
        if($yeniAd!=$username) {
            header('Location: ../index.php?hata=Lütfen Kullanıcı Adında Özel Karakterleri Kullanmayınız (Sadece harf ve rakam kullanabilirsin)');
            die();
        }
    // die("$yeniAd"."     "."$username");
        if($_POST['passR']==$_POST['repassR']){
            $eklePaylasim="select * from users where username='$username'";
            $dataSet=mysqli_query($connect,$eklePaylasim);
            if($dataSet==true){
                if (mysqli_num_rows($dataSet)==0) {
                    $eklePaylasim="select * from users where user_email='$email'";
                    $dataSet=mysqli_query($connect,$eklePaylasim);
                    if($dataSet==true){
                        if(mysqli_num_rows($dataSet)==0){
                            $eklePaylasim="insert into users (user_adi,user_soyadi,username,password,user_email,user_dogum_tarih,user_kayit_tarih,user_giris_tarih,user_ip)
                        VALUES ('$ad','$soyad','$username','$pass','$email','$tarih','$tarihh','$tarihh','$ip')";
                            $dataSet=mysqli_query($connect,$eklePaylasim);
                            if($dataSet==true){
                                //$user_id=mysqli_insert_id($db);
                                //kayıt olan kullanıcıyı al ve session ata
                                $username=mysqli_insert_id($connect);
                                $_SESSION['user'] = $username;
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
                                $mail->AddAddress($email, $ad.' '.$soyad);
                                $mail->CharSet = 'UTF-8';
                                $mail->Subject = 'Üye Kayıt';
                                $mail->MsgHTML('<p>DE Social  kayıt işleminiz başarıyla tamamlanmıştır.</p>
                                      <p><a href="http://siteadi.com/aktivasyonUser.php?id='.$username.'">Buraya Tıklayarak  Mail Aktivasyonunuzu Tamamlayabilirsiniz</a> .</p>
                                      <table border="1" cellpadding="10">
                                        <tr>
                                          <th align="right">Adı Soyadı : </th><td>'. $ad . '  '.$soyad.'</td>
                                        </tr>
                                        <tr>
                                          <th align="right">E-Posta Adresi : </th><td>'. $email .'</td>
                                        </tr>
                                        <tr>
                                          <th align="right">Şifre : </th><td>'. $pass .'</td>
                                        </tr>
                                      </table>');
                                if($mail->Send()) {
                                    header('Location: ../index.php ');
                                } else {
                                    echo '0';
                                    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
                                }

                                // die('<script type="text/javascript">alert("Başarılı bir şekilde kayıt oldunuz");window.open("../index.php","_self");</script>');

                            }else{
                                header('Location: ../index.php?hata=Bir sorun ile karşılaşıldı ');
                            }
                        }else{
                            header('Location: ../index.php?hata=Bu mail adresi kullanımda ');
                        }
                    }

                }else{
                    header('Location: ../index.php?hata=Bu kullanıcı adı kullanımda ');
                }
            }



        }else{
            header("Location: ../index.php?hata=Şifreler Uyuşmuyor&ad=".$ad."&soyad=".$soyad."&username=".$username."&email=".$email." ");
        }


    }

}else{
    header('Location: ../index.php?hata=Lütfen Tüm Alanları Doldurunuz.  ');
}


