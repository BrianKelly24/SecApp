<?php

if(isset($_POST['loginButton'])){
    //Login button was pressed
    $username = $_POST['loginUsername'];    //Login username is the name made on the html input tag in register page
    $password = $_POST['loginPassword']; 
    
    //Login Function called login
    $result = $account->login($username, $password);

    //If the login was successful this code directs the user to the index page
    if($result == true){
        //Here we created a Session variable called userLoggedIn and it stores username
        //To use SESSION it needs to be declared, it is declared in config file
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
?>