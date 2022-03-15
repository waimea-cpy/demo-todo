<?php
    require_once 'common-session.php';
    require_once 'common-functions.php';

    // Check if login data exists and use is logged in
    if( isset( $_SESSION['loggedIn'] ) && $_SESSION['loggedIn'] == true ) {
        $loggedIn = true;
    }
    else {
        $loggedIn = false;

        // Which script is running?
        $script = basename( $_SERVER['SCRIPT_NAME'] );

        // CHeck against a whitelist of allowed scripts
        if( $script != 'form-login.php' &&
            $script != 'process-login.php' &&
            $script != 'form-new-user.php' &&
            $script != 'process-new-user.php' ) {

            // Not an allowed script, so force a login
            header( 'location: form-login.php' );
        }
    }
?>
    

<!doctype html>

<html>
    
<head>
    <title>Do It! - An awesome to-do list</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header id="main-header">

        <h1><a href="index.php">Do It!</a></h1>

<?php
    if( $loggedIn ) {

        echo '<div id="user-info">';
        echo     $_SESSION['forename'].' '.$_SESSION['surname'];
        echo '</div>';

        echo '<form id="main-search" method="GET" action="process-search.php">
                <input name="search" type="text" required>
                <input type="image" src="images/search.svg">
              </form>';
    }
?>

        <nav id="main-nav">
            
            <label for="toggle">
                <img src="images/menu.svg">
            </label>

            <input id="toggle" type="checkbox">

            <ul>
                <label for="toggle">
                    <img src="images/close.svg">
                </label>

<?php
    if( $loggedIn ) {
        echo '<li><a href="process-logout.php">Logout</a></li>';
        echo '<li><a href="form-search.php">Search</a></li>';
        
        echo '<li><a href="index.php?sort=priority">Sort by Priority</a></li>';
        echo '<li><a href="index.php?sort=due">Sort by Due Date</a></li>';
        echo '<li><a href="index.php?sort=title">Sort by Title</a></li>';
        echo '<li><a href="index.php?sort=created">Sort by When Added</a></li>';
    }
    else {
        echo '<li><a href="form-login.php">Login</a></li>';
        echo '<li><a href="form-new-user.php">Create Account</a></li>';
    }

?>

            </ul>
        </nav>

    </header>

    <main>

