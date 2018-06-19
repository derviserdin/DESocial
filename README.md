# DESocial
DE Social  social web site project


Veritabanı Bağlantısı

    - src/DESocial/server-side/db_con.php
    
    function db_con() {
       $user="USER_NAME";  $pass="PASSWORD";

    if (!($connection = mysqli_connect("localhost",$user,"$pass"))) {
        return false;
    }
    if (!($selectdb = mysqli_select_db($connection, "DB_NAME"))) {
        mysqli_close($connection);
        return false;
    }
    mysqli_set_charset($connection, "utf8");
    return $connection;
}


Mail AYARLARI
    
    -src/DESocial/server-side/insertUser.php
    
    -src/DESocial/server-side/editProfile.php
    
    -src/DESocial/kayitMailGonder.php


Hastage kullanımı

"**"  karakterleri ile  etiket oluşturabilirsiniz
örnek : **DESocial its work !

-gün,hafta,ay ve yıl filtrelemesi mevcut

-ayarlar bölümünde  profil ve gizlilik özelleştirme mevcut

-paylaşım işlemlerinde sayfa yenilemeden crud işlemleri yapılabilir.

-üyelere yetki verilebilir, değiştirilebilir, engelleme ve banlama  gibi işlemlerde mavcuttur.
