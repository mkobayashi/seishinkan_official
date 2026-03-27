  //ページ読み込み時
  var size = Math.ceil($('table#dojoName tr').length / 10);     //ページ数
  var page = 0;     //ページ
  
  //セレクト初期化が無限ループしないようにフラグ  
  var flag = 1;

  $(document).ready(function(){
    $('select.dojoSelect').customSelect();
    //ページ変更
    pageChange();
  });

  //検索のセレクトが選択されると反対側はデフォルト値
  $('select#search-prefecture').change(function() {
    flag ++;
    if(flag % 2 == 0){
      $('select#search-country').val("0");
      $('select#search-country').trigger('change');
    }
  });
  $('select#search-country').change(function() {
    flag ++;
    if(flag % 2 == 0){
      $('select#search-prefecture').val("0");
      $('select#search-prefecture').trigger('change');
    }
  });

  //ページがマウスオーバーされた時
  $('span.pageButton').mouseover(function(){
    $(this).css("cursor","pointer");
  });
  
  //ページがクリックされた時
  $('span.pageButton').click(function(){
    var act = $('span.pageButton').index(this);
    if(act%2==0){
      page--;
      //0ページより小さくはならない
      if(page < 0){
        page = 0;
      }
    }
    if(act%2==1){
      page++;
      //最終ページより大きくはならない
      if(page >= size){
        page = size - 1;
      }
    }
    //ページ変更
    pageChange();
  });


  //ページ変更関数
  function pageChange(){
    for(var i=0; i<size; i++){
      if(i!=page){
        $('.page'+i).css('display', 'none');
      }else{
        $('.page'+i).css('display', 'table-row');
      }
    }
    //0ページ(以前)なら「前へ」非表示
    if(page <= 0){
      $('ul.pagenation li.first span').css('display','none');
    }
    //0ページより後なら「前へ」表示
    if(page > 0){
      $('ul.pagenation li.first span').css('display','inline');
    }
    //最終ページ(以降)なら「次へ」非表示
    if(page >= size - 1){
      $('ul.pagenation li.second span').css('display','none');
    }
    //最終ページより前なら「次へ」非表示
    if(page < size - 1){
      $('ul.pagenation li.second span').css('display','inline');
    }
  }

  //道場情報削除確認
  function checkDelete(url){
  	//「OK」時の処理開始 ＋ 確認ダイアログの表示
  	if(window.confirm('削除してよろしいですか？')){
  		location.href = url; // 削除ページへジャンプ
  	}
  	//「OK」時の処理終了

  	//「キャンセル」時の処理開始
  	else{
	  }
	  //「キャンセル」時の処理終了
  }

