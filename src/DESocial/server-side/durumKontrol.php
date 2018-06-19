<?php
// oturum  kontrol sayfası
session_start() ;
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}