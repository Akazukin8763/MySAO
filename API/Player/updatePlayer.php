<?php
    $conn = require_once "../../config.php";

    class Message{
        public $successed;
        public $statement;
        public $guildNotExist = false;
    }
    $message = new Message();

    $items = array("description", "levels", "guild_ID");

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            foreach($_POST as $key => $value) $$key = $value;
            //輸入: (description、levels、guild_name、guild_ID)皆可有可無
            
            if(!empty($guild_name)){    //有填name，就以name優先
                $sql = "SELECT guild_ID
                        FROM guild
                        WHERE guild_name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array($guild_name));
                $result = $stmt->fetchAll();
                if(count($result) != 1) { $message->guildNotExist = true; interrupt($message); }
                $guild_ID = $result[0][0];
            }
            else if(isset($guild_name) && !isset($guild_ID)){    //沒填name又沒傳ID，就等同沒填ID，會離開公會
                $guild_ID = "";
            }
            //沒給name就以ID，但ID我就沒寫防呆了，因為不會是使用者輸入
            //承上，若也沒給ID就自然不會改，沒填的話會離開公會

            foreach($items as $item){
                if (isset($$item)){
                    if($item == "guild_ID" && $guild_ID == "") $guild_ID = NULL;    //沒填就設為NULL，以離開公會 (不能update"")
                    $sql = "UPDATE player
                            SET $item = ?
                            WHERE ID = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array($$item, $_SESSION["ID"]));
                }
            }

            $message->successed = true;
            echo json_encode(array('message' => $message));
        }
        catch (Exception $e){ $message->statement = $e->getMessage(); interrupt($message);  }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>