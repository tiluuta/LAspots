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

$sql = "UPDATE spots 
        SET name = '" . $_REQUEST["name"] . "',
        address = '" . $_REQUEST["address"] . "',
        photo_url = '" . $_REQUEST["photo"] . "',
        price_id = " . $_REQUEST["price"] . ",

        type_id = '" . $_REQUEST["type"] . "'\n" .

    " WHERE spot_id = " . $_REQUEST["id"] . ";";

$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

echo "<hr>" . "The spot has been updated."
?>

