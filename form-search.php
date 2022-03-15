<?php

    require_once 'common-top.php';

?>

<form class="card" method="GET" action="process-search.php">

    <h2>Search Tasks</h2>

    <label>Search for...</label>
    <input name="search" type="text" required>

    <div class="controls">
        <input type="submit" value="Search">
    </div>

</form>


<?php

    require_once 'common-bottom.php';

?>

