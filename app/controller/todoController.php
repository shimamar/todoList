<?php

require_once( dirname( __FILE__ , 2) . '/models/todo.php' );

function index($user_id){
    return Todo::findAll($user_id);
}

function detail($todo_id){
    return Todo::findDetail($todo_id);
}

 ?>
