<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Deleting Task...</h2>';

    // Check that all data fields exist
    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) showErrorAndDie( 'Missing ID' );

    $sql = 'DELETE FROM tasks WHERE id=?';

    // Remove record from server
    modifyRecords( $sql, 'i', [$_GET['id']] );

    // If we get here, all went well!
    showStatus( 'Successfully deleted!' );
    echo '</div>';

    // Head back to the home page
    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>    