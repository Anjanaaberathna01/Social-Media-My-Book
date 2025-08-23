<div class="post" style="display: flex; margin-bottom: 20px;">

    <?php
    // Profile image based on gender
    $image = "/images/user_male.jpg";
    if (!empty($ROW_USER['gender']) && $ROW_USER['gender'] === "Female") {
        $image = "/images/user_female.jpg";
    }

    // Format post date (from DB) into a new style
    $dateText = "";
    if (!empty($ROW['date'])) {
        try {
            $dateObj = new DateTime($ROW['date']);
            // Example format: August 20, 2025 at 2:33 PM
            $dateText = $dateObj->format("F j, Y \\a\\t g:i A");
        } catch (Exception $e) {
            $dateText = htmlspecialchars($ROW['date']); // fallback if invalid
        }
    }
    ?>

    <!-- Profile picture -->
    <img src="<?php echo $image; ?>" alt="Profile Image"
        style="width: 75px; height: 75px; margin-right: 10px; border-radius: 50%; object-fit: cover;">

    <!-- Post content -->
    <div>
        <div style="font-weight: bold; color: #4e69a2;">
            <?php echo htmlspecialchars($ROW_USER['first_name'] . " " . $ROW_USER['last_name']); ?>
        </div>

        <div>
            <?php echo nl2br(htmlspecialchars($ROW['post'])); ?>
        </div>

        <br>

        <a href="">Like</a> |
        <a href="">Comment</a> |
        <a href="">Share</a> |
        <span style="color: #aaa;">
            <?php echo $dateText; ?>
        </span>
    </div></div>