<?php
/**
 * TOP main blocks: 月会費／クラス／道場、見学予約、関連リンク（本番 seishinkan.org と同一マークアップ）
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$reserve_url = trailingslashit( site_url( 'reserve' ) );
?>
<div class="container">
<div class="row top-menu">
<div class="col-xs-12 col-sm-4">
<a href="/entry/entry.php"><div class="sta-label-con"><img class="img-responsive" src="/image/top_menu_report.jpg" />
<div class="bg-primary text-center in-label">
<h3 class="h3-20 ryu-mincho">月会費・入会時費用</h3>
</div>
</div></a>
<p class="text-left">はじめての方も数多く稽古されています。</p>
</div>
<div class="col-xs-12 col-sm-4">
<a href="/class/class.php"><div class="sta-label-con"><img class="img-responsive" src="/image/top_menu_class.jpg" />
<div class="bg-primary text-center in-label">
<h3 class="h3-20 ryu-mincho">クラス紹介</h3>
</div>
</div></a>
<p class="text-left">合氣道クラス、氣のクラス、子どもクラスの稽古内容のご案内です。</p>

</div>
<div class="col-xs-12 col-sm-4">
<a href="/category/dojo/"><div class="sta-label-con"><img class="img-responsive" src="/image/top_menu_dojo.jpg" />
<div class="bg-primary text-center in-label">
<h3 class="h3-20 ryu-mincho">道場・教室一覧</h3>
</div>
</div></a>
<p class="text-left">おうちや職場のお近くの通いやすい道場・教室へどうぞ。</p>
</div>
</div>
</div>
<div class="container">
<div class="row btnlink2">
<a href="<?php echo esc_url( $reserve_url ); ?>"><div class="col-xs-12 col-lg-8 col-lg-push-2 text-center yu-gothic"><span class="btn-lg btn-block">見学・無料体験のご予約</span></div></a>
</div>
</div>
<div class="container">
<div class="row">
   <div class="col-xs-12 text-center text-primary local-title kozuka-mincho">
    <h3>関連リンク</h3>
</div>
</div>
</div>
<div class="container">
<div class="row top-menu">
<div class="col-xs-12 col-sm-12">
<a href="http://www.shinshintoitsuaikido.org/">
<div>
<div class="bg-info text-center extlink">
<h5 class="h5-20 ryu-mincho">心身統一合氣道会本部<br>公式ホームページ</h5>
</div>
</div></a>
<p class="text-left">心身統一合氣道の活動概要や本部主催セミナー、創始者 藤平光一先生、会長 藤平信一先生のバイオグラフィー、会長の特別対談などが掲載されています。</p>
</div>

<div class="row">
<div class="col-xs-12 col-sm-4">
<a href="https://www.ki-aikido-ebisu.com/">
<div>
<div class="bg-info text-center extlink">
<h5 class="h5-20 ryu-mincho">恵比寿教室<br>公式ホームページ</h5>
</div>
</div></a>
<p class="text-left">東京／恵比寿・用賀・桜新町・目黒・西小山の各教室の案内です。</p>
</div>

<div class="col-xs-12 col-sm-4">
<a href="http://aikido-ikenoue.org">
<div>
<div class="bg-info text-center extlink">
<h5 class="h5-20 ryu-mincho">池ノ上教室<br>公式ホームページ</h5>
</div>
</div></a>
<p class="text-left">東京／池ノ上・経堂・吉祥寺、神奈川／あざみの・江田、中川・藤が丘・市ヶ尾の各教室の案内です。</p>
</div>

<div class="col-xs-12 col-sm-4">
<a href="https://www.kiaikido-kunitachi.org">
<div>
<div class="bg-info text-center extlink">
<h5 class="h5-20 ryu-mincho">国立教室<br>公式ホームページ</h5>
</div>
</div></a>
<p class="text-left">東京／国立・国分寺の各教室の案内です。</p>
</div>
</div>

<div class="row">
<div class="col-xs-12 col-sm-4">
<a href="https://www.kiaikido-shiki.org/">
<div>
<div class="bg-info text-center extlink">
<h5 class="h5-20 ryu-mincho">志木教室<br>公式ホームページ</h5>
</div>
</div></a>
<p class="text-left">埼玉／志木教室の案内です。</p>
</div>

<div class="col-xs-12 col-sm-4">
<a href="https://www.zuishinkan.org">
<div>
<div class="bg-info text-center extlink">
<h5 class="h5-20 ryu-mincho">仙台・瑞心館道場<br>公式ホームページ</h5>
</div>
</div></a>
<p class="text-left">宮城県仙台駅近くの瑞心館道場の案内です。</p>
</div>
</div>
</div>
</div>
