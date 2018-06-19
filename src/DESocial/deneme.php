
<?php
require 'server-side/phpmailer/PHPMailerAutoload.php';
require 'server-side/phpmailer/vmd.config.php';


$mail = new PHPMailer();
//$mail->IsSMTP();  server29. satırdaki mail->isSMTP () kodu için serverda ssl
// olması gerekiyor galiba. Onu comment yapıp yeniden yükledim dosyayı. Aklında olsun
$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
$mail->SMTPSecure = 'ssl'; // Güvenli baglanti icin ssl normal baglanti icin tls
$mail->SMTPAuth = true;

$mail->Host = 'birsancak.com';
$mail->IsHTML(true);
$mail->Port = 465;
$mail->SetLanguage("tr", "phpmailer/language");
$mail->Username = 'mail adres';
$mail->Password = 'password';
$mail->SetFrom($mail->Username, 'yazı');
$mail->AddAddress("dervis.erdin1@gmail.com", "derviş" . ' ' . "erdin");
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Üye Kayıt';
$mail->MsgHTML('<p>DE Social kayıt işleminiz başarıyla tamamlanmıştır.</p>
                                      <p><a href=" #">Buraya Tıklayarak  Mail Aktivasyonunuzu Tamamlayabilirsiniz</a> .</p>
                                      <table border="1" cellpadding="10">
                                        <tr>
                                          <th align="right">Adı Soyadı : </th><td>sdfsdfdf</td>
                                        </tr>
                                        <tr>
                                          <th align="right">E-Posta Adresi : </th><td>sdfsdfdsf</td>
                                        </tr>
                                        <tr>
                                          <th align="right">Şifre : </th><td>sdfsdfdsfdsf</td>
                                        </tr>
                                      </table>');
if ($mail->Send()) {
    echo('<script type="text/javascript">alert("Aktivasyon Mailiniz Gönderildi.") ;window.open("index.php","_self");</script>');
} else {
    echo '0';
    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
}