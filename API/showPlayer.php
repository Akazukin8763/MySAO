<?php
    // Include config file
    $conn = require_once "../config.php";

    class player{
        public $ds;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST["name"];

        if ($name == null)
            exit;

        $sql = "SELECT *
                FROM player
                WHERE name = ?";
        $stmt = $conn->prepare($sql); 
        //$stmt->bind_param();
        $stmt->execute(array($name));
        $result = $stmt->fetchAll();

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