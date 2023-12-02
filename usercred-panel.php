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

$sql = 	"SELECT * FROM users";
$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}
$sqluser = "SELECT * from users";
$resultsuser = $mysql->query($sqluser);
$sqlspots = "SELECT * from spots";
$resultsspots = $mysql->query($sqlspots);


$userpanel = '
            <form class="formcontainer" action="">
            <h2>Edit User</h2><br>
            <div class="input">Username<br><select class="user-select round-button" name="user">';

$i = 0;
while ($users = $resultsuser->fetch_assoc()) {
    $useroption= "<option value='" . $users["user_id"] . "'>" . $users["username"] . "</option>";
    $userpanel = $userpanel . $useroption;
    $i += 1;
}

$userpanel = $userpanel . '</select><br>
                <input type="text" placeholder="New username" name="username"></div>
            <div class="input">
                <input type="text" placeholder="New password" name="password"><br><br></div>
            <button type="submit" class="round-button beige">Edit Credentials</button><br><br>
            <a class="round-button brown" href="sign-up-spots.php">Create New Account</a>
            <br><br>
        </form>';
