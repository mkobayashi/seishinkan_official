/* address: 住所,
 * tag: 地図を表示したい場所のタグ
 */
function drawGMap(address, tag) {
    var geocoder = new google.maps.Geocoder();
    //住所から座標を取得する
    geocoder.geocode({
        'address': address,
        'region': 'jp'
    },
    function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            google.maps.event.addDomListener(window, 'load', function () {

                var map_tag = $(tag).get(0);
                var map_location = new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng());
                
                //マップ表示のオプション
                var map_options = {
                    zoom: 15,//縮尺
                    center: map_location,
                    disableDefaultUI: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                // マーカー付きマップ表示
                var map = new google.maps.Map(map_tag, map_options);
                new google.maps.Marker({
                    position: map_location,
                    map: map
                });
            });
        } else {
            $('.ggmap').addClass('empty');
        }
    }
    );
}


/*** Google Map ***/

$(function(){
    drawGMap("東京都世田谷区成城5-9-3", 'div.ggmap.seijo');
    drawGMap("栃木県芳賀郡市貝町大字赤羽3515", 'div.ggmap.tochigi');
    drawGMap("東京都千代田区一番町4-4 一番町笹田ビル", 'div.ggmap.mapdisplay');
    drawGMap("大阪市北区本庄東 1-13-5", 'div.ggmap.osaka');

});

