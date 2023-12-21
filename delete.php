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

$id = $_GET['id']; // 削除するレコードのIDを取得

// SQLクエリの準備と実行
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 処理結果の確認
if($status == false) {
    // エラーの場合の処理
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
} else {
    // 削除成功の場合の処理
    header("Location: select.php"); // 成功時にリダイレクト
}
?>
