<?php

require_once( dirname( __FILE__ , 2) . '/config/db.php' );

class Todo {
    public $pdo;

    private $title;
    private $detail;
    private $status;
    private $deadline_date;

    public function __construct() {
        $this->dbConnect();
    }

    public function dbConnect() {
        $this->pdo = new PDO('mysql:host=50284b150784;dbname=sample;charset=utf8', 'user', 'password');
    }

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

    public function getDeadLineDate() {
        return $this->deadline_date;
    }

    public function setDeadLineDate($deadline_date) {
        $this->deadline_date = $deadline_date;
    }

    public static function findAll() {
        $query = "SELECT * FROM sample.todos";
        $dbh = new PDO(DSN, USER, PW);
        $stmh = $dbh->query($query);

        if($stmh) {
            $result = $stmh->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    /*public static function findAll($user_id){
        try {
            $dbh = new PDO(DSN, USER, PW);
        } catch (PDOException $e) {
            echo 'データベースにアクセスできません！' . $e->getMessage();
            return false;
        }
        $sql = "SELECT * FROM sample.todos WHERE user_id=" . $user_id;
        try {
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
            return false;
        }
        if(!$stmh){
            return $stmh;
        }
        return $data_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public static function findByQuery($query) {
        $stmh = $this->pdo->query($query);
        if($stmh) {
            $result = $stmh->fetchAll(PDO::FERCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }


    //public static function findByQuery($dsn, $user, $password, $sql) {
        //MySQLと接続
        //try {
            //$dbh = new PDO($dsn, $user, $password);
        //} catch (PDOException $e) {
            //echo 'データベースにアクセスできません！' . $e->getMessage();
            //return false;
        //}
        //SQL実行
        //try {
            //$stmh = $dbh->query($sql);
        //} catch (PDOException $e) {
            //echo '接続エラー：' . $e->getMessage();
            //return false;
        //}
        //値を取得
        //return $data_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
    //}

    public static function findById($todo_id) {
        $query = sprintf('SELECT * FROM sample.todos WHERE id=%s', $todo_id);
        $dbh = new PDO(DSN, USER, PW);
        $stmh = $dbh->query($query);
        if($stmh) {
            $result = $stmh->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }


    /*public static function findById($todo_id){
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
    }*/

    public function save() {
        $sql = sprintf(
            "INSERT INTO `todos`
                (`id`, `user_id`, `title`, `detail`, `status`, `created_at`, `updated_at`)
            VALUES ( 1, 10, '%s', '%s', 0, NOW(), NOW());",
            $this->title,
            $this->detail
        );

        try {
            //トランザクション開始
            $this->pdo->beginTransaction();

            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();

            //コミット
            $this->pdo->commit();
        } catch(PDOException $e) {
            //ロールバック
            $this->pdo->rollBack();

            //エラーメッセージ出力
            echo $e->getMessage();
        }
    }

    public function update() {
        $query = sprintf("UPDATE `todos` SET title = %s, detail = '%s';",
            $this->title,
            $this->detail
            );

        try {
            //トランザクション開始
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            //コミット
            $this->pdo->commit();

        } catch(PDOException $e) {

            //ロールバック
            $this->pdo->rollBack();

            //エラーメッセージ出力
            echo $e->getMessage();
        }
    }

}

 ?>
