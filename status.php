<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS --><!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <link href="css/bootstrap-col-5.css" rel="stylesheet">
        <link href="css/bootstrap-modal-fade.css" rel="stylesheet">

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

            .card-header {
                color: white;
            }

            .form-control:focus {
                border-color: rgba(135, 220, 233, 0.95);
                box-shadow: 0 0 0 0.2rem rgba(16, 46, 102, 0.25);
            }
        </style>

        <script type="module">
            import { showGraph } from "./js/ability/showGraph.js";
            function setStatus() {
                var __name = "桐谷和人";
        
                $.ajax({
                    type: "POST",
                    url: "API/getAbility.php",
                    dataType: "json",
                    data: {
                        name: __name
                    },
                    success: function(response) {
                        if (response.message.successed) {
                            var attack = response.ability.attack;
                            var health = response.ability.health;
                            var defense = response.ability.defense;
                            var reaction = response.ability.reaction;
                            var agile = response.ability.agile;
                            
                            showGraph($("#ability"), attack, health, defense, reaction, agile);
                            $("#attack").html(attack);
                            $("#health").html(health);
                            $("#defense").html(defense);
                            $("#reaction").html(reaction);
                            $("#agile").html(agile);
                        }
                        else {
                            console.log(response.message.statement);
                        }
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            }

            // Description Update
            $("#description").parent().dblclick(function() {
                $("#description").prop('disabled', false);
                $("#description").focus();
            })
            $("#description").focusout(function() {
                $("#description").prop('disabled', true);
            })

            window.addEventListener("load", function(event) {
                setStatus();
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
                                <a class="nav-link" href="main.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="status.php">Status</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="aincrad.php">Aincrad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="guild.php">Guild</a>
                            </li>
                        </ul>
                        <div class="input-group w-25">
                            <input type="text" class="form-control" placeholder="username" required>
                                <button type="button" class="btn btn-danger" id="search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </input>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card header-gradient" style="height: 86vh">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span id="playerID">#CR000001</span>
                                    <span id="playerNmae">桐谷和人</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="ability">
                                    <!-- Nothing -->
                                </canvas>
                            </div>
                            <div class="card-footer">
                                <div>
                                    <div class="d-flex justify-content-center text-center">
                                        <span class="col-6">Attack</span>
                                        <span class="col-6" id="attack"></span>
                                    </div>
                                    <div class="d-flex justify-content-center text-center">
                                        <span class="col-6">Health</span>
                                        <span class="col-6" id="health"></span>
                                    </div>
                                    <div class="d-flex justify-content-center text-center">
                                        <span class="col-6">Defense</span>
                                        <span class="col-6" id="defense"></span>
                                    </div>
                                    <div class="d-flex justify-content-center text-center">
                                        <span class="col-6">Reaction</span>
                                        <span class="col-6" id="reaction"></span>
                                    </div>
                                    <div class="d-flex justify-content-center text-center">
                                        <span class="col-6">Agile</span>
                                        <span class="col-6" id="agile"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-8">
                        <div class="card header-gradient" style="height: 42vh">
                            <div class="card-header">
                                <span>Description</span>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" id="description" style="background-color: inherit; color: white; height: 100%;" disabled></textarea>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <i class="bi bi-lightbulb"></i>
                                        Double-click on textarea to edit description.
                                    </span>
                                    <span id="descriptionERR" style="color: rgb(200, 0, 0)">(ERR-TEXT-TEMP)</span>
                                </div>
                            </div>
                        </div>

                        <div style="height: 2vh"></div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card header-gradient" style="height: 42vh;">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Aincrad</span>
                                            <span id="level">#1</span>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                    </div>
                                    <div class="card-footer">
                                        <span>⭐💥</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card header-gradient" style="height: 42vh;">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Guild</span>
                                            <span id="guild">Unknown...</span>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                    </div>
                                    <div class="card-footer">
                                        <span>⭐💥</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>