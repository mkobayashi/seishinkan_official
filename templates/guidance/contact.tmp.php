    <hr class="sta-space-sm">
    <div class="container">
      <form class="form-horizontal contact" action="/guidance/mailcheck.php" method="post">
        <div class="row">
          <div class="col-xs-12">
            <p>お問合わせ内容を下記のボタンでお選びになり、フォームに入力のうえ送信ください。<br>
              なお、返信に時間がかかる場合があります。お急ぎの場合は、各窓口に直接お電話にてお問合わせください。</p>
          </div>
        </div>
        <div class="row">
          <ul class="col-xs-12" style="color:#ff0000;font-weight:bold; width:">
<?php
  foreach($Common->ErrorMessage as $key => $element){
?>
          <li><?php echo($element); ?></li>
<?php
  }
?>
          </ul>
        </div>
        <div class="row title-radio">
          <div class="form-group col-xs-12 text-info">
<?php
  foreach($Guidance->aCategory as $key => $element){
?>
            <div class="radio">
              <input type="radio" name="category" id="r<?php echo($key); ?>" value="<?php echo($key); ?>"<?php echo(!empty($Common->request["category"]) && $key==$Common->request["category"] ? " checked='checked'" : ""); ?>>
              <label for="r<?php echo($key); ?>"><?php echo($element); ?></label>
            </div>
<?php
  }
?>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <p class="text-info"><span class="text-danger">※</span>は必須項目です。</p>
          </div>
          <div class="col-xs-12 detail">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="name"><span class="text-danger">※</span>氏名</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="name" name="name" value="<?php echo(!empty($Common->request["name"]) ? $Common->request["name"] : ""); ?>"></div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="kana"><span class="text-danger">※</span>フリガナ</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="kana" name="kana" value="<?php echo(!empty($Common->request["kana"]) ? $Common->request["kana"]:""); ?>"></div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="mail"><span class="text-danger">※</span>メールアドレス</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="mail" name="mailaddr" value="<?php echo(!empty($Common->request["mailaddr"]) ? $Common->request["mailaddr"] : ""); ?>"></div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="section">所属</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="section" name="section" value="<?php echo(!empty($Common->request["section"]) ? $Common->request["section"] : ""); ?>"></div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="zipcode1">郵便番号</label>
              <div class="col-xs-12 col-sm-6">
                <input type="text" class="form-control zipcode" id="zipcode1" maxlength="3" name="zip1" value="<?php echo(!empty($Common->request["zip1"]) ? $Common->request["zip1"]:""); ?>">
                <span class="form-control-static zipcode">-</span>
                <input type="text" class="form-control zipcode" id="zipcode2" maxlength="4" name="zip2" value="<?php echo(!empty($Common->request["zip2"]) ? $Common->request["zip2"]:""); ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="prefecture">都道府県</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="prefecture" name="prefecture" value="<?php echo(!empty($Common->request["prefecture"]) ? $Common->request["prefecture"]:""); ?>"></div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="city">市区町村</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="city" name="city" value="<?php echo(!empty($Common->request["city"]) ? $Common->request["city"] : ""); ?>"></div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 control-label" for="address">番地（建物）</label>
              <div class="col-xs-12 col-sm-6"><input type="text" class="form-control" id="address" name="address" value="<?php echo(!empty($Common->request["address"]) ? $Common->request["address"] : ""); ?>"></div>
            </div>

            <div class="form-group bottom">
              <label class="col-xs-12 col-sm-3 control-label" for="content"><span class="text-danger">※</span>お問合せ内容</label>
              <div class="col-xs-12 col-sm-6">
                <textarea class="form-control" rows="10" id="content" name="content"><?php echo(!empty($Common->request["content"]) ? $Common->request["content"] : ""); ?></textarea>
              </div>
            </div>

            <div class="form-group action bottom">
              <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
                <input type="reset" class="btn btn-lg btn-default" value="クリア">
                <input type="submit" class="btn btn-lg btn-default" value="入力内容を確認する" id="contact-submit">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
