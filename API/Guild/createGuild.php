<?php
    $conn = require_once "../../config.php";

    //輸入: guild_name

    class Message{
        public $successed;
        public $statement;
        public $have_guild = false;
        public $guild_name_illegal = false;
        public $guild_name_exist = false;
    }

    //輸出:
    $message = new Message();
    //ex: message.successed 得知是否完全成功
    $guild_ID;
    //返回新註冊guild_ID
    //ex: guild_ID

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            foreach($_POST as $key => $value) $$key = $value;
            
            $sql = "SELECT guild_ID
                    FROM player
                    WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($_SESSION['ID']));
            $result = $stmt->fetchAll();
            if($result[0][0] != NULL){ $message->have_guild = true; interrupt($message); }

            if (empty($guild_name)){ $message->guild_name_illegal = true; interrupt($message); }
            
            $sql = "SELECT COUNT(guild_name)
                    FROM guild
                    WHERE guild_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guild_name));
            $result = $stmt->fetchAll();
            if($result[0][0]){ $message->guild_name_exist = true; interrupt($message); }
            
            $sql = "SELECT SUBSTRING(MAX(guild_ID), 3, 6)
                    FROM guild
                    WHERE SUBSTRING(guild_ID, 1, 2) = 'GD'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            $guild_ID = "GD".str_pad(intval($result[0][0])+1, 6, "0", STR_PAD_LEFT);
            date_default_timezone_set('Asia/Taipei');
            $establishment = date("Y-m-d");

            $sql = "INSERT INTO guild(guild_ID, guild_name, ID, establishment)
                    VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guild_ID, $guild_name, $_SESSION['ID'], $establishment));

            $sql = "UPDATE player
                    SET guild_ID = ?
                    WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guild_ID, $_SESSION['ID']));

            $message->successed = true;
            echo json_encode(array('message' => $message, 'guild_ID' => $guild_ID));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>