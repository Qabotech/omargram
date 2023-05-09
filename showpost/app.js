var currentScrollPos = 0;
$("#stories .fa-angle-right").click(function () {
    currentScrollPos = $(".stories").scrollLeft();
    $(".stories").scrollLeft(currentScrollPos + 400);
    $("#stories .fa-angle-left").show();
});
$("#stories .fa-angle-left").hide();
$("#stories .fa-angle-left").click(function () {
    currentScrollPos = $(".stories").scrollLeft();
    $(".stories").scrollLeft(currentScrollPos - 400);
    if (currentScrollPos <= 400) {
        $("#stories .fa-angle-left").hide();
    }
    else {
        $("#stories .fa-angle-left").show();
    }
});
$(".post p").each(function () {
    var maxLength = 150;
    var text = $(this).text();
    if (text.length > maxLength) {
        var trimmedText = text.substr(0, maxLength);
        $(this).text(trimmedText + "... ");
        var readMore = $("<a href=''>Mehr Lesen</a>");
        readMore.click(function (event) {
            event.preventDefault();
            if ($(this).text() === "Mehr Lesen") {
                $(this).text("Wieniger Lesen");
                $(this).prev().text(text);
            } else {
                $(this).text("Mehr Lesen");
                $(this).prev().text(trimmedText + "... ");
            }
        });
        $(this).after(readMore);
    }
});
var clicks = 0;


$(".like-post").click(function () {
    $(this).toggleClass("fa-regular");
    $(this).toggleClass("fa-solid");
    $(this).toggleClass("liked");
});
$("#nav-profile").attr("src", localStorage.getItem("user_avatar"));
$(".liked").click(
    function () {
        $(this).toggleClass("unliked");
        $(this).toggleClass("liked");
    }
)
$(document).ready(function () {
    $(".like-post").click(function () {
        var post_id = $(this).attr("id").split("-")[2];
        var like_count = parseInt($("#like-count-" + post_id).text());
        clicks++;
        $.ajax({
            url: "../actions/like.php",
            type: "POST",
            data: { postId: post_id, likeCount: like_count },
            success: function (data) {
                if (data == "liked") {
                    if (clicks === 1) {
                        like_count++;
                    } else if (clicks === 2) {
                        like_count--;
                        clicks = 0;
                    }
                    if (like_count < 0) {
                        like_count = 0;
                    }
                    if (data == "liked") {
                        $("#like-count-" + post_id).text(like_count);
                    }

                }
            }
        });
    });
});


