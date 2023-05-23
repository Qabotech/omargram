$("#email").val(localStorage.getItem("not_email"));

if (localStorage.getItem("PWD") === null) {
  $("#PWD").val('');
}
else{
$("#PWD").val(localStorage.getItem("PWD"));
}