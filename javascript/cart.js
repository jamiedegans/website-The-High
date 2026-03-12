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
