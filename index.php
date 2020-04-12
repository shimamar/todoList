<h1>Hello Docker Compose!</h1>

<p>I love Laravel and Docker!</p>

<?php
phpinfo();

//データベースに接続するために必要なデータソースを変数に格納
 // mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
$dsn = 'mysql:host=50284b150784;dbname=sample;charset=utf8';

// データベースのユーザー名
$user = 'user';

// データベースのパスワード
$password = 'password';

// tryにPDOの処理を記述
try {

    // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

// エラー（例外）が発生した時の処理を記述
} catch (PDOException $e) {

    // エラーメッセージを表示させる
    echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
    exit;

}


//mySQL操作のためのSQL文作成
try {

    //SQL文の組み立て
    $sql = "SELECT * FROM sample.todos";

    //プリペアドステートメントの作成
    $stmh = $dbh->prepare($sql);

    //クエリの実行
    $stmh->execute();

} catch (PDOException $e) {
    echo '接続エラー：' . $e->getMessage();
}


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
<?php
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
?>
    <tr>
        <th><?=htmlspecialchars($row['id'])?></th>
        <th><?=htmlspecialchars($row['user_id'])?></th>
        <th><?=htmlspecialchars($row['title'])?></th>
        <th><?=htmlspecialchars($row['detail'])?></th>
        <th><?=htmlspecialchars($row['priority'])?></th>
        <th><?=htmlspecialchars($row['deadline_date'])?></th>
        <th><?=htmlspecialchars($row['statue'])?></th>
        <th><?=htmlspecialchars($row['created_at'])?></th>
        <th><?=htmlspecialchars($row['updated_at'])?></th>
        <th><?=htmlspecialchars($row['deleted_at'])?></th>
    </tr>
<?php
    }
    $pdo = null;
?>
</tbody></table>

<?php

//mySQL操作のためのSQL文作成
try {

    //SQL文の組み立て
    $sql = "SELECT * FROM sample.users";

    //プリペアドステートメントの作成
    $stmh = $dbh->prepare($sql);

    //クエリの実行
    $stmh->execute();

} catch (PDOException $e) {
    echo '接続エラー：' . $e->getMessage();
}

 ?>

<h2>USERリスト</h2>
<table><tbody>
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
<?php
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
?>
    <tr>
        <th><?=htmlspecialchars($row['id'])?></th>
        <th><?=htmlspecialchars($row['name'])?></th>
        <th><?=htmlspecialchars($row['created_at'])?></th>
        <th><?=htmlspecialchars($row['updated_at'])?></th>
    </tr>
<?php
    }
    $pdo = null;
?>
</tbody></table>
