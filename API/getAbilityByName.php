<?php
    $conn = require_once "../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    $message = new Message();/*
    class Ability{}
    $ability = new Ability();*/

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        foreach($_POST as $key => $value) $$key = $value;
        
        if ($name == null){ $message->statement = "Name is null"; interrupt($message); }

        try{
            $sql = "SELECT health, attack, defense, reaction, agile
                    FROM player natural left outer join ability
                    WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($name));
            $result = $stmt->fetchAll();
        }
        catch (Exception $e) {
            $message->statement = "Error in get ability by name: " . $e->getMessage(); interrupt($message);
        }
        
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