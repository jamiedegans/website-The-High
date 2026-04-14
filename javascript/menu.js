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
      <span class="card-badge">${category}</span>
    </div>

    <div class="card-body">
      <h3 class="card-title">${name}</h3>
      <p class="card-desc">${ingredients}</p>
      <p class="card-price">€${price}</p>

      <button class="btn-allergen">
        <i class="fa fa-info-circle"></i> Ingredients & Allergens
      </button>

      <div class="allergen-panel">
        <p><strong>Ingredients:</strong> ${description}</p>
        <p><strong>Allergens:</strong></p>
        <div class="allergen-tags">
          ${allergenList.length === 0
            ? '<span class="allergen-tag">None</span>'
            : allergenList.map(a => `<span class="allergen-tag">${a}</span>`).join("")
          }
        </div>
      </div>
    </div>
  </div>
`;


//CLICKER FOR THE BUTTON TO OPEN THE ALLERGEN PANEL
    this.querySelector(".btn-allergen").addEventListener("click", () => {
        this.querySelector(".allergen-panel").classList.toggle("open");
      });
  }
}

customElements.define("menu-card", MenuCard);
// created the name of the class and the custom element to be used in the html file.
