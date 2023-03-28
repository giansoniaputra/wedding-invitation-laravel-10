$(document).ready(function() {
    $("#username").on("click", function(){
        $("#username").removeClass('is-invalid');
        $("#password").removeClass('is-invalid');
        $("#error").addClass('d-none');
    })
    $("#password").on("click", function(){
        $("#username").removeClass('is-invalid');
        $("#password").removeClass('is-invalid');
        $("#error").addClass('d-none');
    })
})