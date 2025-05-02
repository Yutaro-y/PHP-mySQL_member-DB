<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(405); #Accept_POST_only
    echo json_encode(['error' => 'Method Not Allouwed']);
    exit;

}

#recieve POST
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

#check POST content
if (!$name || !$email){
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request:Missing parameters']);
    exit;
}


###Access DB###
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS,$DB_NAME);
if ($conn -> connect_error) {
    #エラー時はトップページ(index.php)に遷移＆ポップアップ
    $msg = urlencode("データベース接続に失敗しました");
    header("Location: index.php?error=$msg");
    //http_response_code(500);
    //echo json_encode(['error' => 'Database connection failed']);
    exit;
}
#####

###~~~~~~~~Register~~~~~~~~~###
$stmt = $conn -> prepare("INSERT INTO members (name,email) VALUES (?, ?)");
if (!$stmt) {
    $msg = urlencode("SQLクエリ生成に失敗しました");
    header("Location: index.php?error=$msg");
    exit;
  }

$stmt-> bind_param("ss", $name, $email);
//i=integer、s=string、d=double、b=blob

if (!$stmt->execute()) {
    $msg = urlencode("登録処理に失敗しました: " . $stmt->error);
    header("Location: index.php?error=$msg");
    exit;
  }

/*
////ごみ////
if ($stmt->affected_rows > 0){
    //echo json_encode(['message' => 'Member registered successfully']);
    header("Location: index.php?status=success");
} else{
    #エラー時はトップページ(index.php)に遷移＆ポップアップ
    $msg = urlencode("登録操作に失敗しました");
    header("Location: index.php?error=$msg");
    //http_response_code(500);
    //echo json_encode(['error' => 'Insert failed']);
}
////ごみ////
*/

##~~~~~~Register END~~~~~~~~~~###

$stmt->close();
$conn->close();

header("Location: index.php?status=register_success");
exit;
?>