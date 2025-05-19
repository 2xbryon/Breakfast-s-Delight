<?php
// Include database connection
include 'config.php';
$page_title = "Add New Recipe";
include 'header.php';

$title = $ingredients = $instructions = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    $instructions = mysqli_real_escape_string($conn, $_POST['instructions']);

    // Insert into database
    $sql = "INSERT INTO recipes (title, ingredients, instructions) VALUES ('$title', '$ingredients', '$instructions')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Recipe</title>
    <link rel="stylesheet" href="styles.css">
     <style>
        form {
            max-width: 600px;  /* Increased max-width */
            margin: auto;
            margin-top: 20px;
            background: white;
            padding: 30px;  /* Increased padding */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;  /* Larger font size */
        }

        label {
            margin: 12px 0 6px;  /* Spacing adjustment */
            display: block;
            font-weight: bold;
            font-size: 16px;  /* Larger font size */
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;  /* Increased padding */
            margin: 6px 0 12px;  /* Spacing adjustments */
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;  /* Larger font size */
        }

        textarea {
            min-height: 150px;  /* Larger textarea */
            resize: vertical;  /* Allow resizing */
        }

        button {
            width: 100%;
            padding: 12px;  /* Increased padding */
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;  /* Larger button text */
        }

        button:hover {
            background-color: #4cae4c;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                max-width: 90%;  /* More responsive form width */
                padding: 20px;  /* Adjust padding for smaller screens */
            }

            input[type="text"], textarea {
                font-size: 14px;  /* Slightly smaller font for mobile */
            }

            button {
                font-size: 16px;  /* Adjust button font size for mobile */
            }
        }
    </style>
</head>
<body>
<form method="POST" action="add_recipe.php">
    <label>Title:</label>
    <input type="text" name="title" required>
    <label>Ingredients:</label>
    <textarea name="ingredients" required></textarea>
    <label>Instructions:</label>
    <textarea name="instructions" required></textarea>
    <button type="submit">Add Recipe</button>
</form>
</body>
</html>
