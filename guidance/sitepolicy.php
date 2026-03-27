<?php
  //ライブラリ読み込み
  require_once(sprintf("%s/lib/lib_common.php",$_SERVER["DOCUMENT_ROOT"]));
  //Commonクラス生成////////////////////////////////////////////////////////////////////////////////
  $Common = new Common();
  
  //追加CSS設定
  $Common->addCSS = array("/css/guidance/style.css","/css/guidance/sitepolicy.css");
  
  //タイトル設定
  $GLOBALS["title"] = "心身統一合氣道会 - 利用規約";

  //ヘッダ読み込み
  require_once(sprintf("%sheader.tmp.php",$Common->RootDirTemplates));
?>


    
    <!-- Local header -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 local-header-title text-center">
          <h2 class="h2-28 ryu-mincho">利用規約</h2>
        </div>
      </div>
    </div>


    

    <!-- Local Contents -->

    <div class="container">
      <div class="row guidance">
        
        <div class="col-xs-12">
          <div class="title sta-bg-vpgreen sta res-left"><div>
            <h4 class="h4-16 text-info">WEBサイトのご利用条件</h4>
          </div></div>
          <div class="sta res-left"><div>
              <p>当WEBサイトは、当会が業務を委託するKiマネジメント株式会社が運営しています。<br>
                当WEBサイトにおける著作権は当会に帰属しており、利用上の制限がありますので、ご利用の前に必ず以下の利用条件をお読みください。<br>
                また、関連する個々のWEBサイトに利用条件が設けられているものについては、その利用条件をよくお読みの上ご利用ください。</p>
          </div></div>
        </div>

        <div class="col-xs-12">
          <div class="title sta-bg-vpgreen sta res-left"><div>
            <h4 class="h4-16 text-info">1. データ資料使用の制限</h4>
          </div></div>
          <div class="sta res-left"><div>
              <table class="table sitepolicy">
                <tr>
                  <th>1.</th>
                  <td>当WEBサイトに掲載されている図形や写真、動画、音楽、音声、文章などの情報、データ（以下、総称してデータ資料といいます）は、全て当社、または当会に使用を許諾している権利所有者の著作権（または著作隣接権）により保護されています。</td>
                </tr>

                <tr>
                  <th>2.</th>
                  <td>データ資料は次の条件を全て満たす場合に限りダウンロードを認めます。
                    <ul>
                      <li>WEBサイト上で、該当データのダウンロードを許可していること。</li>
                      <li>使用目的が非営利的、個人的用途であること。</li>
                      <li>ご自宅、ご家庭での使用で、1台のコンピューターで1コピーのみであること。</li>
                      <li>データ資料に表示されている全ての著作権、商標権その他一切の権利表示を保持したままであること。</li>
                      <li>当会が利用を許可したバナー、アフィリエイトバナー、ブログパーツなどについての利用条件は、それぞれのコンテンツの規約をご確認ください。</li>
                    </ul>
                  </td>
                </tr>

                <tr>
                  <th>3.</th>
                  <td>以下のような使用は認めておりません。くれぐれもご注意ください。
                    <ul>
                      <li>ダウンロードしたデータ資料を他のコンピューターにインストールすること。</li>
                      <li>ダウンロードしたデータ資料を、複製、改変、編集したり、他人に配布、販売したり、リバースエンジニアリング・逆コンパイル・逆アッセンブル、その他読み取り可能な形態にしたりすること。例えばダウンロードしたデータ資料に手を加えたり、データ資料をWEBサイトやブログ、サーバに掲載したりすることや、プリントアウトして他人に配ることなどがその代表例です。<br>
                        これは、営利を目的としないネットワーク上においても同様です。</li>
                    </ul>
                  </td>
                </tr>

                <tr>
                  <th>4.</th>
                  <td>ダウンロードしたデータ資料は、あくまでこの利用条件の中で承認された範囲内でのみ、非独占的に使用できるもので、いかなる権利の譲渡を意味するものではありません。</td>
                </tr>
                <tr>
                  <th>5.</th>
                  <td>この利用条件に違反したときは、当社はデータ資料の使用許諾を解除することができます。この場合、データ資料のご利用を直ちに中止するとともに、ダウンロードしたデータ資料及びそのコピーを全て抹消しなければなりません。</td>
                </tr>

                <tr>
                  <th>6.</th>
                  <td>当会が使用許諾を解除したか否かにかかわらず、当会に無断で個人利用以外の方法（著作権法で特に認められている場合を除きます。）でデータ資料を使用されますと、著作権（または著作隣接権）の侵害となります。<br>
                    著作権侵害は、著作権法により違法行為とされ、権利者から侵害行為の差止めや損害賠償の請求を受けるだけでなく、厳格な刑事罰の対象となりますので、くれぐれもご注意ください。</td>
                </tr>

                <tr>
                  <th>7.</th>
                  <td>このWEBサイトの発信地は日本国ですが、ベルヌ条約、万国著作権条約などにより、このWEBサイトを受信している外国の国内法においても保護されています。 従って、外国におけるデータ資料の不正利用も著作権（または著作隣接権）の侵害となることに変わりありません。</td>
                </tr>
              </table>


          </div></div>
        </div>

        <div class="col-xs-12">
          <div class="title sta-bg-vpgreen sta res-left"><div>
            <h4 class="h4-16 text-info">2. 法の適用</h4>
          </div></div>
          <div class="sta res-left"><div>
              <p>この利用条件の解釈は日本国の法律を準拠法とします。この利用条件が外国語に翻訳された場合においても、全て日本語による解釈が優先します。また、当WEBサイトに関する訴訟は、全て日本国の東京地方裁判所を第一審の専属管轄裁判所とします。</p>
          </div></div>
        </div>

        <div class="col-xs-12">
          <div class="title sta-bg-vpgreen sta res-left"><div>
            <h4 class="h4-16 text-info">3. リンクについて</h4>
          </div></div>
          <div class="sta res-left"><div>
              <p>当WEBサイトへのリンクは基本的に自由です。連絡は不要ですがご一報いただければ幸いです。<br>
                次のリンクはお断り致します。</p>

              <ul class="sta begin">
                <li>当WEBサイトの誹謗中傷、または信用毀損を意図するサイトからのリンク。</li>
                <li>違法もしくは違法の可能性があるコンテンツを含むWEBサイト、または違法もしくは違法の可能性がある活動に関与するWEBサイトからのリンク。</li>
                <li>フレームその他の方法で、当社のコンテンツであることが不明確になるリンク。</li>
              </ul>

              <p class="sta begin">当WEBサイトから、もしくは当WEBサイトにリンクしている当社以外の第三者のWEBサイトの内容について、そのWEBサイトをご利用した際に生じたいかなる損害についても責任を負いません。</p>
          </div></div>
        </div>
        
      </div>
    </div>


    <hr class="sta-space-md">

    <!-- Footer Contents -->
<?php
  //フッタ読み込み
  require_once(sprintf("%sfooter.tmp.php",$Common->RootDirTemplates));
?>    
