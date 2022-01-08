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
            $("#_login_btn").click(function() {
                var _name = $("#_name0").val();

                $.ajax({
                    type: "POST",
                    url: "API/Player/Login.php",
                    dataType: "json",
                    data: {
                        name: _name
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            
            $("#_registerPlayer_btn").click(function() {
                var _name = $("#_name").val();
                var _health = $("#_health").val();
                var _attack = $("#_attack").val();
                var _defense = $("#_defense").val();
                var _reaction = $("#_reaction").val();
                var _agile = $("#_agile").val();

                $.ajax({
                    type: "POST",
                    url: "API/Player/registerPlayer.php",
                    dataType: "json",
                    data: {
                        name: _name,
                        health: _health,
                        attack: _attack,
                        defense: _defense,
                        reaction: _reaction,
                        agile: _agile
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.ID);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            /*
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
            })*/

            $("#_searchPlayer_btn").click(function() {
                var _name = $("#_name2").val();
                
                $.ajax({
                    type: "POST",
                    url: "API/Player/searchPlayer.php",
                    dataType: "json",
                    data: {
                        name: _name
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.playerInfo);
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
                    url: "API/Player/updatePlayer.php",
                    dataType: "json",
                    data: {
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
                    url: "API/Player/updatePlayer.php",
                    dataType: "json",
                    data: {
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
                var _guild_name = $("#_guild_name").val();

                $.ajax({
                    type: "POST",
                    url: "API/Player/updatePlayer.php",
                    dataType: "json",
                    data: {
                        guild_ID: _guild_ID,
                        guild_name: _guild_name
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            /*
            $("#_updateAbility_btn").click(function() {
                var _id = $("#_id").val();
                var _health = $("#_health").val();
                var _attack = $("#_attack").val();
                var _defense = $("#_defense").val();
                var _reaction = $("#_reaction").val();
                var _agile = $("#_agile").val();

                $.ajax({
                    type: "POST",
                    url: "API/Player/updateAbility.php",
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
            })*/

            $("#_getAincrad_btn").click(function() {
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
            
            $("#_getAincradDetail_btn").click(function() {
                var _levels = $("#_level").val();

                $.ajax({
                    type: "POST",
                    url: "API/Aincrad/getAincradDetail.php",
                    dataType: "json",
                    data: {
                        levels: _levels
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.levelInfo);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            
            $("#_getGuild_btn").click(function() {

                $.ajax({
                    type: "POST",
                    url: "API/Guild/getAll.php",
                    dataType: "json",
                    data: {
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.guildsInfo);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })

            $("#_getGuildDetail_btn").click(function() {
                var _guild_name = $("#_guild_name2").val();

                $.ajax({
                    type: "POST",
                    url: "API/Guild/getGuildDetail.php",
                    dataType: "json",
                    data: {
                        guild_name: _guild_name
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.guildInfo);
                        console.log(response.memberDistribution);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            
            $("#_getPlayerList_btn").click(function() {
                var _orderBy = $("#_orderBy").val();

                $.ajax({
                    type: "POST",
                    url: "API/Player/getPlayerList.php",
                    dataType: "json",
                    data: {
                        orderBy: _orderBy
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.playerList);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
            
            $("#_createGuild_btn").click(function() {
                var _guild_name = $("#_guild_name3").val();

                $.ajax({
                    type: "POST",
                    url: "API/Guild/createGuild.php",
                    dataType: "json",
                    data: {
                        guild_name: _guild_name
                    },
                    success: function(response) {
                        console.log(response.message);
                        console.log(response.guild_ID);
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR);
                    }
                })
            })
        </script>
    </head>
    <body>
        <h1>Login</h1>
        <label for="_name0">name: </label>
        <input type="text" id="_name0" name="_name0"><br>
        <button type="button" class="btn btn-primary" id="_login_btn">Login</button><br><br>

        <h1>Register player</h1>
        <label for="_name">name: </label>
        <input type="text" id="_name" name="_name"><br>
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
        <button type="button" class="btn btn-primary" id="_registerPlayer_btn">Register</button>
<!--
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
-->
        <h1>searchPlayer</h1>
        <label for="_name2">name: </label>
        <input type="text" id="_name2" name="_name2"><br>
        <button type="button" class="btn btn-primary" id="_searchPlayer_btn">Get</button><br><br>

        <h1>Update player</h1>
        <label for="_description">description: </label>
        <input type="text" id="_description" name="_description">
        <button type="button" class="btn btn-primary" id="_updateDescription_btn">Update</button><br>
        <label for="_levels">levels: </label>
        <input type="text" id="_levels" name="_levels">
        <button type="button" class="btn btn-primary" id="_updateLevels_btn">Update</button><br>
        <label for="_guild_ID">guild_ID: </label>
        <input type="text" id="_guild_ID" name="_guild_ID"><br>
        <label for="_guild_name">guild_name: </label>
        <input type="text" id="_guild_name" name="_guild_name">
        <button type="button" class="btn btn-primary" id="_updateGuildID_btn">Update</button><br><br>
        
        <h1>Get Aincrad Table</h1>
        <button type="button" class="btn btn-primary" id="_getAincrad_btn">Get</button><br><br>
        
        <h1>Get AincradDetail</h1>
        <label for="_level">levels: </label>
        <input type="text" id="_level" name="_level">
        <button type="button" class="btn btn-primary" id="_getAincradDetail_btn">Get</button><br><br>
        
        <h1>Get Guild Table</h1>
        <button type="button" class="btn btn-primary" id="_getGuild_btn">Get</button><br><br>

        <h1>Get GuildDetail</h1>
        <label for="_guild_name2">guild_name: </label>
        <input type="text" id="_guild_name2" name="_guild_name2">
        <button type="button" class="btn btn-primary" id="_getGuildDetail_btn">Get</button><br><br>
        
        <h1>Get PlayerList</h1>
        <label for="_orderBy">orderBy: </label>
        <input type="text" id="_orderBy" name="_orderBy">
        <button type="button" class="btn btn-primary" id="_getPlayerList_btn">Get</button><br><br>
        
        <h1>Create Guild</h1>
        <label for="_guild_name3">guild_name: </label>
        <input type="text" id="_guild_name3" name="_guild_name3">
        <button type="button" class="btn btn-primary" id="_createGuild_btn">Create</button><br><br>
    </body>
</html>