<?php
include_once 'durumKontrol.php';
include_once 'fonksiyon.php';
include_once 'db_con.php';
$db=db_con();
if(isset($_SESSION['user'])){

    if(isset($_POST['payId'] ) ){
        $paylasim=mysqli_real_escape_string($db,$_POST['payId']);
        $user=$_SESSION['user'];
        $durum=mysqli_real_escape_string($db,$_POST['durum']);
       if($durum=='engelKaldir'){


            $sqlBegeni="delete from sikayet where sikayet_eden_id='$user' and sikayet_user_id='$paylasim' and sikayet_type='engel'" ;
            $sqlBegeniData=mysqli_query($db,$sqlBegeni);
            if ($sqlBegeniData==true) {
              echo 'ok';
            }
            else{
                echo '0';
            }

        }else if($durum=="userEngelle"){
           $sqlBegeni="insert into sikayet (sikayet_eden_id,sikayet_user_id,sikayet_type)
                                  VALUES ('$user','$paylasim','engel') ";
           $sqlBegeniData=mysqli_query($db,$sqlBegeni);
           if ($sqlBegeniData==true) {
               $sql="delete from takip where user_id='$user' and takip_edilen_id='$paylasim'";
               $data=mysqli_query($db,$sql);
               if ($data==true) {
                   echo 'ok';
               }else{
                   echo mysqli_error($db);
               }
           }
           else{
               echo '0';
           }
       }

        else{

        }


    }
    else{
        echo '0';
    }



}else{
    echo 'gelen user yok';
}

