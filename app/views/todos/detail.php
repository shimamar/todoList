<?php

require_once '../../config/db.php';
require_once '../../models/todo.php';
require_once '../../controller/todoController.php';

//todo_id
$todo_id = 1;
//該当のtodo_id内容取得
$controller = new todoController;
$todo_detail = $controller->detail();

?>

<!DOCTYPEhtml>
<?php include('../include/header.php'); ?>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="link col-2 offset-8 mt-4 p-2 text-center rounded">
            <a class="link_text" href="./index.php">戻る</a>
        </div>
    </div>

    <h4 class="title">TODOリスト 詳細</h4>
    <table class="table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?php echo $todo_detail["title"]?></td>
                <td><?php echo $todo_detail["detail"] ?></td>
            </tr>
        </tbody>
    </table>
    <button class="link px-4 m-3 mb-5 text-center rounded">
        <a class="link_text" href="./edit.php?id=<?php echo $todo_detail['id'];?>">編集</a>
    </button>

</div>
</body>
</html>
