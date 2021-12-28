<?php
    $conn = require_once "../config.php";

    class Message{
        public $successed;
        public $statement;              //回報錯誤
        public $nameIllegal = false;    //使用者防呆
        public $nameExist = false;      //使用者防呆
    }
    $message = new Message();

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        foreach($_POST as $key => $value) $$key = $value;
        //輸入: name
        if (empty($name)){ $message->nameIllegal = true; interrupt($message); }
        $sql = "SELECT COUNT(name)
                FROM player
                WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($name));
        $result = $stmt->fetchAll();
        if($result[0][0]){ $message->nameExist = true; interrupt($message); }
        
        try {
            $sql = "SELECT SUBSTRING(MAX(ID), 3, 6)
                    FROM player
                    WHERE SUBSTRING(ID, 1, 2) = 'CR'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        catch (Exception $e) {
            $message->statement = "Error in search player's ID : " . $e->getMessage(); interrupt($message);
        }
        
        $id = "CR".str_pad(intval($result[0][0])+1, 6, "0", STR_PAD_LEFT);
        $levels = 1;

        try {
            $sql = "INSERT INTO player(ID, name, levels)
                    VALUES(?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($id, $name, $levels));
        }
        catch (Exception $e) {
            $message->statement = "Error in insert player : " . $e->getMessage() .
                "\nInsert ID was " . $id;
            interrupt($message);
        }

        $message->successed = true;
        echo json_encode(array('message' => $message, 'ID' => $id));
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>