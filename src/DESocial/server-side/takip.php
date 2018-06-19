<?php
session_start();

include_once 'db_con.php';
$connect=db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($connect,"utf8");
date_default_timezone_set('Asia/Kuwait');
$tarih= date("Y-m-d H:i:s");
if(isset($_SESSION['user'])){
    $user=$_SESSION['user']; //

    if(isset($_POST['takipId']) and isset($_POST['islem'])){

        $takipId=mysqli_real_escape_string($connect,$_POST['takipId']);
        $islem=mysqli_real_escape_string($connect,$_POST['islem']);
      if($islem=='follow'){
            $sql="insert into takip (user_id,takip_edilen_id,takip_type) VALUES ('$user','$takipId','takip')";
          $data=mysqli_query($connect,$sql);
        //  takipciArttir($_SESSION['user'],$takipId,'follow');
          //bildirim kayıt


         $uyeTakipEden =uyeKadiBul($user);
        $username=$uyeTakipEden[0]['username'];
          $sqlBildirim="insert into bildirimler
                                  (user_gelen_id,bildirim_baglanti,bildirim_type,okundu_bilgisi,bildirim_giden_user,tarih)
                                  VALUES ('$user','$username','takip','0','$takipId','$tarih')";
          if(mysqli_query($connect,$sqlBildirim)!=true){
              echo mysqli_error($connect);
          }else{
           echo   yeniUyeGetir();
          }

      }else if($islem=='unfollow'){
          $sql="delete from takip where user_id='$user' and takip_edilen_id='$takipId'";
          $data=mysqli_query($connect,$sql);

        //  takipciArttir($_SESSION['user'],$takipId,'unfollow');
          $sql="delete from bildirimler where user_gelen_id='$user' and bildirim_giden_user='$takipId' and bildirim_type='takip'";
          if(mysqli_query($connect,$sql)!=true){
              echo mysqli_error($connect);
          }
      }else if($islem=="baska"){
          echo   yeniUyeGetir();

      }else{
          echo '0';
      }
    }



}else{
    echo '0';
}

