<html>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QL7D4BF2WZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-QL7D4BF2WZ');
    </script>
</html>
<?php
include './login.php';
include './navbar.php';
include './admin-frontpage.php';
include './admin-panel.php';
echo $navbar;

echo $login;
?>

