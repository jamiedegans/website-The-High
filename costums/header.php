<header class="site-header">
    <div class="header-inner">
        <a href="index.php" class="logo">
            <img src="images\logo.png" alt="The High Solan" class="logo-img" />
            <span class="logo-text">The High Solan</span>
        </a>
        <nav class="main-nav">
            <a href="index.php" class="nav-link active">Home</a>
            <a href="menu.php" class="nav-link">Menu</a>
            <a href="about.php" class="nav-link">About</a>
            <a href="contact.php" class="nav-link">Contact</a>
        </nav>
        <div class="header-actions">
            <div class="search-bar">
                <input type="text" placeholder="Search menu..."
                    onkeydown="if(event.key==='Enter') window.location='menu.php?q='+this.value" />
                <button class="search-btn"><i class="fa fa-search"></i></button>
            </div>
            <a href="cart.php" class="cart-btn">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-count" id="cart-badge">0</span>
            </a>
            <a href="login.php" class="btn btn-primary">
                <i class="fa fa-user"></i> Login
            </a>
        </div>

        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="fa fa-bars"></i>
        </button>
    </div>

    <nav class="mobile-nav" id="mobile-nav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="menu.php" class="nav-link">Menu</a>
        <a href="about.php" class="nav-link">About</a>
        <a href="contact.php" class="nav-link">Contact</a>
        <a href="login.php" class="nav-link">Login</a>
        <a href="cart.php" class="nav-link">Cart</a>
    </nav>
</header>