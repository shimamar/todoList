<?php

class Validation {
    private $data;
    private $error_msgs = array();

    public function setData($data){
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function getErrorMessages() {
        return $this->error_msgs;
    }

    public function check(){
        $title = $this->data['title'];
        $detail = $this->data['detail'];

        if(empty($title)) {
            $this->error_msgs[] = 'タイトルが空です。';
        }
        if(empty($detail)) {
            $this->error_msgs[] = '詳細が空です。';
        }

        if(count($this->error_msgs) > 0) {
            return false;
        }
        return true;
    }

    public function users_check() {
        $user_id = $this->data['user_id'];
        $user_pw = $this->data['user_pw'];
        if(empty($user_id)) {
            $this->error_msgs[] = 'ユーザーIDを入力してください。';
        }
        if(empty($user_pw)) {
            $this->error_msgs[] = 'パスワードを入力してください。';
        }
        if(count($this->error_msgs) > 0) {
            return false;
        }
        return true;
    }

    public function searchitem_check() {
        $title = $this->data['title'];
        $status = $this->data['status'];
        $deadline_date = $this->data['deadline_date'];
        if(empty($title) && empty($status) && empty($deadline_date)) {
            $this->error_msgs[] = '検索条件が設定されていません。';
            return false;
        }
        return true;
    }
}

 ?>
