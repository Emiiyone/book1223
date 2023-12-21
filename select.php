<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('funcs.php');

//1.  DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db231216;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .="<p>";
    // $view .= h($result['date']). h($result['title']) . h($result['publisher'] .h($result['link']) .h($result['imgLink'])  , ENT_QUOTES);
    // $view .="</p>";
    $view .= "<div class='selectListAll'>";
    $view .= "<ul class='selectList'>";
    $view .= "<li class='listTtl'><p><a href='" . h($result['link']) . "' target='_blnak'>" . h($result['title']) . "</a></p>";
    $view .= "<p>" . h($result['publisher']) . "</p>";
    $view .= "<p>" . h($result['date']) . "</p></li>";
    $view .= "<li class='listImg'><img src='" . h($result['imgLink']) . "'></li>";
    $view .= "</ul>";
    $view .= "<div class='btns'>";
    // 削除ボタン
    $view .= "<div class='deleteBtn'><a class='deleteBtn' data-id='" .h($result['id']) . "' href='#'>削除</a></div>";
    // 更新ボタン
    $view .= "<div class='upBtn'><a class='updateBtn' data-id='" . h($result['id']) . "' href='#'>更新</a></div>";
    $view .= "</div>";
    $view .= "<div class='updateForm' id='updateForm-" . h($result['id']) . "' style='display: none;'>";
    $view .= "<input class='i01' type='text' id='inputTitle-" . h($result['id']) . "' name='title' placeholder='タイトル'>";
    $view .= "<input class='i02' type='text' id='inputPublisher-" . h($result['id']) . "' placeholder='著者名'>";
    $view .= "<input class='i03' type='text' id='inputLink-" . h($result['id']) . "' name='link' placeholder='リンク'>";
    $view .= "<input class='i04' type='text' id='inputImgLink-" . h($result['id']) . "' name='imgLink' placeholder='画像リンク'>";
    $view .= "<input class='i05' type='text' id='inputDate-" . h($result['id']) . "' name='date' placeholder='日付'>";
    $view .= "<div class='ups'>";
    $view .= "<div class='submitUp'><button type='submit' class='submitUpdate' data-id='" . h($result['id']) . "'>更新する</button></div>";
    $view .= "<div class='closeUp'><button class='close'>更新をやめる</button></div>";
    $view .= "</div>";
    $view .= "</div>";
    $view .= "</div>";
    $view .= "</div>";

  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍データ表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="style.css" rel="stylesheet">
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <div class="logoWrap selectPage">
    <a href="index.php"><h1 class="logo"><img src="https://www.google.com/intl/en_ALL/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="google"></h1></a>
    <h2 class="cat">BOOKS</h2>
  </div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="wrapper">
    <?= $view ?>

      <!-- HTML内の例示入力フィールド -->
  </div>

<!-- Main[End] -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // 更新ボタンのイベントハンドラ
  $(document).ready(function() {

      $('.updateBtn').on('click', function(e) {
        e.preventDefault(); // 通常のリンク動作を停止
        var id = $(this).data('id'); // データIDの取得
        var formHtml = $('#updateForm').html(); 
        $(this).after(formHtml); // 更新ボタンの直下にフォームを挿入
        $('.updateForm').hide(); // 他のフォームを非表示にする
        $('#updateForm-' + id).show(); // 対応するフォームを表示
        $('.close').on('click', function(){
        $('#updateForm-' + id).hide(); 
      });
       // $('.updateForm').show(); // フォームを表示

        //AJAXリクエスト
        $.ajax({
            url: 'fetch_data.php',
            type: 'GET',
            data: { 'id': id },
            success: function(data) {
              var result = JSON.parse(data);
              //console.log(result);
              $('#inputTitle-' + id).val(result.title);
              $('#inputPublisher-' + id).val(result.publisher);
              $('#inputLink-' + id).val(result.link);
              $('#inputImgLink-' + id).val(result.imgLink);
              $('#inputDate-' + id).val(result.date);
    
            }
        });
    });

      $('.submitUpdate').on('click', function(e) {
        //e.preventDefault();
        var id = $(this).data('id');

      $.ajax({
          url: 'update.php', // 更新処理を行うPHPファイル
          type: 'POST',
          contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
          data: {
            id: id,
            title: $('#inputTitle-' + id).val(),
            publisher: $('#inputPublisher-' + id).val(),
            link: $('#inputLink-' + id).val(),
            imgLink: $('#inputImgLink-' + id).val()
          },
          success: function(response) {
              // 成功した場合の処理
              $('#updateForm-' + id).hide(); // フォームを非表示にする
              location.reload(); // ページをリロード
          }
      });
    });


    // 削除ボタンのイベントハンドラ
    $('.deleteBtn').on('click', function(e) {
    //e.preventDefault(); // 通常のリンク動作を停止
    var id = $(this).attr('data-id'); // データIDの取得
    console.log('ID:', id); // コンソールにIDを出力

      // AJAXリクエストを送信してレコードを削除
        $.ajax({
            url: 'delete.php',
            type: 'GET',
            data: { 'id': id },
            success: function(response) {
                //alert('レコードが削除されました。');
                location.reload(); // ページをリロード
            }
        });
    });

  });
    
 
</script>
</body>
</html>
