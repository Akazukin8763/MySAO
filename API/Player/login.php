<?php
    $conn = require_once "../../config.php";

    //輸入: name
    
    class Message{
        public $successed;
        public $statement;
        public $name_notExist = false;
    }
    
    //輸出:
    $message = new Message();
    //ex: message.name_notExist 得知輸入是否有效

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT ID
                    FROM player
                    WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($name));
            $result = $stmt->fetchAll();

            if(count($result) != 1) { $message->name_notExist = true; interrupt($message); }
            $ID = $result[0][0];

            $_SESSION["ID"] = $ID;
            $_SESSION["username"] = $name;
            
            $message->successed = true;
            echo json_encode(array('message' => $message));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>