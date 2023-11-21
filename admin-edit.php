<?php

if(empty($_REQUEST["id"])) {
    echo '<a href="http://samaksha.webdev.iyaserver.com/acad276/LA_Spots/Untitled/admin-edit.php?id=">Please provide a valid record ID.</a>';
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

echo $sql;

$results = $mysql->query($sql);

$sqlprice = "SELECT * from price";
$resultsprice = $mysql->query($sqlprice);

$sqltype = "SELECT * from types";
$resultstype = $mysql->query($sqltype);

$sqluser = "SELECT * from users";
$resultsuser = $mysql->query($sqluser);
echo "<hr>"

?>

<form action ="admin-update.php">
    <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">

    <?php $currentrow = $results->fetch_assoc();?>

    <input type ="text" name="name" value="<?php echo $currentrow["name"];?>">

    <?php
    $currentrow["name"] . "<br>" ?>
    <input type ="text" name="address" value="<?php echo $currentrow["address"];?>">
    <?php
    $currentrow["address"] . "<br>" ?>

    <input type ="text" name="photo" value="<?php echo $currentrow["photo"];?>">
    <?php
    echo $currentrow["photo"] . "<br>" ?>

    <select name="price">
        <?php
        "<option value='" . $currentrow["price_id"] . "'>" . $currentrow["price"] . "</option>";

        while($prices = $resultsclass->fetch_assoc()){
            echo "<option value= '" . $prices["price_id"] . "'>" . $prices["price"] .
                "</option>";
        }
        ?></select><br>
    <select name="type">
        <?php
        echo "<option value='" . $currentrow["type_id"] . "'>" . $currentrow["type"] . "</option>";

        while ($types = $resultstype->fetch_assoc()) {
            "<option value='" . $types["type_id"] . "'>" . $types["type"] . "</option>";
        }
        ?>
    </select><br>
    <select name="users">
        <?php
        echo "<option value='" . $currentrow["user_id"] . "'>" . $currentrow["user"] . "</option>";

        while ($users = $resultsuser->fetch_assoc()) {
            echo "<option value='" . $users["user_id"] . "'>" . $users["user"] . "</option>";
        }
        ?>
    </select><br>
<!--    <label for="sortorder"></label>-->
<!--    <select name="sortorder" id="sortorder">-->
<!--        <option value="Ascending">Ascending</option>-->
<!--        <option value="Descending">Descending</option>-->
<!--    </select><br>-->
    <input type="submit">
</form>


