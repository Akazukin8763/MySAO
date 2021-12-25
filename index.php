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

            $("#_registerPlayer_btn").click(function() {
                var _name = $("#_name").val();/*
                var _description =  $("#_description").val();
                var _levels =  $("#_levels").val();
                var _guild_ID =  $("#_guild_ID").val();*/

                $.ajax({
                    type: "POST",
                    url: "API/registerPlayer.php",
                    dataType: "json",
                    data: {
                        name: _name
                    },
                    success: function(response) {
                        console.log(response.ID);
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })

            $("#_registerAbility_btn").click(function() {
                var _id = $("#_id").val();
                var _health = $("#_health").val();
                var _attack = $("#_attack").val();
                var _defense = $("#_defense").val();
                var _reaction = $("#_reaction").val();
                var _agile = $("#_agile").val();

                $.ajax({
                    type: "POST",
                    url: "API/registerAbility.php",
                    dataType: "json",
                    data: {
                        id: _id,
                        health: _health,
                        attack: _attack,
                        defense: _defense,
                        reaction: _reaction,
                        agile: _agile
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })

            $("#_getAbility_btn").click(function() {
                var _id = $("#_id").val();

                $.ajax({
                    type: "POST",
                    url: "API/getAbility.php",
                    dataType: "json",
                    data: {
                        id: _id
                    },
                    success: function(response) {
                        console.log(response.ability);
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
        </script>
    </head>
    <body>
        <!--<button type="button" class="btn btn-primary" id="_test_btn">SHOW IN CONSOLE</button><br><br>-->
        <!--
        <label for="_name">description: </label>
        <input type="text" id="_description" name="_description"><br><br>
        <label for="_name">levels: </label>
        <input type="text" id="_levels" name="_levels"><br><br>
        <label for="_name">guild_ID: </label>
        <input type="text" id="_guild_ID" name="_guild_ID"><br><br>
        <input type="submit" id="_submit" value="Submit">-->

        <h1>Register player</h1>
        <label for="_name">name: </label>
        <input type="text" id="_name" name="_name"><br>
        <button type="button" class="btn btn-primary" id="_registerPlayer_btn">Register</button><br><br>

        <h1>Register ability</h1>
        <label for="_id">ID: </label>
        <input type="text" id="_id" name="_id"><br>
        <label for="_health">health: </label>
        <input type="text" id="_health" name="_health"><br>
        <label for="_attack">attack: </label>
        <input type="text" id="_attack" name="_attack"><br>
        <label for="_defense">defense: </label>
        <input type="text" id="_defense" name="_defense"><br>
        <label for="_reaction">reaction: </label>
        <input type="text" id="_reaction" name="_reaction"><br>
        <label for="_agile">agile: </label>
        <input type="text" id="_agile" name="_agile"><br>
        <button type="button" class="btn btn-primary" id="_registerAbility_btn">Register</button><br><br>
        
        <h1>Get ability</h1>
        <label for="_id">ID: </label>
        <input type="text" id="_id" name="_id"><br>
        <button type="button" class="btn btn-primary" id="_getAbility_btn">Get</button><br><br>
    </body>
</html>