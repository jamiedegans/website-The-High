<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The High Solan – Amsterdam</title>
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
  <header><restaurant-header></restaurant-header></header>
  <!-- ===================== MAIN ===================== -->
  <main class="site-main">


    <!-- HERO -->
    <section>
      <div class="hero">

        <div class="hero-content">
          <p class="hero-label">Amsterdam · Op De Dijk</p>
          <h1 class="hero-title">The High Solan</h1>
          <p class="hero-slogan">"The High because this always the hype"</p>
          <div class="hero-buttons">
            <a href="menu.html" class="btn btn-primary">View Menu</a>
            <a href="cart.html" class="btn btn-outline">Order Now</a>
          </div>
        </div>

        <div class="hero-image">
          <!-- Replace img/hero.jpg with your own photo -->
          <img src="img/hero.jpg" alt="Signature dish from The High Solan" class="hero-img" />
        </div>

      </div>
    </section>


    <!-- FEATURED DISHES — 3 per row -->
    <section class="section-block">
      <div class="inner">
        <div class="section-head">
          <h2>Featured Dishes</h2>
          <p>Handpicked favourites from our kitchen</p>
        </div>
        <!-- Cards rendered here by JavaScript -->
        <div class="card-row centered" id="featured-grid"></div>
        <div style="text-align:center; margin-top:2rem;">
          <a href="menu.html" class="btn btn-outline">See Full Menu</a>
        </div>
      </div>
    </section>


    <!-- INFO ROW — 3 blocks -->
    <section class="section-block dark">
      <div class="inner">
        <div class="card-row centered">

          <div class="info-card">
            <i class="fa fa-map-marker-alt info-icon"></i>
            <h3>Location</h3>
            <p>Op De Dijk, Amsterdam</p>
          </div>

          <div class="info-card">
            <i class="fa fa-clock info-icon"></i>
            <h3>Hours</h3>
            <p>Mon – Sun: 12:00 – 23:00</p>
          </div>

          <div class="info-card">
            <i class="fa fa-phone info-icon"></i>
            <h3>Reservations</h3>
            <p>+31 20 000 0000</p>
          </div>

        </div>
      </div>
    </section>


  </main>


  <!-- ===================== FOOTER ===================== -->
  <footer>
<restaurant-footer></restaurant-footer>
  </footer>


  <!-- ===================== JAVASCRIPT ===================== -->
  <script src="javascript/+javascript.js">
  </script>
  <script src="javascript/defer.js"></script>
  <script>

    /* Render the 3 featured dishes on the homepage */
    function renderFeatured() {
      const featured = menuItems.filter(function (item) { return item.featured; });
      const grid = document.getElementById('featured-grid');
      grid.innerHTML = '';

      featured.slice(0, 3).forEach(function (item) {
        grid.innerHTML += buildMenuCard(item);
      });
    }

    /* Run when page loads */
    renderFeatured();

  </script>

</body>

</html>