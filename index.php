<?php
// Include database connection
include 'config.php';
$page_title = "Breakfast Recipes";
include 'header.php'; 

// Fetch all recipes from the database
$sql = "SELECT title, description, prep_time, cook_time, servings, instructions, created_at FROM recipes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <?php 
                // Generate base filename from the recipe title
                $base_filename = "images/" . str_replace(' ', '-', $row['title']);
                $allowed_extensions = ['jpg', 'png', 'webp', 'gif'];	

                // Check for each allowed extension
                foreach ($allowed_extensions as $ext) {
                    if (file_exists("$base_filename.$ext")) {
                        $image_path = "$base_filename.$ext";
                        break;
                    }
                }
            ?>
            <div>
                <div>
                    <h1><?php echo htmlspecialchars($row['title']); ?></h1>
                    <p>Added on: <?php echo $row['created_at']; ?></p>
                    <p>Prep Time: <?php echo $row['prep_time']; ?> min | 
                    Cook Time: <?php echo $row['cook_time']; ?> min</p>
                    <p>Servings: <?php echo $row['servings']; ?></p>
                    <p>Description: <?php echo htmlspecialchars($row['description']); ?></p>
                    <p>Instructions:</p>
                    <p><?php echo nl2br(htmlspecialchars($row['instructions'])); ?></p>
                </div>
                
                <?php if (isset($image_path)): ?>
                    <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No recipes found.</p>  
    <?php endif; ?>

    <footer>
        <p>&copy; 2025 Recipe Management. All Rights Reserved.</p>
    </footer>

</body>
</html>
