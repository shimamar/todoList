<?php

class Todo {

    public function findAll($dbh, $sql){

        //SQL実行
        try {
            //SQL文の組み立て
            $stmh = $dbh->query($sql);
        } catch (PDOException $e) {
            echo '接続エラー：' . $e->getMessage();
        }

        //値を取得
        $data_list = $stmh->fetchAll(PDO::FETCH_ASSOC);

        return $this->data_list = $data_list;

    }



}

 ?>
