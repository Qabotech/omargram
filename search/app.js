$(".acc").hide();
$(document).on('keypress', function (e) {
    if (e.which == 13) {
        var filter = $('#search-input').val(),
            count = 0;
        $('#results .acc .headLine').each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).parent().hide();
            } else {
                $(this).parent().show();
                count++;
            }
        });
    }
});