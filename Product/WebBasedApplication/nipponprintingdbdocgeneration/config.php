<?php
    $mysqli = new mysqli("localhost", "root", "yourpassword", "db_nippon_printing");

    if ($mysqli -> connect_errno) {
        echo "connection to mysql failed: " . $mysqli -> connect_error;
        exit();
    }
?>