<?php
    // Include config file
    $conn = require_once "../config.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "SELECT *
                FROM player";
        $stmt = $conn->prepare($sql); 
        //$stmt->bind_param();
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (count($result) != 0) {
            echo json_encode(array('result' => $result));
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