$(document).ready(function () {
    if ($.cookie("cookie_notification") === undefined) {
        $("#cookie-notification").show("slow");
    }
});

$("#cookie-accept").on("click", function () {
    $.cookie("cookie_notification", "accepted", { expires: 1, path: "/" });
    $("#cookie-notification").hide("slow");
});

$("#cookie-reject").on("click", function () {
    $.cookie("cookie_notification", "rejected", { expires: 1, path: "/" });
    $("#cookie-notification").hide("slow");
});
