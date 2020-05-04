<?php

class Todo {

    public static function findAll($dsn, $user, $password, $user_id){

        //MySQLと接続
        try {
            // PDOインスタンスを生成
            $dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            // エラーメッセージ表示
            echo 'データベースにアクセスできません！' . $e->getMessage();
            // 強制終了
            exit;
        }
        $sql = "SELECT * FROM sample.todos WHERE user_id=" . $user_id;

        //SQL実行
        try {
            //SQL文の組み立て
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
        }

        //$stmh 空チェック
        if($stmh){
            exit;
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
            exit;
        }
        //SQL実行
        try {
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
        }
        //値を取得
        return $data_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
    }

}

 ?>
