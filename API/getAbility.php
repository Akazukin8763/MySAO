<?php
    $conn = require_once "../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    $message = new Message();/*
    class Ability{
        public $health;
        public $attack;
        public $defense;
        public $reaction;
        public $agile;
    }
    $ability = new Ability();*/

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        foreach($_POST as $key => $value) $$key = $value;

        if ($id == null){ $message->statement = "ID is null"; interrupt($message); }
        $sql = "SELECT *
                FROM ability
                WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll();
        if(count($result) == 0){ $message->statement = "ID isn't exist in ability"; interrupt($message); }
        
        //foreach($result[0] as $key => $value) $ability->$key = $value;

        $message->successed = true;
        echo json_encode(array('message' => $message, 'ability' => $result[0]));
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>