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
            $("#_test_btn").click(function() {
                var __name = "桐谷和人";

                $.ajax({
                    type: "POST",
                    url: "API/showPlayer.php",
                    dataType: "json",
                    data: {
                        // NONE
                        name: __name,
                    },
                    success: function(response) {
                        if (response.result) { // 回傳的 json 中含有 result
                            console.log(response.result);
                            console.log(response.result[0].ds);
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
            
            $("#_insertRole_btn").click(function() {
                var _id = $("#_id").val();
                var _name = $("#_name").val();
                var _health = $("#_health").val();
                var _attack = $("#_attack").val();
                var _defense = $("#_defense").val();
                var _reaction = $("#_reaction").val();
                var _agile = $("#_agile").val();

                $.ajax({
                    type: "POST",
                    url: "API/insertRole.php",
                    dataType: "json",
                    data: {
                        _id: _id,
                        _name: _name,
                        _health: _health,
                        _attack: _attack,
                        _defense: _defense,
                        _reaction: _reaction,
                        _agile: _agile
                    },
                    success: function(response) {
                        if (response.result) {
                            console.log(response.result);
                            console.log(response.result[0].ds);
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
        <h5>test</h5>
        <button type="button" class="btn btn-primary" id="_test_btn">SHOW IN CONSOLE</button><br><br>
        <form>
            <label for="_id">ID: </label>
            <input type="text" id="_id" name="_id"><br><br>
            <label for="_name">name: </label>
            <input type="text" id="_name" name="_name"><br><br>
            <label for="_health">health: </label>
            <input type="text" id="_health" name="_health"><br><br>
            <label for="_attack">attack: </label>
            <input type="text" id="_attack" name="_attack"><br><br>
            <label for="_defense">defense: </label>
            <input type="text" id="_defense" name="_defense"><br><br>
            <label for="_reaction">reaction: </label>
            <input type="text" id="_reaction" name="_reaction"><br><br>
            <label for="_agile">agile: </label>
            <input type="text" id="_agile" name="_agile"><br><br>
            <input type="submit" id="_submit" value="Submit">
        </form>
        <button type="button" class="btn btn-primary" id="_insertRole_btn">Insert the role</button><br><br>
    </body>
</html>