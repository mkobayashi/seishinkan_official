/*** local header fade ***/
$(function() {
    var w = $(window).width();
    var h = Math.min(w * 600 / 1200, 600);
    var cf_css = {};
    if (w >= 1200) {
        cf_css = {
            height: h,
            maxWidth: '100%'
        };
    } else if (w >= 768) {
        cf_css = {
            height: h,
            width: '100%'
        };
    } else {
        h = (w + 30) * 600 / 1200;
        cf_css = {
            height: h,
            width: '100%'
        };
    }

    $('#local-header-fade, #local-header-fade-ki').each(function() {
        var $fade = $(this);
        if (w >= 1200) {
            $fade.find('img').css({
                maxWidth: '100%'
            });
        }
        $fade.css(cf_css);
        $fade.crossFader({
            timer: 4000,
            speed: 1000,
            changeSpd: 800,
            autoStart: true,
            loop: true
        });
    });
 });

/*** top header fade ***/
$(function() {
    var w = $(window).width();
    //    var h = Math.min(w * 1239 / 2400 - 95, 731);
    var h = Math.min(w * 680 / 1200, 680);    
    var cf_css = {};
    if (w >= 1200) {
        cf_css = {
            height: h,
            maxWidth: '100%'
        };
        $('#top-header-fade img').css({
            //width: '1600px'
            maxWidth: '100%'
        });
    } else if (w >= 768) {
        cf_css = {
            height: h,
            width: '100%'
        };
    } else {
        //var h = w * 1239 / 2400 - 75;
        var h = (w + 30) * 680 / 1200;        
        cf_css = {
            height: h,
            width : '100%'
        };
    }
    $('#top-header-fade').css(cf_css);
    
    $('#top-header-fade').crossFader({
        timer: 4000,
        speed: 1000,
        changeSpd: 800,
        autoStart: true,
        loop: true
    });
 });


/*** article fade ***/
$(function() {
    var w = $(window).width();
    var cf_css = {};
    if (w >= 1600) {
        cf_css = {
            height: '605px',
            maxWidth: '100%'
        };
        $('.article-fade img').css({
            //width: '1600px'
            maxWidth: '100%'
        });
    } else if (w >= 1200) {
        cf_css = {
            height: '605px',
            width: '100%'
        };
    } else {
        var h = w * 908 / 2400;
        cf_css = {
            height: h,
            width : '100%'
        };
    }
    $('.article-fade').css(cf_css);
    
    $('.article-fade').crossFader({
        timer: 4000,
        speed: 1000,
        changeSpd: 800,
        autoStart: true,
        loop: true
    });
 });
