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

//        echo "<br><form>";
//        echo 'Edit User <select name="users">';
$i = 0;
while ($users = $resultsuser->fetch_assoc()) {
    $useroption[$i]= "<option value='" . $users["user_id"] . "'>" . $users["username"] . "</option>";
    $i += 1;
}
//        echo '</select> <a class="small-button green" style="padding:10px 30px 8px 30px;">Add</a> <button type="submit" class="small-button tan">Edit</button> <button class="small-button brown">Delete</button></form>';
//
//        echo "<form action='admin-edit.php'>";
//        echo 'Edit a Spot <select name="id">';
//        while ($spots = $resultsspots->fetch_assoc()) {
//            echo "<option value='" . $spots["spot_id"] . "'>" . $spots["name"] . "</option>";
//        }
//        echo '</select> <a class="small-button green" style="padding:10px 30px 8px 30px;" href="upload-spots.php">Add</a> <button type="submit" class="small-button tan">Edit</button> <a class="small-button brown" style="padding:12px 30px 10px 30px;" href="admin-delete.php">Delete</a></form>';

$adminpanel = '
    <br>
    <div class="row" style="justify-content:center;">
        <div class="item">
        <form class="formcontainer" action="">
            <h2>Edit Users</h2><br><select name="users">';

            $i = 0;
            while ($users = $resultsuser->fetch_assoc()) {
                $useroption[$i]= "<option value='" . $users["user_id"] . "'>" . $users["username"] . "</option>";
                $i += 1;
            }

            $adminpanel = $adminpanel . $useroption[2];

$adminpanel = $adminpanel . '</select><div class="input">Username<br>
                <input type="text" placeholder="Enter username" name="username"></div><br><br>
            <div class="input">Password<br>
                <input type="text" placeholder="Enter password" name="password"><br><br></div>
            <button type="submit" class="round-button tan">Log In</button><br><br>
            <a class="round-button brown" href="sign-up-spots.php">Create an Account</a>
        </form>
        </div>
        <div class="item">
        <form class="formcontainer" action="">
            <h2>Edit Spots</h2><br>
            <div class="input">Username<br>
                <input type="text" placeholder="Enter username" name="username"></div><br><br>
            <div class="input">Password<br>
                <input type="text" placeholder="Enter password" name="password"><br><br></div>
            <button type="submit" class="round-button tan">Log In</button><br><br>
            <a class="round-button brown" href="sign-up-spots.php">Create an Account</a>
        </form>
        </div>
    </div>';


?>

