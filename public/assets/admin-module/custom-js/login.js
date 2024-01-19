$(document).ready(function () {
    "use strict";
    $('.tooltipped').tooltip();
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $(function () {
        $(".preloader").fadeOut();
    });
});
