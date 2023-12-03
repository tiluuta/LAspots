<?php

if(empty($_REQUEST["id"])) {
    echo '<a href="search-spots-admin.php">Please provide a valid record ID.</a>';
    exit();
}

include './login.php';
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

$sql = "UPDATE spots 
        SET name = '" . addslashes($_REQUEST["name"]) . "',
        address = '" . $_REQUEST["address"] . "',
        description = '" . addslashes($_REQUEST["desc"]) . "',
        photo_url = '" . $_REQUEST["photo"] . "',
        price_id = " . $_REQUEST["price"] . ",

        type_id = '" . $_REQUEST["type"] . "'" .

    " WHERE spot_id = " . $_REQUEST["id"] . ";";

$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

echo '<link rel="stylesheet" href="stylesheet.css">
    <div style="text-align:center;">
        <h4>'. $_REQUEST["name"] . ' has been updated. Redirecting to home in 2 seconds...</h4>
    </div>';

?>
<script>
    setTimeout(function() { window.location='frontpage.php'; }, 2000);
</script>


