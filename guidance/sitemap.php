<?php
  //ライブラリ読み込み
  require_once(sprintf("%s/lib/lib_common.php",$_SERVER["DOCUMENT_ROOT"]));
  //Commonクラス生成////////////////////////////////////////////////////////////////////////////////
  $Common = new Common();
  
  //追加CSS設定
  $Common->addCSS = array("/css/guidance/style.css","/css/guidance/sitemap.css");
  
  //タイトル設定
  $GLOBALS["title"] = "心身統一合氣道会 - サイトマップ";

  //ヘッダ読み込み
  require_once(sprintf("%sheader.tmp.php",$Common->RootDirTemplates));
?>
    
    <!-- Local header -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho">サイトマップ</h2>
        </div>
      </div>
    </div>


    

    <!-- Local Contents -->

    <div class="container">
      <div class="row sitemap-ls guidance js-masonry">
        <div class="col-xs-12 col-sm-6">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">心身統一合氣道とは</h4>
          </div>

          <ul class="list-unstyled">
            <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
              <a href="/about/message.php">会長ご挨拶</a></li>
            <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
              <a href="/about/founder.php">宗主&nbsp;藤平光一</a></li>
            <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
              <a href="/about/successor.php">継承者&nbsp;藤平信一</a></li>
            <li class="top"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
              <a href="/about/corporation.php">法人情報</a></li>
            <li class="next"><a href="/about/corporation.php#corp-history">沿革</a></li>
            <li class="next"><a href="/about/corporation.php#corp-board">組織</a></li>
            <li class="next end"><a href="/about/corporation.php#corp-hq">本部</a></li>
          </ul>
        </div>

        <div class="col-xs-12 col-sm-6">          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">クラス紹介</h4>
          </div>
              <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class.php">大人クラス</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class_kids.php">子どもクラス</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class_ki.php">氣のクラス</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class_kinokouza.php">氣の講座</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/class/class_bis.php">企業・アスリート</a></li>
              </ul>
        </div>

        <div class="col-xs-12 col-sm-6" id="entry">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">入会案内</h4>
          </div>
              <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/entry/entry.php">さあ、はじめましょう</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/entry/entry.php#entry-price">会費</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/entry/entry.php#entry-qa">Q&amp;A</a></li>
              </ul>
        </div>

        <div class="col-xs-12 col-sm-6" id="dojo">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">道場・教室</h4>
          </div>
          <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/dojo">道場・教室検索</a></li>
          </ul>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">セミナー・講習会</h4>
          </div>
          <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/seminar">セミナー・講習会情報</a></li>
          </ul>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">お知らせ</h4>
          </div>
          <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/information">お知らせ</a></li>
          </ul>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">各種ご案内</h4>
          </div>
          <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/guidance/privacy.php">プライバシーポリシー</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/guidance/sitepolicy.php">サイトポリシー</a></li>
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/guidance/sitemap.php">サイトマップ</a></li>
                
          </ul>
        </div>

        <div class="col-xs-12 col-sm-6">
          <div class="title sta-bg-vpgreen">
            <h4 class="h4-16 text-info">お問合せ</h4>
          </div>
          <ul class="list-unstyled">
                <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                  <a href="/guidance/mailcontact.php">お問合せ</a></li>
          </ul>
        </div>
        
      </div>
    </div>


    <hr class="sta-space">

    <!-- Footer Contents -->
<?php
  //フッタ読み込み
  require_once(sprintf("%sfooter.tmp.php",$Common->RootDirTemplates));
?>    
