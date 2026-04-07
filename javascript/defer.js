const css = `
.button{
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border: 1px solid transparent;
    border-radius: var(--radius);

    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;

    white-space: nowrap;
}
`;




export class button extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: "open" });

    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
        <style>${css}</style>
    <button class="button">
       <span class="label">Click Me</span>
    </button>
    `;
    }
}


