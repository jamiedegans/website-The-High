<?php
include_once 'database.php';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    while ($row = mysqli_fetch_array($query)) {
        echo $row[email]
    }
}
?>
<a href="logout.php">logout</a>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Web Component Buttons - Playground</title>
    <style>
        /* ================================
       PAGE STYLES — normal CSS
       nothing special here
    ================================ */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            padding: 2rem;
        }

        h1 {
            margin-bottom: 0.5rem;
        }

        h2 {
            margin: 2rem 0 0.5rem;
            color: #444;
        }

        p {
            color: #666;
            margin-bottom: 1rem;
        }

        #output {
            margin-top: 1rem;
            padding: 1rem;
            background: white;
            border-left: 4px solid #4f46e5;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #333;
            min-height: 48px;
        }

        /* ================================
       BUTTON STYLES
       These classes get applied to the
       <button> inside the component
    ================================ */
        .my-btn {
            padding: 0.6rem 1.4rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            transition: opacity 0.2s;
        }

        .my-btn:hover {
            opacity: 0.85;
        }

        /* each type gets its own color */
        .my-btn.default {
            background: #6b7280;
            color: white;
        }

        .my-btn.primary {
            background: #4f46e5;
            color: white;
        }

        .my-btn.danger {
            background: #e63946;
            color: white;
        }

        .my-btn.success {
            background: #16a34a;
            color: white;
        }

        .my-btn.warning {
            background: #f59e0b;
            color: white;
        }
    </style>
</head>

<body>

    <h1>🧩 Button Web Component Playground</h1>
    <p>All buttons below use ONE component: <code>&lt;my-button&gt;</code>. Play with the attributes and functions!</p>

    <!-- ================================
    HOW TO USE:
    <my-button label="..." type="..." action="..."></my-button>

    label  = the text on the button
    type   = the color (default, primary, danger, success, warning)
    action = which function to run when clicked
  ================================= -->

    <h2>Basic buttons</h2>
    <my-button label="Default button" type="default" action="sayHello"></my-button>
    <my-button label="Primary button" type="primary" action="changeBackground"></my-button>
    <my-button label="Danger button" type="danger" action="showAlert"></my-button>
    <my-button label="Success button" type="success" action="showSuccess"></my-button>
    <my-button label="Warning button" type="warning" action="countdown"></my-button>

    <h2>Same action, different labels</h2>
    <p>All 3 use action="addToCart" but have different labels — one component, infinite uses</p>
    <my-button label="Add Burger" type="primary" action="addToCart"></my-button>
    <my-button label="Add Pizza" type="primary" action="addToCart"></my-button>
    <my-button label="Add Salmon" type="primary" action="addToCart"></my-button>

    <h2>Toggle button</h2>
    <my-button label="Toggle dark mode" type="default" action="toggleDark"></my-button>

    <!-- output box — buttons write messages here -->
    <div id="output">Output shows here when you click a button...</div>


    <script>
        // ============================================================
        //  THE WEB COMPONENT
        //  This is the class that defines what <my-button> does.
        //  Think of it like a Java class — it has a constructor
        //  and methods (functions) that do specific jobs.
        // ============================================================

        class MyButton extends HTMLElement {

            // ----------------------------------------------------------
            // constructor() runs ONCE when the element is created.
            // This is where you:
            //   1. Build the HTML for the button
            //   2. Read the attributes (label, type, action)
            //   3. Set up the click listener
            // ----------------------------------------------------------
            constructor() {
                super(); // always first — required by the browser

                // Read the attributes from the HTML tag
                // For example: <my-button label="Click me" type="primary" action="sayHello">
                const label = this.getAttribute('label') || 'Click';   // text on the button
                const type = this.getAttribute('type') || 'default'; // color class
                const action = this.getAttribute('action') || '';        // which function to call

                // Build the HTML — no shadow DOM here so normal CSS applies
                this.innerHTML = `
          <button class="my-btn ${type}">${label}</button>
        `;

                // Grab the button element we just made
                const btn = this.querySelector('.my-btn');

                // Set up ONE click listener.
                // It reads the action attribute and calls the matching function.
                // To add a NEW button action:
                //   1. Add it here as a new else if
                //   2. Write the function below in the class
                btn.addEventListener('click', () => {

                    if (action === 'sayHello') {
                        this.sayHello();

                    } else if (action === 'changeBackground') {
                        this.changeBackground();

                    } else if (action === 'showAlert') {
                        this.showAlert();

                    } else if (action === 'showSuccess') {
                        this.showSuccess();

                    } else if (action === 'addToCart') {
                        this.addToCart(label); // pass the label so we know which item

                    } else if (action === 'toggleDark') {
                        this.toggleDark();

                    } else if (action === 'countdown') {
                        this.countdown(btn); // pass the button so we can change its text

                    } else {
                        // No matching action found — good for debugging
                        this.output('⚠️ No action defined for: ' + action);
                    }

                });
            }


            // ----------------------------------------------------------
            // HELPER — writes a message to the output box on the page.
            // All functions below use this to show what they did.
            // ----------------------------------------------------------
            output(message) {
                document.getElementById('output').textContent = message;
            }


            // ----------------------------------------------------------
            // FUNCTION 1: sayHello
            // The simplest possible function — just writes a message.
            // Try changing the text below and refreshing!
            // ----------------------------------------------------------
            sayHello() {
                this.output('👋 Hello! You clicked the default button.');
            }


            // ----------------------------------------------------------
            // FUNCTION 2: changeBackground
            // Changes the page background color randomly.
            // Shows how a button can affect OTHER things on the page.
            // ----------------------------------------------------------
            changeBackground() {
                const colors = ['#fef9c3', '#dbeafe', '#dcfce7', '#fce7f3', '#ede9fe'];
                // Pick a random color from the array
                const random = colors[Math.floor(Math.random() * colors.length)];
                document.body.style.background = random;
                this.output('🎨 Background changed to: ' + random);
            }


            // ----------------------------------------------------------
            // FUNCTION 3: showAlert
            // Shows a browser alert popup.
            // Replace alert() with your own modal component later!
            // ----------------------------------------------------------
            showAlert() {
                this.output('🚨 Danger button clicked — you could show a delete confirmation here!');
            }


            // ----------------------------------------------------------
            // FUNCTION 4: showSuccess
            // A simple success message.
            // ----------------------------------------------------------
            showSuccess() {
                this.output('✅ Success! Action completed.');
            }


            // ----------------------------------------------------------
            // FUNCTION 5: addToCart
            // Receives which item was clicked (via the label attribute).
            // Shows how you can pass data INTO a function.
            // ----------------------------------------------------------
            addToCart(item) {
                // Remove "Add " from the label to get just the item name
                const name = item.replace('Add ', '');
                this.output('🛒 ' + name + ' added to cart!');
            }


            // ----------------------------------------------------------
            // FUNCTION 6: toggleDark
            // Toggles a CSS class on the body to switch dark mode.
            // Add a .dark { background: #111; color: white; } in CSS to try it!
            // ----------------------------------------------------------
            toggleDark() {
                document.body.classList.toggle('dark');
                const isDark = document.body.classList.contains('dark');
                document.body.style.background = isDark ? '#1a1a2e' : '#f0f2f5';
                document.body.style.color = isDark ? '#ffffff' : '#000000';
                this.output(isDark ? '🌙 Dark mode ON' : '☀️ Dark mode OFF');
            }


            // ----------------------------------------------------------
            // FUNCTION 7: countdown
            // Shows how a button can change its OWN text.
            // Receives the button element as a parameter.
            // ----------------------------------------------------------
            countdown(btn) {
                let count = 3;
                btn.disabled = true; // disable so you can't spam click

                // setInterval runs a function every X milliseconds
                const timer = setInterval(() => {
                    btn.textContent = 'Wait... ' + count;
                    count--;

                    if (count < 0) {
                        clearInterval(timer);       // stop the timer
                        btn.textContent = 'Done!';
                        btn.disabled = false;       // re-enable the button
                        this.output('⏱️ Countdown finished!');
                    }
                }, 1000); // every 1000ms = every 1 second

                this.output('⏳ Countdown started...');
            }

        } // end of class


        // ============================================================
        //  REGISTER THE COMPONENT
        //  This tells the browser that <my-button> = MyButton class.
        //  Without this line, <my-button> is just an unknown tag.
        // ============================================================
        customElements.define('my-button', MyButton);


        // ============================================================
        //  HOW TO ADD YOUR OWN BUTTON:
        //
        //  1. Add a new <my-button> tag in the HTML above:
        //       <my-button label="My new button" type="success" action="doMyThing"></my-button>
        //
        //  2. Add an else if in the click listener inside constructor():
        //       } else if (action === 'doMyThing') {
        //           this.doMyThing();
        //       }
        //
        //  3. Write the function below the others:
        //       doMyThing() {
        //           this.output('My thing happened!');
        //       }
        //
        //  That's it!
        // ============================================================

    </script>

</body>

</html>