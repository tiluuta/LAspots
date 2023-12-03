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
); //

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}

$sql = 	"SELECT * FROM spots";
$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}
$sqlspots = "SELECT * from spots";
$resultsspots = $mysql->query($sqlspots);

//        echo "<br><form>";
//        echo 'Edit User <select name="users">';
//        echo '</select> <a class="small-button green" style="padding:10px 30px 8px 30px;">Add</a> <button type="submit" class="small-button tan">Edit</button> <button class="small-button brown">Delete</button></form>';
//
//        echo "<form action='admin-edit.php'>";
//        echo 'Edit a Spot <select name="id">';
//        while ($spots = $resultsspots->fetch_assoc()) {
//            echo "<option value='" . $spots["spot_id"] . "'>" . $spots["name"] . "</option>";
//        }
//        echo '</select> <a class="small-button green" style="padding:10px 30px 8px 30px;" href="upload-spots.php">Add</a> <button type="submit" class="small-button tan">Edit</button> <a class="small-button brown" style="padding:12px 30px 10px 30px;" href="admin-delete.php">Delete</a></form>';

$spotpanel = '
        <form class="formcontainer" action="details-spots.php">
            <h2>Edit Spot</h2><br>
            <div class="input">Select Name<br><select class="user-select round-button" name="id">';

$i = 0;
while ($spots = $resultsspots->fetch_assoc()) {
    $spotoption= "<option value='" . $spots["spot_id"] . "'>" . $spots["name"] . "</option>";
    $spotpanel = $spotpanel . $spotoption;
    $i += 1;
}

$spotpanel = $spotpanel . '</select><br><br>
                </div>
            <br><button type="submit" class="round-button beige">Edit Spot Details</button><br><br>
        </form>';

?>

