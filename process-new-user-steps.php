<?php

    require_once 'common-top.php';

    // Show headings

    // Check that all data fields exist

    // If we get here, we have all the data

    // Hash & salt the password using current hashing standard
    $hash = password_hash( $password, PASSWORD_DEFAULT );

    // Check if the user already exists in the DB

    // Add new user to the DB

    // Inform the user of success and head back to home page

    require_once 'common-bottom.php';
?>
    