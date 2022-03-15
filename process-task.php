<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Adding New Task...</h2>';

    // Check that all data fields exist
    if( !isset( $_POST['id'] ) )    showErrorAndDie( 'Missing ID' );
    if( !isset( $_POST['title'] )    || empty( $_POST['title'] ) )    showErrorAndDie( 'Missing Title' );
    if( !isset( $_POST['priority'] ) || empty( $_POST['priority'] ) ) showErrorAndDie( 'Missing Priority' );
    if( !isset( $_POST['due'] ) )   showErrorAndDie( 'Missing Due Date' );
    if( !isset( $_POST['notes'] ) ) showErrorAndDie( 'Missing Notes' );

    // If no date given, make sure we send a null
    if( empty( $_POST['due'] ) ) $_POST['due'] = null;

    // Is this a new task, or an edit?
    if( empty( $_POST['id'] ) ) {
        // New task
        showStatus( 'Adding task...' );

        $sql = 'INSERT INTO tasks (title, priority, due, notes, user)
                VALUES (?, ?, ?, ?, ?)';
        $types = 'sissi';
        $data = [
            $_POST['title'], 
            $_POST['priority'], 
            $_POST['due'], 
            $_POST['notes'],
            $_SESSION['userID']
        ];
    }
    else {
        // Edit of existing task
        showStatus( 'Updating task...' );

        $sql = 'UPDATE tasks 
                SET title=?, priority=?, due=?, notes=?
                WHERE id=?';
        $types = 'sissi';
        $data = [
            $_POST['title'], 
            $_POST['priority'], 
            $_POST['due'], 
            $_POST['notes'],
            $_POST['id']
        ];
    }

    // Send data to server
    modifyRecords( $sql, $types, $data );

    // If we get here, all went well!
    showStatus( 'Success!' );
    echo '</div>';

    // Head back to the home page
    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>    