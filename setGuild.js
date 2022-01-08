import * as guild from "./js/guild/showGraph.js";
export function showGuild(index = 0) {
    let noName = "[No Name]";
    let noDescription = "...";
    let allPlayer;
    let guild_person;
    ajax_getPlayerList().then(function(response) {
        if (response.message.successed) {
           //console.log(response);
           allPlayer = response.playerList;
           console.log(allPlayer);
        }
        else
            return;
    }).catch(function(jqXHR) {
        console.log(jqXHR)
    });
    ajax_getGuildALL().then(function(response) {
        if (response.message.successed) {
            console.log(response);        
            
            
            let guildsInfo = response.guildsInfo;
            let length = guildsInfo.length;

            // Indicators
            var indicators = $("#indicatorsGuild");
            indicators.empty();

            for (let i = 0; i < length / 2; i++) {
                var indicatorsButton = $('<button type="button" data-bs-target="#indicatorsGuild" data-bs-slide-to="' + i + '" aria-label="Slide ' + i + 1+ '"></button>');
                if (i == 0) indicatorsButton.addClass("active");

                indicatorsButton.appendTo(indicators);
            }

            


            var quit = $("#quit");
            quit.click(function() {     
                var yes=window.confirm("你確定嗎?");
                if(yes){
                    ajax_quitGuild(my_guildName).then(function(response) {
                        if (response.message.successed) {
                            window.alert("成功退出公會");
                            location.href="Guild.php";
                        }
                    }).catch(function(jqXHR) { 
                        console.log(jqXHR);
                    });    
                } 
            });


            var create = $("#buildGuild");
            create.click(function() {     
                $("#create").modal("show");
                $(".carousel").carousel("pause");
            });

            var newGuild = $("#create_guild");

            newGuild.click(function() {
                var newName =  $("#uploadTitle").val();
                console.log(newName);
                ajax_createGuild(newName).then(function(response) {
                    if (response.message.successed) {
                        $("#create").modal("hide");
                        window.alert("成功新建公會");
                        location.href="Guild.php";
                    }
                }).catch(function(jqXHR) { 
                    console.log(jqXHR);
                });
            });



            // Inner
            var inner = $("#innerGuild");
            inner.empty();

            for (let i = 0; i < length / 2; i++) {
                var innerItem = $('<div class="carousel-item">');
                if (i == index) innerItem.addClass("active");

                // 0 ~ 4
                $('<br>').appendTo(innerItem);
                var inner1 = $('<div class="row"></div>');
                inner1.appendTo(innerItem);
                // All
                var innerAll = [inner1];

                for (let j = 0; j < 2; j++) {
                    if (i * 2 + j >= length) break;

                    let guildInfo = guildsInfo[i * 2 + j];
                    let guild_name = guildInfo.guild_name;
                    let guild_establishment = guildInfo.establishment;
                    

                    for(var k=0;k<allPlayer.length;k++){
                        if(guildInfo.ID == allPlayer[k].ID){
                            guild_person = allPlayer[k].name;
                            break;
                        }

                    }

                    var col = $('<div class="col-md"></div>');
                    var card = $('<div class="card card-cover h-100 overflow-hidden shadow-lg rounded-5"></div>');
                    var cardBody = $('<div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1"></div>');

                    // Body
                    $('<h2 class="fw-bold">' + guild_name +'</h2>').appendTo(cardBody);
                    $('<ul class="d-flex mt-auto">').appendTo(cardBody);
                    $('<li class="me-auto" style="list-style-type: none;"></li><br><br>').appendTo(cardBody);
                    $('<br><li class="d-flex align-items-center me-3"><small><img src="src/image/level74.gif"width="32" height="32" class="rounded-circle border border-white"> '+guild_person+'</small></li>').appendTo(cardBody);
                    $('<li class="me-auto" style="list-style-type: none;"><small>'+guild_establishment+'</small></li>').appendTo(cardBody);

                    cardBody.appendTo(card);
                    card.appendTo(col);
                    col.appendTo(innerAll[Math.floor(j / 2)]);
                    let guildsNumber = 1;

                    

                    card.click(function() {     
                       
                        //每次生成圖表前要先破壞前有的
                        $("#guildChart").remove();  
                        $("#Chart").append('<canvas id="guildChart"></canvas>');


                        for(var k=0;k<allPlayer.length;k++){
                            if(guildInfo.ID == allPlayer[k].ID){
                                guild_person = allPlayer[k].name;
                                break;
                            }
                        }
                        ajax_getGuildDetail(guild_name).then(function(response) {
                            if (response.message.successed) {
                                let detail = new Map();

                                response.memberDistribution.forEach(function(element) {
                                    detail.set(element.lv, element.num);
                                });
                                //console.log(detail);
                                guildsNumber = detail.size;
                                //console.log(guildsNumber);
                                guild.showGraph($("#guildChart"), [...detail.keys()], [...detail.values()]);

                                $("#description").modal("show");
                                $(".carousel").carousel("pause");

                                // Level
                                $("#descriptionHeaderTitle").html("SAO公會｜Description");
                                $("#guildName").html("公會名稱：");
                                $("#mainDescription").html(guild_name);
                                $("#guildPerson").html("創建人：");
                                $("#personDescription").html(guild_person);
                                $("#date").html("創建日期：");
                                $("#dateDescription").html(guild_establishment);

                                //其他資訊
                                $("#guildTitle").html("SAO公會：" + (i * 2 + j + 1) + "｜Other Description");

                                /*
                                Enemy
                                */
                                var info = $("#info");
                                info.empty();


                                var chart = $('<canvas"></canvas>');
                                var title = $('<div class="d-flex justify-content-between align-items-center"></div>')
                                var description = $('<p></p>');
                                
                                title.appendTo(info);

                                // people
                                var people = $('<span style="font-weight: bold">' + guildsNumber + '人</span>')
                                
                                people.appendTo(title);

                            }
                        }).catch(function(jqXHR) { // 錯誤則只顯示自己
                            console.log(jqXHR);
                        });


                       
                    });
                }

                innerItem.appendTo(inner);
            }
        }
        else
            return;
    }).catch(function(jqXHR) {
        console.log(jqXHR)
    });

    
}

function ajax_getGuildALL() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Guild/getAll.php",
            dataType: "json",
            data: {
            },
            success: function(response) {
                resolve(response)
            },
            error: function(jqXHR) {
                reject(jqXHR)
            }
        })
    });
}

function ajax_getPlayerList() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Player/getPlayerList.php",
            dataType: "json",
            data: {
            },
            success: function(response) {
                resolve(response)
            },
            error: function(jqXHR) {
                reject(jqXHR)
            }
        })
    });
}
function ajax_getGuildDetail(__guild_name) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Guild/getGuildDetail.php",
            dataType: "json",
            data: {
                guild_name: __guild_name
            },
            success: function(response) {
                resolve(response)
            },
            error: function(jqXHR) {
                reject(jqXHR)
            }
        })
    });
}

function ajax_createGuild(__guild_name) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Guild/createGuild.php",
            dataType: "json",
            data: {
                guild_name: __guild_name
            },
            success: function(response) {
                resolve(response)
            },
            error: function(jqXHR) {
                reject(jqXHR)
            }
        })
    });
}

function ajax_quitGuild(__guild_name) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Player/updatePlayer.php",
            dataType: "json",
            data: {
                guild_name: __guild_name
            },
            success: function(response) {
                resolve(response)
            },
            error: function(jqXHR) {
                reject(jqXHR)
            }
        })
    });
}
