<?php
    $conn = require_once "../../config.php";

    //輸入: 

    class Message{
        public $successed;
        public $statement;
    }

    //輸出:
    $message = new Message();
    //ex: message.successed 得知是否完全成功

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            //foreach($_POST as $key => $value) $$key = $value;
            
            //先刪公會
            $sql = "SELECT guild_ID
                    FROM guild
                    WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($_SESSION['ID']));
            $result = $stmt->fetchAll();

            if(count($result)){
                $dismiss_guild_ID = $result[0][0];

                $sql = "UPDATE player
                        SET guild_ID = NULL
                        WHERE guild_ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array($dismiss_guild_ID));

                $sql = "DELETE FROM guild
                        WHERE guild_ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array($dismiss_guild_ID));
            }
            
            $sql = "DELETE FROM player
                    WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($_SESSION['ID']));

            $sql = "DELETE FROM ability
                    WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($_SESSION['ID']));
            
            $_SESSION['ID'] = null;
            $_SESSION['name'] = null;

            $message->successed = true;
            echo json_encode(array('message' => $message));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>