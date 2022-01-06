<?php
    $conn = require_once "../../config.php";

    //輸入: (description)、(levels)、(guild_name)、(guild_ID) 皆可有可無
    
    class Message{
        public $successed;
        public $statement;
        public $levels_illegal = false;
        public $guild_name_illegal = false;
        //guild_ID不會由使用者輸入，所以不做防呆
    }
    
    //輸出:
    $message = new Message();
    //ex: message.guild_name_illegal 得知輸入是否有效

    $items = array("description", "levels", "guild_ID");

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    session_start();
    //瘋狂玩 NULL / "" / isset() / empty() 的一篇
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            foreach($_POST as $key => $value) $$key = $value;

            if(!isset($_SESSION["ID"])) { $message->statement = "Error: _SESSION[ID] unset!"; interrupt($message); }
            
            if(isset($levels)){     //levels為空要擋下來，其他可以為空
                $sql = "SELECT count(levels)
                        FROM aincrad
                        WHERE levels = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array($levels));
                $result = $stmt->fetchAll();
                if($result[0][0] != 1) { $message->levels_illegal = true; interrupt($message); }
            }

            if(!empty($guild_name)){    //有填name，就以name優先
                $sql = "SELECT guild_ID
                        FROM guild
                        WHERE guild_name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array($guild_name));
                $result = $stmt->fetchAll();
                if(count($result) != 1) { $message->guild_name_illegal = true; interrupt($message); }
                $guild_ID = $result[0][0];
            }
            else if(isset($guild_name) && !isset($guild_ID)){    //沒填name又沒傳ID，就等同沒填ID，會離開公會
                $guild_ID = "";
            }
            //沒給name就以ID，但ID我就沒寫防呆了，因為不會是使用者輸入
            //承上，若也沒給ID就自然不會改，沒填的話會離開公會

            foreach($items as $item){
                if (isset($$item)){
                    if($item == "levels" && empty($levels)) continue;   //沒填levels等同於沒給
                    else if($item == "guild_ID" && $guild_ID == "") $guild_ID = NULL;    //沒填就設為NULL(不是真的SET"")，以離開公會
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