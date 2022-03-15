<?php

    require_once 'common-top.php';

    echo '<h2>Task Search</h2>';
    
    // Has search term been set?
    if( !isset( $_GET['search'] ) || empty( $_GET['search'] ) ) {
        showErrorAndDie( 'Missing search term' );    
    }

    // Get search term from URL
    $search = $_GET['search'];

    showStatus( 'Searching for <strong>'.$search.'</strong>...' );

    // Add in wildcard operators
    $search = '%'.$search.'%';

    // Get the tasks
    $sql = 'SELECT * FROM tasks 
            WHERE NOT complete AND (title LIKE ? OR notes LIKE ?)
            ORDER BY priority ASC';

    $tasks = getRecords( $sql, 'ss', [$search, $search] );

?>

<ol id="task-list">

<?php

    foreach( $tasks as $task ) {

        if( empty( $task['due'] ) ) {
            $niceDate = '';
        }
        else {
            $date = new DateTime( $task['due'] );
            $today = new DateTime( 'today' );

            $diff = $today->diff( $date );

            if( $diff->invert && $diff->days == 1 ) {
                $niceDate = 'due yesterday!';
                $dateClass = 'late';
            }
            if( $diff->invert ) {
                $niceDate = $diff->days.' days overdue!';
                $dateClass = 'late';
            }
            elseif( $diff->days == 0 ) {
                $niceDate = 'due today';
                $dateClass = 'today';
            }
            elseif( $diff->days == 1 ) {
                $niceDate = 'due tomorrow';
                $dateClass = '';
            }
            else {
                $niceDate = 'due in '.$diff->days.' days';
                $dateClass = '';
            }

            // $niceDate = $date->format( 'j M Y' );
        }

?>

    <li class="task card priority-<?= $task['priority'] ?>">

        <h3><?= $task['title'] ?></h3>

        <div class="info">
            <span class="priority"><?= $task['priority'] ?></span>
            <span class="due-date <?= $dateClass ?>"><?= $niceDate ?></span>
        </div>

        <div class="more">
            <a href="show-task.php?id=<?= $task['id'] ?>">
                <img src="images/dots.svg">
            </a>
        </div>

    </li>

<?php
    }
?>

</ol>


<?php

    require_once 'common-bottom.php';

?>

