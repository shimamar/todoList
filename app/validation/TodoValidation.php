<?php

class TodoValidation {

    public static function nullcheck($data){
        if(empty($data)){
            return false;
        }
        return true;
    }
}

 ?>
