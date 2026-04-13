

class MenuCard extends HTMLElement {
  connectedCallback() {

const name = this.getAttribute("dish-name");
const price = this.getAttribute("dish-price");
const description = this.getAttribute("dish-description");
const ingredients = this.getAttribute("dish-ingredients");
const allergens = this.getAttribute("dish-allergens");
const category = this.getAttribute("dish-category") || "General"
const img = this.getAttribute("dish-img") || "images/dishes/placeholder.png";
// created the variables to get the attributes from the html file.

//create the data tranfromers in a js for each loop
    const allergenList = allergens
  ? allergens.split(",").map(a => a.trim())
  : [];


    this.innerHTML = `
  <div class="menu-card">
    <div class="card-img-wrap">
      <img src="${img}" alt="${name}" />
      <span>${category}</span>
    </div>

    <div class="card-body">
      <h3>${name}</h3>
      <p>${ingredients}</p>
      <p>€${price}</p>

      <button class="btn-allergen">Info</button>

      <div class="allergen-panel">
        ${
          allergenList.length === 0
            ? "None"
            : allergenList.map(a => `<span>${a}</span>`).join("")
        }
      </div>
    </div>
  </div>
`;

  }
}

customElements.define("menu-card", MenuCard);

// created the name of the class and the custom element to be used in the html file.
