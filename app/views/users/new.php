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
    $action = new UserController;
    $action->new();
}

$user_name = '';
$user_id = '';
$user_pw = '';
//一度入力した内容は入力欄に表示
if($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    }
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
            <a class="link_text" href="./index.php">戻る</a>
        </div>
    </div>

    <div class="text-center p-5">
        <h4 class="title">アカウント作成</h4>
        <form action="./new.php" method="post">
            <div class="text pt-4 pb-1">ユーザーID</div>
            <div><input class="rounded border" name="user_id" type="text" value="<?php echo $user_id ?>"> </div>
            <div class="text pt-4 pb-1">パスワード</div>
            <div><input class="rounded border" name="user_pw" type="text" value="<?php echo $user_pw ?>"> </div>
            <button class="btn btn-outline-success mt-5" type="submit">登録</button>
        </form>
    </div>

</div>
</body>
</html>
