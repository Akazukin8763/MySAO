<?php
    $conn = require_once "../../config.php";

    //輸入: name、health、attack、defense、reaction、agile

    class Message{
        public $successed;
        public $statement;
        //輸入皆由前端開發者傳入，不需要防呆
        public $name_illegal = false;
        public $name_exist = false;
    }

    //輸出:
    $message = new Message();
    //ex: message.successed 得知是否完全成功
    $ID;
    //返回新註冊ID
    //ex: ID

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            foreach($_POST as $key => $value) $$key = $value;
            
            if (empty($name)){ $message->name_illegal = true; interrupt($message); }
            
            $sql = "SELECT COUNT(name)
                    FROM player
                    WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($name));
            $result = $stmt->fetchAll();
            if($result[0][0]){ $message->name_exist = true; interrupt($message); }
            
            $sql = "SELECT SUBSTRING(MAX(ID), 3, 6)
                    FROM player
                    WHERE SUBSTRING(ID, 1, 2) = 'CR'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            $ID = "CR".str_pad(intval($result[0][0])+1, 6, "0", STR_PAD_LEFT);

            $sql = "INSERT INTO player(ID, name, levels)
                    VALUES(?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($ID, $name, 1));

            $sql = "INSERT INTO ability(ID, health, attack, defense, reaction, agile)
                    VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($ID, $health, $attack, $defense, $reaction, $agile));

            $message->successed = true;
            echo json_encode(array('message' => $message, 'ID' => $ID));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>