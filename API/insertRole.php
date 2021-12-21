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
        $_id = $_POST["_id"];
        $_name = $_POST["_name"];
        $_health = $_POST["_health"];
        $_attack = $_POST["_attack"];
        $_defense = $_POST["_defense"];
        $_reaction = $_POST["_reaction"];
        $_agile = $_POST["_agile"];

        if ($_id == null) exit;
        if ($_name == null) exit;
        if ($_health == null) exit;
        if ($_attack == null) exit;
        if ($_defense == null) exit;
        if ($_reaction == null) exit;
        if ($_agile == null) exit;

        $sql = "INSERT INTO ability VALUES($_id, $_health, $_attack, $_defense, $_reaction, $_agile)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($_id, $_health, $_attack, $_defense, $_reaction, $_agile));
        $result = $stmt->fetchAll();
        
        /*
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
        }*/
    }
    else {
        echo json_encode(array('errorMsg' => '請求無效，只允許 POST 方式訪問！'));
    }

    // Close connection
    $conn = null;
    //mysqli_close($conn);
?>