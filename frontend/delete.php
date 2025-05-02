<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Accept GET only
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

if (isset($_GET['id'])) {
    $id=intval($_GET['id']);
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if ($conn -> connect_error) {
        $msg = urlencode(("データベース接続に失敗しました"));
        header("Location: index.php?error=$msg");
        exit;
    }
}

## Delete member from database
$stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
if (!$stmt) {
    $msg = urlencode("SQLクエリ生成に失敗しました");
    header("Location: index.php?error=$msg");
    exit;
}
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    $msg = urlencode("削除処理に失敗しました: " . $stmt->error);
    header("Location: index.php?error=$msg");
    exit;
}

$stmt->close();
$conn->close();
header("Location: index.php?status=delete_success");
exit

?>