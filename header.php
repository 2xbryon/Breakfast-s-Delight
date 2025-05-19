<!-- You can include the Styles.css link here if you need -->
<link rel="stylesheet" href="styles.css">

<header>
    <nav class="navbar">
        <!-- Dropdown Menu on the Left -->
        <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
                <a href="index.php">Home</a>
                <a href="add_recipe.php">Add Recipe</a>
                <a href="search_recipe.php">Search Recipe</a>
            </div>
        </div>

        <!-- Page Title in the Center -->
        <span class="navbar-title"><?php echo isset($page_title) ? $page_title : 'Page Title'; ?></span>
    </nav>
</header>

