$(document).ready(function () {
    $('.book-item').mouseover(function() {
        $(this).children('.edit-panel').show();
    }).mouseout(function(){
        $(this).children('.edit-panel').hide();
    });
});
