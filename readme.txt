Helps to keep track.
But this is a breakfast blog-esque website where user can browse, search and add their own recipes

All pages include header.php and config.php.
Config.php connects the webpage to the server

1)index.php
Line 5-10: Fetches all the recipes from the database and displays them on the homepage
Line 12-20: Loops through every recipe and displays them with a photo

2)search_recipe.php
Line 5: Defines the character set to utf8mb4 to allow special characters (AI suggested)
Line 7-10: Handles the search form submission
Line 12-15: Sanitizes input from the user to prevent SQL injection (AI suggested)
Line 17-20: Search db188 for reciper by title or ingredients
Line 22-27: Runs the query and checks for errors, printing results number if OK
Line 29-35: Displays results of search or message if there are no recipes

3)recipe_details.php
Line 5: Captures recipe ID from GET parameter and cleans it
Line 7-10: Builds and executes SQL query to fetch the details of the recipe from the database
Line 12-18: Displays title of the recipe, ingredients, and instructions if found
Line 20: Shows an error message if the recipe is not valid or does not exist

4)add_recipe.php
Line 5-8: Defines variables for recipe title, ingredients, and instructions
Line 10-21: Handles form submission, sanitizes input, and adds the recipe to the database
Line 23-25: Sends the page to the homepage if it successfully submits
Line 27-30: Displays an error message when it fails to add

5)header.php
Only made it a php file to make the title dynamic and not have to do to much for it to match the appropiate page
