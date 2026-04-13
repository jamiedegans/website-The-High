<?php
include_once 'database.php';

$zoekopdracht = $_GET['zoekopdracht'] ?? '';

if ($zoekopdracht == '') {
    $sql = "SELECT * FROM menu";
    $statement = $pdo->prepare($sql);
    $statement->execute();
} else {
    $sql = "SELECT * FROM menu WHERE naam   LIKE ? OR ingredients LIKE ? OR allergens LIKE ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        '%' . $zoekopdracht . '%',
        '%' . $zoekopdracht . '%',
        '%' . $zoekopdracht . '%'
    ]);
}
$menuItems = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu – The High Solan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="javascript\menu.js" defer></script>
</head>

<body>
    <!-- ===================== HEADER ===================== -->
    <?php
    include_once 'costums/header.php';
    ?>
    <!-- ===================== MAIN ===================== -->
    <main class="site-main">


        <!-- Page header + search bar -->
        <div class="page-header">
            <h2>Our Menu</h2>
            <p>Fresh ingredients, bold flavours</p>


            <p id="search-notice" style="margin-top:0.75rem; font-size:0.85rem; color:#7C7C7C;"></p>
        </div>

        <menu-card dish-name="Pizza" dish-price="12.99" dish-description="A delicious pizza with fresh ingredients." dish-ingredients="Tomato sauce, mozzarella, pepperoni" dish-allergens="Gluten, Dairy" dish-category="Main Course" dish-img="images/dishes/placeholder.png"></menu-card>


        <!-- Menu grid — 3 cards per row, wraps on smaller screens -->
        <div class="inner" style="padding-bottom:4rem;">
            <div class="card-row" id="menu-grid" style="flex-wrap:wrap;">
                <?php
                foreach ($menuItems as $menuItem) {
                    $image_url = $menuItem['image_url'];
                    if ($image_url == "" || $image_url === null) {
                        $image_url = "images/dishes/placeholder.png";
                    } else {
                        $image_url = "images/dishes/" . $image_url . ".png";
                    }
                    ?>


                    <div class="menu-card">
                        <div class="card-img-wrap">
                            <img src="<?php echo $image_url; ?>" alt="<?php echo $menuItem['naam']; ?>" />
                            <span class="card-badge">
                                <?php echo $menuItem['category']; ?>
                            </span>
                        </div>

                        <div class="card-body">
                            <h3 class="card-title">
                                <?php echo $menuItem['naam']; ?>
                            </h3>
                            <p class="card-desc">
                                <?php echo $menuItem['ingredients']; ?>
                            </p>
                            <p class="card-price">€
                                <?php echo number_format($menuItem['prijs'], 2); ?>
                            </p>
                            <button class="btn-allergen" onclick="toggleAllergen(<?php echo $menuItem['id']; ?>)"></button>
                            <i class="fa fa-info-circle"></i> Ingredients & Allergens
                            </button>

                            <!-- Allergen panel — hidden by default, opens on click -->
                            <div class="allergen-panel" id="allergen-<?php echo $menuItem['id']; ?>">
                                <p><strong>Ingredients:</strong>
                                    <?php echo $menuItem['ingredients']; ?>
                                </p>
                                <p><strong>Allergens:</strong></p>
                                <div class="allergen-tags">
                                    <?php
                                    $allergens = array_filter(array_map('trim', explode(',', $menuItem['allergens'])));
                                    if (count($allergens) === 0) {
                                        echo '<span class="allergen-tag">None</span>';
                                    } else {
                                        foreach ($allergens as $allergen) {
                                            echo '<span class="allergen-tag">' . htmlspecialchars($allergen) . '</span>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </main>


    <!-- ===================== FOOTER ===================== -->
    <?php
    include_once 'costums/footer.php';
    ?>
    <!-- ===================== JAVASCRIPT ===================== -->
    <script>
        function toggleAllergen(id) {
            const panel = document.getElementById('allergen-' + id);
            if (!panel) { console.log('Panel not found for id:', id); return; }
            panel.classList.toggle('open');
            console.log('Classes now:', panel.className); // Should show "allergen-panel open"
        }
    </script>

</body>

</html>