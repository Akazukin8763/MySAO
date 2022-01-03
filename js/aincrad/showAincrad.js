import { showGraph } from "../ability/showGraph.js";

export function showAincrad(index = 0) {
    var length = 100;

    // Indicators
    var indicators = $("#indicatorsAincrad");
    indicators.empty();

    for (let i = 0; i < length / 10; i++) {
        var indicatorsButton = $('<button type="button" data-bs-target="#carouselAincrad" data-bs-slide-to="' + i + '" aria-label="Slide ' + i + 1+ '"></button>');
        if (i == 0) indicatorsButton.addClass("active");

        indicatorsButton.appendTo(indicators);
    }

    // Inner
    var inner = $("#innerAincrad");
    inner.empty();

    for (let i = 0; i < length / 10; i++) {
        var innerItem = $('<div class="carousel-item">');
        if (i == index) innerItem.addClass("active");

        // 0 ~ 4
        $('<br>').appendTo(innerItem);
        var inner1 = $('<div class="row"></div>');
        inner1.appendTo(innerItem);
        // 5 ~ 9
        $('<br>').appendTo(innerItem);
        var inner2 = $('<div class="row"></div>');
        inner2.appendTo(innerItem);
        // All
        var innerAll = [inner1, inner2];

        for (let j = 0; j < 10; j++) {
            if (i * 10 + j >= length) break;

            var col = $('<div class="col-md-1-5"></div>');
            var card = $('<div class="card"></div>');
            var cardImage = $('<div class="card-image"></div>');
            var cardBody = $('<div class="card-body"></div>');

            // Image
            if ((i * 10 + j + 1) == 74) $('<img src="src/image/level74.gif" class="card-img-top">').appendTo(cardImage);
            else $('<img src="src/image/Tier-S_Forest.png" class="card-img-top">').appendTo(cardImage);
            $('<div>Levels ' + (i * 10 + j + 1) + '</div>').appendTo(cardImage);

            // Body
            $('<h5 class="card-title">Main Area</h5>').appendTo(cardBody);
            $('<p class="card-text">' + (i * 10 + j + 1) + '</p>').appendTo(cardBody);
            $('<h5 class="card-title">Major Area</h5>').appendTo(cardBody);
            $('<p class="card-text">' + (i * 10 + j + 1) + '</p>').appendTo(cardBody);

            cardImage.appendTo(card);
            cardBody.appendTo(card);
            card.appendTo(col);
            col.appendTo(innerAll[Math.floor(j / 5)]);

            card.click(function() {
                // SQL
                //console.log((i * 10 + j + 1));

                $("#description").modal("show");
                $(".carousel").carousel("pause");

                // Level
                $("#descriptionHeaderTitle").html("Levels：" + (i * 10 + j + 1) + "｜Description");
                $("#mainArea").html("Main Area：" + "Unknown...");
                $("#mainDescription").html("Unknown...");
                $("#majorArea").html("Major Area：" + "Unknown...");
                $("#majorDescription").html("Unknown...");
                $("#landscape").html("Landscape");
                $("#landscapeDescription").html("Unknown...");

                // Enemy
                $("#enemyHeaderTitle").html("Levels：" + (i * 10 + j + 1) + "｜Enemy");

                /*
                Enemy
                */
                var boss = $("#boss");
                boss.empty();

                var mobs = $("#mobs");
                mobs.empty();

                //for (let i = 0; i < 1; i++) {}

                var title = $('<div class="d-flex justify-content-between align-items-center"></div>')
                var description = $('<p></p>');
                var chart = $('<canvas></canvas>');

                let is_boss = 1;
                if (is_boss == 1) {
                    title.appendTo(boss);
                    description.appendTo(boss);
                    chart.appendTo(boss);
                }
                else {
                    title.appendTo(mobs);
                    description.appendTo(mobs);
                    chart.appendTo(mobs);
                }

                showGraph(chart, 10, 20, 30, 40, 50);
                chart.css({ "display": "none" });

                // Name
                var name = $('<span style="font-weight: bold">' + "金牛國王亞斯特留斯" + '</span>')
                var detail = $('<span class="detail bi bi-clipboard-data"></span>')

                var flag = false;
                detail.click(function() {
                    if (flag) chart.css({ "display": "none" });
                    else chart.css({ "display": "block" });
                    flag = !flag;
                });

                name.appendTo(title);
                detail.appendTo(title);

                // Desciption
                description.html("金牛族能連續使出產生麻痹效果的劍技「麻痹衝擊」和「麻痹爆破」。");
            });
        }

        innerItem.appendTo(inner);
    }
}