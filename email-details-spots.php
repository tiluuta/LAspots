<?php
session_start();

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

$sql = "SELECT * FROM spot_view2";

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
    <style>
        #emailBox{
            float: left;
            text-align: left;
            width: 35%;
            height:fit-content;
            /*border: 1px red solid;*/
            margin-left: 5%;
            font-size: 20pt;
            padding-left: 1%;
        }
    </style>
</head>
<body>

<?php
include './navbar.php';
echo $navbar;
?>
<div id="emailBox">
<?php
if(!empty($_REQUEST["email"]))
{
    $to = $_REQUEST["email"];
    $subject = "Message from LA Spots";
    $message = "Hi! A friend recommended this spot to you! ";
    $from = "sandmanl@webdev.iyaserver.com";
    $message .= "Spot: " . $_SESSION['name'];

    $message .= " unsubscribe";

    $test = mail($to,$subject,$message,$from);

    if ($test==1)
    {
        echo "<br> Spot sent to " . $_REQUEST["email"] . "!";
    }
}
else {
    echo "<br> Please write an email!";
}
?>
</div>
</body>


</html>