<?php
    $conn = require_once "../../config.php";

    //輸入: name

    class Message{
        public $successed;
        public $statement;
        public $name_notExist = false;
    }
    class Info{}

    //輸出:
    $message = new Message();
    //ex: message.name_notExist 得知輸入是否有效
    $playerInfo = new Info();
    //含有該玩家的 player、ability、所在guild 的attribute
    //ex: playerInfo.attack

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT *
                    FROM player natural join ability left outer join guild using (guild_ID)
                    WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($name));
            $result = $stmt->fetchAll();

            if(count($result) != 1) { $message->name_notExist = true; interrupt($message); }

            foreach($result[0] as $key => $value)
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