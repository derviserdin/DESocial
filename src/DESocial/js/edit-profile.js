$(document).ready(function () {
    $('.paylasimYazi').val('');
    $('#paylasimModal').on('click', function () {

        var data;

        data = new FormData();
        data.append('resim', $('#resimModal')[0].files[0]);
        data.append('name', $('#paylasimYaziModal').val());


        $.ajax({
            url: "server-side/paylasimModal.php",  //php dosyasının yolu
            type: 'POST',
            beforeSend: function () {
                $('.loadBolum').show();
            },
            success: function (e) {
                if (e == 'boş') {
                    $('.hata').html('<h4>Lütfen paylaşım alanlarından birini doldurunuz.</h4>')
                } else {

                    $('.hata').html(' ')
                    $('.paylasimYazi').val('');
                    //resim inputu yenilenir
                    $('#resimPaylasimAlanModal').html('' +
                        '<a href="#" class="link-black text-sm">' +

                        '<i class="fa fa-camera    margin-r-5">' +
                        '<input id="resimModal" name="resimModal" class="dosyaYukle" type="file">' +
                        '</i>' +
                        '</a>');


                    $('#PaylasVazgecModal').trigger('click');
                }
            }, complete: function () {
                $('.loadBolum').hide();
            },
            data: data,
            cache: false,
            contentType: false,
            processData: false
        });

    });

    $('#payGizleDurum').change(function () {
        var durum = $(this).val();
        if (durum == 0) {
            alert("Lürfen bir seçenek seçiniz.")
        } else {
            $.ajax({
                url: 'server-side/paylasimDurumGuncelle.php',
                type: 'POST',
                data:'durum='+durum,
                success:function(gelen){
                    alert(gelen);
                    location.reload();

                }
            })
        }
    });
    $('#takipDurum').change(function () {
        var durum = $(this).val();
        if (durum == 0) {
            alert("Lürfen bir seçenek seçiniz.")
        } else {
            $.ajax({
                url: 'server-side/takipDurumGuncelle.php',
                type: 'POST',
                data:'durum='+durum,
                success:function(gelen){
                    alert(gelen);
                    location.reload();

                }
            })
        }
    });
    $('#mesajDurum').change(function () {
        var durum = $(this).val();
        if (durum == 0) {
            alert("Lürfen bir seçenek seçiniz.")
        } else {
            $.ajax({
                url: 'server-side/mesajDurumGuncelle.php',
                type: 'POST',
                data:'durum='+durum,
                success:function(gelen){
                    alert(gelen);
                    location.reload();

                }
            })
        }
    });
    //$(".filestyle").filestyle({buttonText: "Dosya Bul"});


    $("#resimCropSonuc").off('click').on("click", function () {
        var x = $('#x').val();
        var y = $('#y').val();
        var x2 = $('#x2').val();
        var y2 = $('#y2').val();
        var w = $('#w').val();
        var h = $('#h').val();
        var user_id = $.trim($("input[name=user_id]").val());
        var resimLink = $('#resimLink').val();
        //alert(user_id);
        var a = 'x=' + x + '&y=' + y + '&x2=' + x2 + '&y2=' + y2 + '&w=' + w + '&h=' + h + '&resimLink=' + resimLink + '&user_id=' + user_id;
        $.ajax({
            url: 'do_crop.php',
            type: 'POST',
            data: a,
            beforeSend: function () {
                $("#crop_wrapper").css('display', 'none');
                $('.loadResim').show();
            },
            success: function (data) {
                if (data == 0) {
                    alert('Lütfen  resmi kırpma işlemini gerçekleştirin !');
                    $("#crop_wrapper").css('display', 'block');
                } else {
                    window.location.href = 'edit-profile.php';
                }

                // $('#resimModal').show();
            }, complete: function () {
                $('.loadResim').hide();
            }
        });
    });

    $('#resimVazgecTamam').click(function () {
        $('.gizleBtn').css('display', 'block');
        $('#resimVazgecTamam').css('display', 'none');
        $("#crop_wrapper").html(" ");
    });

    $("#btn_resim_guncelle").off('click').on("click", function () {
        var formData = new FormData();
        var user_id = $.trim($("input[name=user_id]").val());
        formData.append('lokasyon', $("input[name=lokasyon]")[0].files[0]);
        formData.append('user_id', user_id);
        $("#crop_wrapper").html(" ");
        $.ajax({
            url: 'server-side/uploadImg.php',
            type: 'POST',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            beforeSend: function () {
                $('.loadResim').show();
            },
            success: function (data) {
                if (data == 'boş') {
                    $('.gizleBtn').hide();
                    $('#resimVazgecTamam').css('display', 'block');
                    $("#crop_wrapper").html(" Lütfen bir Resim seçiniz");

                } else if (data == 'resimBoyut') {
                    $('.gizleBtn').hide();
                    $('#resimVazgecTamam').css('display', 'block');
                    $("#crop_wrapper").html(" Lütfen 280x280 den daha büyük boyutlu bir resim seçiniz.");
                } else {
                    $("#crop_wrapper").html(data);
                    // $('#resimModal').show();
                }

            }, complete: function () {
                $('.loadResim').hide();
            }
        });
    });


    $('#ara').keyup(function () {
        var name = $(this).val();
        if (name == '') {
            $('#sonuclar').css('display', 'none');
            $('#sonuclar').html('');
            return false
        } else {
            $.post('server-side/uyeAra.php', {ad: name}, function (data) {
                $('#sonuclar').css('display', 'block');
                $('#sonuclar').html(data);
            })
        }

    })


    $("#btn_bilgi_guncelle").off('click').on("click", function () {

        var user_id = $.trim($("input[name=user_id]").val());
        var user_adi = $.trim($("input[name=user_adi]").val());
        var user_soyadi = $.trim($("input[name=user_soyadi]").val());
        var username = $.trim($("input[name=username]").val());
        var password = $.trim($("input[name=password]").val());
        var passwordR = $.trim($("input[name=passwordR]").val());
        var user_sehir = $.trim($("input[name=user_sehir]").val());
        var gun = $.trim($("select[name=gun]").val());
        var ay = $.trim($("select[name=ay]").val());
        var yil = $.trim($("select[name=yil]").val());
        var user_ulke = $.trim($("input[name=user_ulke]").val());
        var user_mail = $.trim($("input[name=email]").val());
        var user_mailR = $.trim($("input[name=emailR]").val());

        var user_dogum_tarih = yil + '-' + ay + '-' + gun;
        $.post("server-side/editProfile.php", {
            "user_id": user_id,
            "user_adi": user_adi,
            "user_soyadi": user_soyadi,
            "username": username,
            "password": password,
            "passwordR": passwordR,
            "user_sehir": user_sehir,
            "user_dogum_tarih": user_dogum_tarih,
            "user_ulke": user_ulke,
            "user_mail": user_mail,
            "user_mailR": user_mailR

        })
            .done(function (data) {
                if (data == 'ok2') {
                    alert("Bilgileriniz Güncellenmiştir.");
                    window.location.href = 'edit-profile.php';
                } else if (data == 'ok') {
                    alert("Bilgileriniz Güncellenip  Yeni Mail Aktivasyonu Gönderilmiştir.");
                    window.location.href = 'edit-profile.php';
                }
                else {
                    alert(data);
                    //window.location.href='edit-profile.php';

                }


            })
            .fail(function () {
                alert("Hata!Sayfaya Ulaşılamadı.");
                return false;
            });


    });

    $("#btn_bilgi_sil").off('click').on("click", function () {

        var sifre = prompt("Lütfen Şifrenizi Giriniz.");

        var user_id = $.trim($("input[name=user_id]").val());


        var r = confirm("Kaydı Silmek İstediğinize Emin misiniz! Bütün Bilgileriniz Silinecek. ");
        if (r == true) {
            $.post("server-side/kisiSil.php", {
                "user_id": user_id,
                "sifre": sifre
            })
                .done(function (data) {
                    if (data == 'ok') {
                        //alert("Kayıt silme  işlemi tamamlandı");
                        location.href = "server-side/logout.php";
                    } else if (data == 'yetki') {
                        alert("Eksik Bilgi. Lütfen Bilgileri Kontrol Ediniz..");
                    } else if (data == 'sifre') {
                        alert("Yanlış Şifre Girdiniz");
                    }
                    else {
                        alert("Bir Hata Oluştu");
                    }
                })
                .fail(function () {
                    alert("Hata!Sayfaya Ulaşılamadı.");
                    return false;
                });
        }


    });

});
