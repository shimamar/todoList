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
    session_start();
    $_SESSION["user_id"] = $_POST['user_id'];

    $action = new loginController;
    $action->login();
}

 ?>

 <!DOCTYPEhtml>
 <?php include('../include/header.php'); ?>
<body>
    <div class="container mt-5">
        <?php if($error_msgs):?>
            <div>
                <ul>
                    <?php foreach ($error_msgs as $error_msg):?>
                        <li><?php echo $error_msg; ?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="link col-2 offset-8 mt-4 p-2 text-center rounded">
                <a class="link_text" href="./new.php">新規作成</a>
            </div>
        </div>

        <div class="text-center p-5">
            <h4 class="title">TODOリスト ログイン</h4>
            <form action="./index.php" method="post">
                <div class="text pt-4 pb-1">ユーザーID</div>
                <div><input class="rounded border" name="user_id" type="text" value="<?php echo $user_id ?>"></div>
                <div class="text pt-4 pb-1">パスワード</div>
                <div><input class="rounded border" name="user_pw" type="text"></div>
                <button class="btn btn-outline-success mt-5"type="submit">ログイン</button>
            </form>
        </div>
    </div>
</body>
</html>
