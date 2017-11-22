
    <?php
    include('./dbconfig.php');
    // load chats from mysql DB
    $query = "SELECT * FROM (SELECT * FROM chat ORDER BY date DESC LIMIT 30) as t ORDER BY date DESC";
    $result = $mysqli->query($query);

    while ($rows = $result->fetch_array()) {
        ?>

        <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon"></i>
                 <?php
                 $date = $rows['date'];
        $date = explode(" ", $date);
        echo $date[0]; ?> | <?php echo $rows['nick'] ?> : <?php echo htmlentities($rows['text']); ?>
            </span>
        </li>

    <?php

    } ?>
