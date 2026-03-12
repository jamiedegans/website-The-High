
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
