<?php

    require_once 'common-top.php';

    // Show headings

    // Clear out any previous login details
    session_unset();

    // Check that all data fields exist

    // If we get here, we have all the data

    // Get the user info from the DB

    // If no user with that username, they need to make an account

    // User exists, so get their record

    // Check the hashed password against stored hash
    if( password_verify( $password, $user['hash'] ) == false ) showErrorAndDie( 'Incorrect password' );

    // Password is correct, so store user details in the session
    $_SESSION['loggedIn'] = true;
    $_SESSION['userID']   = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['forename'] = $user['forename'];
    $_SESSION['surname']  = $user['surname'];

    // Say hello, and head back to home page

    require_once 'common-bottom.php';
?>
    