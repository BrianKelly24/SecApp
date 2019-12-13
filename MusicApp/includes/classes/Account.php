<?php
    class Account {

        private $con;
        private $errorArray;
        

        //VALADIATE FUNCTIONS (Contructor)
        public function __construct($con){
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($un, $pw){

            $pw = md5($pw); //encrypts passwords using md5
            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'"); //querys user table all usernames and passwords so you can compare with login inputs

            //Check if its successful
            if(mysqli_num_rows($query) == 1) {
                return true;
            }
            else {
                //if login failed we push out an error array of the constant class fail message
                array_push($this->errorArray, Constants::$loginFailed);
                return false;

            }
        }

        // variables set to null due to error 
        public function register($un = null, $fn = null, $ln = null, $em = null, $em2 = null, $pw = null, $pw2 = null) {
            //call inputs to validate functions
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray) == true){
                //Insert into DataBase
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }
            else{
                return false;
            }
        }

        //Function to output the error message to the user if user details is unsuccessful
        public function getError($error) {
            
            if(!in_array($error, $this->errorArray)){           //This checks to see if the $error paramater exists in the errorArray
               $error = "";                                     //if it doesnt find a msg in error array it will set error paramater to empty string
            }                                                   //TIP** if you want to use quotes in quotes you need to use single quotes ' ' because using "" will end the previous ""
            return "<span class='errorMessage'>$error</span>";  //Outputs an error message        
        }


        //here we insert user details into the database
        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryptedPw = md5($pw);        //Here we encrypt password by using a library method called md5 encryption option 
            $profilePic = "assets/images/profile-pics/empty-profile.jpg";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')"); {  //values are being pushed to the database (they have to be in order with the names in the database table)
            return $result; //You need to return as if ^^ was successful it will return true and if the upper line is false it will return false but it needs a return statement to do so
            }
        }

        // Validates users register details 

        private function validateUsername($un){
            if(strlen($un) > 25 || strlen($un) < 5){
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            //Check if username is already taken
            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
            }

        }


        //Validates First & last Name
        private function validateFirstName($fn){ 
            if(strlen($fn) > 25 || strlen($fn) < 2){
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }

        private function validateLastName($ln){
            if(strlen($ln) > 25 || strlen($ln) < 2){
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }    
        }


        //Validate that the email matches
        private function validateEmails($em, $em2){
            if($em != $em2){
                array_push($this->errorArray, Constants::$emailsDoNotMatch);
                return;
            }
            
            //Checks the email is valid with a .com at the end
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            //Checks if email is already taken
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
            }
        }

        //Validates password
        private function validatePasswords($pw, $pw2){
           if($pw != $pw2){
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;    
           } 

            if(preg_match('/[^A-Za-z0-9]/', $pw)){
                array_push($this->errorArray, Constants::$passwordsNotAlphanumeric);
                return; 
            } 
            
            if(strlen($pw) > 30 || strlen($pw) < 6){
                array_push($this->errorArray, Constants::$passwordsCharacters);
                return;
            }   
        }
    
    } 
?>