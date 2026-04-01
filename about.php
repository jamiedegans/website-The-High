<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About – The High Solan</title>
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

        <div class="page-header">
            <h2>About Us</h2>
            <p>The story behind The High Solan</p>
        </div>

        <div class="inner" style="padding-bottom:5rem;">


            <!-- Story block: image left, text right -->
            <div class="about-block">

                <div style="flex:1;">
                    <!-- Replace img/interior.jpg with your own interior photo -->
                    <img src="images/insideview.png" alt="The High Solan interior"
                        style="width:100%; height:380px; border-radius:10px; border:1px solid #2a2a2a;" />
                </div>

                <div class="about-text" style="flex:1;">
                    <h2>Our Story</h2>
                    <p>
                        Welcome to The High Solan — Amsterdam's most talked-about dining destination.
                        Located on Op De Dijk, we bring bold flavours and a luxury atmosphere together
                        under one roof.
                    </p>
                    <p>
                        Everything we serve is crafted from fresh, local ingredients. Our kitchen team
                        is passionate about elevating every dish, every time. No shortcuts. No compromise.
                    </p>
                    <p class="about-slogan">"The High because this always the hype"</p>
                    <a href="menu.php" class="btn btn-primary" style="margin-top:0.5rem;">
                        <i class="fa fa-utensils"></i> View Our Menu
                    </a>
                </div>

            </div>


            <!-- Three interior photos in a row -->
            <div class="card-row" style="margin-top:1rem;">
                <!-- Replace these images with your own interior photos -->
                <div class="photo-card">
                    <img src="images/view1png.png" alt="Interior view 1" />
                </div>
                <div class="photo-card">
                    <img src="images/view2.png" alt="Interior view 2" />
                </div>
                <div class="photo-card">
                    <img src="img/interior-4.jpg" alt="Interior view 3" />
                </div>
            </div>


        </div>

    </main>


    <!-- ===================== FOOTER ===================== -->
  <?php
    include_once 'costums/footer.php';
    ?>
    <!-- ===================== JAVASCRIPT ===================== -->
    <script src="javascript\javascript.js"></script>

</body>

</html>