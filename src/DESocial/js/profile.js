$(function () {
    $( '#paylasimYazi' ).val('').autoGrow();
    $( '.paylasimYazi' ).val('');
    $( '.yorumPaylasim' ).val('');

    $('#adminYap').click(function () {

        var id=$('#idTakip').val();
      //  alert(id);
        $.ajax({
            url: "server-side/adminYap.php",  //php dosyasının yolu
            type: 'POST',
            data: 'term='+id,
            success: function(e){
                if(e=='ok'){
                    alert('Kullanıcının Yetkileri Değiştirildi');
                    location.reload();
                  //  $('#adminYap').remove();
                }else{
                    alert('Bir Sorun Oluştu')
                }
            }
        });
        return false;
    });
    $('#editorYap').click(function () {

        var id=$('#idTakip').val();
        //  alert(id);
        $.ajax({
            url: "server-side/editorYap.php",  //php dosyasının yolu
            type: 'POST',
            data: 'term='+id,
            success: function(e){
                if(e=='ok'){
                    alert('Kullanıcının Yetkileri Değiştirildi');
                    location.reload();

                   // $('#editorYap').remove();
                }else{
                    alert('Bir Sorun Oluştu')
                }
            }
        });
        return false;
    });
    $('#kaldirYetki').click(function () {

        var id=$('#idTakip').val();
        //  alert(id);
        $.ajax({
            url: "server-side/kaldirYetki.php",  //php dosyasının yolu
            type: 'POST',
            data: 'term='+id,
            success: function(e){
                if(e=='ok'){
                    alert('Kullanıcının Yetkileri Değiştirildi');
                    location.reload();

                    // $('#editorYap').remove();
                }else{
                    alert('Bir Sorun Oluştu')
                }
            }
        });
        return false;
    });

    $('#seditorYap').click(function () {

        var id=$('#idTakip').val();
        //  alert(id);
        $.ajax({
            url: "server-side/sAdminYap.php",  //php dosyasının yolu
            type: 'POST',
            data: 'term='+id,
            success: function(e){
                if(e=='ok'){
                    alert('Kullanıcının Yetkileri Değiştirildi');
                    location.reload();

                    // $('#editorYap').remove();
                }else{
                    alert('Bir Sorun Oluştu')
                }
            }
        });
        return false;
    });
    $('#paylas').on('click',function(){

        var data;

        data = new FormData();
        data.append( 'resim', $( '#resim' )[0].files[0] );
        data.append( 'name', $( '#paylasimYazi' ).val() );

        console.log(data);
        $.ajax({
            url: "server-side/insertPaylasim.php",  //php dosyasının yolu
            type: 'POST',

            data: data,
            cache: false,
            contentType: false,
            processData: false ,
            beforeSend:function () {
                $('.loadBolum').show();
            },
            success: function(e){
                if(e=='boş'){
                    $('.hata').html('<h4>Lütfen paylaşım alanlarından birini doldurunuz.</h4>')
                }else{
                    var paylasimsayi=$('.paylasimSayiUye').val();
                    $('.paylasimSayiUyeGoster').val(paylasimsayi+1)
                    $('.hata').html(' ')
                    $( '#paylasimYazi' ).val('');
                    //resim inputu yenilenir
                    $('#resimPaylasimAlan').html('' +
                        '<a href="#" class="link-black text-sm">'+

                        '<i class="fa fa-camera  margin-r-5">'+
                        '<input id="resim" name="resim" class="dosyaYukle" type="file">'+
                        '</i>'+
                        '</a>');


                    $('#duvarAlani').prepend(
                        e
                    ).slideDown('slow');
                }
            },complete:function () {
                $('.loadBolum').hide();
                $('#paylasimYazi').css('height','54');
            }
        });

    });
    $('#paylasimModal').on('click',function(){

        var data;

        data = new FormData();
        data.append( 'resim', $( '#resimModal' )[0].files[0] );
        data.append( 'name', $( '#paylasimYaziModal' ).val() );



        $.ajax({
            url: "server-side/paylasimModal.php",  //php dosyasının yolu
            type: 'POST',
            beforeSend:function () {
                $('.loadBolum').show();
            },
            success: function(e){
                if(e=='boş'){
                    $('.hata').html('<h4>Lütfen paylaşım alanlarından birini doldurunuz.</h4>')
                }else{

                    $('.hata').html(' ')
                    $( '.paylasimYazi' ).val('');
                    //resim inputu yenilenir
                    $('#resimPaylasimAlanModal').html('' +
                        '<a href="#" class="link-black text-sm">'+

                        '<i class="fa fa-camera    margin-r-5">'+
                        '<input id="resimModal" name="resimModal" class="dosyaYukle" type="file">'+
                        '</i>'+
                        '</a>');


                    $('#duvarAlani').prepend(
                        e
                    ).slideDown('slow');
                    $('#PaylasVazgecModal').trigger('click');
                }
            },complete:function () {
            $('.loadBolum').hide();
                 },
            data: data,
            cache: false,
            contentType: false,
            processData: false
        });

    });


    //yorum ekle
    $(document).off('keypress','.yorumPaylasim').on('keypress','.yorumPaylasim',function (e) {
       var boyut=$(this).val().trim();
        if(e.which == 13 && boyut.length>1) {
                var td= $(this).closest('div');
            var id=    $('input:eq(0)',td).val();
            var yazi=    $('textarea:eq(0)',td).val();
            var resim=    $('input:eq(1)',td)[0].files[0];


            data = new FormData();
            data.append( 'resim', resim );
            data.append( 'name', yazi );
            data.append( 'payId', id);
            console.log(data);

            $.ajax({
                url: "server-side/insertYorum.php",  //php dosyasının yolu
                type: 'POST',
                success: function(data){

                    if(data=='boş'){
                        return false;
                    }else{
                        $('.yorumPaylasim').val('');


                        //resim inputu yenilenir
                        $('.yorumResimInput').html(
                            '<input  style="float: right;position: relative;width: 50px;z-index: 0;left: -35px;"   required id="resimYorum" name="resimYorum" class="dosyaYukle fa fa-picture-o  margin-r-5 " type="file">'
                        );

                        // sonuç   yorum bölümüne aktarılır
                        $('.yorumAnaBolum'+id).prepend(
                            data
                        ).slideDown('slow');
                    }

                },
                data: data,
                // dataType:json,
                cache: false,
                contentType: false,
                processData: false
            });
        }


    });

    $(document).off('click','.begeniArttir').on('click','.begeniArttir',function () {
        var veri = $(this).closest('a');

        var id=    $('span:eq(0)',veri).text();
        $.ajax(
            {
                url:'server-side/paylasimBegeni.php',
                type:'POST',
                data:'payId='+id,
                success:function (gelen) {
                    console.log(gelen);

                    $('.begeniLi'+id).html(
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniAzalt">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        '<i class="fa fa-star "></i>' +
                        ' <span class="begeniSayi'+id+'"> Beğenmekten Vazgeç ' +
                        '  <a href="#" data-num="'+id+'" data-toggle="modal" data-target="#payKisiGoster" class="gosterBegSayi">('+gelen+')'+
                        ' </a>' +
                        '</span>' +
                        '<a/>')

                }

            }
        )
    });

    $(document).off('click','.begeniAzalt').on('click','.begeniAzalt',function () {
        var veri = $(this).closest('a');

        var id=    $('span:eq(0)',veri).text();
        $.ajax(
            {
                url:'server-side/paylasimBegeni.php',
                type:'POST',
                data:'payId='+id+'&durum=ok',
                success:function (gelen) {
                    console.log(gelen);
                    $('.begeniLi'+id).html(
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniArttir">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        '<i class="fa fa-star "></i>' +
                        ' <span class="begeniSayi'+id+'"> Beğen ' +
                        '  <a href="#" data-num="'+id+'" data-toggle="modal" data-target="#payKisiGoster" class="gosterBegSayi">('+gelen+')'+
                        ' </a>' +
                        '</span>' +
                        '<a/>')


                }

            }
        )
    });
    $(document).off('click','.begeniYorumArttir').on('click','.begeniYorumArttir',function () {
        var veri = $(this).closest('a');

        var id=    $('span:eq(0)',veri).text();
        var yorumId=    $('span:eq(1)',veri).text();
        $.ajax(
            {
                url:'server-side/yorumBegeni.php',
                type:'POST',
                data:'payId='+id+'&yorumId='+yorumId,
                success:function (gelen) {
                    console.log(gelen);

                    $('.yorumBegeniLi'+yorumId).html(
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumAzalt">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        ' <span class="yorumId'+yorumId+'" style="display:none">'+yorumId+'</span>' +
                        '<i class="fa fa-star margin-r-5"></i>' +
                        ' <span class="begeniYorumSayi'+yorumId+'"> Beğenmekten Vazgeç' +
                        '  <a href="#" data-num="'+yorumId+'" data-toggle="modal" data-target="#payKisiGoster" class="gosterYoBegSayi">('+gelen+')'+
                        ' </a>' +
                        ' </span>' +
                        '<a/>')

                }

            }
        )
    });
    $(document).off('click','.begeniYorumAzalt').on('click','.begeniYorumAzalt',function () {
        var veri = $(this).closest('a');

        var id=    $('span:eq(0)',veri).text();
        var yorumId=    $('span:eq(1)',veri).text();
        $.ajax(
            {
                url:'server-side/yorumBegeni.php',
                type:'POST',
                data:'payId='+id+'&yorumId='+yorumId+'&durum=ok',
                success:function (gelen) {
                    console.log(gelen);
                    $('.yorumBegeniLi'+yorumId).html(
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumArttir">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        ' <span class="yorumId'+yorumId+'" style="display:none">'+yorumId+'</span>' +
                        '<i class="fa fa-star margin-r-5"></i>' +
                        ' <span class="begeniYorumSayi'+yorumId+'">Beğen ' +
                        '  <a href="#" data-num="'+yorumId+'" data-toggle="modal" data-target="#payKisiGoster" class="gosterYoBegSayi">('+gelen+')'+
                        ' </a>' +
                        '</span>' +
                        '<a/>')


                }

            }
        )
    });
    $(document).off('click','.payPaylas').on('click','.payPaylas',function () {
        var veri = $(this).closest('a');

        var id=    $('span:eq(0)',veri).text();
        // var yorumId=    $('span:eq(1)',veri).text();
        $.ajax(
            {
                url:'server-side/paylasimPaylas.php',
                type:'POST',
                data:'payId='+id,
                beforeSend:function () {
                    $('.loadPayPaylas').show();
                },
                success:function (gelen) {
                    console.log(gelen);
                    $('#myModal .modal-body ').html(gelen);
                    $('#myModal .modal-footer').prepend(' <span class="idModal" style="display: none" >'+id+'</span>');
                    $('.loadPayPaylas').css('display','block');

                }

            }
        )
    });

    $("#uyeSil").off('click').on("click", function(){

        var user_id = $.trim($("input[name=user_id]").val());


        var r = confirm("Kaydı Silmek İstediğinize Emin misiniz! Bütün Bilgileriniz Silinecek. ");
        if (r == true) {
            $.post("server-side/adminUyeSil.php", {
                "user_id" : user_id
            })
                .done(function(data){
                    if(data=='ok'){
                      alert("Kayıt silme  işlemi tamamlandı");
                    location.href="index.php";
                    }else if(data=='yetki'){
                        alert("Eksik Bilgi. Lütfen Bilgileri Kontrol Ediniz..");
                    }else{
                        alert("Bir Hata Oluştu");
                    }
                })
                .fail(function(){
                    alert("Hata!Sayfaya Ulaşılamadı.");
                    return false;
                });
        }

return false;


    });

    $(document).off('click','#paylasimSonuc').on('click','#paylasimSonuc',function () {
        var veri = $(this).closest('div');

        var id=    $('span:eq(0)',veri).text();
        var text= $('#payPaylasText').val();
        $.ajax(
            {
                url:'server-side/paylasimPaylasSonuc.php',
                type:'POST',
                data:'payId='+id+'&text='+text,
                success:function (gelen) {
                    console.log(gelen);


                    $('#payPaylasVazgec').trigger('click');

                }


            }
        )
    });


    $(document).off('click','#silPaylasimSonuc').on('click','#silPaylasimSonuc',function () {
        var veri = $(this).closest('div');

        var id=$('#silModal #paySilID').val();
        var id2=$('#silModal #paySilUserID').val();
        var durum=$('.sec:checked').val();
        //  console.log(durum);
        $.ajax(
            {
                url:'server-side/silPaylasim.php',
                type:'POST',
                data:'payId='+id+'&durum='+durum+'&userPaylasim='+id2,
                success:function (gelen) {
                    //  console.log(gelen);
                    if(gelen=='ok'){
                        $(".paylasimAlan"+id).remove();
                        $('#silPaylasVazgec').trigger('click');
                    }else if(gelen=='sikayet'){
                        alert('Paylaşım Şikayet Edildi')
                        $('#silPaylasVazgec').trigger('click');
                    }else if(gelen=='kayityok'){
                        $('.alanRadio').html('Paylaşıma Ulaşılamadı' );
                    }else{
                        $('#silPaylasimSonuc').remove();
                        $('#silModal .modal-footer').append('  <button style="float: left;" type="button" class="btn btn-primary" id="paylasimDuzenle">Düzenle</button>')

                        $('.alanRadio').html(gelen);
                    }


                }


            }
        )

    });

    $(document).off('click','.sil').on('click','.sil',function () {
        var veri = $(this).closest('span');
        var id=    $('span:eq(0)',veri).text();
        var id2=    $('span:eq(1)',veri).text();
        console.log(id2);
        $.ajax(
            {
                url:'server-side/silPaylasim.php',
                type:'POST',
                data:'payId='+id+'&durum=karsilastir&userPaylasim='+id2,
                success:function (gelen) {
                    // console.log(gelen);
                    if(gelen=='ok'){

                        $('.alanRadio').html('').prepend(
                            '<input type="radio" value="paySil"  name="sec" class="sec" aria-label="Paylaşımı Düzenle">  Paylaşımı Sil<br>'+
                            '<input type="radio" value="payDuz"  name="sec" class="sec" aria-label="Paylaşımı Düzenle">  Paylaşımı Düzenle <br>'
                        )
                    }else if(gelen=='no'){
                        $('.alanRadio').html('').prepend(
                            '<input type="radio" value="userSikayet"  name="sec"  class="sec" aria-label="Kullanıcıyı Şikayet Et">   Paylaşımı Şikayet Et <br>' +
                            '     <input type="radio" value="userEngelle" name="sec" class="sec"  aria-label="Kullanıcıyı Şikayet Et">   Kullanıcıyı Engelle <br>'+
                            ' <input type="radio" value="payGizle"  name="sec" class="sec" aria-label="Kullanıcıyı Şikayet Et">  Paylaşımı Gizle <br>'


                        )
                    }else if(gelen=='yetki'){
                        $('.alanRadio').html('').prepend(
                            '<input type="radio" value="paySil"  name="sec" class="sec" aria-label="Kullanıcıyı Şikayet Et">  Paylaşımı Sil <br>' +
                            '<input type="radio" value="userSikayet"  name="sec"  class="sec" aria-label="Kullanıcıyı Şikayet Et">   Paylaşımı Şikayet Et <br>' +
                            '     <input type="radio" value="userEngelle" name="sec" class="sec"  aria-label="Kullanıcıyı Şikayet Et">   Kullanıcıyı Engelle <br>'+
                            ' <input type="radio" value="payGizle"  name="sec" class="sec" aria-label="Kullanıcıyı Şikayet Et">  Paylaşımı Gizle <br>'


                        )
                    }
                }


            }
        )


        $('#silModal #paySilID').val(id)
        $('#silModal #paySilUserID').val(id2)
        $('#silPaylasimSonuc').css('display','none');
    });

    $(document).off('click','#duzenleReSil').on('click','#duzenleReSil',function () {
        $('#resimPaylasimAlanModalDu').html('<a href="#" class="link-black text-sm">'+

            ' <i class="fa fa-camera  margin-r-5">'+
            '<input required id="resimModaldu" name="resimModal"'+
            ' class="dosyaYukle required resimdu" type="file">'+

            '            </i>'+
            '           </a>');




        return false;
    });

    //var resimgosterdu = $("#duResimGoster");
    $(document).off('change','#resimModaldu').on('change','#resimModaldu',function (event) {


        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();
        reader.onload = function(e){
            image_base64 = e.target.result;
            $("#duResimGoster").html("<a href='"+image_base64+"' data-lightbox='image-1'>" +
                "<img width='250px' height='250px'  src='"+image_base64+"'/>" +
                "<a/> <br><br> ");
        };
        reader.readAsDataURL(file);
    });

    $(document).off('click','#paylasimDuzenle').on('click','#paylasimDuzenle',function () {

        var   id=$('#payIdDuzenle').val();
        var resimSayi=$( '#resimPaylasimAlanModalDu' ).find('.resimdu').length;
        //  $('#resimPaylasimAlanModalDu').find('#resimdu')
        if(resimSayi>0){
            var data;

            data = new FormData();
            data.append( 'resim', $( '.resimdu' )[0].files[0] );
            data.append( 'text', $( '#paylasimYaziModaldu' ).val() );
            data.append( 'id', $( '#payIdDuzenle' ).val() );

        }else{
            var data;

            data = new FormData();
            // data.append( 'resim', $( '.resimdu' )[0].files[0] );
            data.append( 'text', $( '#paylasimYaziModaldu' ).val() );
            data.append( 'id', $( '#payIdDuzenle' ).val() );

        }

        $.ajax({
            url: "server-side/duzenlePaylasim.php",  //php dosyasının yolu
            type: 'POST',

            data: data,
            cache: false,
            contentType: false,
            processData: false ,
            beforeSend:function () {
                $('.alanRadio').html( ' ');
                //$('.loadBolum').show();
            },
            success: function(e){
                if(e=='eksikbilgi'){
                    $('.alanRadio').html( 'Lütfen Tüm bilgileri Giriniz ');
                }else if(e=='gelen user yok'){
                    $('.alanRadio').html( 'Kullanıcı Yok ');

                }else {
                    alert( 'Paylaşım Düzenlendi ');
                    $('#silPaylasVazgec').trigger('click');
                    $('#paylasimDuzenle').remove();
                    $('#silModal .modal-footer').append(' <button  type="button" class="btn btn-danger " id="silPaylasimSonuc" style="display: block;">Gönder</button>')
                    $('.paylasimAlan'+id).html(e);

                }
            }
        });


    });




    $(document).off('click','.sec').on('click','.sec',function () {
        $('#silPaylasimSonuc').css('display','block');
    });






    var resimgoster = $(".hata");
    $("#resim").change(function(event){
        var input = $(event.currentTarget);
        var file = input[0].files[0];
        var reader = new FileReader();
        reader.onload = function(e){
            image_base64 = e.target.result;
            resimgoster.html("<a href='"+image_base64+"' data-lightbox='image-1'>" +
                "<img width='250px' height='250px'  src='"+image_base64+"'/>" +
                "<a/> <br><br> ");        };
        reader.readAsDataURL(file);
    });


    $(document).off('click','#takipBirak').on('click','#takipBirak',function () {
        var id=$('#idTakip').val();
        var r = confirm("Takipten Çıkmak İstediğinize Eminmisiniz!\n");
        if (r == true) {
            $.ajax(
                {
                    url:'server-side/takip.php',
                    type:'POST',
                    data:'takipId='+id+'&islem=unfollow',
                    success:function (gelen) {
                        console.log(gelen);
                        var sayi= $('#takipciSayi'+id).html();
                        sayi=Number(sayi)-1;

                        $('#takipciSayi'+id).html(sayi);
                        $('.islemlerUser').html('').prepend('' +
                            '<a href="#" onclick="return false" id="takipEt" class="btn btn-primary btn-block ">Takip Et</a>'+
                            ' <input type="hidden" name="idTakip" id="idTakip" value="'+id+'">');
                        location.reload();
                    }


                }
            )
        }
    });

    $(document).off('click','#takipEt').on('click','#takipEt',function () {
        var id=$('#idTakip').val();


            $.ajax(
                {
                    url:'server-side/takip.php',
                    type:'POST',
                    data:'takipId='+id+'&islem=follow',
                    success:function (gelen) {
                        console.log(gelen);
                        var sayi= $('#takipciSayi'+id).html();

                        sayi=Number(sayi)+1;
                        $('#takipciSayi'+id).html(sayi);
                        $('.islemlerUser').html('').prepend('' +
                            '<a href="#" onclick="return false" id="takipBirak" class="btn btn-primary btn-block ">Takip Ediyorsun</a>'+
                           ' <input type="hidden" name="idTakip" id="idTakip" value="'+id+'">');
                        location.reload();

                    }


                }
            )

    });

    $(document).off('click','#engelle').on('click','#engelle',function () {
        var id=$('#idTakip').val();


        $.ajax(
            {
                url:'server-side/uyeEngel.php',
                type:'POST',
                data:'payId='+id+'&durum=userEngelle',
                success:function (gelen) {
                    console.log(gelen);
                    $('#duvarAlani').hide();
                    $('.engelle').html('').prepend('' +
                        ' <a href="#" onclick="return false" id="engelKaldir" class="btn btn-primary btn-block ">Engeli Kaldır</a>'+
                        ' ');
                    location.reload();

                }
            }
        )

    });

    $(document).off('click','#engelKaldir').on('click','#engelKaldir',function () {
        var id=$('#idTakip').val();


        $.ajax(
            {
                url:'server-side/uyeEngel.php',
                type:'POST',
                data:'payId='+id+'&durum=engelKaldir',
                success:function (gelen) {
                    console.log(gelen);

                    $('#duvarAlani').show();
                    $('.engelle').html('').prepend('' +
                        ' <a href="#" onclick="return false" id="engelle" class="btn btn-primary btn-block ">Engelle</a>'+
                        ' ')
                    location.reload();

                }


            }
        )

    });

    $('#ara').keyup(function () {
        var name=$(this).val();
        if(name==''){
            $('#sonuclar').css('display','none');
            $('#sonuclar').html('');
            return false
        }else{
            $.post('server-side/uyeAra.php',{ad:name},function (data) {
                $('#sonuclar').css('display','block');
                $('#sonuclar').html(data);
            })
        }

    })
});