<?php
session_start();
include './navbar.php';

if(($_SESSION['username'] != 'admin' && $_SESSION['password'] != 'pw')) {
    header("Location:frontpage.php");
}

echo '<link rel="stylesheet" href="stylesheet.css">';
echo $navbar;

if (empty($_REQUEST['id'])){
    echo "<a class='round-button brown' href='search-spots.php'>Invalid Spot ID: return to results list</a><br>";
    exit();
}

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

$sql = "DELETE FROM spots
        WHERE spot_id = " . $_REQUEST["id"] . ";";

$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

echo "SQL: " . $sql . "<hr>";
echo "<hr>" . "The spot has been deleted."
?>


