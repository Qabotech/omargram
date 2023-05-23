$(document).ready(function () {
    var userId = localStorage.getItem("ID");
    if (userId != null) {
        $("#user_id").val(userId);
        $("#user_id1").val(userId);
    }
});
$('#post').click(function () {
    $("#post-form").show();
    $("#story-form").hide();
    $("#story").prop("checked", false);
});
$('#story').click(function () {
    $("#post-form").hide();
    $("#story-form").show();
    $("#post").prop("checked", false);
});

$("#story-form").hide();