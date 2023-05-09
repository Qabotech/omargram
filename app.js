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
$("body > .overlay").hide();
$("#stories .story").click(function () {
    $(this).toggleClass("full");
    $(".story").hide();
    $("nav").hide();
    $("#stories i").toggleClass("full");
    $("#stories").toggleClass("full");
    $("body > .overlay").show();
});
function wrapSameClassElements(klass) {
    const classes = $('[class*="' + klass + '"]').map(function () {
        return $(this).attr('class').split(' ').filter(c => c.startsWith(klass))[0];
    }).get();
    const uniqueClasses = [...new Set(classes)];

    uniqueClasses.forEach(cls => {
        const clsElements = $('.' + cls);
        clsElements.each(function (index) {
            if (index > 0) {
                if ($(this).hasClass("story")) {
                    $(this).addClass('sub-story');
                }
            }

        });
    });
}
wrapSameClassElements("s-id")

function storyDone() {
    $("#stories i").toggleClass("full");
    $("body > .overlay").hide();
    for (let i = 0; i < story.length; i++) {
        $(story[i]).removeClass("full");
    }
    $(".story").show();
    $(".sub-story").hide();
    wrapSameClassElements("s-id")
    $("nav").show();
    temp = 0;
}
$("body > .overlay").click(storyDone);
$("#stories .fa-angle-right").click(function () {
    if ($(this).hasClass("full") == true) {
        for (let i = 0; i < story.length; i++) {
            if ($(story[i]).hasClass("full") == true) {
                temp = i;
                $(story[i]).removeClass("full");
            }
        }
        if ((temp + 1) <= (story.length - 1)) {
            $(story[temp + 1]).addClass("full");
            console.log(temp + "2");
        }
        if (temp == (story.length - 1)) {
            storyDone();
        }
    }
});
$("#stories .fa-angle-left").click(function () {
    if ($(this).hasClass("full") == true) {
        for (let i = 0; i < story.length; i++) {
            if ($(story[i]).hasClass("full") == true) {
                temp = i;
                $(story[i]).removeClass("full");
            }
        }
        console.log(temp + "1");
        if ((temp - 1) <= (story.length - 1)) {
            $(story[temp - 1]).addClass("full");
            console.log(temp + "2");
        }
        if (temp == (story.length - 1)) {
            storyDone();
        }
    }
});

