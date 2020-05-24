<?php

require_once( dirname( __FILE__ , 2) . '/models/todo.php' );
require_once( dirname( __FILE__ , 2) . '/validation/TodoValidation.php' );

class todoController{

    public static function index($user_id){
        return Todo::findAll($user_id);
    }

    public static function detail($todo_id){
        return Todo::findById($todo_id);
    }

    public static function new(){
        $title = $_POST['title'];
        $detail = $_POST['detail'];

        $check = new TodoValidation;
        $check_title = $check->nullcheck($title);

        $secound_check = new TodoValidation;
        $check_detail = $secound_check->nullcheck($detail);

        if($check_title && $check_detail){

            $todo = new Todo;
            $todo->setTitle($title);
            $todo->setDetail($detail);
            //データ保存
            $result = $todo->save();

            if($result === false) {
                header("Location: ./new.php");
            }
            header("Location: ./index.php" );

        }else{
            echo '入力項目が空です。';
        }
    }
}

 ?>
