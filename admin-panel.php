<?php
$sqluser = "SELECT * from users";
$resultsuser = $mysql->query($sqluser);
$sqlspots = "SELECT * from spots";
$resultsspots = $mysql->query($sqlspots);

//        echo "<br><form>";
//        echo 'Edit User <select name="users">';
//        while ($users = $resultsuser->fetch_assoc()) {
//            echo "<option value='" . $users["user_id"] . "'>" . $users["username"] . "</option>";
//        }
//        echo '</select> <a class="small-button green" style="padding:10px 30px 8px 30px;">Add</a> <button type="submit" class="small-button tan">Edit</button> <button class="small-button brown">Delete</button></form>';
//
//        echo "<form action='admin-edit.php'>";
//        echo 'Edit a Spot <select name="id">';
//        while ($spots = $resultsspots->fetch_assoc()) {
//            echo "<option value='" . $spots["spot_id"] . "'>" . $spots["name"] . "</option>";
//        }
//        echo '</select> <a class="small-button green" style="padding:10px 30px 8px 30px;" href="upload-spots.php">Add</a> <button type="submit" class="small-button tan">Edit</button> <a class="small-button brown" style="padding:12px 30px 10px 30px;" href="admin-delete.php">Delete</a></form>';

$adminpanel = '<link rel="stylesheet" href="stylesheet.css">
    <form class="login-box" action="account.php">
        <h2>Edit Data</h2><br>
        <div class="input">Username<br>
            <input type="text" placeholder="Enter username" name="username"></div><br><br>
        <div class="input">Password<br>
            <input type="text" placeholder="Enter password" name="password"><br><br></div>
        <button type="submit" class="round-button tan">Log In</button><br><br>
        <a class="round-button brown" href="sign-up-spots.php">Create an Account</a>
    </form>';
?>

