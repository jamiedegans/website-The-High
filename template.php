<?php
session_start();
include_once "database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit();
}

// ADD THIS BELOW to fetch the item data for pre-filling the form
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM menu 
WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    echo "Item not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The High Solan – Amsterdam</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <!-- Icons (replace individual icons by changing the fa-* class name) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Your stylesheet -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>


    <!-- ============================================================
     HEADER — copy this to every page, change active nav link
============================================================ -->
    <?php
    include_once 'costums/header.php';
    ?>
    <main class="site-main">

        <div class="admin-box">
            <h3><i class="fa fa-edit"></i> Edit Menu Item</h3>

            <form action="update.php" method="POST">

                
                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>" />

                <div class="form-group">
                    <label>Dish Name</label>
                    
                    <input type="text" name="dish-name" class="form-input"
                        value="<?php echo htmlspecialchars($row['naam']); ?>" required />
                </div>

                <div class="form-group">
                    <label>Price (€)</label>
                    <input type="number" name="dish-price" class="form-input" step="0.01" min="0"
                        value="<?php echo $row['prijs']; ?>" required />
                </div>

                <div class="form-group">
                    <label>Ingredients</label>
                    <input type="text" name="dish-ingredients" class="form-input"
                        value="<?php echo htmlspecialchars($row['ingredients']); ?>" required />
                </div>

                <div class="form-group">
                    <label>Allergens</label>
                    <input type="text" name="dish-allergens" class="form-input"
                   
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="dish-category" class="form-input">
                        <option value="starters" <?php echo $row['category'] === 'starters' ? 'selected' : ''; ?>>Starters
                        </option>
                        <option value="mains" <?php echo $row['category'] === 'mains' ? 'selected' : ''; ?>>Main Dishes
                        </option>
                        <option value="desserts" <?php echo $row['category'] === 'desserts' ? 'selected' : ''; ?>>Desserts
                        </option>
                        <option value="drinks" <?php echo $row['category'] === 'drinks' ? 'selected' : ''; ?>>Drinks
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Featured on homepage?</label>
                    <select name="dish-featured" class="form-input">
                        <option value="0" <?php echo $row['featured'] == 0 ? 'selected' : ''; ?>>No</option>
                        <option value="1" <?php echo $row['featured'] == 1 ? 'selected' : ''; ?>>Yes</option>
                    </select>
                </div>

                <button type="submit" name="edit_item" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save Changes
                </button>

            </form>
        </div>
    </main>


    <!-- ============================================================
     FOOTER — copy this to every page
============================================================ -->
    <footer>
    </footer>
    <!-- Shared JavaScript -->
   </body>

</html>