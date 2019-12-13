
<?php               //This class contains all our error message strings stored in variables that are used in the Account & Register php files and maybe more
class Constants {
    
    //Register failed messages
    //Having these variables static means you do not need to instantiate 
    public static $passwordsDoNotMatch = "Passwords do not match";
    public static $passwordsNotAlphanumeric = "Your password can only contain numbers and letters"; 
    public static $passwordsCharacters = "Your password must be between 6-30 Characters"; 
    public static $emailInvalid = "Email is invalid"; 
    public static $emailsDoNotMatch = "Your emails do not match"; 
    public static $emailTaken = "This email already exists"; 
    public static $lastNameCharacters = "Your username must be between 2 and 25 characters"; 
    public static $firstNameCharacters = "Your username must be between 2 and 25 characters"; 
    public static $usernameCharacters = "Your username must be between 5 and 25 characters"; 
    public static $usernameTaken = "This username already exists";  
    
    //login fail messages
    public static $loginFailed = "Your username or password was incorrect";  
}

?>