<?php

function db_con() {
       $user="USERNAME";  $pass="PASSWORD";

    
    if (!($connection = mysqli_connect("localhost",$user,"$pass"))) {
        return false;
    }
    if (!($selectdb = mysqli_select_db($connection, "DBNAME"))) {
        mysqli_close($connection);
        return false;
    }
    mysqli_set_charset($connection, "utf8");
    return $connection;
}

?>
