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

        $query = "SELECT * FROM sample.users WHERE id=%s', $id";
        $dbh = new PDO(DSN, USER, PW);
        $stmh = $dbh->query($query);

        var_dump($stmh);

        if($stmh) {
            //該当idがあった場合
            return false;
        } else {
            //該当idなし
            return true;
        }
    }
}
?>
