<?php

session_start() ;
if(!isset($_SESSION['user']) and  !isset($_COOKIE['userc'])){
   include_once 'duvarGiris.php';
}else{
    include_once 'duvar.php';
}
?>
