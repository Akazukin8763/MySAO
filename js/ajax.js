/**
 * Player
 */

// searchPlayer
export function ajax_searchPlayer(__name) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Player/searchPlayer.php",
            dataType: "json",
            data: {
                name: __name
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

// updatePlayer_description
export function ajax_updatePlayer_description(__description) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Player/updatePlayer.php",
            dataType: "json",
            data: {
                description: __description
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

// updatePlayer_level
export function ajax_updatePlayer_level(__levels) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "API/Player/updatePlayer.php",
            dataType: "json",
            data: {
                levels: __levels
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

/**
 * Aincrad
 */

//


/**
 * Guild
 */

// getGuildDetail
export function ajax_getGuildDetail(__guild_name) {
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