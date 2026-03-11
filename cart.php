<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart – The High Solan</title>
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

        <div class="page-header">
            <h2>Your Order</h2>
            <p>Review your cart before placing your order</p>
        </div>

        <div class="inner">

            <!-- LOGIN WALL — shown when no user is logged in -->
            <div id="login-wall" class="login-wall" style="display:none;">
                <i class="fa fa-lock"></i>
                <h3 style="font-family:'Cinzel',serif; color:#F8F8F8;">Login Required</h3>
                <p>You must be logged in to place an order.</p>
                <a href="login.html" class="btn btn-primary">
                    <i class="fa fa-sign-in-alt"></i> Go to Login
                </a>
            </div>


            <!-- CART LAYOUT — shown when user is logged in -->
            <div id="cart-layout" class="cart-layout" style="display:none;">

                <!-- Left: list of cart items -->
                <div class="cart-items" id="cart-items-list"></div>

                <!-- Right: order summary -->
                <div class="cart-sidebar">
                    <div class="cart-summary">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal">€ 0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Service fee (10%)</span>
                            <span id="service-fee">€ 0.00</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span id="total">€ 0.00</span>
                        </div>
                        <button class="btn btn-primary btn-full" onclick="placeOrder()">
                            <i class="fa fa-check"></i> Place Order
                        </button>
                    </div>
                </div>

            </div>


            <!-- EMPTY CART — shown when logged in but cart is empty -->
            <div id="cart-empty" class="cart-empty" style="display:none;">
                <i class="fa fa-shopping-cart"></i>
                <p>Your cart is empty.</p>
                <a href="menu.html" class="btn btn-outline" style="margin-top:1rem;">Browse Menu</a>
            </div>

        </div>

    </main>


    <!-- ===================== FOOTER ===================== -->
     <footer>
    <restaurant-footer></restaurant-footer>
    </footer>
    <!-- ===================== JAVASCRIPT ===================== -->
    <script src="javascript\javascript.js"></script>
    <script>

        const SERVICE_FEE = 0.10; /* 10% */

        /* Render all cart items and totals */
        function renderCart() {
            const user = getUser();
            const cart = getCart();
            const loginWall = document.getElementById('login-wall');
            const cartLayout = document.getElementById('cart-layout');
            const cartEmpty = document.getElementById('cart-empty');
            const cartItemsList = document.getElementById('cart-items-list');

            /* Not logged in — show login wall */
            if (!user) {
                loginWall.style.display = 'flex';
                cartLayout.style.display = 'none';
                cartEmpty.style.display = 'none';
                return;
            }

            loginWall.style.display = 'none';

            /* Cart is empty */
            if (cart.length === 0) {
                cartLayout.style.display = 'none';
                cartEmpty.style.display = 'flex';
                return;
            }

            /* Cart has items */
            cartLayout.style.display = 'flex';
            cartEmpty.style.display = 'none';

            /* Build each cart item row */
            cartItemsList.innerHTML = '';
            cart.forEach(function (item) {
                cartItemsList.innerHTML += `
        <div class="cart-item">

          <div class="cart-item-info">
            <p class="cart-item-name">${item.name}</p>
            <p class="cart-item-unit">€ ${item.price.toFixed(2)} each</p>
          </div>

          <div class="qty-controls">
            <button class="qty-btn" onclick="updateQty(${item.id}, -1)">–</button>
            <span class="qty-value">${item.quantity}</span>
            <button class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
          </div>

          <span class="cart-line-total">€ ${(item.price * item.quantity).toFixed(2)}</span>

          <button class="cart-remove-btn" onclick="deleteItem(${item.id})" aria-label="Remove item">
            <i class="fa fa-trash"></i>
          </button>

        </div>
      `;
            });

            /* Calculate and display totals */
            const subtotal = cart.reduce(function (sum, item) {
                return sum + (item.price * item.quantity);
            }, 0);
            const fee = subtotal * SERVICE_FEE;
            const total = subtotal + fee;

            document.getElementById('subtotal').textContent = '€ ' + subtotal.toFixed(2);
            document.getElementById('service-fee').textContent = '€ ' + fee.toFixed(2);
            document.getElementById('total').textContent = '€ ' + total.toFixed(2);
        }

        /* Change item quantity and re-render */
        function updateQty(itemId, delta) {
            changeQty(itemId, delta);
            renderCart();
        }

        /* Remove item and re-render */
        function deleteItem(itemId) {
            removeFromCart(itemId);
            renderCart();
        }

        /* Place the order */
        function placeOrder() {
            const user = getUser();
            const cart = getCart();

            if (!user) { window.location.href = 'login.html'; return; }
            if (cart.length === 0) { alert('Your cart is empty.'); return; }

            /* -------------------------------------------------------
               TODO: send the order to your database
               Example:
                 const orderData = {
                   userId   : user.id,
                   items    : cart,
                   total    : parseFloat(document.getElementById('total').textContent.replace('€','').trim()),
                   createdAt: new Date().toISOString()
                 };
                 await fetch('/api/orders', {
                   method : 'POST',
                   headers: { 'Content-Type': 'application/json' },
                   body   : JSON.stringify(orderData)
                 });
            ------------------------------------------------------- */

            alert('Order placed! Thank you, ' + user.name + '. We will prepare your order shortly.');

            /* Clear the cart after placing */
            localStorage.removeItem('highsolan_cart');
            updateCartBadge();
            renderCart();
        }

        /* Update login button if already logged in */
        function updateLoginButton() {
            const user = getUser();
            const loginBtn = document.getElementById('login-btn');
            if (user && loginBtn) {
                loginBtn.innerHTML = '<i class="fa fa-user"></i> ' + user.name;
                loginBtn.href = '#';
                loginBtn.onclick = function () {
                    logoutUser();
                    window.location.href = 'index.html';
                };
            }
        }

        /* Run on page load */
        updateLoginButton();
        renderCart();

    </script>

</body>

</html>