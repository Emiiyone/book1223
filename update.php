<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('funcs.php');

try {
    $pdo = new PDO('mysql:dbname=gs_db231216;charset=utf8;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    var_dump($_POST); // Output POST data for debugging

    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $link = $_POST['link'];
    $imgLink = $_POST['imgLink'];
    $id = $_POST['id']; // Ensure this line is added to capture 'id'

    // Prepare and bind parameters
    $stmt = $pdo->prepare("UPDATE gs_bm_table SET title = :title, publisher = :publisher, link = :link, imgLink = :imgLink WHERE id = :id");
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':publisher', $publisher, PDO::PARAM_STR);
    $stmt->bindValue(':link', $link, PDO::PARAM_STR);
    $stmt->bindValue(':imgLink', $imgLink, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute and check the result
    $stmt->execute();
    var_dump($stmt->rowCount()); // Outputs number of affected rows

} catch (PDOException $e) {
    var_dump($e->getMessage()); // Outputs error message if exception occurs
}



