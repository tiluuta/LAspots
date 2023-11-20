<?php
session_start();

if(empty(($_SESSION['username']))) {
    if (empty(($_REQUEST['username'])) || empty(($_REQUEST['password']))) {
        header("Location: frontpage.php");
    }
}

include './login.php';
include './navbar.php';
echo $navbar;

$errorpage = '
    <link rel="stylesheet" href="stylesheet.css">
    <div style="text-align:center;">
        <h4>Invalid Username or Password</h4>
    </div>
';

$host = "webdev.iyaserver.com";
$userid = "sandmanl";
$userpw = "Ace-sweden-sonority89!";
$db = "sandmanl_la_spots";

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
); //

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql = 	"SELECT * FROM users";
$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

if (!empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
    while ($currentrow = $results->fetch_assoc()):
        if ($_REQUEST['username'] == $currentrow['username'] && $_REQUEST['password'] == $currentrow['password']) {
            $_SESSION['username'] = $currentrow['username'];
            $_SESSION['password'] = $currentrow['password'];
        }
    endwhile;
}
if (empty($_SESSION['username'])){
    echo $errorpage;
}

if(array_key_exists('logout', $_POST)) {
    session_unset();
}

if (!empty($_SESSION['username'])){
    $accountpage = '
                <link rel="stylesheet" href="stylesheet.css"> 
                <script>
                    function showPass(){
                       document.getElementById("showPass-button").style.display = "none";
                       document.getElementById("password").innerHTML = "' . $_SESSION["password"] . '";
                       document.getElementById("hidePass-button").style.display = "inline";
                    }
                    function hidePass(){
                       document.getElementById("hidePass-button").style.display = "none";
                       document.getElementById("password").innerHTML = "*****";
                       document.getElementById("showPass-button").style.display = "inline";
                    }
                </script>
                <div style="text-align:center;">
                    <h2>Account Details</h2>
                    <div class="login-box" style="text-align:left;width:fit-content;padding:100px;">
                    <strong>Username: </strong>' . $_SESSION['username'] .
        ' <br><br><div class="row" style="margin:auto;">
                    <strong>Password: </strong>
                        <div id="password">*****</div>
                        <button id="showPass-button" onclick="showPass()" class="small-button tan">Show</button>
                        <button id="hidePass-button" onclick="hidePass()" class="small-button green" style="display:none;">Hide</button>
                    </div><br><br>
                    <form method="post">
                        <button type="submit" name="logout" id="logout-button" class="round-button brown">Logout</button>
                    </form>
                </div>
                ';
    echo $accountpage;
} else {
    echo $login;
}




?>
