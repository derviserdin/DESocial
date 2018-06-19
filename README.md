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
