<?php
/**
 * user : Dervish
 * Açıklama : Paylaşımlar tablosunda bulunan hastagların sayısını bulup listeler
 */

?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Gündem</h3>
    </div>

    <div class="col-md-12" style="padding: 0;">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#gun" data-toggle="tab" aria-expanded="true">Bugün</a></li>
                <li class=""><a href="#hafta" data-toggle="tab" aria-expanded="false">Hafta</a></li>
                <li class=""><a href="#ay" data-toggle="tab" aria-expanded="false">Ay</a></li>
                <li class=""><a href="#yil" data-toggle="tab" aria-expanded="false">Yıl</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="gun">
                    <?php
                    //bugünün tarihini alıp  atılan tweetleri buluyoruz

                    $bugun=date("Y-m-d 00:00:00");
                    //atılan tweetleri döngüde karşılaştırıp  sırasını bulalım
                    $hashtagSirasi= " ";
                    $diziSayi=array();
                    error_reporting(0);
                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and paylasim_tarihi>='$bugun'";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['paylasim_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr(trim($arr[$i]),0,2)==$htag){

                                if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){

                                    $diziSayi[$hashtagSirasi]+=1;
                                }else{
                                    $diziSayi[trim($arr[$i])]+=1;
                                    $hashtagSirasi=trim($arr[$i]);
                                }
                            }
                            $i++;
                        }
                    }

                    $sqlHash="select *  from paylasim_yorum where yorum_icerik like '%**%' and yorum_tarih>='$bugun'";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['yorum_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo trim($arr[$i]);
                            if(substr($arr[$i],0,2)==$htag){
                                if (strlen(trim($arr[$i])) > 2) {
                                    if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){
                                        $diziSayi[$hashtagSirasi]+=1;
                                    }else{
                                        $diziSayi[trim($arr[$i])]+=1;
                                        $hashtagSirasi=trim($arr[$i]);
                                    }
                                }

                            }
                            $i++;
                        }
                    }



                    // var_dump($diziSayi);
                    ?>
                    <div class="box-body">
                        <ul class="list-group gundemLi">
                            <?php
                            $a=1;

                            array_multisort($diziSayi,SORT_DESC);
                            // var_dump($diziSayi);
                            foreach ($diziSayi as $anahtar => $deger){

                                echo ' <li class="list-group-item">
                            <span class="badge">'.$deger.'</span>
                            <a href="hashtag.php?kelime='.$anahtar.'">'.substr($anahtar,0,22).'</a>
                        </li>';

                                if ($a==13) {
                                    break;
                                }else{
                                    $a++;
                                }

                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="tab-pane " id="hafta">
                    <?php
                    //bugünün tarihini alıp  atılan tweetleri buluyoruz

                    $zaman=gundemAl("hafta");
                    $bugun=date("Y-m-d 00:00:00");
                    //atılan tweetleri döngüde karşılaştırıp  sırasını bulalım
                    $hashtagSirasi= " ";
                    $diziSayi=array();
                    error_reporting(0);
                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and  paylasim_tarihi>'$zaman'   ";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['paylasim_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr(trim(trim($arr[$i])),0,2)==$htag){

                                if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){

                                    $diziSayi[$hashtagSirasi]+=1;
                                }else{
                                    $diziSayi[trim($arr[$i])]+=1;
                                    $hashtagSirasi=trim($arr[$i]);
                                }
                            }
                            $i++;
                        }
                    }

                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and  paylasim_tarihi>='$zaman' ";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['yorum_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr($arr[$i],0,2)==$htag){
                                if (strlen(trim($arr[$i])) > 2) {
                                    if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){
                                        $diziSayi[$hashtagSirasi]+=1;
                                    }else{
                                        $diziSayi[trim($arr[$i])]+=1;
                                        $hashtagSirasi=trim($arr[$i]);
                                    }
                                }

                            }
                            $i++;
                        }
                    }



                    // var_dump($diziSayi);
                    ?>
                    <div class="box-body">
                        <ul class="list-group">
                            <?php
                            $a=1;

                            array_multisort($diziSayi,SORT_DESC);
                            // var_dump($diziSayi);
                            foreach ($diziSayi as $anahtar => $deger){

                                echo ' <li class="list-group-item">
                            <span class="badge">'.$deger.'</span>
                            <a href="hashtag.php?kelime='.$anahtar.'">'.substr($anahtar,0,22).'</a>
                        </li>';

                                if ($a==13) {
                                    break;
                                }else{
                                    $a++;
                                }

                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="ay">
                    <?php
                    //bugünün tarihini alıp  atılan tweetleri buluyoruz

                    $zaman=gundemAl("ay");
                    $bugun=date("Y-m-d 00:00:00");
                    //atılan tweetleri döngüde karşılaştırıp  sırasını bulalım
                    $hashtagSirasi= " ";
                    $diziSayi=array();
                    error_reporting(0);
                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and  paylasim_tarihi>'$zaman'   ";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['paylasim_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr(trim($arr[$i]),0,2)==$htag){

                                if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){

                                    $diziSayi[$hashtagSirasi]+=1;
                                }else{
                                    $diziSayi[trim($arr[$i])]+=1;
                                    $hashtagSirasi=trim($arr[$i]);
                                }
                            }
                            $i++;
                        }
                    }

                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and  paylasim_tarihi>='$zaman' ";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['yorum_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr($arr[$i],0,2)==$htag){
                                if (strlen(trim($arr[$i])) > 2) {
                                    if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){
                                        $diziSayi[$hashtagSirasi]+=1;
                                    }else{
                                        $diziSayi[trim($arr[$i])]+=1;
                                        $hashtagSirasi=trim($arr[$i]);
                                    }
                                }

                            }
                            $i++;
                        }
                    }



                    // var_dump($diziSayi);
                    ?>
                    <div class="box-body">
                        <ul class="list-group">
                            <?php
                            $a=1;

                            array_multisort($diziSayi,SORT_DESC);
                            // var_dump($diziSayi);
                            foreach ($diziSayi as $anahtar => $deger){

                                echo ' <li class="list-group-item">
                            <span class="badge">'.$deger.'</span>
                            <a href="hashtag.php?kelime='.$anahtar.'">'.substr($anahtar,0,22).'</a>
                        </li>';

                                if ($a==13) {
                                    break;
                                }else{
                                    $a++;
                                }

                            }
                            ?>
                    </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="yil">
                    <?php
                    //bugünün tarihini alıp  atılan tweetleri buluyoruz

                    $zaman=gundemAl("yil");
                    $bugun=date("Y-m-d 00:00:00");
                    //atılan tweetleri döngüde karşılaştırıp  sırasını bulalım
                    $hashtagSirasi= " ";
                    $diziSayi=array();
                    error_reporting(0);
                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and  paylasim_tarihi>'$zaman'   ";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['paylasim_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr(trim($arr[$i]),0,2)==$htag){

                                if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){

                                    $diziSayi[$hashtagSirasi]+=1;
                                }else{
                                    $diziSayi[trim($arr[$i])]+=1;
                                    $hashtagSirasi=trim($arr[$i]);
                                }
                            }
                            $i++;
                        }
                    }

                    $sqlHash="select *  from paylasim where paylasim_icerik like '%**%' and  paylasim_tarihi>='$zaman' ";
                    $dataSetHash=mysqli_query($db,$sqlHash);

                    while($row=mysqli_fetch_assoc($dataSetHash)){
                        $i=0;
                        $string=$row['yorum_icerik'];
                        $htag='**';
                        $arr=explode(" ",$string);
                        $arrc=count($arr);

                        while($i < $arrc){
                            //echo $arr[$i];
                            if(substr($arr[$i],0,2)==$htag){
                                if (strlen(trim($arr[$i])) > 2) {
                                    if(strcasecmp($hashtagSirasi,trim($arr[$i]))==0){
                                        $diziSayi[$hashtagSirasi]+=1;
                                    }else{
                                        $diziSayi[trim($arr[$i])]+=1;
                                        $hashtagSirasi=trim($arr[$i]);
                                    }
                                }

                            }
                            $i++;
                        }
                    }



                    // var_dump($diziSayi);
                    ?>
                    <div class="box-body">
                        <ul class="list-group">
                            <?php
                            $a=1;

                            array_multisort($diziSayi,SORT_DESC);
                            // var_dump($diziSayi);
                            foreach ($diziSayi as $anahtar => $deger){

                                echo ' <li class="list-group-item">
                            <span class="badge">'.$deger.'</span>
                           <a href="hashtag.php?kelime='.$anahtar.'">'.substr($anahtar,0,22).'</a>
                        </li>';

                                if ($a==13) {
                                    break;
                                }else{
                                    $a++;
                                }

                            }
                            ?>
                    </div>
                </div>

                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.box-header -->

</div>