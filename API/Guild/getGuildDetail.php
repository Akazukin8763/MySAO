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
    //ex: memberDistribution[0]

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
            
            $num_inLevels = array();
            for($i=0; $i<=100; $i++)
                $num_inLevels[] = 0;
            
            $sql = "SELECT *
                    FROM player natural left outer join ability
                    WHERE guild_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($guildInfo->guild_ID));
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++) {
                $guildInfo->player[] = new Player();
                foreach($result[$i] as $key => $value)
                    $guildInfo->player[$i]->$key = $value;
                $num_inLevels[$result[$i]['levels']]++;
            }

            for($i=1; $i<=100; $i++){
                if($num_inLevels[$i])
                    $memberDistribution[] = new Distribution($i, $num_inLevels[$i]);
            }
            
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