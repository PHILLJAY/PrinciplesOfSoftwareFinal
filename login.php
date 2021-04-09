<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="src/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=Nunito+Sans:wght@300;400&display=swap" rel="stylesheet">
    <style>
        .errormssg {
            font-family: 'Nunito Sans', sans-serif;
            font-weight: 400;
        }

        .login-div {
            height: 500px;
        }
    </style>
</head>

<body>
    <div class="login-div">
        <div class="title">Caminati Casino Elite</div>
        <div class="sub-title">login</div>
        <div class="fields">
            <form action="src/includes/login.inc.php" method="POST">
                <div class="username"> <svg class="svg-icon" viewBox="0 0 20 20">
                        <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z">
                        </path>
                    </svg><input type="username" name="username" id="email" class="user-input" placeholder="username/email" required style="width: 330px;" /></div>
                <div class="password"> <svg class="svg-icon" viewBox="0 0 20 20">
                        <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z">
                        </path>
                    </svg><input type="password" name="password" class="pass-input" placeholder="password" required style="width: 330px;" /></div>
                <button name="submit" class="signin-button">Login</button>
            </form>
        </div>
        <div class="link">
            <a href="register.php">Register</a> or <a href="home.html">Return home</a>
        </div>
        <div class="error">
            <?php
            if (isset($_GET["error"])) {
                if (($_GET["error"]) == "emptyinput") {
                    echo "<p class=\"errormssg\">Please Fill in all fields!</p>";
                } else if (($_GET["error"]) == "wronglogin") {
                    echo "<p class=\"errormssg\">Please input a valid username/email and password.</p>";
                } else if (($_GET["error"]) == "logout") {
                    echo "<p class=\"errormssg\">Logged out succesfully!.</p>";
                }
            }
            ?>
        </div>

    </div>

    <script src="" async defer></script>
</body>

</html>