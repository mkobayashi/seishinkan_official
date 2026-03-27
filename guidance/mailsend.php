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

  //フォーム受信
  $Common->fields = array(
    "correct",
    "category",
    "name",
    "kana",
    "mailaddr",
    "section",
    "zip1",
    "zip2",
    "prefecture",
    "city",
    "address",
    "content",
  );
  $Common->ReceiveRequest();
  //バリッドチェック
  $Guidance->CheckValid();

  //エラーチェック
  if(count($Common->ErrorMessage)==0){
    //エラー無しならメール送信
    $Guidance->SendMail();
    //送信結果ページにリダイレクト
    header('Location: /guidance/mailend.php');
    exit;
  }
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
    <hr class="sta-space-sm">
    <div class="container">
      <div class="form-horizontal contact" action="/guidance/send.php" method="post">
        <div class="row">
          <div class="col-xs-12">
            <p>お問合わせ内容を確認のうえ送信ください。</p>
          </div>
        </div>
        <div class="row title-radio">
          <div class="form-group col-xs-12 text-info">
            <p class="text-info"><?php echo($Guidance->aCategory[$Common->request["category"]]); ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 detail">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label"><span class="text-danger">※</span>氏名</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["name"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="kana"><span class="text-danger">※</span>フリガナ</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["kana"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="mail"><span class="text-danger">※</span>メールアドレス</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["mailaddr"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="section">所属</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["section"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="zipcode1">郵便番号</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["zip1"]); ?>-<?php echo($Common->request["zip2"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="prefecture">都道府県</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["prefecture"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="city">市区町村</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["city"]); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="address">番地（建物）</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo($Common->request["address"]); ?>
              </div>
            </div>

            <div class="form-group bottom">
              <label class="col-xs-12 col-sm-3 control-label" for="content"><span class="text-danger">※</span>お問合せ内容</label>
              <div class="col-xs-12 col-sm-6">
                <?php echo(nl2br($Common->request["content"])); ?>
              </div>
            </div>

            <div class="form-group action bottom">
              <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
                <form class="form-horizontal contact" action="/guidance/check.php" method="post">
                  <input type="hidden" name="correct" value="1">
                  <input type="hidden" name="category" value="<?php echo($Common->request["category"]); ?>">
                  <input type="hidden" id="name" name="name" value="<?php echo($Common->request["name"]); ?>">
                  <input type="hidden" id="kana" name="kana" value="<?php echo($Common->request["kana"]); ?>">
                  <input type="hidden" id="mail" name="mailaddr" value="<?php echo($Common->request["mailaddr"]); ?>">
                  <input type="hidden" id="section" name="section" value="<?php echo($Common->request["section"]); ?>">
                  <input type="hidden" id="zipcode1" maxlength="3" name="zip1" value="<?php echo($Common->request["zip1"]); ?>">
                  <input type="hidden" id="zipcode2" maxlength="4" name="zip2" value="<?php echo($Common->request["zip2"]); ?>">
                  <input type="hidden" id="prefecture" name="prefecture" value="<?php echo($Common->request["prefecture"]); ?>">
                  <input type="hidden" id="city" name="city" value="<?php echo($Common->request["city"]); ?>">
                  <input type="hidden" id="address" name="address" value="<?php echo($Common->request["address"]); ?>">
                  <input type="hidden" class="form-control" id="content" name="content" value="<?php echo($Common->request["content"]); ?>">
                  <input type="submit" class="btn btn-lg btn-default" value="訂正する">
                </form>
                <form class="form-horizontal contact" action="/guidance/send.php" method="post">
                  <input type="hidden" name="correct" value="1">
                  <input type="hidden" name="category" value="<?php echo($Common->request["category"]); ?>">
                  <input type="hidden" id="name" name="name" value="<?php echo($Common->request["name"]); ?>">
                  <input type="hidden" id="kana" name="kana" value="<?php echo($Common->request["kana"]); ?>">
                  <input type="hidden" id="mail" name="mailaddr" value="<?php echo($Common->request["mailaddr"]); ?>">
                  <input type="hidden" id="section" name="section" value="<?php echo($Common->request["section"]); ?>">
                  <input type="hidden" id="zipcode1" maxlength="3" name="zip1" value="<?php echo($Common->request["zip1"]); ?>">
                  <input type="hidden" id="zipcode2" maxlength="4" name="zip2" value="<?php echo($Common->request["zip2"]); ?>">
                  <input type="hidden" id="prefecture" name="prefecture" value="<?php echo($Common->request["prefecture"]); ?>">
                  <input type="hidden" id="city" name="city" value="<?php echo($Common->request["city"]); ?>">
                  <input type="hidden" id="address" name="address" value="<?php echo($Common->request["address"]); ?>">
                  <input type="hidden" class="form-control" id="content" name="content" value="<?php echo($Common->request["content"]); ?>">
                  <input type="submit" class="btn btn-lg btn-default" value="入力内容で送信する" id="contact-submit">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="sta-space">

<?php
  //フッタ読み込み
  require_once(sprintf("%sfooter.tmp.php",$Common->RootDirTemplates));
?>    
