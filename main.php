<?php
    session_start();

    if (isset($_SESSION["ID"])) {
        $ID = $_SESSION["ID"];
        $username = $_SESSION["username"];

        setcookie("ID", $ID);
        setcookie("username", $username);
    }
    else {
        header('location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS --><!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-col-13.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <title>MySAO</title>

        <style>
            .Aincrad {
                height: 100vh;
                background-image: url('src/image/Aincrad.png');
                background-size: cover;
            }
            .header-gradient {
                background: linear-gradient(270deg, rgba(16, 46, 102, 0.9)0%, rgba(135, 220, 233, 0.8)100%);
                background: -moz-linear-gradient(270deg, rgba(16, 46, 102, 0.9)0%, rgba(135, 220, 233, 0.8)100%);
                background: -webkit-linear-gradient(270deg, rgba(16, 46, 102, 0.9)0%, rgba(135, 220, 233, 0.8)100%);
                background: -o-linear-gradient(270deg, rgba(16, 46, 102, 0.9)0%, rgba(135, 220, 233, 0.8)100%);
            }

            h2 {
                color: white;
                font-family: "Lucida Console", Courier, monospace;
                -webkit-text-stroke: 1.2px black;
            }

            .card {
                transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
                cursor: pointer;
            }
            .card:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
            }
            .card-image {
                position: relative;
                text-align: center;
            }
            .card-image img {
                opacity: 50%;
            }
            .card-image div {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #logout {
                opacity: 0%;
            }
            #logout:hover {
                transition: .5s;
                opacity: 100%;
            }
        </style>

        <script type="module">
            import { getCookie } from "./js/cookie.js";
            import * as ajax from "./js/ajax.js";

            let __ID = getCookie("ID");
            let __name = getCookie("username");

            // Logout
            $("#logout").click(function() {
                let confirm = window.confirm("Once you logout, you will die.");

                if (confirm) {
                    ajax.ajax_deleteAccount().then(function(response) {
                        if (response.message.successed)
                            location.href = "index.php";
                        else
                            alert("You can not logout!");
                    }).catch(function(jqXHR) {
                        alert("You can not logout!");
                    });
                }
            });

            // Window Load
            window.addEventListener("load", function(event) {
                $("#currentUsername").html(__name);
            });
        </script>
    </head>
    <body>
        <div class="Aincrad">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark header-gradient">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <!-- <img src="https://imgur.com/FuZhgll.png" alt="" width="30" height="24"> -->
                        MySAO
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarToggler">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="main.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="status.php">Status</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="aincrad.php">Aincrad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="guild.php">Guild</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="player.php">Player</a>
                            </li>
                        </ul>
                        <div class="justify-content-end" style="color: white;">
                            <i class="bi bi-person-circle"></i>
                            &zwnj;&zwnj;&zwnj;
                            <span id="currentUsername"></span>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <br>
                <div class="d-flex justify-content-center">
                    <h2>Welcome to Sword Art Online !</h2>
                </div>
                    
                <br>
                <div class="row">
                    <div class="col-sm-6-13">
                        <div class="card" style="height: 30vh">
                            <div class="card-image" onclick="location.href='status.php'">
                                <img src="src/image/Main-Status.png" class="card-img-top" style="height: 29.7vh;">
                                <div>
                                    <h2>Status</h2>
                                </div>
                            </div>
                        </div>

                        <div style="height: 8vh"></div>

                        <div class="card" style="height: 30vh">
                            <div class="card-image" onclick="location.href='guild.php'">
                                <img src="src/image/Main-Guild.png" class="card-img-top" style="height: 29.7vh;">
                                <div>
                                    <h2>Guild</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-1-13"></div>

                    <div class="col-sm-6-13">
                        <div class="card" style="height: 30vh">
                            <div class="card-image" onclick="location.href='aincrad.php'">
                                <img src="src/image/Main-Aincrad.png" class="card-img-top" style="height: 29.7vh;">
                                <div>
                                    <h2>Aincrad</h2>
                                </div>
                            </div>
                        </div>

                        <div style="height: 8vh"></div>

                        <div class="card" style="height: 30vh">
                            <div class="card-image" onclick="location.href='player.php'">
                                <img src="src/image/Main-Player.png" class="card-img-top" style="height: 29.7vh;">
                                <div>
                                    <h2>Player</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="d-flex justify-content-center">
                    <span class="btn btn-danger w-25" type="button" id="logout">
                        <i class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;&nbsp;L o g o u t
                    </span>
                </div>
            </div>

        </div>
    </body>
</html>