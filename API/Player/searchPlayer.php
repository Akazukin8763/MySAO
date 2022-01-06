<?php
    $conn = require_once "../../config.php";

    class Message{
        public $successed;
        public $statement;
        public $playerNotExist = false;
    }
    class Info{}
    $message = new Message();
    $playerInfo = new Info();
    //玩家資訊
    //含有該 player的attribute 與 ability attribute
    //ex: playerInfo.attack

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;
            //輸入name

            $sql = "SELECT *
                    FROM player
                    WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($name));
            $result = $stmt->fetchAll();

            if(count($result) != 1) { $message->playerNotExist = true; interrupt($message); }

            foreach($result[0] as $key => $value)
                $playerInfo->$key = $value;
            
            $sql = "SELECT *
                    FROM ability
                    WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($playerInfo->ID));
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++)
                $playerInfo->$key = $value;
            
            $message->successed = true;
            echo json_encode(array('message' => $message, 'playerInfo' => $playerInfo));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>