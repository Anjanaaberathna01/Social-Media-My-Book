<div id="friends">
    <?php
    $image = "/images/user_male.jpg";
    if (!empty($FRIEND_ROW['gender']) && $FRIEND_ROW['gender'] === "Female") {
        $image = "/images/user_female.jpg";
    }
    ?>
    <img id="friends-img" src="<?php echo $image ?>" alt="Friend 1">
    <br>

    <?php echo htmlspecialchars($FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']); ?>
</div>