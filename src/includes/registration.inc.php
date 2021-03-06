<?php

if (isset($_POST["submit"])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['pass1'];
    $password_2 = $_POST['pass2'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    //Form validation functions (see functions.inc.php)
    if(emptyInputSignup($username,$email, $password_1, $password_2) !== false){
        header("location: ../../register.php?error=emptyinput");
        exit();
    }
    if (invalidUsername($username) !== false){
        header("location: ../../register.php?error=invalidusername");
        exit();
    }
    if (invalidEmail($email) !== false){
        header("location: ../../register.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($password_1,$password_2)){
        header("location: ../../register.php?error=passwordsfail");
        exit();
    }
    if (userExists($db,$username,$email)){
        header("location: ../../register.php?error=usernametaken");
        exit();
    }

    createUser($db,$username,$email, $password_1);

}else{
    header("location: ../../register.php");
    exit();
}

?>