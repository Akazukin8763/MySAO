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
                var _name = $("#_name").val();

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
                var _name = $("#_name2").val();
                
                $.ajax({
                    type: "POST",
                    url: "API/getAbility.php",
                    dataType: "json",
                    data: {
                        name: _name
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

            $("#_updateDescription_btn").click(function() {
                var _id = $("#_id2").val();
                var _description = $("#_description").val();

                $.ajax({
                    type: "POST",
                    url: "API/updatePlayer.php",
                    dataType: "json",
                    data: {
                        id: _id,
                        description: _description
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            
            $("#_updateLevels_btn").click(function() {
                var _id = $("#_id2").val();
                var _levels = $("#_levels").val();

                $.ajax({
                    type: "POST",
                    url: "API/updatePlayer.php",
                    dataType: "json",
                    data: {
                        id: _id,
                        levels: _levels
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            
            $("#_updateGuildID_btn").click(function() {
                var _id = $("#_id2").val();
                var _guild_ID = $("#_guild_ID").val();

                $.ajax({
                    type: "POST",
                    url: "API/updatePlayer.php",
                    dataType: "json",
                    data: {
                        id: _id,
                        guild_ID: _guild_ID
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })

            $("#_updateAbility_btn").click(function() {
                var _id = $("#_id").val();
                var _health = $("#_health").val();
                var _attack = $("#_attack").val();
                var _defense = $("#_defense").val();
                var _reaction = $("#_reaction").val();
                var _agile = $("#_agile").val();

                $.ajax({
                    type: "POST",
                    url: "API/updateAbility.php",
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

            $("#_getAincrad_btn").click(function() {
                var _id = $("#_id").val();
                var _health = $("#_health").val();
                var _attack = $("#_attack").val();
                var _defense = $("#_defense").val();
                var _reaction = $("#_reaction").val();
                var _agile = $("#_agile").val();

                $.ajax({
                    type: "POST",
                    url: "API/Aincrad/getDescription.php",
                    dataType: "json",
                    data: {
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.levelsInfo);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
        </script>
    </head>
    <body>
        <h1>Register player</h1>
        <label for="_name">name: </label>
        <input type="text" id="_name" name="_name"><br>
        <button type="button" class="btn btn-primary" id="_registerPlayer_btn">Register</button><br><br>

        <h1>Register/Update ability</h1>
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
        <button type="button" class="btn btn-primary" id="_registerAbility_btn">Register</button>
        <button type="button" class="btn btn-primary" id="_updateAbility_btn">Update</button><br><br>
        
        <h1>Get ability</h1>
        <label for="_name2">name: </label>
        <input type="text" id="_name2" name="_name2"><br>
        <button type="button" class="btn btn-primary" id="_getAbility_btn">Get</button><br><br>

        <h1>Update player</h1>
        <label for="_id2">ID: </label>
        <input type="text" id="_id2" name="_id2"><br>
        <label for="_description">description: </label>
        <input type="text" id="_description" name="_description">
        <button type="button" class="btn btn-primary" id="_updateDescription_btn">Update</button><br>
        <label for="_levels">levels: </label>
        <input type="text" id="_levels" name="_levels">
        <button type="button" class="btn btn-primary" id="_updateLevels_btn">Update</button><br>
        <label for="_guild_ID">guild_ID: </label>
        <input type="text" id="_guild_ID" name="_guild_ID">
        <button type="button" class="btn btn-primary" id="_updateGuildID_btn">Update</button><br><br>
        
        <h1>Get Aincrad</h1>
        <button type="button" class="btn btn-primary" id="_getAincrad_btn">Get</button><br><br>
    </body>
</html>