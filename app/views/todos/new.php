<?php

//セッションからメッセージ取得
session_start();
$error_msgs = $_SESSION["error_msgs"];
unset($_SESSION["error_msgs"] );

//セッションからユーザーID取得
session_start();
$user_id = $_SESSION["user_id"];

//DBデータ取得・更新ファイル
require_once '../../controller/todoController.php';
require_once '../../config/db.php';
require_once '../../models/todo.php';

$title = '';
$detail = '';
//一度入力した内容は入力欄に表示
if($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['title'])) {
        $title = $_GET['title'];
    }
    if(isset($_GET['detail'])) {
        $detail = $_GET['detail'];
    }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = new TodoController;
    $action->new();
}

?>

<!DOCTYPEhtml>
<?php include('../include/header.php'); ?>
<body>
<div class="container mt-5 text-center">
    <?php if($error_msgs):?>
        <div>
            <ul>
                <?php foreach ($error_msgs as $error_msg):?>
                    <li><?php echo $error_msg; ?></li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif; ?>
    <h4 class="title pt-5">新規作成</h4>
    <form action="./new.php" method="post">
    <div>
        <div class="text mt-4">タイトル</div>
        <div><input class="w-50 rounded" name="title" type="text" value="<?php echo $title; ?>"></div>
    </div>
    <div>
        <div class="text mt-3">詳細</div>
        <div>
            <textarea class="w-50 rounded" name="detail"><?php echo $detail; ?></textarea>
        </div>
    </div>
    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
    <button class="btn btn-outline-success my-4" type="submit">登録</button>
    </form>

    <div class="row">
        <div class="link col-2 offset-8 my-4 p-2 text-center rounded">
            <a class="link_text" href="./index.php">戻る</a>
        </div>
    </div>
</div>
</body>
</html>
