<?php
    // Include config file
    $conn = require_once "../config.php";

    class Player{
        public $id;
        public $name;
        public $ds;
    }
    class Ability{
        public $id;
        public $health;
        public $attack;
        public $defense;
        public $reaction;
        public $agile;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $levels = $_POST["levels"];
        $guild_ID = $_POST["guild_ID"];
        $attack = $_POST["attack"];
        $defense = $_POST["defense"];
        $reaction = $_POST["reaction"];
        $agile = $_POST["agile"];

        if ($id == null) exit;
        if ($name == null) exit;/*
        if ($description == null) $description = "";
        if ($levels == null) $levels = "";
        if ($guild_ID == null) $guild_ID = "";*/
        /*
        if ($health == null) exit;
        if ($attack == null) exit;
        if ($defense == null) exit;
        if ($reaction == null) exit;
        if ($agile == null) exit;*/

        //$sql = "INSERT INTO ability VALUES($id, $health, $attack, $defense, $reaction, $agile)";
        $sql = "INSERT INTO player VALUES($id, $name, NULL, NULL, NULL)";
        $stmt = $conn->prepare($sql);
        //$stmt->execute(array($id, $health, $attack, $defense, $reaction, $agile));
        $stmt->execute(array($id, $name));
        $result = $stmt->fetchAll();
        
        echo "??";
        if (count($result) != 0) {
            $data = array();

            for ($i = 0; $i < count($result); $i++) {
                $p = new player();

                $p->ds = $result[$i]["description"];

                $data[] = $p;
            }
            
            echo json_encode(array('result' => $data));
        }
        else {
            echo json_encode(array('errorMsg' => 'STARBURST STREAM'));
        }
    }
    else {
        echo json_encode(array('errorMsg' => '請求無效，只允許 POST 方式訪問！'));
    }

    // Close connection
    $conn = null;
    //mysqli_close($conn);
?>