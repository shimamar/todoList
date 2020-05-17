<?php

//DBデータ取得・更新ファイル
require_once( dirname( __FILE__ , 3) . '/controller/todoController.php' );

if(isset($_POST['title']) && $_SERVER["REQUEST_METHOD"]==="POST"){
    $action = new TodoController;
    $action->new();
}
?>

<!DOCTYPEhtml>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規作成</title>
</head>
<body>
    <div>新規作成</div>
    <form action="./new.php" method="post">
    <div>
        <div>タイトル</div>
        <div>
            <input name="title" type="text"> </div>
        </div>
        <div>
            <div>詳細</div>
            <div>
                <textarea name="detail"></textarea>
            </div>
        </div>
        <button type="submit">登録</button>
    </form>

    <div>
        <a href="./index.php">戻る</a>
    </div>

</body>
</html>
