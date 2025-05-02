<?php
require 'config.php';
$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
if ($conn->connect_error){
    http_response_code(500);
    exit;
}

$result = $conn ->query("SELECT id,name,email FROM members");
$data =[];
while ($row = $result->fetch_assoc()){ $data[] = $row; }

header('Content-Type: application/json');
echo json_encode($data);

?>