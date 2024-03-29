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
            body {
                overflow: hidden;
            }

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
            .modal-gradient {
                background: linear-gradient(270deg, rgba(57, 170, 96, 0.9)0%, rgba(135, 189, 201, 1)67%);
                background: -moz-linear-gradient(270deg, rgba(57, 170, 96, 0.9)0%, rgba(135, 189, 201, 1)67%);
                background: -webkit-linear-gradient(270deg, rgba(57, 170, 96, 0.9)0%, rgba(135, 189, 201, 1)67%);
                background: -o-linear-gradient(270deg, rgba(57, 170, 96, 0.9)0%, rgba(135, 189, 201, 1)67%);
            }
            .modal-header {
                font-weight: bold;
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

            .detail:hover {
                transform: scale(1.3);
            }
        </style>

        <script type="module">
            import { setModal } from "./js/aincrad/setModal.js";
            setModal();

            import { showAincrad } from "./js/aincrad/showAincrad.js";
            window.addEventListener("load", function(event) {
                var search, tag, index = 0;

                try {
                    search = location.search.split("?")[1];
                    tag = search.split("=")[0];
                    index = search.split("=")[1];

                    if (tag != "index") index = 0;
                }
                catch {
                    // Nothing
                }
                finally {
                    showAincrad(index % 10);
                }
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
                                <a class="nav-link" href="status.php">Status</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="aincrad.php">Aincrad</a>
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
                <div id="carouselAincrad" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators" style="bottom: -5vh;" id="indicatorsAincrad">
                        <!-- Nothing -->
                    </div>
                    <div class="carousel-inner" id="innerAincrad">
                        <!-- Nothing -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAincrad" data-bs-slide="prev" style="left: -15%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAincrad" data-bs-slide="next" style="right: -15%;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Modal Description -->
            <div class="modal fade" id="description" tabindex="-1" aria-labelledby="description" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modal-gradient">
                        <!-- Description Header -->
                        <div class="modal-header justify-content-center">
                            <span class="modal-title" id="descriptionHeaderTitle"></span>
                        </div>
                        <!-- Description Body -->
                        <div class="modal-body" id="descriptionBody">
                            <h5 id="mainArea"></h5>
                            <p id="mainDescription"></p>
                            <h5 id="majorArea"></h5>
                            <p id="majorDescription"></p>
                            <h5 id="landscape"></h5>
                            <p id="landscapeDescription"></p>
                        </div>
                        <!-- Description Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" id="description-enemy">Enemy &gt;</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Enemy -->
            <div class="modal fade" id="enemy" tabindex="-1" aria-labelledby="enemy" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modal-gradient">
                        <!-- Enemy Header -->
                        <div class="modal-header justify-content-center">
                            <span class="modal-title" id="enemyHeaderTitle"></span>
                        </div>
                        <!-- Enemy Body -->
                        <div class="modal-body" id="enemyBody">
                            <h5>Boss</h5>
                            <div id="boss">
                                <!-- Nothing -->
                            </div>
                            <h5>Mobs</h5>
                            <div id="mobs">
                                <!-- Nothing -->
                            </div>
                        </div>
                        <!-- Enemy Footer -->
                        <div class="modal-footer d-flex justify-content-start">
                            <button type="button" class="btn btn-outline-dark" id="enemy-description">&lt; Desciption</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>