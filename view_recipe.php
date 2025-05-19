<?php
// Include database connection
include 'config.php';

// Check if the recipe ID is provided
if (!isset($_GET['id'])) {
    die("Recipe ID not specified.");
}

// Get the recipe ID from the URL
$id = intval($_GET['id']);

// Fetch the recipe from the database
$sql = "SELECT title, ingredients, instructions, created_at FROM recipes WHERE id = $id";
$result = $conn->query($sql);

// Check if the recipe exists
if ($result->num_rows === 0) {
    die("Recipe not found.");
}

$recipe = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($recipe['title']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; }
        h1, h2 { text-align: center; }
        .details { margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
        <p>Added on: <?php echo $recipe['created_at']; ?></p>

        <div class="details">
            <h2>Ingredients</h2>
            <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
        </div>

        <div class="details">
            <h2>Instructions</h2>
            <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
        </div>

        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
