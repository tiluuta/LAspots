<?php
session_start();

    if($_SESSION['username'] != 'admin' && $_SESSION['password'] != 'pw') {
        header("Location: search-spots.php");
    }
?>
<html>
<head>
    <title>LA Spots!</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-QL7D4BF2WZ');
    </script>
</head>
<body>
<?php
    include './navbar.php';
    echo $navbar;
?>
<div class="margins">
<?php

if(empty($_REQUEST['type'])) {
    header("Location: search-spots.php");
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

$sql = 	"SELECT * FROM spot_view2 WHERE 1=1";
if(!empty($_REQUEST['name'])) {
    $sql .= " AND name LIKE '%" . $_REQUEST["name"] . "%'";
}
if(!empty($_REQUEST['address'])) {
    $sql .= " AND address LIKE '%" . $_REQUEST["address"] . "%'";
}
if($_REQUEST['type'] != "ALL") {
    $sql .=		" AND type = '" . $_REQUEST["type"] . "'";
}

if($_REQUEST['interest'] != "ALL") {
    $sql .=		" AND interest = '" . $_REQUEST["interest"] . "'";
}
if($_REQUEST['price'] != "ALL") {
    $sql .=		" AND price = '" . $_REQUEST["price"] . "'";
}
//$sql .= " AND price < '" . $_REQUEST["max_price"] . "'";
//$sql .= " AND price > '" . $_REQUEST["min_price"] . "'\n";


$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

echo "<em>Found <strong>" .
    $results->num_rows .
    "</strong> results.</em>";
echo "<br><br>";

?>

<div class="gallery">

    <?php while($currentrow = $results->fetch_assoc()): ?>

        <div class="gallery-item">

            <div class="image" style="background-image: url('<?php echo $currentrow['photo_url']; ?>')"></div>

            <a class="details" href="details-spots.php?id=<?php echo $currentrow['spot_id']?>">
                <div class="overlay">
                <h3 class="location-tag">&#128205;<?php echo $currentrow['name']; ?></h3>
                <p class="address"><?php echo $currentrow['address']; ?></p>
                <p><em><?php echo $currentrow['type']; ?></em></p>
                <p><?php echo $currentrow['interest']; ?></p>
                <p><?php echo $currentrow['price']; ?></p>
                <a class="small-button beige" style="padding:12px 30px 10px 30px;" href='admin-edit.php?id=<?php echo$currentrow["spot_id"]?>'>Edit</a>
                    <a class="small-button brown" style="padding:12px 30px 10px 30px;" href='admin-delete.php?id=<?php echo$currentrow["spot_id"]?>'>Delete</a>
                </div>
            </a>

        </div>

    <?php endwhile; ?>

</div>
</div>

</body>
</html>

