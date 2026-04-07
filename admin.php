<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit();
}
?>

<?php
include_once 'database.php';

// Handle REMOVE item
if (isset($_POST['remove_item'])) {
    $sql = "DELETE FROM menu WHERE id = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$_POST['item_id']]);
    echo '✓ Item removed from the menu.';
}

// Handle ADD item
if (isset($_POST['add_item'])) {
    $sql = "INSERT INTO menu (naam, prijs, category, ingredients, allergens, featured, image_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        $_POST['dish-name'],
        $_POST['dish-price'],
        $_POST['dish-category'],
        $_POST['dish-ingredients'],
        $_POST['dish-allergens'],
        $_POST['dish-featured'],
        ''  // empty image no image currently, can be updated later
    ]);
    $add_notice = '✓ "' . $_POST['dish-name'] . '" added to the menu.';
}

// Fetch all menu items
$sql = "SELECT * FROM menu";
$statement = $pdo->prepare($sql);
$statement->execute();
$menuItems = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin – The High Solan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>


    <!-- ===================== HEADER ===================== -->

    <!-- ===================== MAIN ===================== -->
    <main class="site-main">

        <div class="page-header">
            <h2>Admin Panel</h2>
            <p>Manage the menu — connect to database when ready</p>
        </div>
        <div class="inner" style="padding-bottom:4rem;">
            <div class="admin-layout"><a class="btn btn-outline" href="logout.php">logout</a>

                <!-- LEFT: Add new item -->
                <div class="admin-box">
                    <h3><i class="fa fa-plus-circle"></i> Add New Menu Item</h3>

                    <form action="admin.php" method="POST">

                        <div class="form-group">
                            <label>Dish Name</label>
                            <input type="text" name="dish-name" class="form-input" placeholder="e.g. Truffle Burger"
                                required />
                        </div>

                        <div class="form-group">
                            <label>Price (€)</label>
                            <input type="number" name="dish-price" class="form-input" step="0.01" min="0" required />
                        </div>

                        <div class="form-group">
                            <label>Ingredients</label>
                            <input type="text" name="dish-ingredients" class="form-input"
                                placeholder="beef, truffle, brioche" required />
                        </div>

                        <div class="form-group">
                            <label>Allergens</label>
                            <input type="text" name="dish-allergens" class="form-input" placeholder="gluten, dairy" />
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="dish-category" class="form-input">
                                <option value="starters">Starters</option>
                                <option value="mains">Main Dishes</option>
                                <option value="desserts">Desserts</option>
                                <option value="drinks">Drinks</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Featured on homepage?</label>
                            <select name="dish-featured" class="form-input">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <button type="submit" name="add_item" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add to Menu
                        </button>
                    </form>

                    <!-- Success message after adding -->
                    <?php if (isset($add_notice)) { ?>
                        <p class="form-success"><?php echo $add_notice; ?></p>
                    <?php } ?>
                </div>


                <!-- RIGHT: Show all current items -->
                <div class="admin-box">
                    <h3><i class="fa fa-list"></i> Current Menu Items</h3>

                    <?php foreach ($menuItems as $item) { ?>
                        <div class="admin-item">
                            <div>
                                <p class="admin-item-name"><?php echo $item['naam']; ?></p>
                                <p class="admin-item-price">€ <?php echo number_format($item['prijs'], 2); ?></p>
                                <p class="admin-item-cat"><?php echo $item['category']; ?></p>
                            </div>

                            <a href="template.php?id=<?php echo $item['id']; ?>" class="btn btn-secondary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>


                            <!-- Delete button -->
                            <form action="admin.php" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>" />
                                <button type="submit" name="remove_item" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>

        </div>

    </main>


    <!-- ===================== FOOTER ===================== -->
    <!-- ===================== JAVASCRIPT ===================== -->
    <script src="javascript\javascript.js"></script>

</body>

</html>