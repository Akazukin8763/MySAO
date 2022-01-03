<?php
    $conn = require_once "../../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    $message = new Message();
    $levelsInfo = array();

    function interrupt($msg){
        $msg->successed = false;
        $_SESSION["message"] = $message;
        exit;
    }
    
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //foreach($_POST as $key => $value) $$key = $value;

        try{
            $sql = "SELECT *
                    FROM aincrad";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch (Exception $e) {
            $message->statement = "Error in get aincrad: " . $e->getMessage(); interrupt($message);
        }

        $levelsInfo[] = $result[0];
        for($i=0; $i<100; $i++)
            $levelsInfo[] = $result[$i];
        $_SESSION["levelsInfo"] = $levelsInfo;
        $message->successed = true;
        $_SESSION["message"] = $message;
        //echo json_encode(array('message' => $message, 'levelsInfo' => $levelsInfo));
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>