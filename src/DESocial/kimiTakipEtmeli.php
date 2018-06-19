<div class="col-md-3 kimiTakipEtmeli">

    <!-- Profile  -->
    <!-- /.son -->

    <!-- Hashtaglar bölümü -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kimi Takip Etmeli </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
            //oturum açmış kullanıcı
            $gelenKulID=$_SESSION['user'];
            //bütün Kullanıcılarun user_idlerini alıyoruz
            $sql = mysqli_query($db, "select user_id from  users ");
            if ($sql == true) echo mysqli_error($db);
            if ($sql == true){
                if (mysqli_num_rows($sql) > 0) {
                    //Tüm kullanıcı sayısını alıyoruz
                    $maxSayi = mysqli_num_rows($sql);
                    // dizi oluşturuyoruz
                    $dizi=array();
            //takip tablosunda  oturum açan kullanıcısının bütün  takip ettiği kişilerin bilgilerini alıyoruz
                    $sqli = mysqli_query($db, "select user_id,takip_edilen_id from  takip WHERE user_id='$gelenKulID' ");
                    while($row=mysqli_fetch_assoc($sqli)){
                        //diye atıyoruz
                        array_push($dizi,$row['takip_edilen_id']) ;
                    }
                    // 3  defa dönen bir döngü yapıyoruz sql kodu 17 satırda
                    for ($i = 1;$i <= 3;$i++){
                        // tüm kullanıcıların aidlerini çekiyoruz
                        $dbId=mysqli_fetch_assoc($sql);
                        $durum="";
                      //  while( in_array( ($id = rand(1,$maxSayi)), $dizi ) );
                        if($maxSayi<=$uye[0]['user_takip_edilen_sayi'] ){
                            //üye sayısı   oturum a.mış kişininkinden  küçük ve eişt ise  random bir üyenin id al
                            $id = rand(1, $maxSayi);
                        }else{
                            do{
                                //şart ne olursa olsun 1 defa random üye çekip
                                $id = rand(1, $maxSayi);
                                //Kullanıcının takip ettiği kişi mi değilmi diye kontrol ediyoruz ve ona göre
                                // $durum değişkenine ok yada  yok diye yezıyoruz

                                if (array_search($id, $dizi)) {
                                    $durum="ok";
                                }else{
                                    $durum="yok";
                                }
                                //şart olarak rastgele seçilen id   oturum açmış kişinin  takip ettikleri arasında değilse
                                // devam etsin döngü dursun
                            }while($durum=='ok');
                        }
                        //bu satıra bak sonra
                        $sqlKontrolTakip = mysqli_query($db, "select user_id from users ");
                        //random  çekilen üyenin bilgilerini veri tabanından çek
                        $sql = mysqli_query($db, "select * from users where user_id=$id ");
            //sql doğru ise sonraki aşamaya geç
                        if ($sql == true){
                        //dönen sonuç varsa sonraki aşamaya geç
                            if (mysqli_num_rows($sql) == 1){
                                //sonuçları döndür $row  değişkenine dizi şekilinde at
                                $row = mysqli_fetch_assoc($sql);
                                //oturum açmış kullanıcı id ile eşit değilse işlemlere başla
                                 if ($_SESSION['user'] != $row['user_id']){
                                    echo '
                                                    <div class="user-block alan'.$row['user_id'].'" style="margin-bottom: 5%">
                                                        ';
                                    if ($row['user_profil_resim'] != '') {
                                        echo '<img src="uploads/user/' .$row['user_profil_resim']. '"   class="img-circle img-bordered-sm">';
                                    } else {
                                        echo '<img src="dist/img/profil-resim.png"  class="img-circle img-bordered-sm" >';

                                    }
                                    echo '
                                                        <span class="username username7">
                                                                                <a href="user.php?id=' . $row['username'] . '">' . $row['user_adi'] . ' ' . $row['user_soyadi'] . '  </a>
                                                                              <a href="#" data-id="' . $row['user_id'] . '" class="pull-right btn-box-tool tBaska"><i class="fa fa-times"></i></a>
                                                                                <a style="font-size: 13px;color: #8899a6;">
                                                                                @' . $row['username'] . '
                                                                                </a>

                                                                               <br>
                                                                               <div class="islemlerUser islemlerUser' . $row['user_id'] . '">
                        
                        
                                                                             ';
                                    if ($row['user_id'] != $_SESSION['user']) {
                                        $takipci = $_SESSION['user'];
                                        $takipEdilen = $row['user_id'];
                                        $sql = "select * from takip where user_id='$takipci' and takip_edilen_id='$takipEdilen'";
                                        $data = mysqli_query($db, $sql);
                                        if ($data) {
                                            if (mysqli_num_rows($data) > 0) {
                                                echo '<a href="#" onclick="return false" id="takipBirakk" class="takipBirak' . $row['user_id'] . ' btn btn-primary btn-sm ">Takip Ediyorsun</a>
                                                                                                 <input type="hidden" name="idTakip" id="idTakip" value="' . $row['user_id'] . '">';
                                            } else {
                                                echo '<a href="#" onclick="return false" id="takipEtt" class="takipEt' . $row['user_id'] . ' btn btn-primary btn-sm">Takip Et</a>
                                                                                                <input type="hidden" name="idTakip" id="idTakip" value="' . $row['user_id'] . '">';
                                            }
                                        }
                                    }
                                    ?>
                                </div>

                                </span>

                            </div>
                            <?php
                            } else {
                                $i--;
                            }
                        }
                        else {
                            $i--;
                        }
                    }
                }
            }
    }


    ?>
    <div class="altBox" style="margin-top: 5px;text-align: center">
        <a href="arkadasBul.php">Tümünü Gör</a>
    </div>
</div>
