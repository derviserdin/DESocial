<?php
header('Content-Type: text/plain; charset=utf-8');
include_once 'db_con.php';

$db = db_con();
$ad = $_POST['ad'];
 $boslukAra=strstr(' ',$ad);
if (substr($ad,0,2)=='**') {

    echo '   <a href="hashtag.php?kelime='.$ad.'"><span class="badge">'.$ad.'</span></a>';


}else{
$ayir=explode(' ',$ad);
 $boyutAyir=count($ayir);




if($boyutAyir==1){

    $sql = "select * from users where user_adi LIKE '%$ayir[0]%'";
}else{
    $sql = "select * from users where user_adi LIKE '%$ayir[0]%' and user_soyadi LIKE '%$ayir[1]%' ";
}

$data = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($data)) {

    if($row['user_profil_resim']==''){
        $resim='<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';
    }else{
        $resim='<img src="uploads/user/'.$row['user_profil_resim'].'"   class="img-circle img-bordered-sm">';
    }
    echo '<div class="user-block">
                '.$resim.'
                <span class="username username1">
                    <a href="user.php?id='.$row['username'].'">'.$row['user_adi'].' '.$row['user_soyadi'].'</a>
                  
                    </span>
                <span class="description">'.$row['user_ulke'].'</span>
          </div>
          <hr>';
}

}