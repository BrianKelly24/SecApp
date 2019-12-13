$(document).ready(function() {
    
    // code $("") is how you create an object in JavaScript
    // When #hideLogin element is clicked we are going to do the below code eg hide and show
    
    $("#hideLogin").click(function(){
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $("#hideRegister").click(function() {
        $("#loginForm").show();
        $("#registerForm").hide();
    });
});