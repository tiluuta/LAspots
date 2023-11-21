
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
//
?>
<link rel="stylesheet" href="stylesheet.css">
<html>
<head>
    <title>Create an Account!</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
</head>
<body>
<form
        action= "upload-confirm-spots.php"
        method = "get"
>
    <?php
    include './navbar.php';
    echo $navbar;
    ?>


    <h1 align="center">upload a spot!</h1>

    <div class="form" align="center">
        <form class="upload-box" action="account.php">
            <div class="upload">Name <br>
                <input type="text" placeholder="Enter Spot Name" name="spot_name"></div><br>
            <div class="upload" >Address<br>
                <input type="text" placeholder="Enter Address" name="spot_address" ><br><br></div>
            <div class="upload">Description<br>
                <input type="text" placeholder="Enter Description of Spot" name="spot_description" height="200px"<br><br><br></div>

            <div class="formtitles">Type of Spot<br></div>
            <select name="spot_type" class="user-select round-button">
                <?php

                $sql = "SELECT * FROM types";

                $results = $mysql->query($sql);

                if(!$results) {
                    echo "SQL error: ". $mysql->error;
                    exit();
                }

                while($currentrow = $results->fetch_assoc()) {
                    echo "<option value='" . $currentrow['type_id'] . "'>" . $currentrow['type'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <div class="formtitles">Interest</div>
            <select name="spot_interest" class="user-select round-button">
                <?php

                $sql = "SELECT * FROM interests";

                $results = $mysql->query($sql);

                if(!$results) {
                    echo "SQL error: ". $mysql->error;
                    exit();
                }

                while($currentrow = $results->fetch_assoc()) {
                    echo "<option value='" . $currentrow['interest_id'] . "'>" . $currentrow['interest'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <div class="formtitles">Price level</div>
            <select name="spot_price" class="user-select round-button">
                <?php

                $sql = "SELECT * FROM prices";

                $results = $mysql->query($sql);

                if(!$results) {
                    echo "SQL error: ". $mysql->error;
                    exit();
                }

                while($currentrow = $results->fetch_assoc()) {
                    echo "<option value='" . $currentrow['price_id'] . "'>" . $currentrow['price'] . "</option>";
                }
                ?>

            </select>
            <br><br>

            <div class="upload">Image Url<br>
                <input type="text" placeholder="Enter Image URL" name="spot_photo_url"></div><br>


            <button type="submit" class="round-button brown">Upload Spot!</button>
        </form>
    </div>


</body>

</html>
