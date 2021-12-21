<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <title>Welcome</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="module">
            $("#btn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "API/showPlayer.php",
                    dataType: "json",
                    data: {
                        // NONE
                    },
                    success: function(response) {
                        if (response.result) { // 回傳的 json 中含有 result
                            console.log(response.result);
                        }
                        else {
                            console.log(response.errorMsg);
                        }
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
        </script>
    </head>
    <body>
        <h5>123</h5>
        <button type="button" class="btn btn-primary" id="btn">SHOW IN CONSOLE</button>
    </body>
</html>