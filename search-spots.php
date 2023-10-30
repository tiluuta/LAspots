<?php
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
?>

<form action="results-spots.php">
    <strong>Name of Spot</strong><input type="text" name="name">
    <strong>Address</strong><input type="text" name="address">
    <br>
    <strong>Type of Spot</strong><select name="type">
        <option value="ALL">Select a type</option>
        <?php

        $sql = "SELECT * FROM types";

        $results = $mysql->query($sql);

        if(!$results) {
            echo "SQL error: ". $mysql->error;
            exit();
        }

        while($currentrow = $results->fetch_assoc()) {
            echo "<option>" . $currentrow['type'] . "</option>";
        }
        ?>
    </select>
    <br>
    <strong>Max Price/Cost of Admission</strong><input type="number" name="max-price">
    <br>
    <strong>Min Price/Cost of Admission</strong><input type="number" name="min-price">
    <br><br>
    <input type="submit" value="Submit Search">
</form>