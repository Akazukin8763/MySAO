<?php
    $conn = require_once "../../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    class Info{}
    $message = new Message();
    $guildsInfo;
    //ex: guildsInfo[0].guild_name

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            //foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT *
                    FROM guild";
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