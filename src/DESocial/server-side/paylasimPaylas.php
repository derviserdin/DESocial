<?php
session_start();

include_once 'db_con.php';
$connect=db_con();
require_once 'fonksiyon.php';
require_once 'views/paylasimView.php';
header('Content-Type: text/plain; charset=utf-8');

mysqli_set_charset($connect,"utf8");

if(isset($_SESSION['user'])){
    $user=$_SESSION['user']; // şuan için oturum kontrolü yapamıyorum
    if(isset($_POST['payId'])){
       // $text=mysqli_real_escape_string($connect,$_POST['text']);
        $payId=mysqli_real_escape_string($connect,$_POST['payId']);
        //link için harf rakam karışımı uzantı üretelim

        $urett=array("asd","fgh","jkl","lşi","ıop");
        $sayi_tut=rand(1,10000000);
        $uzanti=$urett[rand(0,4)].$sayi_tut;
        $sql="select * from paylasim where paylasim_id='$payId'";
        $dataSet=mysqli_query($connect,$sql);
        if ($dataSet) {
            if(mysqli_num_rows($dataSet)>0){
                $veri=mysqli_fetch_assoc($dataSet);
                echo '
<script>
$( "#payPaylasText" ).val("").autoGrow().css("height","50");
 $("#payPaylasText").bind("keydown keyup keypress change",function(){
                            //   alert("oldu");
                            var uzunluk = $(this).val().length;
                            var sonuc=298-uzunluk;
                            if(uzunluk > 298){
                                //     alert("oldu");
                                $("#paylasimSonuc").css("display","none");
                            }else{
                                $("#paylasimSonuc").css("display","block").css("float","right");
                            }
                            $(".payPa").html(sonuc);

                        });
</script>
<div id="" style="margin-bottom: 4%;">
 <textarea  id="payPaylasText" name="payPaylasText" cols="1" rows="1" class="form-control "
                                                 required     >

                                            </textarea>
    <span style="float: right;" class="payPa">298</span>

</div>';
                echo '  <div class="post'.$payId.'">
                                    <div class="user-block">
                                        ';
                $uyePaylasim=array();
                $uyePaylasim=uyeBul($veri['user_id']);
                if($uyePaylasim[0]['user_profil_resim']!=''){
                    echo '<img src="uploads/user/'.$uyePaylasim[0]['user_profil_resim'].'"   class="img-circle img-bordered-sm">';
                }else{
                    echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                }
                echo '    <span style="display: none" >'.$payId.'</span>
                                        <span class="username">
                         <a href="user/'.$uyePaylasim[0]['username'].'">'.$uyePaylasim[0]['user_adi'].' '.$uyePaylasim[0]['user_soyadi']. '</a>
                         
                        </span>
                                         <span class="description">Paylaşım tarihi '.zaman($veri['paylasim_tarihi']).'</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        '.$veri['paylasim_icerik'].'
                                    </p>
                                   ';
                if($veri['paylasim_resim_id']!=''){
                    echo '  <div class="resimPaylasim row">
                                         <div class="col-sm-12">
                                            <img class="img-responsive" style="width: 75%;" src="uploads/paylasim/'.$veri['paylasim_resim_id'].'" >
                                         </div>
                                      </div>';
                }

                echo '

                                </div>';
            }else{
                echo '0';
            }

        }else{
            echo 'Bir Sorun Oluştu';
        }

    }else{
        echo 'post yok';
    }




}else{
    echo 'session yok';
}

