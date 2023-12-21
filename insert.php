<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// POSTデータの存在チェック
if (!isset($_POST['title']) || !isset($_POST['publisher']) || !isset($_POST['link']) || !isset($_POST['imgLink'])) {
    // エラーメッセージをJSON形式で出力して処理を中止
    echo json_encode(['status' => 'error', 'message' => 'Required data is missing']);
    exit;
}

//1. POSTデータ取得
$titleArray = $_POST['title'];
$publisherArray = $_POST['publisher'];
$linkArray = $_POST['link'];
$imgLinkArray = $_POST['imgLink'];

//2. DB接続
try {
    $pdo = new PDO('mysql:dbname=gs_db231216;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    // DB接続エラー時の処理
    echo json_encode(['status' => 'error', 'message' => 'DB Connection Error: ' . $e->getMessage()]);
    exit;
}

//3. データ登録SQL作成
$stmt = $pdo->prepare("
    INSERT INTO
        gs_bm_table(id, title, publisher, link, imgLink, date)
    VALUES (
        NULL, :title, :publisher, :link, :imgLink, sysdate()
    )");

// ループ処理で各データをDBに挿入
for ($i = 0; $i < count($titleArray); $i++) {
    $stmt->bindValue(':title', $titleArray[$i], PDO::PARAM_STR);
    $stmt->bindValue(':publisher', $publisherArray[$i], PDO::PARAM_STR);
    $stmt->bindValue(':link', $linkArray[$i], PDO::PARAM_STR);
    $stmt->bindValue(':imgLink', $imgLinkArray[$i], PDO::PARAM_STR);

    //実行
    $status = $stmt->execute();

    if ($status === false) {
        // SQL実行時にエラーがある場合
        $error = $stmt->errorInfo();
        echo json_encode(['status' => 'error', 'message' => 'SQL Error: ' . $error[2]]);
        exit;
    }
}

//4. データ登録処理後のレスポンス
$responseArray = [
    'status' => 'success',
    'message' => 'Data processed successfully'
];
echo json_encode($responseArray);
