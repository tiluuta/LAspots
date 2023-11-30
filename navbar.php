<?php

    $navbar = '<div class="navbar">
            <a href="frontpage.php" class="logo">&nbsp;</a>
            <a href="search-spots.php">Search</a>
            <a href="upload-spots.php" style="margin-left:50px;">Upload a Spot</a>
            <a href="account.php" class="profile green">&nbsp;</a>
        </div>';

    if(!empty($_SESSION['username'])) {
        if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'pw') {
            $navbar = '<div class="navbar">
            <a href="frontpage.php" class="logo">&nbsp;</a>
            <a href="search-spots.php">Search</a>
            <a href="upload-spots.php" style="margin-left:50px;">Upload a Spot</a>
            <a href="account.php" style="margin-left:auto;margin-right:50px;">Admin Panel</a>
        </div>';
        }
    }
?>