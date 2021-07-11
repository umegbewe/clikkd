$(document).ready(function() {

    //On click signup, hide login and diplay register
    $("#signup").click(function() {
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });

    //On click register, hide register and diplay login
    $("#signin").click(function() {
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    });
});