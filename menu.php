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
<header><restaurant-header></restaurant-header></header>
    <!-- ===================== MAIN ===================== -->
    <main class="site-main">


        <!-- Page header + search bar -->
        <div class="page-header">
            <h2>Our Menu</h2>
            <p>Fresh ingredients, bold flavours</p>

            <!-- Big search bar on menu page -->
            <div class="search-bar" style="max-width:500px; margin:1.5rem auto 0; border-radius:8px;">
                <input type="text" id="menu-search" placeholder="Search a dish, ingredient or allergen..."
                    oninput="handleSearch(this.value)" style="width:100%; padding:0.75rem 1rem; font-size:0.95rem;" />
                <button class="search-btn"><i class="fa fa-search"></i></button>
            </div>

            <!-- Search result count -->
            <p id="search-notice" style="margin-top:0.75rem; font-size:0.85rem; color:#7C7C7C;"></p>
        </div>


        <!-- Menu grid — 3 cards per row, wraps on smaller screens -->
        <div class="inner" style="padding-bottom:4rem;">
            <div class="card-row" id="menu-grid" style="flex-wrap:wrap;"></div>
        </div>


    </main>


    <!-- ===================== FOOTER ===================== -->
  <footer>
<restaurant-footer></restaurant-footer>
  </footer>


    <!-- ===================== JAVASCRIPT ===================== -->
    <script src="javascript\javascript.js"></script>
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