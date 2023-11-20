
<?php
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


if (empty(trim($_REQUEST['spot_name']))) {
    echo "You must enter a spot name.";
    exit();
}


$sql = "  INSERT INTO spots " .
    "    (name, address, description, type_id, interest_id, price_id, photo_url)" .
    "    VALUES (" .
    "	'" . $_REQUEST['spot_name'] . "'" .
    "	'" . $_REQUEST['spot_address'] . "'" .
    "	'" . $_REQUEST['spot_description'] . "'" .
    "	'" . $_REQUEST['spot_type'] . "'" .
    "	'" . $_REQUEST['spot_interest'] . "'" .
    "	'" . $_REQUEST['spot_price'] . "'" .
    "	'" . $_REQUEST['spot_photo_url'] . "'" .
    ")";
$results = $mysql->query($sql);

if(!$results) {
    echo "ERROR! FORM info " . print_r($_REQUEST) . "<hr>";
    echo "SQL: " . $sql . "<hr>";
    echo "db error: " . $mysql->error;
    exit();
}

echo "New title " . $_REQUEST['spot_name'] . " added. ";


?>

<p align="center">Your spot has been uploaded!</p>


</body>

</html>
