<?php

require_once( dirname( __FILE__ , 2) . '/config/db.php' );

class Todo {
    public $pdo;

    private $title;
    private $detail;
    private $status;
    private $deadline_date;
    private $todo_id;

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

    public function getid() {
        return $this->todo_id;
    }

    public function setid($todo_id) {
        $this->todo_id = $todo_id;
    }

    public static function findAll() {
        $query = "SELECT * FROM sample.todos order by id asc";
        $dbh = new PDO(DSN, USER, PW);
        $stmh = $dbh->query($query);

        if($stmh) {
            $result = $stmh->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function findByQuery($query) {
        $stmh = $this->pdo->query($query);
        if($stmh) {
            $result = $stmh->fetchAll(PDO::FERCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function findById($todo_id) {
        $query = sprintf('SELECT * FROM sample.todos WHERE id=%s', $todo_id);
        $dbh = new PDO(DSN, USER, PW);
        $stmh = $dbh->query($query);
        if($stmh) {
            $result = $stmh->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function isExistfindById($todo_id) {
        $dbh = new PDO(DSN, USER, PW);
        $query = sprintf('SELECT * FROM sample.todos WHERE id=%s', $todo_id);
        $stmh = $dbh->query($query);
        if(!$stmh) {
            return false;
        } else {
            return true;
        }
    }

    public function save() {
        $sql = sprintf(
            "INSERT INTO `todos`
                (`user_id`, `title`, `detail`, `status`, `created_at`, `updated_at`)
            VALUES (1, '%s', '%s', 0, NOW(), NOW());",
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
        $query = sprintf("UPDATE `todos` SET title = '%s', detail = '%s' WHERE id=%s;",
            $this->title,
            $this->detail,
            $this->todo_id
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

    public function delete() {
        try {
            $this->pdo->beginTransaction();
            $query = sprintf("DELETE FROM `todos` WHERE id=%s;", $this->todo_id);
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();
            $result = false;
        }
        return $result;
    }

}

 ?>
