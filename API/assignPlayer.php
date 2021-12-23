<?php
    $conn = require_once "../config.php";

    class Message{
        public $successed;
        public $statement;  //error message
        public $nameIllegal = false;
        public $nameExist = false;
    }
    $message = new Message();

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        foreach($_POST as $key => $value) $$key = $value;

        if ($name == null){ $message->nameIllegal = true; interrupt($message); }
        $sql = "SELECT count(name)
                FROM player
                WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($name));
        $result = $stmt->fetchAll();
        if($result[0][0]){ $message->nameExist = true; interrupt($message); }
        
        $sql = "SELECT COUNT(*)
                FROM player";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        $id = "CR".str_pad($result[0][0]+1, 6, "0", STR_PAD_LEFT);
        $levels = 1;
        
        $sql = "INSERT INTO player(ID, name, levels)
                VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id, $name, $levels));

        $message->successed = true;
        echo json_encode(array('message' => $message, 'ID' => $id));
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>