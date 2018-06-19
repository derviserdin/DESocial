<?php
header('Content-Type: text/plain; charset=utf-8');
include_once 'db_con.php';
$connect=db_con();
mysqli_set_charset($connect,"utf8");
$userİd=1;
//  PAylaşım göstermek için öncelikle  üyenin takip ettiği kişileri  bulalım
$output = array();
//üyenin kendi id sini bir diziye atalım sonrada  takip ettiği kişilerin
array_push($output, 1);
$query = "SELECT * FROM takip where user_id='1'";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // takip ettiği kişileri diziye atıyoruz
        array_push($output, $row['takip_edilen_id']);
    }
}
//paylasimlar dizisi
$paylasimlar=array();
//$output dizisinde  takip edilen kişilerin idleri var  bizde paylasimlar tablosundan
// bunların idsine eşit olanları bulup diziye atıyoruz
for ($i=0;count($output)>$i;$i++){
    //$i değerine göre   takip edilen kişileri teker teker  sorgulatıp  $paylasimlar dizisine atıyoruz
    $id=$output[$i];
    $sql="select * from paylasim where user_id='$id'";
    $dataSet=mysqli_query($connect,$sql);
    while($paylasim=mysqli_fetch_assoc($dataSet)){
        $paylasimlar[]=array(
            "paylasim_id"=>$paylasim['paylasim_id'],
            "user_id"=>$paylasim['user_id'],
            "paylasim_icerik"=>$paylasim['paylasim_icerik'],
            "paylasim_url"=>$paylasim['paylasim_url'],
            "paylasim_resim_id"=>$paylasim['paylasim_resim_id'],
            "paylasim_sayisi"=>$paylasim['paylasim_sayisi'],
            "paylasim_sahibi"=>$paylasim['paylasim_sahibi'],
            "paylasim_tarihi"=>$paylasim['paylasim_tarihi'],
            "paylasim_begeni_sayisi"=>$paylasim['paylasim_begeni_sayisi'],
            "paylasim_yorum_sayisi"=>$paylasim['paylasim_yorum_sayisi'],
            "paylasim_harici_link"=>$paylasim['paylasim_harici_link'],


        );

    }
}


//json çıktısı ike işlşem tamamlanıyor
echo json_encode($paylasimlar);
?>