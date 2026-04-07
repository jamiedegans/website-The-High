
import { button } from "./defer.js";


customElements.define("custom-button", button);



//    SEARCH — filter menu items by name, description or ingredients
// ---------------------------------------------------------- */
// function searchMenu(query) {
//     const q = query.trim().toLowerCase();
//     if (q === '') return menuItems;

//     return menuItems.filter(function (item) {
//         return (
//             item.name.toLowerCase().includes(q) ||
//             item.description.toLowerCase().includes(q) ||
//             item.ingredients.join(' ').toLowerCase().includes(q)
//         );
//     });
// }
