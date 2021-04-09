<?php
$swag = "hello";

function emptyInputSignup($username, $email, $password_1, $password_2)
{
    $result;
    if (empty($username) || empty($email) || empty($password_1)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($password_1, $password_2)
{
    $result;
    if ($password_1 !== $password_2) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function userExists($db, $username, $email)
{
    $sql = "SELECT * FROM users WHERE Username = ? OR EmailAddress = ?;";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../registration.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function createUser($db, $username, $email, $password_1)
{
    $sql = "INSERT INTO users (Username, Password, EmailAddress) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../registration.php?error=stmtfailed");
        exit();
    }

    $hashedPass = password_hash($password_1, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPass, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../registration.php?error=none");
    exit();
}

function emptyInputLogin($username, $pass)
{
    $result;
    if (empty($username) || empty($pass)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function loginUser($db, $username, $pass)
{
    $userExists = userExists($db, $username, $username);

    if ($userExists === false) {
        header("location: ../../login.php?error=wronglogin");
        exit();
    }

    $hashedPass = $userExists["Password"];
    if (!(password_verify($pass, $hashedPass))) {
        header("location: ../../login.php?error=wronglogin");
        exit();
    } else if (password_verify($pass, $hashedPass)) {
        session_start();
        $_SESSION["userid"] =  $userExists["Id"];
        $_SESSION["userName"] =  $userExists["Username"];
        header("location: ../../index.html");
        exit();
    }
}
function emptyInputBook($checkin, $checkout, $rooms, $hotelID)
{
    $result;
    if (empty($checkin) || empty($checkout) || empty($rooms)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidDates($checkin, $checkout, $hotelID)
{
    $result;
    if ($checkin < date("m/d/Y") || $checkout < date("m/d/Y")) {
        $result = true;
    } else if ($checkin >= $checkout) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function bookingExists($db, $checkin, $checkout, $hotelID)
{
    $sql = "SELECT * FROM bookings WHERE hotelID = $hotelID AND startDate < ? AND endDate > ?;";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../booking.php?error=stmtfailed&hotelID=" . $hotelID);
    exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $checkin, $checkin);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    var_dump($resultData);
    //var_dump(get_defined_vars());

    if (!(mysqli_fetch_assoc($resultData) == null)) { //checks to see if the check in date collides wth an existing booking
        return true;
    }
    $sql2 = "SELECT * FROM bookings WHERE hotelID = $hotelID AND startDate < ? AND endDate > ?;";
    $stmt2 = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        
        header("location: ../../booking.php?error=stmtfailed&hotelID=" . $hotelID);
        exit();
    }
    mysqli_stmt_bind_param($stmt2, "ss", $checkout, $checkout);
    mysqli_stmt_execute($stmt2);

    $resultData2 = mysqli_stmt_get_result($stmt2);
    var_dump($resultData2);
    if (!(mysqli_fetch_assoc($resultData2) == null)) { //checks to see if the check in date collides wth an existing booking
        return true;
    } else {
        return false;
    }
    
}

function createBooking($db,$checkin,$checkout,$hotelID,$userID,$rooms){
    $sql = "INSERT INTO bookings (hotelID, userID, startDate, endDate, rooms) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($db);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../booking.php?error=stmtfailed&fuck=shid&hotelID=" . $hotelID);
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssss", $hotelID, $userID, $checkin, $checkout, $rooms);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../booking.php?error=none&hotelID=" . $hotelID);
    exit();
}