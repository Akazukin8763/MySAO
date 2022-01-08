<?php
    $conn = require_once "../../config.php";

    //輸入: (orderBy) 預設ID

    class Message{
        public $successed;
        public $statement;
    }
    class Info{}

    //輸出:
    $message = new Message();
    //ex: message.name_notExist 得知輸入是否有效
    $playerList = array();
    //含有所有玩家的 ID、name
    //ex: playerList.name

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;

            if(empty($orderBy)) $orderBy = 'ID';

        try{
            $sql = "SELECT ID, name
                    FROM player natural join ability
                    ORDER BY $orderBy";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch (Exception $e) { $message->statement = "Have not this attribute!"; interrupt($message); }

            for($i=0; $i<count($result); $i++) {
                $playerList[] = new Info();
                foreach($result[$i] as $key => $value)
                    $playerList[$i]->$key = $value;
            }
            
            $message->successed = true;
            echo json_encode(array('message' => $message, 'playerList' => $playerList));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>