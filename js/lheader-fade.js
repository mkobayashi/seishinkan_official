/*** クラス紹介など：ローカルヘッダー crossfader（#local-header-fade と #local-header-fade-ki は別インスタンス・別タイマー） ***/
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

    var crossfaderOpts = {
        timer: 4000,
        speed: 1000,
        changeSpd: 800,
        autoStart: true,
        loop: true
    };

    function sizeLocalCrossfader($fade) {
        if (!$fade.length) {
            return;
        }
        if (w >= 1200) {
            $fade.find('img').css({
                maxWidth: '100%'
            });
        }
        $fade.css(cf_css);
    }

    // 1台目（合氣道「動」・子ども・氣圧法ページの単一スライダーなど）：即時初期化
    var $fadePrimary = $('#local-header-fade');
    if ($fadePrimary.length) {
        sizeLocalCrossfader($fadePrimary);
        $fadePrimary.crossFader(crossfaderOpts);
    }

    // 2台目（同一ページ内の「静」）：別 setInterval をずらして同時切り替えによる干渉感を減らす
    var $fadeKi = $('#local-header-fade-ki');
    if ($fadeKi.length) {
        sizeLocalCrossfader($fadeKi);
        setTimeout(function() {
            $fadeKi.crossFader(crossfaderOpts);
        }, 500);
    }
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
