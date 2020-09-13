<?php

//セッションからメッセージ取得
session_start();
$error_msgs = $_SESSION["error_msgs"];
//セッション削除
unset($_SESSION["error_msgs"] );

//セッションからユーザーID取得
session_start();
$user_id = $_SESSION["user_id"];

//DBデータ取得・更新ファイル
require_once '../../config/db.php';
require_once '../../models/todo.php';
require_once '../../controller/todoController.php';

//データベースにアクセス
try {
    $dbh = new PDO(DSN, USER, PW);
} catch (PDOException $e) {
    echo 'データベースにアクセスできません！' . $e->getMessage();
    exit;
}

//削除ボタンが押されていれば削除処理実行
if(isset($_GET['action']) & $_GET['action'] === 'delete') {
    $action = new todoController;
    $todo_list = $action->delete();
}

//該当ユーザーIDのTODOリスト取得
$controller = new todoController;
$todo_list = $controller->index();

?>

<!DOCTYPEhtml>
<?php include('../include/header.php'); ?>
<body>
<div class="container mt-5">
    <div class="row pt-3">
        <div class="link offset-2 col-md-3 col-3 text-center rounded py-2">
            <a class="link_text" href="./new.php">新規作成</a>
        </div>
        <div class="offset-md-3 col-md-1 offset-2 col-3">
            <form action="../users/index.php" method="post">
                <input type="hidden" name="action" id="action" value="destroy"/>
                <input class="input rounded px-4 py-1" type="submit" value="ログアウト" />
            </form>
        </div>
    </div>

    <div class="text-center p-5">
        <h5 class="title">検索条件</h5>
        <form action="./index.php" method="get">
            <div>
                <div>タイトル</div>
                <div>
                    <input class="rounded" name="title" id="$title" type="text">
                </div>
            <div>
            <button class="link px-4 mt-2 mb-5" type="submit">検索</button>
        </form>


        <h4  class="title">TODOリスト</h4>
        <!-- TODOリストのタイトルを押下すると詳細画面に遷移 -->
        <ul class="mt-3 list-unstyled w-75 mx-auto">
            <?php foreach ($todo_list as $todo):?>
                <li class="list mt-2 row">
                    <a class="offset-2 col-6 py-1 list_text" href="./detail.php?id=<?php echo $todo['id'];?>">
                        <?php echo $todo['title'];?>
                    </a>
                    <button class="delete_btn rounded offset-1 col-3" data-id="<?php echo $todo['id'];?>">
                        削除
                    </button>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
</body>
</html>

<script>
$(".delete_btn").on('click', function() {
    //data属性の値取得
    const todo_id = $(this).data('id');
    alert("ID：" + todo_id + "を削除しました。");
    window.location.href = "./index.php?action=delete&todo_id=" + todo_id;
});
</script>
