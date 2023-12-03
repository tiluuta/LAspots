<?php

include './navbar.php';
echo $navbar;

$host = "webdev.iyaserver.com";
$userid = "sandmanl";
$userpw = "Ace-sweden-sonority89!";
$db = "sandmanl_la_spots";

//

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql = "UPDATE users 
        SET username = '" . $_REQUEST["new_user"] . "',
            password = '" . $_REQUEST["new_pass"] . "'
        WHERE user_id = " . $_REQUEST["user_id"] . ";";

$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

$_SESSION = [];

echo '<link rel="stylesheet" href="stylesheet.css">
    <div style="text-align:center;">
        <h4>'. $_REQUEST["new_user"] . ' has been updated. Redirecting to home in 2 seconds...</h4>
    </div>';

?>

<script>
    setTimeout(function() { window.location='loginpage.php'; }, 2000);
</script>





