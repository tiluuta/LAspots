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

$sql = "SELECT * FROM spot_view2 WHERE spot_id = " . $_REQUEST["id"];

$results = $mysql->query($sql);

if(!$results){
    echo "SQL ERROR:" . $mysql->error;
    echo "<hr>" . $sql;
    exit();
}

?>
<link rel="stylesheet" href="stylesheet.css">
<html>
<head>
    <title>Email Sent</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
</head>
<body>
<?php
include './navbar.php';
echo $navbar;

if(!empty($_REQUEST["email"]))
{
    $to = $_REQUEST["email"];
    $subject = "A hidden LA gem...";
    $message = "Hi! A friend recommended this spot to you! ";

    while($currentrow = $results->fetch_assoc()) {
        $message .= "Spot: " . $currentrow["name"];
    }

    $test = mail($to,$subject,$message);


    if ($test==1)
    {
        echo "Spot sent to " . $_REQUEST["email"] . "!";
        exit();
    }
}
?>
</body>


</html>