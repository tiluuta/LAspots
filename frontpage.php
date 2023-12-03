<?php
    session_start();
    include './navbar.php';
    include './login.php';
?>
<html>
<head>
    <title>LA Spots</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta charset="UTF-8">
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
    if(empty(($_SESSION['username'])) || empty(($_SESSION['password']))){
        echo '<div class="sidebar">', $login, '</div>';
    }
?>
<div class="row">

    <!--- EDIT ID="spotlight" to change to random spot --->
    <div id="spotlight" class="item" style="width:34.5%;position:relative;">
        <a href="details-spots.php?id=75">
        <img class="frontpage-img" src="Assets/LIES479-046.jpg">
        <a class="location-tag">&#128205; The Wallflower, Venice</a>
        </a>
    </div>

    <div class="item" style="width:65%;">
        <h1>LA Spots</h1>
        <h4 style="width:60%;">Experience the city of angels differently.
            Find your favorite hidden gems that won’t pop up in a simple internet search.</h4>
        <div>
            <button class="tan round-button"><a href="search-spots.php">Find your Spot</a></button>
        </div>
        <br>
        <div>
            <button class="green round-button"><a href="details-spots.php?id=<?php echo "SELECT spot_id FROM spot_view2 ORDER BY RAND () LIMIT 1" ?>">Randomize Spot</a></button>
<!--            details-spots.php?id=-->
        </div>

    </div>

</div>
</body>
</html>
