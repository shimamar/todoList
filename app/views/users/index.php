<?php

//セッションからメッセージ取得
session_start();
$error_msgs = $_SESSION["error_msgs"];
unset($_SESSION["error_msgs"] );

//ログアウトの場合
if ($_POST["action"] == "destroy") {
    unset($_SESSION["user_id"] );
}

$user_id = "" ;
//セッションからユーザーID取得
session_start();
$user_id = $_SESSION["user_id"];

//DBデータ取得・更新ファイル
require_once '../../config/db.php';
require_once '../../models/todo.php';
require_once '../../controller/todoController.php';

if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] != "destroy") {
    $action = new TodoController;
    $action->check();
}

 ?>

 <!DOCTYPEhtml>
 <html lang="ja">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>ログイン画面</title>
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
    <div>
        <a href="./new.php">新規作成</a>
    </div>
    <div>ログイン</div>
    <form action="./index.php" method="post">
        <div>ユーザーID</div>
        <div><input name="user_id" type="text" value="<?php echo $user_id ?>"></div>
        <div>パスワード</div>
        <div><input name="user_pw" type="text"></div>
        <button type="submit">ログイン</button>
    </form>

</body>
</html>
