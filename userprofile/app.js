var pwd = $('.pass').text();
function hidePass() {
    var hiddenPassword = '';
    for (var i = 0; i < pwd.length; i++) {
        hiddenPassword += '*';
    }
    $('.pass').text(hiddenPassword);
    $('.pass').toggleClass("hidden");
    if ($('.pass').hasClass("hidden")) {
        $('.pass').text(hiddenPassword);
    }
    else {
        $('.pass').text(pwd);
    }
}
$('.password-toggle').click(function () {

    hidePass();
});
hidePass();