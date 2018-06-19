<?php

function db_con() {
       $user="root";  $pass="";

    //   $user="ikinci_osmanli_u";  $pass="os3421OS";
    if (!($connection = mysqli_connect("localhost",$user,"$pass"))) {
        return false;
    }
    if (!($selectdb = mysqli_select_db($connection, "ikinci_osmanli_db"))) {
        mysqli_close($connection);
        return false;
    }
    mysqli_set_charset($connection, "utf8");
    return $connection;
}

?>
