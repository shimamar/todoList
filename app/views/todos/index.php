<?php

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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODOリスト</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div>
        <a href="./new.php?user_id=<?php echo $_GET['user_id']; ?>">新規作成</a>
    </div>

    <h2>TODOリスト</h2>
    <table><tbody>
        <tr>
            <th>ID</th>
            <th>USER ID</th>
            <th>TODO title</th>
            <th>detail</th>
            <th>priority</th>
            <th>deadline_date</th>
            <th>status</th>
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
            <th><?=htmlspecialchars($todo['status'])?></th>
            <th><?=htmlspecialchars($todo['created_at'])?></th>
            <?php if($todo['updated_at']) : ?>
                <th><?=htmlspecialchars($todo['updated_at'])?></th>
            <?php else : ?>
                <th>データなし</th>
            <?php endif; ?>
            <?php if($todo['deleted_at']) : ?>
                <th><?=htmlspecialchars($todo['deleted_at'])?></th>
            <?php else : ?>
                <th>データなし</th>
            <?php endif; ?>
        </tr>
    <?php endforeach;?>
    </tbody></table>

    <!-- TODOリストのタイトルを押下すると詳細画面に遷移 -->
    <ul>
        <?php foreach ($todo_list as $todo):?>
            <li>
                <a href="./detail.php?id=<?php echo $todo['id'];?>">
                    <?php echo $todo['title'];?>
                </a>
                <button class="delete_btn" data-id="<?php echo $todo['id'];?>">
                    削除
                </button>
            </li>
        <?php endforeach;?>
    </ul>

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
