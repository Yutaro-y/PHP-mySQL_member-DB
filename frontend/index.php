<?php
require 'config.php';
$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
$result = $conn->query("SELECT * FROM members");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>管理ポータル</title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /*
            body { font-family: sans-serif;}
            table {border-collapse: collapse; width: 50%;}
            th, td {border: 1px solid #ccc; padding: 8px;}
            th { background-color: #eee;}
            .btn {padding: 6px 12px; background: #007bff; text-decoration: none; border-radius: 4px;}
            */
        </style>

    </head>
    <body class="bg-light small">
        <div class="container mt-4">

            <h2 class ="mb-4 fs-4">会員一覧</h2>

            <a class="btn btn-primary btn-sm mb-3" href="add.php">メンバー追加</a>
            <table class="table table-bordered table-striped table-sm align-middle">
                <thread class="tabele-dark">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>メール</th>
                        <th>操作</th>
                    </tr>
                </thread>

                <tbody>
                    <?php 
                    #DB接続→データ取得
                    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS,$DB_NAME);
                    $result = $conn->query("SELECT * FROM members");
                    while ($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><a class="btn btn-outline-danger btn-sm" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('削除してよいですか？');">削除</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                 
            </table>
            <?php if (isset($_GET['status']) || isset($_GET['error'])): ?>
                
                
                    <?php if ($_GET['status'] === 'register_success'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ メンバー登録が完了しました
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php elseif ($_GET['status'] === 'delete_success'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ メンバー削除が完了しました
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ <?= htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <script>
                    // URLのクエリパラメータを削除
                    // これにより、リロード時にアラートが再表示されないようにする
                    // ただし、ブラウザの履歴には残る
                    // これを行うには、replaceStateを使用
                    // ただし、URLのクエリパラメータを削除するために、window.history.replaceStateを使用
                    if (window.history.replaceState) {
                        const cleanUrl = window.location.origin + window.location.pathname;
                        window.history.replaceState(null, "", cleanUrl);
                    }
                    </script>
            
                
     
            <?php endif; ?>

    </body>
</html>

<?php $conn -> close(); ?>