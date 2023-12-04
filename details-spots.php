<?php
session_start();
?>

<html>
<head>
    <title>LA Spots</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/ol@v7.1.0/dist/ol.js"></script>

    <style>
        #map {
            width: 50%;
            height: 30vh;
            margin-left:auto;
            margin-right:4%;
            border-radius: 20px;
            text-align:left;
        }
        .spotName{
            margin-top: -4%;
        }
        #detailsBox{
            text-align: center;
            height:100%;
        }
        #imageBox{
            Float: right;
            text-align: right;
            width: 50%;
            /*border: 1px red solid;*/
            margin-right: 4%;

        }
        #descriptionBox{
            float: left;
            text-align: left;
            width: 35%;
            height:fit-content;
            /*border: 1px red solid;*/
            margin-left: 5%;
            font-size: 20pt;
            padding-left: 1%;

        }
        .image{
            width: 100%;
        }
        #interestBubbles{
            text-align: center;
            /*border: 1px solid red;*/
            display:flex;
            gap:10px;
            max-width:40%;
            justify-content: center;
            height: 3%;
            margin:auto;
        }
        #typeBox{
            border-radius: 20px;
            background-color: #D6BC7E;
            width: fit-content;
            height: fit-content;
            float: left;
            padding: 5px 30px 5px 30px;
        }
        #interestBox{
            border-radius: 20px;
            background-color: #AFD3A4;
            width: fit-content;
            height: fit-content;
            float: right;
            padding: 5px 30px 5px 30px;
        }

    </style>
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
<form
        action= "email-details-spots.php"
        method = "get"
>
<?php
include './navbar.php';
echo $navbar;

?>
<div class="margins">
    <?php

    if(empty($_REQUEST['id'])) {
        echo "<h4>No spot found. Redirecting to homepage...</h4><script>
    setTimeout(function() { window.location='frontpage.php'; }, 2000);
    </script>";
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

    $sql = "SELECT * FROM spot_view2 WHERE spot_id = " . $_REQUEST["id"];
    //    echo $sql;

    $results = $mysql->query($sql);

    if(!$results){
        echo "SQL ERROR:" . $mysql->error;
        echo "<hr>" . $sql;
        exit();
    }

    //    echo "<hr>";


    ?>

    <div id="detailsBox">
        <?php
        $address = '';
        while($currentrow = $results->fetch_assoc()){
            $address = urlencode($currentrow["address"]);
        echo "<h1 class='spotName'>" . $currentrow["name"] . "</h1>";
        ?>
        <div id="contentBox">
            <div id="interestBubbles">
                <div id="typeBox">
                    <?php
                    echo $currentrow["type"];
                    ?>
                </div>
                <div id="interestBox">
                    <?php
                    echo $currentrow["interest"];
                    ?>
                </div>
            </div>
            <div id="imageBox">
                <?php
                echo "<br><br>" . "<img src='" . $currentrow["photo_url"] . "' class='image'>" . "<br><br>";
                ?>
            </div>
            <div id="descriptionBox">
                <?php
                echo "<br>". "<strong>Location: </strong>" . $currentrow["address"] . "<br><br>";
                echo "<strong> Price: </strong>" . $currentrow["price"] . "<br><br>";
                echo $currentrow["description"];
                echo "<br><br><br>";
                }
                if(!empty(($_SESSION['username']))) {
                if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'pw'){
                ?>
                    <a class="small-button green" style="padding:12px 30px 10px 30px;" href='admin-edit.php?id=<?php echo $_REQUEST["id"]?>'>Edit</a>
                    <a class="small-button brown" style="padding:12px 30px 10px 30px;" href='admin-delete.php?id=<?php echo $_REQUEST["id"]?>'>Delete</a>
                <?php
                }}
                $sql = "SELECT * FROM spot_view2 WHERE spot_id = " . $_REQUEST["id"];
                //    echo $sql;

                $results = $mysql->query($sql);

                if(!$results){
                    echo "SQL ERROR:" . $mysql->error;
                    echo "<hr>" . $sql;
                    exit();
                }

                $_SESSION["id"] = $_REQUEST["id"];
                $_SESSION['name'] = '';
                $address = urlencode('3780 Watt Way, Los Angeles, CA 90089');

                while($currentrow = $results->fetch_assoc()) {
                    if($currentrow['spot_id'] == $_SESSION["id"]){
                        $_SESSION['name'] = $currentrow['name'];
                        $address = urlencode($currentrow['address']);
                    }
                }

                ?>

                <h3>Send a spot to a friend!</h3>
                <form action="" method="post">
                    <h4>Email:</h4> <input type="text" name="email" /><br />
                    <input type="submit"  value='Send Email' />

                </form>
            </div>
        </div>
        <div id="map">
            <iframe width="100%" height="300px;" style="border:0;border-radius:10px" loading="lazy" allowfullscreen
                    src="https://www.google.com/maps/embed/v1/place?q=
                        <?php echo urlencode($_SESSION['name'])?>
                    &key=AIzaSyDHe6Mce63P0AxkiYt2hqYjhmgeYjAO0pw&zoom=11"></iframe>
        </div>
    </div>

</div>

</body>
</html>