<?php

require_once( dirname( __FILE__ , 2) . '/config/db.php' );

class User {
    public $pdo;
    private $id;
    private $pw;

    public function __construct() {
        $this->dbConnect();
    }

    public function dbConnect() {
        $this->pdo = new PDO(DSN, USER, PW);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPw() {
        return $this->pw;
    }

    public function setPw($pw) {
        $this->pw = $pw;
    }

    public static function isExistUserId($id){
        $dbh = new PDO(DSN, USER, PW);
        $query = sprintf('SELECT * FROM users WHERE id = %s', $id);
        $stmh = $dbh->query($query);
        if(!$stmh) {
            return true;
        }
        return false;
    }

    public function new(){
        $query = sprintf("INSERT INTO users VALUES (%s, %s, now(), null)", $this->id, $this->pw);
        $dbh = new PDO(DSN, USER, PW);
        $stmh = $dbh->query($query);
        if(!$stmh) {
            //新規作成に失敗
            return false;
        } else {
            //新規作成成功
            return true;
        }

    }
}
?>
