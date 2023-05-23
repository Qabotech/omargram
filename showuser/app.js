$(".post p", ".story p").each(function () {
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
                    if (clicks == 1) {
                        like_count++;
                        setTimeout(() => {
                            $(".like-post").trigger("click");
                        }, 100);
                        setTimeout(() => {
                            $(".like-post").toggleClass("fa-regular");
                            $(".like-post").toggleClass("fa-solid");
                            $(".like-post").toggleClass("liked");
                        }, 100);
                    } else if (clicks == 2) {
                        like_count--;
                        clicks = 0;
                    }
                    if (like_count < 0) {
                        like_count = 0;
                    }
                    $("#like-count-" + post_id).text(like_count);

                }
            }
        });
    });
});

function copyToClipboard(str) {
    var tempInput = document.createElement("input");
    tempInput.setAttribute("value", str);
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    alert("String has been copied to clipboard.");
}



var click = 1;
function toggleShow(element) {
    if (click == 1) {
        $(element).show();
    } else if (click == 2) {
        $(element).hide();
        click = 0;
    }
    click++;
}
$(".comment-form").hide();