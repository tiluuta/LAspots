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
);

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
<link rel="stylesheet" href="stylesheet.css">
<html>
<head>
    <title>Edit Your Spot!</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QL7D4BF2WZ');
</script>
<body>
<?php
include './navbar.php';
echo $navbar;
?>

<div>
    <h2 style="text-align:center;">edit your spot!</h2>
    <br><br>
<form class="login-box" action="admin-update.php">
    <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">

    <?php $currentrow = $results->fetch_assoc();?>
    <br><div class="formtitles">Name of spot</div><input type="text" name="name" placeholder="Name of Spot" class="round-button" style="width:100%;margin:auto;" value="<?php echo $currentrow["name"];?>"><br>
    <br>
    <div class="formtitles">Address</div>
        <input type="text" name="address" placeholder="Address" class="round-button" style="width:100%;margin:auto;" value="<?php echo $currentrow["address"];?>">


    <div class="formtitles"><br>Photo <value="<?php echo $currentrow["address"];?>"><br>
    <?php echo '<img width="50%" src="' . $currentrow["photo_url"] . '"><br>' ?>
        <br><input type="text" name="photo" placeholder="Photo URL" class="round-button" style="width:100%;margin:auto;" value="<?php echo $currentrow["photo_url"];?>">
        <br><br><div class="formtitles">Price <br><select name="price" class="user-select round-button">>
        <?php
        while($prices = $resultsprice->fetch_assoc()):
            if($currentrow["price"] == $prices["price"]){
                echo "<option value='" . $prices["price_id"] . "'>" . $currentrow["price"] . "</option>";
            }

            echo "<option value= '" . $prices["price_id"] . "'>" . $prices["price"] . "</option>";
        endwhile;
        ?>
    </select><br><br>
            <div class="formtitles">Type <br><select name="type" class="user-select round-button">>
        <?php
        while ($types = $resultstype->fetch_assoc()) {
            if($types["price"] == $currentrow["price"]){
                echo "<option value='" . $types["type_id"] . "'>" . $currentrow["type"] . "</option>";
            }
            echo "<option value='" . $types["type_id"] . "'>" . $types["type"] . "</option>";
        }
        ?>
    </select><br><br>
            <div class="formtitles">Description <br>
                <textarea id="desc" name="desc" class="user-select round-button" maxlength=2500 style="min-height:200px;min-width:100%;max-width:100%;"><?php echo $currentrow["description"];?></textarea><br>
                WARNING: DESC CHANGES ARE NOT IMPLEMENTED YET
                <br><button type="submit" class="round-button brown">Submit</button>
</form>


