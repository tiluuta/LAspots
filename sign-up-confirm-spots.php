<?php
$host = "webdev.iyaserver.com";
$userid = "sandmanl";
$userpw = "Ace-sweden-sonority89!";
$db = "sandmanl_la_spots";


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
?>
<link rel="stylesheet" href="stylesheet.css">
<html>
<head>
    <title>Create an Account!</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
</head>
<body>
<?php
include './navbar.php';
echo $navbar;

$sql = "  INSERT INTO users " .
    "    (username, password)" .
    "    VALUES (" .
    "	'" . $_REQUEST['username'] . "'," .
    "	'" . $_REQUEST['password'] . "'" .
    ")";
$results = $mysql->query($sql);

if(!$results) {
    echo "ERROR! FORM info " . print_r($_REQUEST) . "<hr>";
    echo "SQL: " . $sql . "<hr>";
    echo "db error: " . $mysql->error;
    exit();
}

echo "New user " . $_REQUEST['username'] . " added. ";


?>

<p align="center">Your spot has been uploaded!</p>






</body>

</html>