<?php

    require_once 'common-top.php';

    // Check if the id is missing
    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) {
        $mode = 'New Task';

        $task['id']       = null;
        $task['title']    = '';
        $task['notes']    = '';
        $task['due']      = '';
        $task['priority'] = '3';
    }
    else {
        $mode = 'Edit Task';

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
    }

?>

<form class="card" method="POST" action="process-task.php">
    <h2><?= $mode ?></h2>

    <input name="id" type="hidden" value="<?= $task['id'] ?>">

    <label>Task Title</label>
    <input name="title" 
           type="text" 
           value="<?= $task['title'] ?>" 
           required>

    <label>Priority</label>
    <input name="priority" 
           type="number" 
           value="<?= $task['priority'] ?>"
           min=1
           max=5 
           required>

    <label>Due Date</label>
    <input name="due" type="date" value="<?= $task['due'] ?>">

    <label>Notes</label>
    <textarea name="notes"><?= $task['notes'] ?></textarea>

    <div class="controls">
        <input type="submit" value="Save Task">
    </div>
</form>


<?php

    require_once 'common-bottom.php';

?>

