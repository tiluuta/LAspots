<?php
session_start();

if(empty(($_SESSION['username']))) {
    if (empty(($_REQUEST['username'])) || empty(($_REQUEST['password']))) {
        header("Location: loginpage.php");
        exit();
    }
}

include './login.php';
include './navbar.php';
include './admin-frontpage.php';
include './spotedit-panel.php';
echo $navbar;
echo '
    <head>
    <title>My Account</title>
    <link rel="icon" type="image/x-icon" href="Assets/favicon.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
    <script src="path/to/chartjs/dist/chart.umd.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag("js", new Date());

        gtag("config", "G-QL7D4BF2WZ");
    </script>
';

$errorpage = '
    <div style="text-align:center;">
        <h4>Invalid Username or Password</h4>
    </div>
';

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

$sql = 	"SELECT * FROM users";
$results = $mysql->query($sql);

if(!$results) {
    echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
    echo "SQL Error: " . $mysql->error . "<hr>";
    exit();
}

if (!empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
    while ($currentrow = $results->fetch_assoc()):
        if ($_REQUEST['username'] == $currentrow['username'] && $_REQUEST['password'] == $currentrow['password']) {
            $_SESSION['username'] = $currentrow['username'];
            $_SESSION['password'] = $currentrow['password'];
        }
    endwhile;
}

if (empty($_SESSION['username'])){
    echo $errorpage;
}

if(array_key_exists('logout', $_POST)) {
    session_unset();
}

if (!empty($_SESSION['username'])){
    $accountpage = '
                <script>
                    function showPass(){
                       document.getElementById("showPass-button").style.display = "none";
                       document.getElementById("password").innerHTML = "' . $_SESSION["password"] . '";
                       document.getElementById("hidePass-button").style.display = "inline";
                    }
                    function hidePass(){
                       document.getElementById("hidePass-button").style.display = "none";
                       document.getElementById("password").innerHTML = "*****";
                       document.getElementById("showPass-button").style.display = "inline";
                    }
                </script>
                <div style="text-align:center;">
                    <h2>Account Details</h2>
                    <div class="login-box" style="text-align:left;width:fit-content;padding:100px;">
                    <strong>Username: </strong>' . $_SESSION['username'] .
        ' <br><br><div class="row" style="margin:auto;">
                    <strong>Password: </strong>
                        <div id="password">*****</div>
                        <button id="showPass-button" onclick="showPass()" class="small-button tan">Show</button>
                        <button id="hidePass-button" onclick="hidePass()" class="small-button green" style="display:none;">Hide</button>
                    </div><br><br>
                    <form method="post">
                        <button type="submit" name="logout" id="logout-button" class="round-button brown">Logout</button>
                    </form>
                </div>
                ';
    echo $accountpage;

    if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'pw'){
        include './usercred-panel.php';
        $sqluser = "SELECT * from users";
        $resultsuser = $mysql->query($sqluser);
        $sqlspots = "SELECT * from spots";
        $resultsspots = $mysql->query($sqlspots);

        echo '<div class="row" style="justify-content:center;margin-top:50px;margin-bottom:50px;">';
        echo '<div class="item">' . $spotpanel . "</div>";
        echo '<div class="item">' . $adminpanel . "</div>";
        echo '</div>';


        $sql = "SELECT DISTINCT interest, COUNT(interest) as amount FROM interest_search_view GROUP BY interest";

        $interest_searches = $mysql->query($sql);

        $interests = [];
        $interest_freqs = [];
        $i = 0;
        while ($currentrow = $interest_searches->fetch_assoc()) {
            $interests[$i] = $currentrow['interest'];
            $interest_freqs[$i] = $currentrow['amount'];
            $i++;
        }

        $sql = "SELECT DISTINCT type, COUNT(type) as amount FROM type_search_view GROUP BY type";

        $type_searches = $mysql->query($sql);

        $types = [];
        $type_freqs = [];
        $i = 0;
        while ($currentrow = $type_searches->fetch_assoc()) {
            $types[$i] = $currentrow['type'];
            $type_freqs[$i] = $currentrow['amount'];
            $i++;
        }

        ?>
            <div class="row margins">
                <div class="item" style="width:50%;">
                    <canvas id="interestSearch" width="200px;"></canvas>
                </div>
                <div class="item" style="width:50%;">
                    <canvas id="typeSearch" width="200px;"></canvas>
                </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx1 = document.getElementById('interestSearch');

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: [<?php foreach($interests as $interest) { echo "'" .$interest . "', "; } ?>],
                    datasets: [{
                        label: '# of Searches per Interest',
                        data: [<?php foreach($interest_freqs as $freq) { echo "'" .$freq . "', "; } ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx2 = document.getElementById('typeSearch');

            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: [<?php foreach($types as $type) { echo "'" .$type . "', "; } ?>],
                    datasets: [{
                        label: '# of Searches per Type',
                        data: [<?php foreach($type_freqs as $freq) { echo "'" .$freq . "', "; } ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }

                    }
                }
            });
        </script>




        <?php


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

    } else{
        include './usercred-panel.php';
        echo '<div class="row" style="justify-content:center;margin-top:50px;margin-bottom:50px;">' . $userpanel . '</div>';
    }
} else {
    echo $login;
}
?>
