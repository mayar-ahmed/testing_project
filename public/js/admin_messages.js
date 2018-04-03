$(document).ready( function() {


    $('.rep').click(function(e){
    e.preventDefault();
   $(this).next(".first").toggle();
    });
});


$(document).ready( function() {
    $('.sub').click(function(e){
    $(this).parent().toggleClass();
});
});
 
/*
function showDiv(){
    //document.getElementById($id1).style.display = "block";
    //document.getElementById($id2).style.display = "block";
    //jQuery(this).parent().next(".first").toggle();
    $(this).next(".first").toggle();
}

function hideDiv(){
    //document.getElementById($id1).style.display = "none";
    //document.getElementById($id2).style.display = "none";
    $(this).parent(".first").toggle();
}


$('.table > tbody > tr').on('click' , function() {
    // row was clicked
   document.getElementById('first').style.display = "block";
});

*/

/*
jQuery(document).ready(function($) {
    $("#table-row").click(function() {
        document.getElementById('first').style.display = "block";
        //window.document.location = $(this).data("href");
    });
});
*/