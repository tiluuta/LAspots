<?php

if (empty($_SESSION["username"])){

}

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
            <form class="formcontainer" action="user-edit.php">
            <h2>Edit User</h2><br>
            <div class="input">Change Credentials';

$adminpanel = $userpanel . '<br><select class="user-select round-button" name="user_id">';

$i = 0;
while ($users = $resultsuser->fetch_assoc()) {
    if ($users["username"] == $_SESSION["username"]){
        $currentuserid = $users["user_id"];
    }
    $useroption= "<option value='" . $users["user_id"] . "'>" . $users["username"] . "</option>";
    $adminpanel = $adminpanel . $useroption;
    $i += 1;
}

$adminpanel = $adminpanel . '</select><br>
                <input type="text" placeholder="New username" name="new_user"></div>
            <div class="input">
                <input type="text" required=1 placeholder="New password" name="new_pass"><br><br></div>
            <button type="submit" class="round-button beige">Edit Credentials</button><br><br>
            <a class="round-button brown" href="sign-up-spots.php">Create New Account</a>
            <br><br>
        </form>';

$userpanel = $userpanel . '<br>
                <input type="hidden" name="user_id" value="' . $currentuserid .
            '"><input type="text" placeholder="New username" name="new_user"></div>
            <div class="input">
                <input type="text" placeholder="New password" name="new_pass"><br><br></div>
            <button type="submit" class="round-button beige">Edit Credentials</button><br><br>
            <a class="round-button brown" href="sign-up-spots.php">Create New Account</a>
            <br><br>
        </form>';