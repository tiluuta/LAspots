
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
);

if($mysql->connect_errno) {
    echo "db connection error : " . $mysql->connect_error;
    exit();
}
?>
<link rel="stylesheet" href="stylesheet.css">
<html>
<head>
    <title>Create an Account!</title>
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


<h1 align="center">create an account!</h1>

<?php
$signup = '<link rel="stylesheet" href="stylesheet.css">
    <form class="login-box" action="sign-up-confirm-spots.php">
        <div class="input">Username<br>
            <input type="text" placeholder="Create username" name="username"></div><br><br>
        <div class="input">Password<br>
            <input type="text" placeholder="Create password" name="password"><br><br></div>
        <button type="submit" class="round-button brown">Create Account</button>
    </form>';

echo '<div>', $signup, '</div>';
?>

</body>

</html>
