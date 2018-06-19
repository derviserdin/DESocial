<?php
///otorum başlatıcı
session_start();
//veri tabanı dosyaları
include_once 'db_con.php';
//resim yükleme sıfımız
include_once 'class.upload.php';
$db=db_con();
if(!isset($_FILES['lokasyon']) || !isset($_POST['user_id']) ) {
    die('boş');
}else {
    $imageData = @getimagesize($_FILES["lokasyon"]["tmp_name"]);
    if (($imageData === FALSE) || (!($imageData[2] == IMAGETYPE_JPEG) && !($imageData[2] == IMAGETYPE_PNG))) {
        die('{ "durum" : "0", "mesaj" : "Dosya tipi jpg veya png olmalıdır!"}');
    }


    $user_id = uniqid(true);
    $dizin = "../uploads/user";


    // upload sınıfından yeni bir nesne türetiyoruz
    $upload=new Upload($_FILES['lokasyon']);

//Yüklenme kontrol

    if($upload->uploaded ){
        //Yüklenme işlenmi sonrası dosyaya isim verelim
        $upload->file_new_name_body=$user_id;
        //dosyayı küçültelim
        //image_src_x  resmin boyutunu verir
        if($upload->image_src_x>800){
            //resmin küçültme aktif olsun
            $upload->image_resize=true;
            //yüksekliği genişliğe oranla küçült genişliğine göre yükseklik pelirle otomatik
            $upload->image_resize=true;
         $upload->image_ratio_y=true;
            $upload->image_x=400;
           //$upload->image_y=400;

        }else if($upload->image_src_x<=280 and $upload->image_src_x<=280 ){
            die('resimBoyut');
        }


        /**
         *  Uzantılar ile  ilgili bir hata olursa burayı kullan
         *
         * $upload->image_convert='jpeg';*/
        //dosyayı taşıyalım
        $upload->process('../uploads/user');	//Dosya taşınmış ise
        if($upload->processed){
            //resimin uzantısını   image_src_type  methodu ile alalım ve gösterelim
            echo '<script type="text/javascript">

  $(function(){

    $("#cropbox").Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords,
      onChange: updateCoords,
    //  minSize:[280,280],
    //  maxSize:[280,280],
       setSelect: [ 280, 280, 100, 100 ]
    });

  });

  function updateCoords(c)
  {
    $("#x").val(c.x);
    $("#y").val(c.y);
    $("#w").val(c.w);
    $("#h").val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($("#w").val())) return true;
    alert("Please select a crop region then press submit.");
        return false;
  };

</script>

<form action="server-side/uploadImg.php" method="post">
<img  src="uploads/user/'.$user_id.'.'.$upload->image_src_type.'"  id="cropbox"/>
                    <input type="hidden" value="" id="x" name="x">
					<input type="hidden" value="" id="y" name="y">
					<input type="hidden" value="" id="x2" name="x2">
					<input type="hidden" value="" id="y2" name="y2">
					<input type="hidden" value="200" id="w" name="w">
					<input type="hidden" value="300" id="h" name="h">
					<input type="hidden" value="uploads/user/'.$user_id.'.'.$upload->image_src_type.'" id="resimLink" name="resimLink">
					
		</form>';
        }else{
            echo 'Hata'.$upload->error;
        }

    }else{
        echo "Hata".$upload->error;
    }


}







/**try{

	if($imageData[2] == IMAGETYPE_PNG)
	{
	move_uploaded_file($_FILES['lokasyon']['tmp_name'],"./$dizin/".$user_id.".png");
	}
	else
	{
	imagepng(imagecreatefromstring(file_get_contents($_FILES['lokasyon']['tmp_name'])),("./$dizin/".$user_id.".png"));
	}
	$resimAd=$user_id.".png";
	$sql="UPDATE users set user_profil_resim='$resimAd' where user_id='$user_id'";
	$sorgu = mysqli_query($db,$sql);
}
catch(Exception $hata){

	 die('{ "durum" : "0", "mesaj" : "Dosya Yüklemesi Sırasında Hata Oluştu!"}');

}*/

?>