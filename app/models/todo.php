<?php

require_once( dirname( __FILE__ , 2) . '/config/db.php' );

class Todo {

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

    public static function findDetail($todo_id){

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

}

 ?>
