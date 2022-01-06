<?php
    $conn = require_once "../../config.php";

    //輸入: levels

    class Message{
        public $successed;
        public $statement;
        public $levels_notExist = false;
    }
    class Info{
        public $enemy = array();  //考慮沒有元素的情況 也保持陣列型態
    }
    class Enemy{}
    
    //輸出:
    $message = new Message();
    //ex: message.levels_notExist 得知輸入是否有效
    $levelInfo = new Info();
    //含有該 level的attribute 與 enemy陣列
    //ex: levelInfo.major_area ; levelInfo.enemy[0].attack

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT *
                    FROM aincrad
                    WHERE levels = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($levels));
            $result = $stmt->fetchAll();

            if(count($result) != 1) { $message->levels_notExist = true; interrupt($message); }

            foreach($result[0] as $key => $value)
                $levelInfo->$key = $value;
            
            $sql = "SELECT *
                    FROM enemy natural left outer join ability
                    WHERE levels = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($levels));
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++) {
                $levelInfo->enemy[] = new Enemy();
                foreach($result[$i] as $key => $value)
                    $levelInfo->enemy[$i]->$key = $value;
            }
            
            $message->successed = true;
            echo json_encode(array('message' => $message, 'levelInfo' => $levelInfo));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>