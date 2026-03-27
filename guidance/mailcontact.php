<?php
  //ライブラリ読み込み
  require_once(sprintf("%s/lib/lib_common.php",$_SERVER["DOCUMENT_ROOT"]));
  //Commonクラス生成////////////////////////////////////////////////////////////////////////////////
  $Common = new Common();
  //追加CSS設定
  $Common->addCSS = array("/css/guidance/style.css","/css/guidance/contact.css");
  //ガイダンスクラス生成
  $Guidance = new Guidance($Common);

  //タイトル設定
  $GLOBALS["title"] = "心身統一合氣道会 - お問合わせ";

?>
<?php
  //ヘッダ読み込み
  require_once(sprintf("%sheader.tmp.php",$Common->RootDirTemplates));
?>    
    <!-- Local header -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho">お問合わせ</h2>
        </div>
      </div>
    </div>

    <!-- Local Contents -->
<?php
  //フォーム読み込み
  require_once(sprintf("%sguidance/contact.tmp.php",$Common->RootDirTemplates));
?>    

    <hr class="sta-space">
    <div class="container">
      <div class="row news-info list">
        <div class="col-xs-12">
          <h4 class="text-info">お問い合わせはこちら</h4>
          <table class="table">                
            <tr class="bottom"> 
              <td class="col-xs-12 col-sm-2 title">
                <h4 class="h4-16 text-info">本部事務局</h4>
              </td>
              <td class="col-xs-12 col-sm-8 text">
                <ul class="list-unstyled">
                  <li>〒102-0082 東京都千代田区一番町4-4 一番町笹田ビル</li>
                  <li>TEL 03-6261-0020</li>
                  <li>FAX 03-6261-0021</li>
                  <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <a href="mailto:contact@shinshintoitsuaikido.org">contact@shinshintoitsuaikido.org</a></li>
                  <li>業務時間 火曜日から土曜日10:00-18:00 ※日曜日・月曜日・祝日休</li>
                  <li>※註&nbsp;下記のお問い合わせにはお答えしかねますのでご了承ください。<br>
                  技に関するもの、実技の伴うこと、個々の疾病や健康に関すること、匿名のもの、など</li>
                </ul>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <hr class="sta-space">
<?php
  //フッタ読み込み
  require_once(sprintf("%sfooter.tmp.php",$Common->RootDirTemplates));
?>    
