<?php

if(empty($_REQUEST["id"])) {
    echo '<a href="search-spots-admin.php">Please provide a valid record ID.</a>';
    exit();
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

//echo $_REQUEST ["id"];

$sql = "SELECT * FROM spot_view2 WHERE spot_id =" . $_REQUEST["id"];

$results = $mysql->query($sql);

$sqlprice = "SELECT * from prices";
$resultsprice = $mysql->query($sqlprice);

$sqltype = "SELECT * from types";
$resultstype = $mysql->query($sqltype);

$sqluser = "SELECT * from users";
$resultsuser = $mysql->query($sqluser);

?>

<form class="formcontainer" action="admin-update.php">
    <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">

    <?php $currentrow = $results->fetch_assoc();?>

    Name <input type ="text" name="name" value="<?php echo $currentrow["name"];?>"><br>

    <?php
    $currentrow["name"] . "<br>" ?>
    Address <input type ="text" name="address" value="<?php echo $currentrow["address"];?>"><br>
    <?php
    $currentrow["address"] . "<br>" ?>

    Photo <input type ="text" name="photo" value="<?php echo $currentrow["photo_url"];?>"><br>
    <?php
    echo '<img width="50%" src="' . $currentrow["photo_url"] . '"><br>' ?>

    Price <select name="price">
        <?php
        echo "<option value='" . $currentrow["price_id"] . "'>" . $currentrow["price"] . "</option>";

        while($prices = $resultsprice->fetch_assoc()):
            echo "<option value= '" . $prices["price_id"] . "'>" . $prices["price"] . "</option>";
        endwhile;
        ?>
    </select><br>
    Type <select name="type">
        <?php
        echo "<option value='" . $currentrow["type_id"] . "'>" . $currentrow["type"] . "</option>";

        while ($types = $resultstype->fetch_assoc()) {
            echo "<option value='" . $types["type_id"] . "'>" . $types["type"] . "</option>";
        }
        ?>
    </select><br>
    Users <select name="users">
        <?php
        echo "<option value='" . $currentrow["user_id"] . "'>" . $currentrow["user"] . "</option>";

        while ($users = $resultsuser->fetch_assoc()) {
            echo "<option value='" . $users["user_id"] . "'>" . $users["username"] . "</option>";
        }
        ?>
    </select><br>
<!--    <label for="sortorder"></label>-->
<!--    <select name="sortorder" id="sortorder">-->
<!--        <option value="Ascending">Ascending</option>-->
<!--        <option value="Descending">Descending</option>-->
<!--    </select><br>-->
    <button type="submit">Submit</button>
</form>


