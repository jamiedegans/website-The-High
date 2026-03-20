<?php
include_once 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin – The High Solan</title>
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
            <h2>Admin Panel</h2>
            <p>Manage the menu — connect to database when ready</p>
        </div>

        <div class="inner" style="padding-bottom:4rem;">
            <div class="admin-layout">


                <!-- LEFT BOX: Add new menu item -->
                <div class="admin-box">
                    <h3><i class="fa fa-plus-circle"></i> Add New Menu Item</h3>

                    <!-- TODO: add action="/api/menu" method="POST" when database is ready -->
                    <form class="admin-form" id="add-form" onsubmit="addItem(event)">

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Dish Name</label>
                                <input type="text" id="f-name" class="form-input" placeholder="e.g. Truffle Burger"
                                    required />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Price (€)</label>
                                <input type="number" id="f-price" class="form-input" placeholder="e.g. 14.50"
                                    step="0.01" min="0" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea id="f-desc" class="form-input form-textarea"
                                placeholder="Short dish description..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ingredients (comma-separated)</label>
                            <input type="text" id="f-ingredients" class="form-input"
                                placeholder="e.g. beef, truffle, brioche, lettuce" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Allergens (comma-separated)</label>
                            <input type="text" id="f-allergens" class="form-input"
                                placeholder="e.g. gluten, dairy, nuts" />
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select id="f-category" class="form-input form-select">
                                    <option value="starters">Starters</option>
                                    <option value="mains">Main Dishes</option>
                                    <option value="desserts">Desserts</option>
                                    <option value="drinks">Drinks</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Featured on homepage?</label>
                                <select id="f-featured" class="form-input form-select">
                                    <option value="false">No</option>
                                    <option value="true">Yes</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add to Menu
                        </button>

                    </form>

                    <!-- Confirmation message after adding -->
                    <p id="add-notice" class="form-success" style="margin-top:0.75rem;"></p>

                </div>


                <!-- RIGHT BOX: Current menu items list -->
                <div class="admin-box">
                    <h3><i class="fa fa-list"></i> Current Menu Items</h3>

                    <!-- Items rendered here by JavaScript -->
                    <div id="item-list"></div>

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
    <script>

        /* Guard: only owners can see this page */
        document.addEventListener('DOMContentLoaded', function () {
            const user = getUser();
            if (!user || user.role !== 'owner') {
                alert('Access denied. Owner login required.');
                window.location.href = 'login.html';
            } else {
                renderItemList();
            }
        });

        /* Render the list of current menu items with remove buttons */
        function renderItemList() {
            const list = document.getElementById('item-list');
            list.innerHTML = '';

            menuItems.forEach(function (item) {
                list.innerHTML += `
        <div class="admin-item">
          <div>
            <p class="admin-item-name">${item.name}</p>
            <p class="admin-item-price">€ ${item.price.toFixed(2)}</p>
            <p class="admin-item-cat">${item.category}</p>
          </div>
          <button class="btn btn-danger btn-sm" onclick="removeItem(${item.id})">
            <i class="fa fa-trash"></i> Remove
          </button>
        </div>
      `;
            });
        }

        /* Add a new item to the menu */
        function addItem(event) {
            event.preventDefault();

            /* Build the new item object — same structure as a database row */
            const newItem = {
                id: Date.now(),           /* TODO: use database auto-increment ID */
                name: document.getElementById('f-name').value.trim(),
                description: document.getElementById('f-desc').value.trim(),
                price: parseFloat(document.getElementById('f-price').value),
                category: document.getElementById('f-category').value,
                ingredients: document.getElementById('f-ingredients').value
                    .split(',').map(function (s) { return s.trim(); }),
                allergens: document.getElementById('f-allergens').value
                    .split(',').map(function (s) { return s.trim(); }).filter(Boolean),
                featured: document.getElementById('f-featured').value === 'true',
                image: 'img/dish-new.jpg'    /* TODO: add image upload later */
            };

            /* TODO: POST newItem to your database
               fetch('/api/menu', {
                 method : 'POST',
                 headers: { 'Content-Type': 'application/json' },
                 body   : JSON.stringify(newItem)
               });
            */

            /* For now: add to the local array */
            menuItems.push(newItem);

            /* Show confirmation and reset form */
            document.getElementById('add-notice').textContent = '✓ "' + newItem.name + '" added to the menu.';
            document.getElementById('add-form').reset();
            renderItemList();
        }

        /* Remove an item from the menu */
        function removeItem(itemId) {
            const item = menuItems.find(function (m) { return m.id === itemId; });
            if (!item) return;
            if (!confirm('Remove "' + item.name + '" from the menu?')) return;

            /* TODO: DELETE from your database
               fetch('/api/menu/' + itemId, { method: 'DELETE' });
            */

            /* For now: remove from local array */
            const index = menuItems.indexOf(item);
            menuItems.splice(index, 1);
            renderItemList();
        }

        /* Logout */
        function handleLogout() {
            logoutUser();
            window.location.href = 'index.php';
        }

    </script>

</body>

</html>