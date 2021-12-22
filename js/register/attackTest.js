export function start() {
    var testing = $("#attackTest");
    testing.empty();

    // Generate Video
    var video = $('<video id="attackVideo" style="opacity: 0.25;"></video>');
    video.html('<source src="src/video/Starburst Stream.mp4" type="video/mp4"></source>');

    video.appendTo(testing);
    $("#attackVideo").prop("volume", 0.1);
    $("#attackVideo").trigger("play");
}