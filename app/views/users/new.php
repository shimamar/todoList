<?php

//ユーザー情報 新規作成

//セッションからメッセージ取得
session_start();
$error_msgs = $_SESSION["error_msgs"];

//セッション削除
unset($_SESSION["error_msgs"] );

//DBデータ取得・更新ファイル
require_once '../../controller/todoController.php';
require_once '../../config/db.php';
require_once '../../models/todo.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = new TodoController;
    $action->user_new();
}

$user_name = '';
$user_id = '';
$user_pw = '';
//一度入力した内容は入力欄に表示
if($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['user_name'])) {
        $user_name = $_GET['user_name'];
    }
    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    }
    if(isset($_GET['user_pw'])) {
        $user_pw = $_GET['user_pw'];
    }
}

?>

<!DOCTYPEhtml>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー情報 新規作成</title>
</head>
<body>
    <?php if($error_msgs):?>
        <div>
            <ul>
                <?php foreach ($error_msgs as $error_msg):?>
                    <li><?php echo $error_msg; ?></li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif; ?>
    <div>ユーザー情報 新規作成</div>
    <form action="./new.php" method="post">
        <div>
            <div>お名前</div>
            <div><input name="user_name" type="text" value="<?php echo $user_name ?>"> </div>
        </div>
        <div>
            <div>ユーザー ID</div>
            <div><input name="user_id" type="text" value="<?php echo $user_id ?>"> </div>
        </div>
        <div>
            <div>パスワード</div>
            <div><input name="user_pw" type="text" value="<?php echo $user_pw ?>"> </div>
        </div>
        <button type="submit">登録</button>
    </form>

    <div>
        <a href="./index.php">戻る</a>
    </div>

</body>
</html>
