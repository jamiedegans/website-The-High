<form name="searchBar" action="menu.php" method="get">

    <div class="search-bar">
        <input
            class="form-input"
            name="zoekopdracht"
            type="text"
            placeholder="Search menu..."
        />
        <button class="search-btn" type="submit" name="submit" value="Search">
            <i class="fa fa-search"></i>
        </button>
    </div>

</form>

<?php
if (isset($_GET['submit'])) {
    $zoekopdracht = $_GET['zoekopdracht'];
    $sql = "SELECT * FROM menu WHERE name LIKE ?";
    $statement = $pdo->prepare($sql);
    $statement->execute(['%' . $zoekopdracht . '%']);
    $menuItems = $statement->fetchAll();
    echo count($menuItems) . " results found!";
}
?>
