<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="成心館,心身統一合氣道,ki-aikido,合気道,合氣道,aikido,合気道教室,道場,合気,合氣,aiki">
    <meta name="description" content="心身統一合氣道会の公式サイトです。">
    
    <title>合気道｜心身統一合氣道会 成心館道場 公式サイト</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- other plugin -->
    <link href="/css/crossFader.css" rel="stylesheet">

    <!-- Customize CSS -->
    <!-- Common CSS -->
    <link href="/css/bootstrap-cust.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/common-theme.css" rel="stylesheet">

    <!-- Special CSS -->
    <?php if ( is_home() || is_front_page() ): ?>
    <link href="/css/top.css" rel="stylesheet">
    <?php elseif ( in_category('dojo') ): ?>
    <link href="/css/seishinkan.css" rel="stylesheet">
    <?php else: ?>
    <link href="/css/about/corporation.css" rel="stylesheet">
    <?php endif; ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/jquery.customSelect.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- Customize JS -->
    <script src="/js/custom.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- Special JS -->
    <!-- Crossfader（bsn.Crossfader の img1〜4 デモは削除。スライダーは jQuery プラグインのみ） -->
    <script src="/js/jquery.crossFader.js"></script>
    <script src="/js/lheader-fade.js"></script>
	  <!-- GA -->
	  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S6R1XL99XF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-S6R1XL99XF');
</script>
<?php wp_head(); ?>
  </head>
  
  <body>
    <header class="container-fluid header">
      <div class="row">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
                <span class="sr-only">メインナビゲーション</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button> <!-- スマホ向けメニューボタン -->
              <a href="/" class="navbar-brand"><img src="/image/logo.png" class="img-responsive" alt="心身統一合氣道会"></a>
            </div> <!-- .navbar-header -->
            <div class="collapse navbar-collapse" id="mainNav">
              <ul class="nav navbar-nav ryu-mincho">
                <li class="dropdown">
                  <a href="/about/greeting.html" class="dropdown-toggle" data-toggle="dropdown">成心館のご紹介</a>
                  <ul class="dropdown-menu">
                    <li><a href="/about/greeting.php">ご挨拶</a></li>
                    <li><a href="/about/about.php">概要・沿革</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="/class/class.php" class="dropdown-toggle" data-toggle="dropdown">クラス紹介</a>
                  <ul class="dropdown-menu">
                    <li><a href="/class/class.php">合氣道クラス</a></li>
                    <li><a href="/class/class_kids.php">子どもクラス</a></li>
                    <li><a href="/class/class_ki.php">氣のクラス（氣圧法クラス）</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="/entry/entry.php" class="dropdown-toggle" data-toggle="dropdown">月会費・入会時費用</a>
                  <ul class="dropdown-menu">
                    <li><a href="/entry/entry.php">月会費・入会時費用</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <?php
                  $cat_id = get_category_by_slug('dojo');
                  $cat_link = get_category_link($cat_id);
                  ?>
                  <a href="<?php echo $cat_link; ?>" class="dropdown-toggle" data-toggle="dropdown">道場・教室</a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo $cat_link; ?>">道場・教室一覧</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <?php
                  $cat_id = get_category_by_slug('info');
                  $cat_link = get_category_link($cat_id);
                  ?>
                  <a href="<?php echo $cat_link; ?>" class="dropdown-toggle" data-toggle="dropdown">活動報告</a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo $cat_link; ?>">活動報告</a></li>
                  </ul>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right ryu-mincho header-link">
                               <li><a href="/reserve/"><span class="btn btn-success rad-square">見学予約</span></a></li>
                <li><a href="/contact/"><span class="btn btn-primary rad-square">お問合わせ</span></a></li>
              </ul>
            </div>
          </div>
          <img src="/image/greenline.png" class="img-responsive header-line" />
        </nav>
      </div>
    </header>
