<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>rekenen</h1>
    <form name="bereken" action="opdrachten.php" method="post">
        <div> getal 1: <input name="getal1" type="text" required></div>
        <div> getal 2: <input name="getal2" type="text" required></div>
        <div> getal 3: <input name="getal3" type="text" required></div>

        <div>
        <input name="submit" type="submit"/> <input type="reset"/>
        </div>

                    <script>console.log(<?php echo $menuItem['id']; ?>);</script>
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


    <?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if(isset($_POST['submit'])){
        $getal1 = $_POST['getal1'];
        $getal2 = $_POST['getal2'];
        $getal3 = $_POST['getal3'];

        $som = $getal1 + $getal2 + $getal3;
        
    }




    ?>
</body>

</html>