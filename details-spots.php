<html>
<head>
    <title>LA Spots</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">

    <style>
        .spotName{
            margin-top: -4%;
        }
        #detailsBox{
            text-align: center;
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
            width: 30%;
            margin: auto;
            height: 3%;
        }
        #typeBox{
            border-radius: 20px;
            background-color: #D6BC7E;
            width: auto;
            height: 100%;
            float: left;
            padding-top: 1%;
            padding-left: 5%;
            padding-right: 5%;
            margin-left: 18%;


        }
        #interestBox{
            border-radius: 20px;
            background-color: #AFD3A4;
            width: auto;
            height: 100%;
            float: right;
            padding-top: 1%;
            padding-left: 5%;
            padding-right: 5%;
            margin-right: 18%;

        }

    </style>
</head>
<body>
<?php
include './navbar.php';
echo $navbar;
?>
<div class="margins">
    <?php

    //    if(empty($_REQUEST['type'])) {
    //        header("Location: search-spots.php");
    //    }

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
        while($currentrow = $results->fetch_assoc()){
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
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>