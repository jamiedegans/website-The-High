<?php
include_once 'database.php';

$zoekopdracht = $_GET['zoekopdracht'] ?? '';

if ($zoekopdracht == '') {
    $sql = "SELECT * FROM menu";
    $statement = $pdo->prepare($sql);
    $statement->execute();
} else {
    $sql = "SELECT * FROM menu WHERE naam LIKE ? OR ingredients LIKE ? OR allergens LIKE ?";
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


            <!-- Search result count -->
            <p id="search-notice" style="margin-top:0.75rem; font-size:0.85rem; color:#7C7C7C;"></p>
        </div>


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

                            <!-- Toggle button — shows ingredients & allergens -->
                            <button class="btn-allergen" onclick="toggleAllergens(<?php echo $menuItem['id']; ?>)">
                                <i class="fa fa-info-circle"></i> Ingredients & Allergens
                            </button>

                            <!-- Allergen panel — hidden by default, opens on click -->
                            <div class="allergen-panel" id="allergen-<?php echo $menuItem['id']; ?>">
                                <p><strong>Ingredients:</strong>
                                    <?php echo $menuItem['ingredients']; ?>
                                </p>
                                <p><strong>Allergens:</strong></p>
                                <div class="allergen-tags">
                                    <?php echo $menuItem['allergens']; ?>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-sm" onclick="addToCart(<?php echo $menuItem['id']; ?>)">
                                <i class="fa fa-plus"></i> Add to Cart
                            </button>
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
    <script src="javascript/menu.js"></script>
    <script>

        /* Render all menu items (or a filtered subset) */
        function renderMenu(items) {
            const grid = document.getElementById('menu-grid');
            grid.innerHTML = '';

            if (items.length === 0) {
                grid.innerHTML = '<p style="color:#7C7C7C; padding:3rem 0; width:100%; text-align:center;">No dishes found. Try a different search.</p>';
                return;
            }

            items.forEach(function (item) {
                grid.innerHTML += buildMenuCard(item);
            });
        }

        /* Filter as the user types */
        function handleSearch(query) {
            /* Keep both search inputs in sync */
            const headerInput = document.getElementById('search-input');
            const menuInput = document.getElementById('menu-search');
            if (headerInput) headerInput.value = query;
            if (menuInput) menuInput.value = query;

            const results = searchMenu(query);
            renderMenu(results);

            const notice = document.getElementById('search-notice');
            if (query.trim() !== '') {
                notice.textContent = results.length + ' result(s) for "' + query + '"';
            } else {
                notice.textContent = '';
            }
        }

        /* Check if the page was opened with a search query in the URL */
        /* Example: menu.html?q=truffle */
        function checkUrlQuery() {
            const params = new URLSearchParams(window.location.search);
            const q = params.get('q');
            if (q) {
                document.getElementById('menu-search').value = q;
                handleSearch(q);
            } else {
                renderMenu(menuItems);
            }
        }

        /* Run on load */
        checkUrlQuery();

    </script>
</body>

</html>