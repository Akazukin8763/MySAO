<?php
    $conn = require_once "../../config.php";

    //輸入: 
    
    class Message{
        public $successed;
        public $statement;
    }
    class Info{}
    
    //輸出:
    $message = new Message();
    //ex: message.successed 得知是否完全成功
    $guildsInfo;
    //ex: guildsInfo[0].guild_name ; guildsInfo[0].leader

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            //foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT G.*, name as leader
                    FROM guild as G left outer join player using(ID)";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++) {
                $temp = new Info();
                foreach($result[$i] as $key => $value)
                    $temp->$key = $value;
                $guildsInfo[] = $temp;
            }
            $message->successed = true;
            echo json_encode(array('message' => $message, 'guildsInfo' => $guildsInfo));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>