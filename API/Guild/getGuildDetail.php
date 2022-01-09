<?php
    $conn = require_once "../../config.php";

    //輸入: guild_name

    class Message{
        public $successed;
        public $statement;
        public $guild_name_notExist = false;
    }
    class Info{
        public $player = array();  //考慮沒有元素的情況 也保持陣列型態
    }
    class Player{}
    class Distribution{
        public $lv;
        public $num;
        function __construct($lv, $num){
            $this->lv = $lv;
            $this->num = $num;  
        }
    }
    
    //輸出:
    $message = new Message();
    //ex: message.guild_name_notExist 得知輸入是否有效
    $guildInfo = new Info();
    //含有該 guild的attribute 與 player陣列
    //ex: guildInfo.guild_ID ; guildInfo.player[0].attack
    $memberDistribution = array();
    //記錄有人的樓層與成員人數
    //ex: memberDistribution[0].lv ; memberDistribution[0].num

    function interrupt($msg){
        $msg->successed = false;
        echo json_encode(array('message' => $msg));
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try{
            foreach($_POST as $key => $value) $$key = $value;

            $sql = "SELECT *
                    FROM guild
                    WHERE guild_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guild_name));
            $result = $stmt->fetchAll();

            if(count($result) != 1) { $message->guild_name_notExist = true; interrupt($message); }

            foreach($result[0] as $key => $value)
                $guildInfo->$key = $value;
            
            $sql = "SELECT *
                    FROM player natural join ability
                    WHERE guild_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guildInfo->guild_ID));
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++) {
                $guildInfo->player[] = new Player();
                foreach($result[$i] as $key => $value)
                    $guildInfo->player[$i]->$key = $value;
            }

            $sql = "SELECT levels as lv, COUNT(levels) as num
                    FROM player
                    WHERE guild_ID = ?
                    GROUP BY levels;";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guildInfo->guild_ID));
            $result = $stmt->fetchAll();

            foreach($result as $dstr)
                $memberDistribution[] = new Distribution($dstr['lv'], $dstr['num']);
            
            $message->successed = true;
            echo json_encode(array('message' => $message, 'guildInfo' => $guildInfo, 'memberDistribution' => $memberDistribution));
        }
        catch (Exception $e) { $message->statement = $e->getMessage(); interrupt($message); }
    }
    else {
        $message->statement = '請求無效，只允許 POST 方式訪問！';
        interrupt($message);
    }

    $conn = null;
?>