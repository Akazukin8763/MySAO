<?php
    $conn = require_once "../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    $message = new Message();

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        foreach($_POST as $key => $value) $$key = $value;
        //輸入: ID
        if (empty($id)){ $message->statement = "ID is empty"; interrupt($message); }
        /*
        $sql = "SELECT COUNT(ID)
                FROM ability
                WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll();
        if($result[0][0]){ $message->statement = "ID is exist"; interrupt($message); }*/

        try {
            $sql = "INSERT INTO ability(id, health, attack, defense, reaction, agile)
                    VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($id, $health, $attack, $defense, $reaction, $agile));
        }
        catch (Exception $e) {
            $message->statement = "Error in insert ability : " . $e->getMessage(); interrupt($message);
        }
        
        $message->successed = true;
        echo json_encode(array('message' => $message));
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>