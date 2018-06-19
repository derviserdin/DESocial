<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
$db=db_con();
if(isset($_SESSION['user'])){

    if(isset($_POST['yorumId'] ) ){



            // Begenilen paylaşım id
            $paylasim=mysqli_real_escape_string($db,$_POST['yorumId']);

            $sqlBegeni="delete from paylasim_yorum where yorum_id='$paylasim' ";
            $sqlBegeniData=mysqli_query($db,$sqlBegeni);
            if ($sqlBegeniData==true) {
                $sqlGetPaylasim="delete from paylasim_yorum_begeni where paylasim_yorum_id='$paylasim' ";
                $sqlGetPaylasimData=mysqli_query($db,$sqlGetPaylasim);
                if($sqlGetPaylasimData==true){
                    echo 'ok';
                }else{
                    echo '0';
                }


            }
            else{
                echo '0';
            }
    }
    else{
        echo '0';
    }



}else{
    echo 'gelen user yok';
}

