<?php
    $conn = require_once "../../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    class Info{}
    $message = new Message();
    $levelsInfo;
    //ex: levelsInfo[100].major_area

    function interrupt($msg){
        $msg->successed = false;
        $_SESSION["message"] = $message;
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            //foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT *
                    FROM aincrad";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            $levelsInfo[0] = NULL;
            for($i=0, $temp = new Info(); $i<100; $i++) {
                foreach($result[$i] as $key => $value)
                    $temp->$key = $value;
                $levelsInfo[] = $temp;
            }
            $message->successed = true;
            echo json_encode(array('message' => $message, 'levelsInfo' => $levelsInfo));
        } catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>