<?php

require_once( dirname( __FILE__ , 2) . '/config/db.php' );

class Todo {
    public $title;
    public $detail;
    public $status;

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public static function findAll($user_id){
        //MySQLと接続
        try {
            // PDOインスタンスを生成
            $dbh = new PDO(DSN, USER, PW);
        } catch (PDOException $e) {
            // エラーメッセージ表示
            echo 'データベースにアクセスできません！' . $e->getMessage();
            return false;
        }
        $sql = "SELECT * FROM sample.todos WHERE user_id=" . $user_id;
        //SQL実行
        try {
            //SQL文の組み立て
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
            return false;
        }
        //$stmh 空チェック
        if(!$stmh){
            //$stmh取得失敗時 falseを返す
            return $stmh;
        }
        //値を取得
        return $data_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function findByQuery($dsn, $user, $password, $sql) {
        //MySQLと接続
        try {
            $dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'データベースにアクセスできません！' . $e->getMessage();
            return false;
        }
        //SQL実行
        try {
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
            return false;
        }
        //値を取得
        return $data_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($todo_id){
        try {
            $dbh = new PDO(DSN, USER, PW);
        } catch (PDOException $e) {
            echo 'データベースにアクセスできません！' . $e->getMessage();
            return false;
        }
        $sql = "SELECT * FROM sample.todos WHERE id=" . $todo_id;
        try {
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
            return false;
        }
        if(!$stmh){
            return $stmh;
        }
        //値を取得
        return $data_detail = $stmh->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save() {
        $sql = sprintf(
            "INSERT INTO `todos`
                (`id`, `user_id`, `title`, `detail`, `status`, `created_at`, `updated_at`)
            VALUES ( 1, 10, '%s', '%s', 0, NOW(), NOW());",
            $this->title,
            $this->detail
        );

        try {
            $dbh = new PDO(DSN, USER, PW);
        } catch (PDOException $e) {
            echo 'データベースにアクセスできません！' . $e->getMessage();
            return false;
        }

        try {
            $stmh = $dbh->prepare($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
            return false;
        }

        if(!$stmh){
            return $stmh;
        }

        //値を取得
        return $save_date = $stmh->execute();
    }

}

 ?>
