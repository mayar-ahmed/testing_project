$(document).ready( function() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $('#toggle_search').click(function(e){
        e.preventDefault();
        $('#toggle_form').toggle();

    });

    $('#toggle_courses').click(function(e){
        e.preventDefault();
        $('#course_cat').toggle();

    });
});

