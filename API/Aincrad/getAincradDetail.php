<?php
    $conn = require_once "../../config.php";

    class Message{
        public $successed;
        public $statement;
        public $out_of_range = false;
    }
    class Info{
        public $enemy = array();  //考慮沒有元素的情況 也保持陣列型態
    }
    class Enemy{}
    $message = new Message();
    $levelInfo = new Info();
    //樓層與敵人資訊
    //含有 各aincrad的attribute 與 enemy陣列
    //ex: levelInfo.major_area ; levelInfo.enemy[0].name

    function interrupt($msg){
        $msg->successed = false;
        $_SESSION["message"] = $message;
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;
            //輸入level
            if(empty($level)) { $message->statement = "Empty!"; interrupt($message); }
            if($level < 1 || $level > 100) { $out_of_range = true; interrupt($message); }

            $sql = "SELECT *
                    FROM aincrad
                    WHERE levels = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($level));
            $result = $stmt->fetchAll();

            foreach($result[0] as $key => $value)
                $levelInfo->$key = $value;
            
            $sql = "SELECT *
            FROM enemy
            WHERE levels = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($level));
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++) {
                $levelInfo->enemy[] = new Enemy();
                foreach($result[$i] as $key => $value)
                    $levelInfo->enemy[$i]->$key = $value;
            }

            $message->successed = true;
            echo json_encode(array('message' => $message, 'levelInfo' => $levelInfo));
        } catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>