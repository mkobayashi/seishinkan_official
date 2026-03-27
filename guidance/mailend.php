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
    <p style="text-align:center;">送信ありがとうございました</p>
    <!-- Local Contents -->
    <hr class="sta-space">

<?php
  //フッタ読み込み
  require_once(sprintf("%sfooter.tmp.php",$Common->RootDirTemplates));
?>    
