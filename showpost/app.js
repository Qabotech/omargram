var currentScrollPos = 0;
var clicks = 0;
var story = $(".story");
let temp = 0;
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



$("#nav-profile").attr("src", localStorage.getItem("user_avatar"));
// $("#user_id").val()
console.log();
$(document).on("click", ".like-post", function () {
    $(this).toggleClass("unliked liked");
    $(this).toggleClass("fa-regular");
    $(this).toggleClass("fa-solid");
});
$(document).on("click", ".unliked", function () {
    var post_id = $(this).attr("id").split("-")[2];
    var like_count = parseInt($("#like-count-" + post_id).text());
    $(this).removeClass("unliked").addClass("liked");
    $("#like-count-" + post_id).text(like_count + 1);
    $.ajax({
        url: "../actions/like.php",
        type: "POST",
        data: { postId: post_id, likeCount: like_count + 1, userId: localStorage.getItem("ID") },
        success: function (data) {
            if (data === "liked") {
                if (like_count < 0) {
                    like_count = 0;
                }
            }
        }
    });
});

$(document).on("click", ".liked", function () {
    var post_id = $(this).attr("id").split("-")[2];
    var like_count = parseInt($("#like-count-" + post_id).text());
    $("#like-count-" + post_id).text(parseInt(like_count) - 1);
    $.ajax({
        url: "../actions/like.php",
        type: "POST",
        data: { postId: post_id, likeCount: like_count - 1, userId: localStorage.getItem("ID") },
        success: function (data) {
            if (data === "liked") {
                if (like_count < 0) {
                    like_count = 0;
                }
            }
        }
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