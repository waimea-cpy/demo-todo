<?php

    require_once 'common-top.php';


    $sorting = 'priority';
    
    // Has sorting been set?
    if( isset( $_GET['sort'] ) && !empty( $_GET['sort'] ) ) {
        $sorting = $_GET['sort'];
    }

    // Is it a valid sorting method?
    if( $sorting != 'created' && $sorting != 'due' && $sorting != 'title' ) {
        $sorting = 'priority';
    }

    // If by due date, make sure nulls go last
    if( $sorting == 'due' ) $sorting = 'due IS NULL, due';

    // Get the tasks
    $sql = 'SELECT * FROM tasks 
            WHERE NOT complete AND user=?
            ORDER BY '.$sorting.' ASC, due IS NULL, due ASC';

    $userID = $_SESSION['userID'];
    $tasks = getRecords( $sql, 'i', [$userID] );

?>

<div id="new-task">
    <a href="form-task.php">
        <img src="images/plus.svg">
    </a>
</div>


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

