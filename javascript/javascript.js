/* ============================================================
   THE HIGH SOLAN — script.js
   Shared across all pages.
   Cart uses localStorage so it persists between pages.
   TODO comments show where to add database calls later.
============================================================ */


/* ----------------------------------------------------------
   MENU DATA
   TODO: replace this array with a real fetch() call:
   const menuItems = await fetch('/api/menu').then(r => r.json());
---------------------------------------------------------- */
const menuItems = [
    {
        id: 1,
        name: "Truffle Wagyu Burger",
        description: "Premium wagyu beef patty with black truffle, aged cheddar and caramelised onion on a brioche bun.",
        price: 22.50,
        category: "mains",
        ingredients: ["wagyu beef", "black truffle", "aged cheddar", "brioche bun", "caramelised onion", "lettuce", "truffle mayo"],
        allergens: ["gluten", "dairy", "eggs"],
        featured: true,
        image: "img/dish-1.jpg"
    },
    {
        id: 2,
        name: "Lobster Bisque",
        description: "Creamy Atlantic lobster bisque with a touch of cognac and fresh cream, served with sourdough crostini.",
        price: 16.00,
        category: "starters",
        ingredients: ["Atlantic lobster", "cream", "cognac", "celery", "onion", "sourdough crostini"],
        allergens: ["shellfish", "gluten", "dairy"],
        featured: true,
        image: "img/dish-2.jpg"
    },
    {
        id: 3,
        name: "Smoked Duck Breast",
        description: "Slow-smoked duck breast with cherry reduction, wild mushrooms and pommes dauphine.",
        price: 26.00,
        category: "mains",
        ingredients: ["duck breast", "cherry reduction", "wild mushrooms", "pommes dauphine", "thyme", "butter"],
        allergens: ["dairy", "eggs"],
        featured: true,
        image: "img/dish-3.jpg"
    },
    {
        id: 4,
        name: "Burrata & Heirloom Tomato",
        description: "Fresh burrata with heirloom tomatoes, basil oil, smoked sea salt and aged balsamic.",
        price: 13.50,
        category: "starters",
        ingredients: ["burrata", "heirloom tomatoes", "basil oil", "smoked sea salt", "aged balsamic"],
        allergens: ["dairy"],
        featured: false,
        image: "img/dish-4.jpg"
    },
    {
        id: 5,
        name: "Black Truffle Pasta",
        description: "Hand-rolled tagliatelle in brown butter, parmesan and fresh black truffle shavings.",
        price: 24.00,
        category: "mains",
        ingredients: ["tagliatelle", "black truffle", "brown butter", "parmesan", "garlic", "fresh herbs"],
        allergens: ["gluten", "dairy", "eggs"],
        featured: false,
        image: "img/dish-5.jpg"
    },
    {
        id: 6,
        name: "Dark Chocolate Fondant",
        description: "Warm 70% dark chocolate fondant with salted caramel core and vanilla bean ice cream.",
        price: 10.00,
        category: "desserts",
        ingredients: ["dark chocolate", "salted caramel", "butter", "eggs", "flour", "vanilla ice cream"],
        allergens: ["gluten", "dairy", "eggs"],
        featured: false,
        image: "img/dish-6.jpg"
    }
];


/* ----------------------------------------------------------
   CART — stored in localStorage so it works across pages
   TODO: when you have a real login, store cart server-side
---------------------------------------------------------- */
function getCart() {
    const raw = localStorage.getItem('highsolan_cart');
    return raw ? JSON.parse(raw) : [];
}

function saveCart(cart) {
    localStorage.setItem('highsolan_cart', JSON.stringify(cart));
}

function addToCart(itemId) {
    const item = menuItems.find(function (m) { return m.id === itemId; });
    if (!item) return;

    const cart = getCart();
    const existing = cart.find(function (c) { return c.id === itemId; });

    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({ id: item.id, name: item.name, price: item.price, quantity: 1 });
    }

    saveCart(cart);
    updateCartBadge();
    showToast(item.name + ' added to cart!');
}

function removeFromCart(itemId) {
    const cart = getCart().filter(function (c) { return c.id !== itemId; });
    saveCart(cart);
    updateCartBadge();
}

function changeQty(itemId, delta) {
    const cart = getCart();
    const item = cart.find(function (c) { return c.id === itemId; });
    if (!item) return;

    item.quantity += delta;

    if (item.quantity <= 0) {
        saveCart(cart.filter(function (c) { return c.id !== itemId; }));
    } else {
        saveCart(cart);
    }

    updateCartBadge();
}

/* Update the cart count badge in the header */
function updateCartBadge() {
    const total = getCart().reduce(function (sum, item) {
        return sum + item.quantity;
    }, 0);

    const badge = document.getElementById('cart-badge');
    if (badge) badge.textContent = total;
}


/* ----------------------------------------------------------
   SESSION — simple user session stored in sessionStorage
   TODO: replace with a real server session / JWT token
---------------------------------------------------------- */
function getUser() {
    const raw = sessionStorage.getItem('highsolan_user');
    return raw ? JSON.parse(raw) : null;
}

function saveUser(user) {
    sessionStorage.setItem('highsolan_user', JSON.stringify(user));
}

function logoutUser() {
    sessionStorage.removeItem('highsolan_user');
}


/* ----------------------------------------------------------
   BUILD MENU CARD — returns HTML string
   Reused on index.html (featured) and menu.html (full grid)
---------------------------------------------------------- */
function buildMenuCard(item) {
    /* Build allergen tag HTML */
    let allergenTags = '';
    item.allergens.forEach(function (a) {
        allergenTags += '<span class="allergen-tag">' + a + '</span>';
    });

    return `
    <div class="menu-card">

      <div class="card-img-wrap">
        <img src="${item.image}" alt="${item.name}" />
        <span class="card-badge">${item.category}</span>
      </div>

      <div class="card-body">
        <h3 class="card-title">${item.name}</h3>
        <p class="card-desc">${item.description}</p>
        <p class="card-price">€ ${item.price.toFixed(2)}</p>

        <!-- Toggle button — shows ingredients & allergens -->
        <button class="btn-allergen" onclick="toggleAllergens(${item.id})">
          <i class="fa fa-info-circle"></i> Ingredients & Allergens
        </button>

        <!-- Allergen panel — hidden by default, opens on click -->
        <div class="allergen-panel" id="allergen-${item.id}">
          <p><strong>Ingredients:</strong> ${item.ingredients.join(', ')}</p>
          <p><strong>Allergens:</strong></p>
          <div class="allergen-tags">${allergenTags}</div>
        </div>

        <button class="btn btn-primary btn-sm" onclick="addToCart(${item.id})">
          <i class="fa fa-plus"></i> Add to Cart
        </button>
      </div>

    </div>
  `;
}

/* Toggle allergen panel open/closed */
function toggleAllergens(itemId) {
    const panel = document.getElementById('allergen-' + itemId);
    if (panel) panel.classList.toggle('open');
}


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
   TOAST — small notification popup
---------------------------------------------------------- */
function showToast(message) {
    /* Remove any existing toast */
    const old = document.querySelector('.toast');
    if (old) old.remove();

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;
    document.body.appendChild(toast);

    /* Show */
    setTimeout(function () { toast.classList.add('show'); }, 10);

    /* Hide after 2.5 seconds */
    setTimeout(function () {
        toast.classList.remove('show');
        setTimeout(function () { toast.remove(); }, 400);
    }, 2500);
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