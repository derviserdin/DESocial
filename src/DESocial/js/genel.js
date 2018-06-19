$(function () {

    $(document).off('click','.gosterPaySayi').on('click','.gosterPaySayi',function (e) {
        var veri = $(this).closest('li');
         $('.modal-title').html("Paylaşanlar")
        var id=    $('input:eq(0)',veri).val();
      //  alert(id);
        $.ajax(
            {
                url:'server-side/views/gorunum.php',
                type:'POST',
                data:'Id='+id+'&durum=pay',
                success:function (gelen) {
                    console.log(gelen);
                    if(gelen=="durumHata" ){
                        $('#payKisiGoster .modal-body').html(
                            "Bir sorun ile karşılaşıldı"
                        );

                    }else if(gelen=="yok"){
                        $('#payKisiGoster .modal-body').html(
                            "Şuan İçin paylaşan kimse yok.");

                    }else{
                        $('#payKisiGoster .modal-body').html(
                            gelen
                        )
                    }
                }
            }
        )
        return false;
    });
    $(document).off('click','.devamOku').on('click','.devamOku',function (e) {

        var id=    $(this).attr("data-id");
        $.ajax(
            {
                url:'server-side/views/devamGoster.php',
                type:'POST',
                data:'id='+id,
                success:function (gelen) {
                    console.log(gelen);
                    if(gelen=="0" ) {
                        alert("Bir sorun ile karşılaşıldı. Yetkili kişi ile iletişim kurunuz!!");

                    } else{
                        $('.text'+id).html(
                            gelen
                        )
                    }
                }
            }
        )
        return false;
    });
    $(document).off('click','.gosterBegSayi').on('click','.gosterBegSayi',function (e) {
              var id=    $(this).attr("data-num");
        $('.modal-title').html("Beğenenler");
       //alert(id);
        $.ajax(
            {
                url:'server-side/views/gorunum.php',
                type:'POST',
                data:'Id='+id+'&durum=beg',
                success:function (gelen) {
                    console.log(gelen);
                    if(gelen=="durumHata" ){
                        $('#payKisiGoster .modal-body').html(
                            "Bir sorun ile karşılaşıldı"
                        );

                    }else if(gelen=="yok"){
                        $('#payKisiGoster .modal-body').html(
                            "Şuan İçin begenen kimse yok.");

                    }else{
                        $('#payKisiGoster .modal-body').html(
                            gelen
                        )
                    }



                }


            }
        )
        return false;
    });


$(document).off('click','.gosterYoBegSayi').on('click','.gosterYoBegSayi',function (e) {
    var id=    $(this).attr("data-num");
    $('.modal-title').html("Beğenenler");
    //alert(id);
    $.ajax(
        {
            url:'server-side/views/gorunum.php',
            type:'POST',
            data:'Id='+id+'&durum=begYo',
            success:function (gelen) {
                console.log(gelen);
                if(gelen=="durumHata" ){
                    $('#payKisiGoster .modal-body').html(
                        "Bir sorun ile karşılaşıldı"
                    );

                }else if(gelen=="yok"){
                    $('#payKisiGoster .modal-body').html(
                        "Şuan İçin begenen kimse yok.");

                }else{
                    $('#payKisiGoster .modal-body').html(
                        gelen
                    )
                }



            }


        }
    )
    return false;
});

    $(document).off('click','.begeniArttirr').on('click','.begeniArttirr',function () {
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
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniAzaltt">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        '<i class="fa fa-star margin-r-5"></i>' +
                        ' <span class="begeniSayi'+id+'"> Beğenmekten Vazgeç ('+gelen+')</span>' +
                        '<a/>')

                }

            }
        )
    });

    $(document).off('click','.begeniAzaltt').on('click','.begeniAzaltt',function () {
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
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniArttirr">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        '<i class="fa fa-star margin-r-5"></i>' +
                        ' <span class="begeniSayi'+id+'"> Beğen ('+gelen+')</span>' +
                        '<a/>')


                }

            }
        )
    });

    $(document).off('click','.begeniYorumArttirr').on('click','.begeniYorumArttirr',function () {
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
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumAzaltt">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        ' <span class="yorumId'+yorumId+'" style="display:none">'+yorumId+'</span>' +
                        '<i class="fa fa-star margin-r-5"></i>' +
                        ' <span class="begeniYorumSayi'+yorumId+'"> Beğenmekten Vazgeç ('+gelen+')</span>' +
                        '<a/>')

                }

            }
        )
    });
    $(document).off('click','.begeniYorumAzaltt').on('click','.begeniYorumAzaltt',function () {
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
                        '  <a href="#" onclick="return false"  class="denemeclas link-black text-sm begeniYorumArttirr">' +
                        ' <span class="payId'+id+'" style="display:none">'+id+'</span>' +
                        ' <span class="yorumId'+yorumId+'" style="display:none">'+yorumId+'</span>' +
                        '<i class="fa fa-star margin-r-5"></i>' +
                        ' <span class="begeniYorumSayi'+yorumId+'"> Beğen ('+gelen+')</span>' +
                        '<a/>')


                }

            }
        )
    });

    $("body div").click(function(){
        $('#ara').val("");
        $("#sonuclar").hide().html("");

    });

});