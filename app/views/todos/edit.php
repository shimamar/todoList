<?php

require_once '../../config/db.php';
require_once '../../models/todo.php';
require_once '../../controller/todoController.php';

$action = new todoController;
$todo = $action->edit();

session_start();
//セッション情報の取得
$error_msg = $_SESSION['error_msgs'];

//セッション削除
unset($_SESSION['error_msgs']);

?>
<!DOCTYPE html>
<?php include('../include/header.php'); ?>
<body>
<div class="container mt-5 text-center">
    <h4 class="title pt-4">編集</h4>
    <form action="./edit.php" method="post">
        <div>
            <div class="text mt-4">タイトル</div>
            <div>
                <input class="w-50 rounded" name="title" type="text">
            </div>
        </div>
        <div>
            <div class="text mt-3">詳細</div>
            <div>
                <textarea class="w-50 rounded" name="detail"></textarea>
            </div>
        </div>
        <input name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
        <button class="btn btn-outline-success my-4" type="submit">登録</button>
    </form>
    <?php if($error_msgs): ?>
        <div>
            <ul>
            <?php foreach ($error_msgs as $error_msg): ?>
                <li><?php echo $error_msg; ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
