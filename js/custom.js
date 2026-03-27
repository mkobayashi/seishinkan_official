/*** header opacity ***/
$(function(){
    function transmHeader() {
            var now = $(window).scrollTop();
            if(now > 0) {
                $('.navbar-fixed-top').css('background-color', 'rgba(255, 255, 255, 0.8)');
            } else {
                $('.navbar-fixed-top').css('background-color', 'rgba(255, 255, 255, 1.0)');
            }
    }
    transmHeader;
    $(window).scroll(transmHeader);


    $(".navbar-fixed-top").hover(
        function(){
            $('.navbar-fixed-top').css('background-color', 'rgba(255, 255, 255, 1.0)');
        },
        transmHeader
    );
});





/*** arrow for page-top ***/
$(function(){
    $(window).scroll(
        function(){
            //最上部から現在位置までの距離
            var now = $(window).scrollTop();

            //最下部から現在位置までの距離
            var under = $("body").height() - (now + $(window).height());

            //            if(now > 200 && (under > 50 || $(window).width() >= 768 )) {
            if(now > 200) {
                $("#page-top").fadeIn("slow");
            } else {
                $("#page-top").fadeOut("slow");
            }
        }
    );

    $("#move-page-top").click(
        function(){
            $("html,body").animate({scrollTop:0},"slow");
        }
    );
});

/*** accordion for Q and A ***/
$(function(){
    $('#q1, #q2, #q3, #q4, #q5, #q6, #q7, #q8, #q9, #q10, #q11, #q12, #q13, #q14, #q15, #q16, #q17, #q18, #q19, #q20, #q21, #q22, #q23, #q24, #q25, #q26, #q27, #q28, #q29, #q30, #q31, #q32, #q33, #q34, #q35, #q36, #q37, #q38, #q39, #q40')
        .on('show.bs.collapse', function(){ //< 折り畳み開く処理
        $('a[href="#' + $(this).attr('id') + '"]').find('span.glyphicon')
                .html("ー");
      })
      .on('hide.bs.collapse', function(){ //< 折り畳み閉じる処理
        $('a[href="#' + $(this).attr('id') + '"]').find('span.glyphicon')
                .html("＋");
      });

});

/*** Google Map ***/
/*
$(function(){
     $("div.ggmap.tochigi").html(
        '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3206.024722881761!2d140.06196186195268!3d36.52939792417815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6021e3d2fc8797a7%3A0x17001fdb0b20f74d!2z44CSMzIxLTM0MjYg5qCD5pyo55yM6Iqz6LOA6YOh5biC6LKd55S66LWk576977yT77yV77yR77yV!5e0!3m2!1sja!2sjp!4v1438090015325" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'
    );

    $("div.ggmap.tokyo").html(
        '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.5504059828936!2d139.7425821!3d35.68807085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c6f78a4d2b9%3A0x194d04c0d4b1a4e7!2z44CSMTAyLTAwODIg5p2x5Lqs6YO95Y2D5Luj55Sw5Yy65LiA55Wq55S6IOS4gOeVqueUuuesueeUsOODk-ODqw!5e0!3m2!1sja!2sjp!4v1438147092681" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'
    );

    $("div.ggmap.osaka").html(
        '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.778821995374!2d135.5086475!3d34.7107582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e6bdcb2f0d0f%3A0x994771d8f59db84e!2z44CSNTMxLTAwNzQg5aSn6Ziq5bqc5aSn6Ziq5biC5YyX5Yy65pys5bqE5p2x77yR5LiB55uu77yR77yT4oiS77yV!5e0!3m2!1sja!2sjp!4v1438147346244" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'
    );

}); */


/*** page-down ***/
$(function(){
    $(".page-down-label").click(
        function(){
            var pos = $('#page-down').offset().top - 90;
            $("html,body").animate({scrollTop:pos},"normal");
        }
    );
});


/*** form clear ***/
$(function() {
    $('.clearForm').bind('click', function(){
        $(this.form).find("textarea, :text, select").val("").end().find(":checked").not("input[type=\"radio\"]").prop("checked", false);
        return false;
    });
});

/*** move to link ***/
$(function() {
    $('a[href^=#]').bind('click', function(){
            var href= $(this).attr("href"); 
            var target = $(href == "#" || href == "" ? 'html' : href);
            var position = target.offset().top - 90;
            $("html, body").animate({scrollTop:position}, "normal", "swing");
            return false;
        }); 
});



