<?php

    require_once 'common-top.php';


    // Make sure that there is an ID passed via GET
    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) {
        die( "Unknown task ID" );
    }

    // Get the ID from the URL
    $taskID = $_GET['id'];

    // Get the specified task
    $sql = 'SELECT * FROM tasks WHERE id = ?';

    $tasks = getRecords( $sql, 'i', [$taskID] );

    // Check if we have one entry in array
    if( count( $tasks ) != 1 ) {
        showErrorAndDie( 'Task ID is invalid' );
    }

    // Get the first and only task
    $task = $tasks[0];

    // Fromat the due date
    if( empty( $task['due'] ) ) {
        $niceDueDate = 'None';
    }
    else {
        $date = new DateTime( $task['due'] );
        $niceDueDate = $date->format( 'j M Y' );
    }

    // Format the creation date and time
    $date = new DateTime( $task['created'] );
    $niceCreatedDate = $date->format( 'j M Y, g:ma' );
?>


<div class="card">
    <h2><?= $task['title'] ?></h2>

    <label>Notes</label>
    <p><?= nl2br( $task['notes'] ) ?></p> 

    <label>Priority</label>
    <p><?= $task['priority'] ?></p>

    <label>Due Date</label>
    <p><?= $niceDueDate ?></p>

    <label>Created</label>
    <p><?= $niceCreatedDate ?></p>

    <div class="controls">
        <a href="index.php"><img src="images/back.svg"></a>
        
        <a href="delete-task.php?id=<?= $taskID ?>" 
           class="danger"
           onclick="return confirm('Delete task... Are you sure?');"><img src="images/bin.svg"></a>
        
        <a href="form-task.php?id=<?= $taskID ?>"><img src="images/pencil.svg"></a>
        
        <a href="complete-task.php?id=<?= $taskID ?>" class="good"><img src="images/tick.svg"></a>
    </div>

</div>

<?php

    require_once 'common-bottom.php';

?>
