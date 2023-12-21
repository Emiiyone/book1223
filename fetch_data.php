<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('funcs.php');

// データベース接続
try {
    $pdo = new PDO('mysql:dbname=gs_db231216;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

// URLパラメータからIDを取得
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    // IDが提供されていない場合はエラー
    echo json_encode(["error" => "No ID provided"]);
    exit;
}

// IDに基づいてデータを取得するSQLクエリを準備
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行時にエラーがある場合
    $error = $stmt->errorInfo();
    echo json_encode(["error" => "ErrorQuery:".$error[2]]);
    exit;
} else {
    // データの取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        // データをJSON形式で出力
        echo json_encode($result);
    } else {
        // レコードが見つからない場合
        echo json_encode(["error" => "Record not found"]);
    }
}
?>
