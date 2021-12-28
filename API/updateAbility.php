<?php
    $conn = require_once "../config.php";

    class Message{
        public $successed;
        public $statement;
    }
    $message = new Message();

    $items = array("health", "attack", "defense", "reaction", "agile");

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        foreach($_POST as $key => $value) $$key = $value;
        //輸入: ID、(health、attack、defense、reaction、agile)
        if (empty($id)){ $message->statement = "ID is empty"; interrupt($message); }
        foreach($items as $item) {
            if (!empty($$item)){
                try {
                    $sql = "UPDATE ability
                            SET $item = ?
                            WHERE ID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array($$item, $id));
                }
                catch (Exception $e) {
                    $message->statement = "Error in update ability's $item : " . $e->getMessage();
                    interrupt($message);
                }
            }
        }

        $message->successed = true;
        echo json_encode(array('message' => $message));
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>