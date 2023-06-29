<?php
// データ受け取り
// var_dump($_POST);
// exit();

$id=$_GET['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL実行
//削除の場合
// $sql = 'DELETE FROM todo_table WHERE id=:id';
$sql = 'UPDATE todo_table SET deleted_at=now() WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:todo_read.php");
exit();

?>


