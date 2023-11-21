<?php

$sql = "UPDATE spots 
        SET name = '" . $_REQUEST["name"] . "',
        address = '" . $_REQUEST["address"] . "',
        photo = '" . $_REQUEST["photo"] . "',
        price_id = '" . $_REQUEST["price"] . "',
        user_id = '" . $_REQUEST["user"] . "',
        type_id = " . $_REQUEST["type"] .

    " WHERE spots_id = " . $_REQUEST["id"];

echo $sql;
echo "<hr>" . "The spot has been updated."
?>

