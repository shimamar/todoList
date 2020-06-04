<?php

require_once( dirname( __FILE__ , 2) . '/models/todo.php' );
require_once( dirname( __FILE__ , 2) . '/validation/TodoValidation.php' );

class todoController{

    public function index() {
        $todo_list = Todo::findAll();

        return $todo_list;
    }

    /*public static function index(){
        return Todo::findAll();
    }*/

    /*public static function index($user_id){
        return Todo::findAll($user_id);
    }*/

    public function detail() {
        //GETパラメータから値取得
        $todo_id = $_GET['id'];
        $todo = TODO::findById($todo_id);

        return $todo;
    }

    /*public static function detail($todo_id){
        return Todo::findById($todo_id);
    }*/

    public function new(){
        $data = array(
            "title" => $_POST['title'],
            "detail" => $_POST['detail']
        );

        $validation = new Validation;
        $validation->setData($data);

        $validation_data = $validation->getData();
        $title = $validation_data['title'];
        $detail = $validation_data['detail'];

        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION["error_msgs"] = $error_msgs;

            $params = sprintf("?title=%s&detail=%s", $title, $detail);
            header("Location: ./new.php" . $params);

        } else {

            $todo = new Todo;
            $todo->setTitle($title);
            $todo->setDetail($detail);
            $result = $todo->save();

            if($result === false) {
                $params = sprintf("title=%s&detail=%s", $title, $detail);
                header("Location: ./new.php" . $params);
            }
            header("Location: ./index.php" );
        }
    }

    public function edit() {
        //パラメーターから todo_id を取得
        $todo_id = $_GET['todo_id'];
        //todosテーブルから該当レコード取得
        $todo = Todo::findById($todo_id);
        //POSTパラメータがなければ値を返して終了
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            return $todo;
        }

        $data = array(
            //POSTパラメータ取得
            "title" => $_POST['title'],
            "detail" => $_POST['detail'],
        );

        $validation = new Validation;
        $validation->setData($data);
        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION['error_msgs'] = $error_msgs;

            $params = sprintf("title=%s&detail=%s", $title, $detail);
            header("Location: ./edit.php" . $params);
        }

        $validation_data = $validation->getData();
        $title = $validation_data['title'];
        $detail = $validation_data['detail'];

        $todo = new Todo;
        $todo->setTitle($title);
        $todo->setDetail($detail);
        $todo->update();

        header("Location: ./index.php" );
    }
}

 ?>
