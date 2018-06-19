<?php
include_once 'durumKontrol.php';
include_once 'db_con.php';
include_once 'fonksiyon.php';
$db=db_con();
if(isset($_SESSION['user'])){
  if(isset($_POST['islem'])){
      if($_POST['islem']=='sifirla'){
          $userId=$_SESSION['user'];
          $sql="update bildirimler set okundu_bilgisi='1' where bildirim_giden_user='$userId' and okundu_bilgisi='0'";
          $dataSet=mysqli_query($db,$sql);
      }
  }
  else
  {


          $userId=$_SESSION['user'];
          $sql="select * from bildirimler where bildirim_giden_user='$userId'  ORDER  by tarih desc ";
          $dataSet=mysqli_query($db,$sql);
          echo '<li> <!-- inner menu: contains the actual data -->
                <ul class="menu">';
          if(mysqli_num_rows($dataSet)>0){
              while($row=mysqli_fetch_assoc($dataSet)){
                  //gelen user bilgilerini al

                  $userGelen=uyeBul($row['user_gelen_id']);
                  //bildirim tipi bulma
                  $tip=$row['bildirim_type'];

                  switch($tip){
                      case 'paylasim':
                          $type='Seni paylaşımına etiketledi';
                          break;
                      case 'yorum':
                          $type='Seni paylaşımında bir yoruma etiketledi';
                          break;
                      case 'yorumEtiketsiz':
                          $type='Senin paylaşımına yorum yaptı';
                          break;
                      case 'takip':
                          $type='Seni takip etmeye başladı';
                          break;
                  }


                  echo '
                                <li><!-- start message -->
                                    <a href="user.php?id='.$userGelen[0]['username'].'">
                                    <div class="pull-left">';

                  if ($userGelen[0]['user_profil_resim']!= '') {
                      echo '<img src="uploads/user/' . $userGelen[0]['user_profil_resim'] . '"  class="img-circle ">';
                  } else {
                      echo '<img src="dist/img/profil-resim.png"  class="img-circle" >';

                  }
                  echo'

                                        </div>
                                        <h4>
                                           '.$userGelen[0]['user_adi'].' '.$userGelen[0]['user_soyadi'].'
                                            <small><i class="fa fa-clock-o"></i> '.zaman($row['tarih']).'</small>
                                        </h4>
                                        <p>'.$type.'</p>
                                    </a>
                                </li>
                                <!-- end message -->

                         ';
              }
              echo '   </ul>
                        </li>';
          }else{
              echo '<li><h5 style="text-align: center">Henüz bildirim almadınız</h5></li>';
          }



















      /**
       * gerekirse kullan
       *
       * else{
          echo '<li><h5 style="text-align: center"> Hiç Bildiriminiz Yok</h5></li>';
      }
*/


  }

}else{
    echo '0';
}

