<?php

if(empty($_REQUEST['type'])) {
    header("Location: search-spots.php");
}

$host = "webdev.iyaserver.com";
$userid = "sandmanl";
$userpw = "*PASSWORD*";
$db = "sandmanl_schedule";

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

$sql = 	"SELECT * FROM spots_view WHERE 1=1";
if(!empty($_REQUEST['name'])) {
    $sql .= " AND name ='" . $_REQUEST["name"] . "'";
}
if(!empty($_REQUEST['address'])) {
    $sql .= " AND address ='" . $_REQUEST["address"] . "'";
}
if($_REQUEST['type'] != "ALL") {
    $sql .=		" AND type = '" . $_REQUEST["type"] . "'";
}
    $sql .= " AND price < '" . $_REQUEST["max_price"] . "'";
    $sql .= " AND price > '" . $_REQUEST["min_price"] . "'\n";

$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

echo "<em>Found <strong>" .
    $results->num_rows .
    "</strong> results.</em>";
echo "<br><br>";

while($currentrow = $results->fetch_assoc()) {
    echo "<img alt='" . $currentrow['name'] . "' src='" . $currentrow['photo'] . "' width=100px> " .
    "<strong><a href='details-spots.php?id=" . $currentrow['spot_id'] . "'" .
        $currentrow['name'] . "</strong></a>" .
        $currentrow['address'] . "<em>" .
        $currentrow['type'] . "</em>" .
        $currentrow['price'];
}

?>