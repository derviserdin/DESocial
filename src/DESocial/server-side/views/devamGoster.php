<?php
session_start();
include_once ('../db_con.php');
include_once ('../fonksiyon.php');

if(isset($_POST['id'])){
    $db=db_con();

    $url=mysqli_real_escape_string($db,$_POST['id']);

    $sql="select * from paylasim where  paylasim_id='$url'  ";
    $dataSet=mysqli_query($db,$sql);
    // var_dump(mysqli_fetch_assoc($dataSet));
    while($paylasim=mysqli_fetch_assoc($dataSet)){
        //Gelen user id yi takipçiler dizisi içöinde karşılaştıralım
        $metin=$paylasim['paylasim_icerik'];




        echo '<p>'.hashtag($metin).'</p> ';

    }



}else{
    echo '0';
}

?>