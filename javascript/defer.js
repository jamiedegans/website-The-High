

// // FIX 1: PascalCase class name
// class CustomButton extends HTMLElement {

//     static get observedAttributes() {
//         return ["label", "href", "variant", "target"];
//     }

//     constructor() {
//         super();
//         this.attachShadow({ mode: "open" });
//     }

//     connectedCallback() {
//         this._build();
//     }

//     // FIX 2: Accept the (name, oldValue, newValue) parameters
//     attributeChangedCallback(name, oldValue, newValue) {
//         if (this._link) this._update();
//     }

//     _build() {
//         const style = document.createElement("style");
//        // style.textContent = css;

//         this._link = document.createElement("a");
//         this._link.className = "button";

//         this._label = document.createElement("span");
//         this._label.className = "label";

//         this._slot = document.createElement("slot");

//         this._link.appendChild(this._label);
//         this._link.appendChild(this._slot);

//         this.shadowRoot.appendChild(style);
//         this.shadowRoot.appendChild(this._link);

//         this._update();
//     }

//     _update() {
//         const label = this.getAttribute("label");
//         if (label) {
//             this._label.textContent = label;
//             this._slot.style.display = "none";
//         } else {
//             this._label.textContent = "";
//             this._slot.style.display = "inline";
//         }

//         this._link.href   = this.getAttribute("href")   || "#";
//         this._link.target = this.getAttribute("target") || "_self";
//     }
// }
// customElements.define("custom-button", CustomButton);

