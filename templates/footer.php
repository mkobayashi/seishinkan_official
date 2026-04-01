<!-- 共通フッター: 地図用スクリプト → page-top → <footer> -->
    <script>
$(function(){
    // ggmap.js と Google Maps API を読み込んだページのみ（静的フッターに地図用 div は無い）
    if (typeof drawGMap === 'function' && $('div.ggmap.mapdisplay').length) {
        drawGMap("東京都世田谷区成城5-9-3", 'div.ggmap.mapdisplay');
    }
});
</script>

    <div id="page-top">
      <p><a id="move-page-top">
          <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span><br />
          top</a></p>
    </div>

 <footer>
      <div class="container-fluid footer-link-bg">
        <div class="container">
          <div class="row footer-link hirakaku-gothic">
            <div class="col-xs-12 col-sm-4 col-lg-3">
              <h5>成心館のご紹介</h5>
              <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/about/greeting.php">ご挨拶</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/about/about.php">概要・沿革</a></li>
              </ul>
<a href="http://www.seishinkan.org/english.html"><h6><b>Seishinkan Dojo English Site</b></h6></a>
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-3">
              <h5>クラス紹介</h5>
              <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class.php">合氣道クラス</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class_ki.php">氣圧法クラス</a></li>
                                  <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class_kids.php">子どもクラス</a></li>
              </ul>
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-3">
              <h5>月会費・入会時費用</h5>
              <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/entry/entry.php">月会費・入会時費用</a></li>
              </ul>
            </div>


            <div class="col-xs-12 col-sm-4 col-lg-3">
              <h5>道場・教室一覧</h5>
              <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/category/dojo/">道場・教室一覧</a></li>
              </ul>
              <h5><a href="/info/">活動報告</a></h5>
              <h5><a href="/reserve">見学予約</a></h5>
              <h5><a href="/contact">お問合わせ</a></h5>
              </div>
</div>
</div>
</div> 
<!-- footer-link's container-fluid -->
<div class="container-fluid footer-address-bg">
    <div class="container">
        <div class="row footer-address hirakaku-gothic">
            <div class="col-xs-12 col-lg-4">
              <h5>心身統一合氣道会｜成心館道場</h5>
                <h6><a href="https://www.youtube.com/channel/UCOn7-WmaN3UiLFJwpkL3UCA" target="_blank">成心館公式YouTubeチャンネル</a></h6>
                <iframe id="ytplayer" type="text/html" width="80%" height="135px"
src="https://www.youtube.com/embed/TbpA2txMYOE?controls=0"
                             frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-xs-12 col-lg-4 fa-line">
              <h6>成心館道場</h6>
              <ul class="list-unstyled">
                <li>〒157-0066</li>
                <li>東京都世田谷区成城5-9-3</li>
                <li>TEL 03-3483-7983</li>
              </ul>
            </div>
            <div class="col-xs-12 col-lg-4 fa-line">
              <h6>道場・教室</h6>
              <ul class="list-unstyled">
                <li>成心館道場（成城道場）</li>
                <li>自由が丘教室</li>
                <li>青山教室</li>
                <li>赤坂教室</li>
                <li>お茶の水教室</li>
                <li>札幌西28丁目教室</li>
                <li>札幌大谷地教室</li>
              </ul>
            </div>
          </div>
        </div>
      </div> <!-- footer-address'es container-fluid -->

      <div class="container-fluid copyright-bg">
        <div class="container">
          <div class="row copyright">
            <div class="col-xs-12 col-lg-6">
              <ul class="list-inline">
                <li><a href="/sitemap">サイトマップ</a></li>
                <li>｜ <a href="/sitepolicy">サイトポリシー</a></li>
                <li>｜ <a href="/privacy">プライバシーポリシー</a></li>
                <li>｜ <a href="/english.html">English</a></li>
              </ul>
            </div>

            <div class="col-xs-12 col-lg-6 text-right">
              <p>Copyright &copy; 心身統一合氣道会 成心館道場 All rights reserved.</p>
            </div>
          </div>
        </div>
      </div> <!-- copyright's container-fluid -->
    </footer>
    <?php if (function_exists('wp_footer')) { wp_footer(); } ?>
  </body>
</html>