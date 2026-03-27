/*** datepicker ***/
$('.news-date .input-group.date').datepicker({
    todayHighlight : false,
    autoclose : true,
    keyboardNavigation : false,
    format: 'yyyy-mm-dd',
    language: 'ja'

});

$(function(){
    $('#datepicker1').datepicker() 
        .on('changeDate', function(e){ //開始日が選択されたら
            $('#datepicker2').datepicker('show'); //終了日のカレンダーを表示
            selected_date = e['date']; //開始日のデータ取得
            yyyy = selected_date.getFullYear();
            mm = selected_date.getMonth() + 1;
            dd = selected_date.getDate();
            sd = computeDate(yyyy, mm, dd, 0); //0000-00-00の形で指定日後が返ってくる
            $('#datepicker2').datepicker('setStartDate', sd); //start日より前の日を無効化する
    });
});

function computeDate(year, month, day, addDays) {
    var dt = new Date(year, month - 1, day);
    var baseSec = dt.getTime();
    var addSec = addDays * 86400000;//日数 * 1日のミリ秒数
    var targetSec = baseSec + addSec;
    dt.setTime(targetSec);
    return dt;
}

