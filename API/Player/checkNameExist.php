<?php
    $conn = require_once "../../config.php";

    //輸入: name

    class Message{
        public $successed;
        public $statement;
        public $name_illegal = false;
        public $name_exist = false;
    }

    //輸出:
    $message = new Message();
    //ex: message.name_exist 得知名字是否已被使用

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            foreach($_POST as $key => $value) $$key = $value;
            
            if (empty($name)){ $message->name_illegal = true; interrupt($message); }

            $sql = "SELECT COUNT(name)
                    FROM player
                    WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($name));
            $result = $stmt->fetchAll();
            if($result[0][0]){ $message->name_exist = true; interrupt($message); }

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