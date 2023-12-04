<?php
session_start();
include './navbar.php';
?>


<html>
<head>
    <title>LA Spots</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="przonnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
</head>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QL7D4BF2WZ');
</script>
<body>
<?php
echo $navbar;
?>
<h1>Search Rankings</h1>
<h3>Top Interest Searches!</h3>
<script type="text/javascript" src="bar-chart.js"></script>


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
?>

<?php

$sql = "SELECT * FROM interest_search_view";
//    echo $sql;

$results = $mysql->query($sql);

if(!$results){
    echo "SQL ERROR:" . $mysql->error;
    echo "<hr>" . $sql;
    exit();
}

//    echo "<hr>";




?>



</body>
</html>
