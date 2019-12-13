<?php

    //This is how we link other files to a specific file using includes then file path
    include("includes/config.php");
    include("includes/classes/Account.php");
    //THis class allows you to use the "Constants::$variableName" code which talks to the variables on constant class
    include("includes/classes/Constants.php");

    //Here we instantiate the Account class and sends $con variable that connects to the database to the Account class
    $account = new Account($con);

    include("includes/handlers/login-handler.php");
    include("includes/handlers/register-handler.php");

    //Function to show entered details in field boxes if login fails
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music App</title>

    <link rel="stylesheet" type="text/css" href="assets/css/register.css"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>   <!--Here we link our js file to register page  -->
</head>
<body>
    <?php
    if(isset($_POST['registerButton'])){
        echo'<script>
                $(document).ready(function() {
                    $("#loginForm").hide();
                    $("#registerForm").show();
                });
            </script>';                
    }
    else {
        echo'<script>
                $(document).ready(function() {
                    $("#loginForm").show();
                    $("#registerForm").hide();
                });
            </script>';          
    }

    ?>
    

    <div id="background">   <!--This background id will store the background image -->
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="Enter Username Here" value="<?php getInputValue('loginUsername') ?>" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password" placeholder="Enter Password Here" required>
                    </p>

                    <button type="submit" name="loginButton">Log In</button>
                    <div id="hasAccountText">
                        <span id="hideLogin"><h4>Don't have an account yet? Signup here.</h4></span>
                    </div>
                    
                </form>
                

                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create your free account</h2>
                    <p>
                        <!-- Here we output the validating error if the input does not meet the sign up requirements -->
                        <!-- Constant::$variablename    code essentially calls the constant class from link at the top and Constants:: used to connect to that class and pull the variable (ONLY BECAUSE ITS A STATIC VARIABLE YOU CAN USE CONSTANT::) -->
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" placeholder="e.g. Unique Name" value="<?php getInputValue('username') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>  
                        <label for="firstName">First Name</label>
                        <input id="firstName" name="firstName" type="text" placeholder="e.g. Tom" value="<?php getInputValue('firstName') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last Name</label>
                        <input id="lastName" name="lastName" type="text" placeholder="e.g. Daily" value="<?php getInputValue('lastName') ?>"required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" placeholder="example@gmail.com" value="<?php getInputValue('email') ?>"required>
                    </p>
                    <p>
                        <label for="email2">Confirm Email</label>
                        <input id="email2" name="email2" type="email" placeholder="example@email.com" value="<?php getInputValue('email2') ?>"required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>   
                        <?php echo $account->getError(Constants::$passwordsNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordsCharacters); ?>               
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password"  placeholder="Your Password" required>
                    </p>
                    <p>
                        <label for="password2">Confirm Password</label>
                        <input id="password2" name="password2" type="password"  placeholder="Your Password" required>
                    </p>

                    <button type="submit" name="registerButton">Sign Up</button>
                    
                    <div class ="hasAccountText">
                        <span id="hideRegister">Already have account? Log in here. </span>
                    </div>
                </form>
            </div>

            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to Creative music for free.</h2>
                <ul>
                    <li>Discover music you'll enjoy through your Day</li>
                    <li>Create your own unique playlists</li>
                    <li>Follow your favorite artists new releases</li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>
