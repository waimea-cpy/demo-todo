<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Marking Task Complete...</h2>';

    // Check that all data fields exist
    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) showErrorAndDie( 'Missing ID' );

    $sql = 'UPDATE tasks SET complete=1 WHERE id=?';

    // Remove record from server
    modifyRecords( $sql, 'i', [$_GET['id']] );

    // If we get here, all went well!
    showStatus( 'Success!' );
    echo '</div>';

    // Head back to the home page
    header( 'location: index.php' );

    require_once 'common-bottom.php';
?>    