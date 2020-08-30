<?php

require_once( dirname( __FILE__ , 2) . '/models/todo.php' );
require_once( dirname( __FILE__ , 2) . '/models/User.php' );
require_once( dirname( __FILE__ , 2) . '/validation/TodoValidation.php' );

class todoController{

    public function __construct() {
        //セッションにユーザーIDがあるかチェック
        session_start();
        $user_id = $_SESSION["user_id"];
        if(!isset($user_id)) {
            header("Location: ../users/index.php");
        }
    }


    public function index() {
        $title = $_GET['title'];
        //$status = $_GET['status'];
        //$deadline_date = $_GET['deadline_date'];
        if(empty($title) && empty($status)) {
            $todo_list = Todo::findAll();
        } else  {
            $query = "SELECT * FROM sample.todos WHERE title LIKE '%" . $title . "%'";
            $todo_list = Todo::findByQuery($query);
        }
        return $todo_list;
    }

    public function search() {
        $data = array(
            "title" => $_POST['title'],
            "status" => $_POST['staus'],
            "deadline_date" => $_POST['deadline_date']
        );

        //検索条件が全て空の場合をチェック
        $validation = new Validation;
        $validation->setData($data);

        $validation_data = $validation->getData();
        $title = $validation_data['title'];
        $staus = $validation_data['staus'];
        $deadline_date = $validation_data['deadline_date'];

        if($validation->searchitem_check() === false){
            //検索条件が何も設定されていない場合 エラー表示
            $error_msgs = $validation->getErrorMessages();
            session_start();
            $_SESSION["error_msgs"] = $error_msgs;
            header("Location: ./index.php");
        }else{
            //$todo_search = new Todo;
            $query = "SELECT * FROM sample.todos WHERE title LIKE '%" . $title . "%'";
            $todo_search = Todo::findByQuery($query);
            return $todo_search;
        }
    }

    public function detail() {
        //GETパラメータから値取得
        $todo_id = $_GET['id'];
        $todo = Todo::findById($todo_id);
        return $todo;
    }

    public function new(){
        $data = array(
            "title" => $_POST['title'],
            "detail" => $_POST['detail']
        );

        $user_id = $_POST['user_id'];

        $validation = new TodoValidation;
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
            $todo->setuserid($user_id);
            $result = $todo->save();

            if($result === false) {
                $params = sprintf("?title=%s&detail=%s", $title, $detail);
                header("Location: ./new.php" . $params);
            }
            header("Location: ./index.php" );
        }
    }

    public function edit() {
        //パラメーターから id を取得
        $todo_id = $_POST['id'];

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

        $validation = new TodoValidation;
        $validation->setData($data);
        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION['error_msgs'] = $error_msgs;

            $params = sprintf("?title=%s&detail=%s", $title, $detail);
            header("Location: ./edit.php" . $params);
        }

        $validation_data = $validation->getData();
        $title = $validation_data['title'];
        $detail = $validation_data['detail'];

        $todo_data = new Todo;
        $todo_data->setTitle($title);
        $todo_data->setDetail($detail);
        $todo_data->setid($todo_id);
        $todo_data->update();

        header("Location: ./index.php" );
    }

    public function delete() {
        $todo_id = $_GET['todo_id'];
        $is_exist = Todo::isExistfindById($todo_id);
        if(!$is_exist) {
            session_start();
            $_SESSION['error_msgs'] = [sprintf("id=%sに該当するレコードが存在しません", $todo_id)];
            header("Location: ./index.php");
        }

        $todo = new Todo;
        $todo->setid($todo_id);
        $result = $todo->delete();
        if($result === false) {
            session_start();
            $_SESSION['error_msgs'] = [sprintf("削除に失敗しました。id=%s", $todo_id)];
        }
        header("Location: ./index.php");
    }

    public function user_new () {
        $data = array(
            "user_id" => $_POST['user_id'],
            "user_pw" => $_POST['user_pw']
        );

        $validation = new LoginValidation;
        $validation->setData($data);

        $validation_data = $validation->getData();
        $user_id = $validation_data['user_id'];
        $user_pw = $validation_data['user_pw'];

        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION["error_msgs"] = $error_msgs;

            //$params = sprintf("?title=%s&detail=%s", $title, $detail);
            header("Location: ./new.php");

        } else {

            $todo = new Todo;
            $todo->setTitle($title);
            $todo->setDetail($detail);
            $result = $todo->save();

            if($result === false) {
                $params = sprintf("?title=%s&detail=%s", $title, $detail);
                header("Location: ./new.php" . $params);
            }
            header("Location: ./index.php" );
        }
    }
}

class loginController {
    public function login() {
        // ユーザーidとPW取得
        $data = array(
            "user_id" => $_POST['user_id'],
            "user_pw" => $_POST['user_pw'],
        );
        //空チェック
        $validation = new LoginValidation;
        $validation->setData($data);
        $validation_users = $validation->getData();
        $user_id = $validation_users['user_id'];
        $user_pw = $validation_users['user_pw'];

        if($validation->check() === false) {
            //id 、pw いづれかが空
            $error_msgs = $validation->getErrorMessages();
            session_start();
            $_SESSION['error_msgs'] = $error_msgs;
            $_SESSION['user_id'] = $user_id;
            header("Location: ./index.php");
        } else {
            //ユーザーID チェック
            $user_id = $_POST['user_id'];
            $is_exist = Todo::isExistfindByUserId($user_id);
            if(!$is_exist) {
                session_start();
                $_SESSION['error_msgs'] = [sprintf("user_id=%sは登録されていません", $user_id)];
                header("Location: ./index.php");
            } else {
                // PW照合
                $user_data = Todo::findByUserId($user_id);
                $data_pw = $user_data['password'];
                if ($data_pw == $user_pw) {
                    //PW 適合
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    header("Location: ../todos/index.php");
                } else {
                    //PW 不適合
                    session_start();
                    $_SESSION['error_msgs'] = ["パスワードが間違っています"];
                    $_SESSION['user_id'] = $user_id;
                    header("Location: ./index.php");
                }
            }
        }
    }
}

class UserController {
    public function new () {

        $data = array(
            "user_id" => $_POST['user_id'],
            "user_pw" => $_POST['user_pw']
        );

        // 値が入力されているか
        $validation = new UserValidation;
        $validation->setData($data);
        $validation_data = $validation->getData();
        $user_id = $validation_data['user_id'];
        $user_pw = $validation_data['user_pw'];

        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION["error_msgs"] = $error_msgs;
            $params = sprintf("?user_id=%s", $user_id);
            header("Location: ./new.php"  . $params);

        } else {

            // 既存ユーザーに該当アカウントがないか確認
            $user = User::isExistUserId($user_id);
            if($user === false) {
                //既存ユーザーの場合
                session_start();
                $_SESSION['error_msgs'] = ["すでに登録されているユーザーIDです。"];
                header("Location: ./new.php");
            } else {
                // ユーザー新規作成
                $new = new User;
                $new->setId($user_id);
                $new->setPw($user_pw);
                $result = $new->new();
                if(!$result){
                    //新規作成失敗
                    session_start();
                    $_SESSION['error_msgs'] = ["ユーザーの新規作成が失敗しました。再度作成してください。"];
                    header("Location: ./new.php");
                } else {
                    //新規作成成功
                    header("Location: ./index.php" );
                }
            }
        }
    }
}


 ?>
