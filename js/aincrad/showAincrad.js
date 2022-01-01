export function showAincrad() {
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
        if (i == 0) innerItem.addClass("active");

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
            $('<img src="src/image/Tier-S_Forest.png" class="card-img-top">').appendTo(cardImage);
            $('<div>Levels ' + ( i * 10 + j + 1) + '</div>').appendTo(cardImage);

            // Body
            $('<h5 class="card-title">Main Area</h5>').appendTo(cardBody);
            $('<p class="card-text">' + ( i * 10 + j + 1) + '</p>').appendTo(cardBody);
            $('<h5 class="card-title">Major Area</h5>').appendTo(cardBody);
            $('<p class="card-text">' + ( i * 10 + j + 1) + '</p>').appendTo(cardBody);

            cardImage.appendTo(card);
            cardBody.appendTo(card);
            card.appendTo(col);
            col.appendTo(innerAll[Math.floor(j / 5)]);
        }

        innerItem.appendTo(inner);
    }

}