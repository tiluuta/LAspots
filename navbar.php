<?php

    $navbar = '<link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">
            <div class="navbar">
            <a href="frontpage.php" class="logo">&nbsp;</a>
            <a href="search-spots.php">Search</a>
            <a href="upload-spots.php" style="margin-left:50px;">Upload a Spot</a>
            <a href="account.php" class="profile green">&nbsp;</a>
        </div>';

    if(!empty($_SESSION['username'])) {
        if ($_SESSION['username'] == 'admin' && $_SESSION['password'] == 'pw') {
            $navbar = '<link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">
            <div class="navbar">
            <a href="frontpage.php" class="logo">&nbsp;</a>
            <a href="search-spots.php">Search</a>
            <a href="upload-spots.php" style="margin-left:50px;">Upload a Spot</a>
            <a href="account.php" style="margin-left:auto;margin-right:50px;">Admin Panel</a>
        </div>';
        }
    }
?>