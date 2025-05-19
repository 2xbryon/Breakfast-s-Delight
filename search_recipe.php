<?php
// Include database connection
include 'config.php';
$page_title = "Search Recipes";
include 'header.php';

mysqli_set_charset($conn, 'utf8mb4');

$search_term = "";
$search_results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_term = mysqli_real_escape_string($conn, $_POST['search_term']);

    // Query to search for recipes by title (case-insensitive)
    $sql = "SELECT * FROM recipes WHERE title LIKE '%$search_term%' COLLATE utf8mb4_general_ci";

    // Execute the query
    $result = $conn->query($sql);

    if ($result === false) {
        // Display the SQL error if the query fails
        echo "SQL Error: " . $conn->error;
    } else {
        // Check the number of rows returned
        echo "Number of results: " . $result->num_rows . "<br>";

        if ($result->num_rows > 0) {
            // Store the results in an array
            while ($row = $result->fetch_assoc()) {
                $search_results[] = $row;
            }
        } else {
            echo "No recipes found matching your search term.";
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Recipes</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Search form styling */
        .search-form {
            max-width: 500px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-form input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #4cae4c;
        }

        .search-results {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-results h3 {
            text-align: center;
        }

        .recipe-item {
            padding: 15px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .recipe-item h4 {
            color: #333;
        }

        .recipe-item p {
            color: #555;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-form {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Search Form -->
    <form class="search-form" method="POST" action="search_recipe.php">
        <h2>Search for a Recipe</h2>
        <input type="text" name="search_term" placeholder="Enter recipe title or ingredients" value="<?php echo $search_term; ?>" required>
        <button type="submit">Search</button>
    </form>

    <!-- Search Results -->
    <?php if (!empty($search_results)): ?>
        <div class="search-results">
            <h3>Search Results:</h3>
            <?php foreach ($search_results as $recipe): ?>
                <div class="recipe-item">
                    <h4><?php echo $recipe['title']; ?></h4>
                    <p><strong>Ingredients:</strong> <?php echo substr($recipe['ingredients'], 0, 100); ?>...</p>
                    <p><strong>Instructions:</strong> <?php echo substr($recipe['instructions'], 0, 100); ?>...</p>
                    <a href="recipe_details.php?id=<?php echo $recipe['id']; ?>">View Recipe</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No recipes found matching your search term.</p>
    <?php endif; ?>

</body>
</html>
