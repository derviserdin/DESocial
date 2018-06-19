<?php
session_start();

if (isset($_POST['Id']) and isset($_POST['durum'])) {
    include("../db_con.php");
    include("../fonksiyon.php");
    $db = db_con();
    ob_clean();
    header('Content-Type: text/plain; charset=utf-8');
     $id=mysqli_real_escape_string($db,$_POST['Id']);
     $durum=mysqli_real_escape_string($db,$_POST['durum']);

     if($durum=='pay'){

         $sql = "select * from paylasim where paylasim_sahibi='$id'";
         $data = mysqli_query($db, $sql);
         $userSira="";
         if($data==true){
             if(mysqli_num_rows($data)>0){
                 while ($row = mysqli_fetch_assoc($data)) {

                     $user=  uyeBul($row['user_id']);


                     if($userSira!=$user[0]['user_id']){
                         if($user[0]['user_profil_resim']==''){
                             $resim='<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';
                         }else{
                             $resim='<img src="uploads/user/'.$user[0]['user_profil_resim'].'"   class="img-circle img-bordered-sm">';
                         }
                         echo '<div class="user-block">
                '.$resim.'
                <span class="username username1">
                    <a href="user.php?id='.$user[0]['username'].'">'.$user[0]['user_adi'].' '.$user[0]['user_soyadi'].'</a>
                  
                    </span>
                <span class="description">'.$user[0]['user_ulke'].'</span>
          </div>
          <hr>';
                     }
                     $userSira=$user[0]['user_id'];
                 }
             }else{
                 echo 'yok';
             }
         }else{
             echo 'durumHata';
         }


     }else if($durum=='beg'){
         $sql = "select * from paylasim_begeni where bg_pay_id='$id'";
         $data = mysqli_query($db, $sql);
         $userSira="";
         if($data==true){
             if(mysqli_num_rows($data)>0){
                 while ($row = mysqli_fetch_assoc($data)) {

                     $user = uyeBul($row['bg_user_id']);


                     if ($userSira != $user[0]['user_id']) {
                         if ($user[0]['user_profil_resim'] == '') {
                             $resim = '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';
                         } else {
                             $resim = '<img src="uploads/user/' . $user[0]['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
                         }
                         echo '<div class="user-block">
                ' . $resim . '
                <span class="username username1">
                    <a href="user.php?id=' . $user[0]['username'] . '">' . $user[0]['user_adi'] . ' ' . $user[0]['user_soyadi'] . '</a>
                  
                    </span>
                <span class="description">' . $user[0]['user_ulke'] . '</span>
          </div>
          <hr>';
                     }
                     $userSira = $user[0]['user_id'];
                 }
             }else{
                 echo 'yok';
             }
         }else{
             echo 'durumHata';
         }

     }else if($durum=='begYo'){
         $sql = "select * from paylasim_yorum_begeni where paylasim_yorum_id='$id'";
         $data = mysqli_query($db, $sql);
         $userSira="";
         if($data==true){
             if(mysqli_num_rows($data)>0){
                 while ($row = mysqli_fetch_assoc($data)) {

                     $user = uyeBul($row['paylasim_yorum_user']);


                     if ($userSira != $user[0]['user_id']) {
                         if ($user[0]['user_profil_resim'] == '') {
                             $resim = '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';
                         } else {
                             $resim = '<img src="uploads/user/' . $user[0]['user_profil_resim'] . '"   class="img-circle img-bordered-sm">';
                         }
                         echo '<div class="user-block">
                ' . $resim . '
                <span class="username username1">
                    <a href="user.php?id=' . $user[0]['username'] . '">' . $user[0]['user_adi'] . ' ' . $user[0]['user_soyadi'] . '</a>

                    </span>
                <span class="description">' . $user[0]['user_ulke'] . '</span>
          </div>
          <hr>';
                     }
                     $userSira = $user[0]['user_id'];
                 }
             }else{
                 echo 'yok';
             }
         }else{
             echo 'durumHata';
         }
     }
     else{
         echo 'durumHata';
     }
}



?>