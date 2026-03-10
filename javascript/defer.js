class RestaurantHeader extends HTMLElement {
  constructor() {
    super();

    // Maak een Shadow DOM
    const shadow = this.attachShadow({ mode: 'open' });


    // Voeg HTML + CSS toe binnen Shadow DOM
    shadow.innerHTML = `
<style>
  @import url('css/style.css'); // sinds de dom zijn eigen scope heeft, moet je hier de css 
  // importeren anderen werkt het niet de javascript doet het wel omdat die in de globale scope zit
</style>
      <header class="site-header">
    <div class="header-inner">
      <a href="index.php" class="logo">
        <img src="img/logo.png" alt="The High Solan" class="logo-img" />
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
    `;
  }
}

class RestaurantFooter extends HTMLElement {
  constructor() {
    super();

    // Maak een Shadow DOM
    const shadow = this.attachShadow({ mode: 'open' });

    // Voeg HTML + CSS toe binnen Shadow DOM
    shadow.innerHTML = `
<style>
  @import url('css/style.css'); // sinds de dom zijn eigen scope heeft, moet je hier de css 
  // importeren anderen werkt het niet de javascript doet het wel omdat die in de globale scope zit
</style>
  <footer class="site-footer">
    <div class="footer-inner">
      <div class="footer-brand">
        <img src="img/logo.png" alt="The High Solan" class="footer-logo" />
        <p class="footer-tagline">"The High because this always the hype"</p>
      </div>
      <div class="footer-col">
        <h4>Navigate</h4>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
      </div>
      <div class="footer-col">
        <h4>Account</h4>
        <a href="login.php">Login</a>
        <a href="cart.php">My Cart</a>
      </div>
      <div class="footer-col">
        <h4>Visit Us</h4>
        <span>Op De Dijk, Amsterdam</span>
        <span>+31 20 000 0000</span>
        <span>info@thehighsolan.nl</span>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 The High Solan – Amsterdam. All rights reserved.</p>
    </div>
  </footer>
`;
  }
}


// Registreer het custom element
customElements.define('restaurant-footer', RestaurantFooter);


/* ----------------------------------------------------------
   SEARCH — filter menu items by name, description or ingredients
---------------------------------------------------------- */
function searchMenu(query) {
  const q = query.trim().toLowerCase();
  if (q === '') return menuItems;

  return menuItems.filter(function (item) {
    return (
      item.name.toLowerCase().includes(q) ||
      item.description.toLowerCase().includes(q) ||
      item.ingredients.join(' ').toLowerCase().includes(q)
    );
  });
}

/* ----------------------------------------------------------
   MOBILE MENU TOGGLE
---------------------------------------------------------- */
function toggleMobileMenu() {
  document.getElementById('mobile-nav').classList.toggle('open');
}


/* ----------------------------------------------------------
   INIT — runs on every page load
---------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', function () {
  updateCartBadge();
});