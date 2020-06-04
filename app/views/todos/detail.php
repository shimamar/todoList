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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>詳細画面</title>
</head>
<body>

    <div>
        <a href="./index.php">戻る</a>
    </div>

    <h2>TODOリスト 詳細</h2>
    <table class="table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?php echo $todo_detail['title'] ?></td>
                <td><?php echo $todo_detail['detail'] ?></td>
            </tr>
        </tbody>
    </table>
    <div>
        <button><a href="./edit.php">編集</a></button>
    </div>
</body>
</html>
