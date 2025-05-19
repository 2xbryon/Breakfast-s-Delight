<?php
// Include database connection
include 'config.php';
$page_title = "View Recipe";
include 'header.php';

mysqli_set_charset($conn, 'utf8mb4');

// Check if recipe ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Recipe not found.";
    exit;
}

$recipe_id = intval($_GET['id']);

// Fetch recipe details from the database
$sql = "SELECT * FROM recipes WHERE id = $recipe_id";
$result = $conn->query($sql);

if ($result === false || $result->num_rows == 0) {
    echo "Recipe not found.";
    exit;
}

$recipe = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $recipe['title']; ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .recipe-container { max-width: 800px; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        p { margin: 10px 0; color: #555; }
        .back-link { display: inline-block; margin: 20px 0; color: #5cb85c; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="recipe-container">
    <h2><?php echo htmlspecialchars($recipe['title']); ?></h2>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($recipe['description']); ?></p>
    <p><strong>Ingredients:</strong><br><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
    <p><strong>Instructions:</strong><br><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
    <p><strong>Preparation Time:</strong> <?php echo htmlspecialchars($recipe['prep_time']); ?> minutes</p>
    <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cook_time']); ?> minutes</p>
    <p><strong>Servings:</strong> <?php echo htmlspecialchars($recipe['servings']); ?></p>
    <a href="search_recipe.php" class="back-link">Back to Search</a>
</div>
</body>
</html>
