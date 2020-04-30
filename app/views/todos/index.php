<?php

//必要なデータ取得
//DB接続情報取得ファイル
require 'config/db.php';
//DBデータ取得・更新ファイル
require 'models/todo.php';

//MySQLと接続
try {
    // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    // エラーメッセージ表示
    echo 'データベースにアクセスできません！' . $e->getMessage();
    // 強制終了
    exit;
}

$todo = new Todo();
/* todos */
$sql = "SELECT * FROM sample.todos";
$todo_list = $todo->findAll($dbh, $sql);

/* user */
$sql = "SELECT * FROM sample.users";
$user_list = $todo->findAll($dbh, $sql);

/* todos */
//SQL実行
/*
try {
    //SQL文の組み立て
    $sql = "SELECT * FROM sample.todos";
    $stmh = $dbh->query($sql);
} catch (PDOException $e) {
    echo '接続エラー：' . $e->getMessage();
}

//値を取得
$todo_list = $stmh->fetchAll(PDO::FETCH_ASSOC);*/

/* user */
/*try {
    $sql = "SELECT * FROM sample.users";
    $stmh = $dbh->query($sql);
} catch (PDOException $e) {
    echo '接続エラー：' . $e->getMessage();
}

$user_list = $stmh->fetchAll(PDO::FETCH_ASSOC);*/

 ?>

<h2>TODOリスト</h2>
<table><tbody>
    <tr>
        <th>ID</th>
        <th>USER ID</th>
        <th>TODO title</th>
        <th>detail</th>
        <th>priority</th>
        <th>deadline_date</th>
        <th>statue</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>deleted_at</th>
    </tr>

<?php foreach($todo_list as $todo):?>
    <tr>
        <th><?=htmlspecialchars($todo['id'])?></th>
        <th><?=htmlspecialchars($todo['user_id'])?></th>
        <th><?=htmlspecialchars($todo['title'])?></th>
        <th><?=htmlspecialchars($todo['detail'])?></th>
        <th><?=htmlspecialchars($todo['priority'])?></th>
        <th><?=htmlspecialchars($todo['deadline_date'])?></th>
        <th><?=htmlspecialchars($todo['statue'])?></th>
        <th><?=htmlspecialchars($todo['created_at'])?></th>
        <th><?=htmlspecialchars($todo['updated_at'])?></th>
        <th><?=htmlspecialchars($todo['deleted_at'])?></th>
    </tr>
<?php endforeach;?>
</tbody></table>

<h2>USERリスト</h2>
<table><tbody>
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
<?php foreach($user_list as $user):?>
    <tr>
        <th><?=htmlspecialchars($user['id'])?></th>
        <th><?=htmlspecialchars($user['name'])?></th>
        <th><?=htmlspecialchars($user['created_at'])?></th>
        <th><?=htmlspecialchars($user['updated_at'])?></th>
    </tr>
<?php endforeach;?>
</tbody></table>
