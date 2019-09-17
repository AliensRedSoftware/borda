$(document).ready(function() {

    $('#theme').submit(function(event) {
        event.preventDefault();
        $.cookie('cookie_name', 'cookie_value');
        alert($.cookie('cookie_name'));
    });
});
