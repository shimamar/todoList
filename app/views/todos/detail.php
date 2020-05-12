<?php

require_once( dirname( __FILE__ , 3) . '/controller/todoController.php' );

//todo_id
$todo_id = 1;
//該当のtodo_id内容取得
$todo_detail = detail($todo_id);

?>

<h2>TODOリスト 詳細</h2>
<table><tbody>
    <tr>
        <th>ID</th>
        <th>USER ID</th>
        <th>TODO title</th>
        <th>detail</th>
        <th>priority</th>
        <th>deadline_date</th>
        <th>statue</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>deleted_at</th>
    </tr>

    <?php foreach($todo_detail as $todo):?>
    <tr>
        <th><?=htmlspecialchars($todo['id'])?></th>
        <th><?=htmlspecialchars($todo['user_id'])?></th>
        <th><?=htmlspecialchars($todo['title'])?></th>
        <th><?=htmlspecialchars($todo['detail'])?></th>
        <th><?=htmlspecialchars($todo['priority'])?></th>
        <th><?=htmlspecialchars($todo['deadline_date'])?></th>
        <th><?=htmlspecialchars($todo['statue'])?></th>
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
