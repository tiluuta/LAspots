<?php
session_start();
?>
<html>
<head>
    <title>LA Spots</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-QL7D4BF2WZ');
    </script>
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
        .ol-popup {
            position: absolute;
            background-color: white;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 280px;
        }
        .ol-popup:after, .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }
        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }
        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
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

    $_SESSION["id"] = $_REQUEST["id"];

    while($currentrow = $results->fetch_assoc()) {
        if($currentrow['spot_id'] == $_REQUEST["id"]){
            $_SESSION['name'] = $currentrow['name'];
        }
    }
    echo  $_SESSION['name'];
    echo    $_SESSION["id"];
    ?>

    <div id="detailsBox">
        <?php
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
                ?>

                <h3>Send a spot to a friend!</h3>
                <form action="" method="post">
                    <h4>Email:</h4> <input type="text" name="email" /><br />
                    <input type="submit" value='Send Email' />

                </form>
            </div>
        </div>
        <div id="map">
            <?php
            $url = 'https://geocode.maps.co/search?q='.$address;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($result, true); #decode string into obj
            $dataPhp = array(); #set obj as array

            if($data != null){
                for($i = 0; $i < sizeof($data); $i++){
                    array_push($dataPhp, array("lat" => $data[$i]["lat"], "long" => $data[$i]["lon"], "name" => $data[$i]["display_name"]));
                }
            }

            ?>
            <script>
                var _coords = <?php echo json_encode($dataPhp); ?>;
                var map;


                function initMap() {
                    map = new ol.Map({
                        target: "map",
                        layers: [
                            new ol.layer.Tile({
                                source: new ol.source.OSM(),
                            }),
                        ],
                        view: new ol.View({
                            center: ol.proj.fromLonLat([long, latd]),
                            zoom: 14,
                            maxZoom: 19,
                            minZoom:10
                        }),
                        overlay: [
                            new ol.Overlay({
                                element: container
                            }),
                        ],
                    });
                }

                function addMarker(latd, long, name) {
                    var _feature = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.fromLonLat([long, latd])),

                    });
                    _feature.set("Name", name);

                    var layer = new ol.layer.Vector({
                        source: new ol.source.Vector({
                            features: [
                                _feature,
                            ],
                        }),
                    });
                    map.addLayer(layer);
                }

                if(_coords.length > 0){
                    var latd = _coords[0]["lat"], long = _coords[0]["long"];

                    // load and setup map layers
                    initMap();

                    // to set all the pins
                    for (let i = 0; i < _coords.length; i++) {
                        addMarker(_coords[i]["lat"], _coords[i]["long"], _coords[i]["name"]);
                    }

                    // for the popup box
                    var container = document.getElementById('popup');
                    var content = document.getElementById('popup-content');

                    var overlay = new ol.Overlay({
                        element: container,
                        autoPan: true,
                        autoPanAnimation: {
                            duration: 250
                        }
                    });

                    map.addOverlay(overlay);

                    map.on('pointermove', function (event) {
                        const features = map.getFeaturesAtPixel(event.pixel);
                        if (features.length > 0) {
                            var coordinate = event.coordinate;
                            const name = features[0].get('Name');z
                            //simple text written in the popup, values are just of the second index
                            content.innerHTML = '<br><b>Address: </b>'+name;//just the second one is getting displayed
                            overlay.setPosition(coordinate);
                        }
                        else {
                            // if there are no features on the hovered position then hide the popup box
                            overlay.setPosition(undefined);
                        }
                    });
                }
            </script>
        </div>
    </div>

</div>

</body>
</html>