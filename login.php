<?php
include_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login – The High Solan</title>
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

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $checkemail = "SELECT * FROM users WHERE email='$email'";
        $result = $pdo->query($checkemail);
        $results = $conn->query("$checkemail");
        if ($result->num_rows() > 0) {
            echo "Email exists, proceed with login";
        } else {
            echo "Email does not exist";
            $insertQuery="INSERT INTO users (email, password) 
            VALUES ('$email', '$password')";
            if ($conn->query($insertQuery)== TRUE) {
                echo "New record created successfully";
                header("location: index.php");
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    if(isset($_POST['submit'])){
       $email = $_POST['email'];
         $password = $_POST['password'];    
         $password = md5($password);
         $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
         $result = $conn->query($sql);
         if ($result->num_rows() > 0) {
            session_start();
            $_SESSION['email'] = $email;
            header("location: opdrachten.php");
            exit();

        } else {
            echo "Invalid email or password";

        }
    }
    ?>
    <!-- ===================== MAIN ===================== -->
    <main class="site-main">

        <div class="auth-wrapper">
            <div class="auth-card">
                <div>
                    <h1>Register</h1>
                    <form method="post" action="">
                        <div class="">
                            <i class="fas fa-user"></i>
                            <input type="text" name="fNAme" id="FName" placeholder="First name" required />
                            <label for="FName">First name</label>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="lNAme" id="LName" placeholder="Last name" required />
                            <label for="LName">Last name</label>

                        </div>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="Email address" required />
                            <label for="email">Email address</label>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                            <label for="password">Password</label>
                        </div>
                        <input type="submit" value="Sign Up" name="SignUp" class="btn btn-primary btn-full" />
                    </form>
                </div>





                <!-- Logo + title -->
                <div cla44ss="auth-header">
                    <img src="img/logo.png" alt="The High Solan" class="auth-logo-img" />
                    <h2>The High Solan</h2>
                    <p class="subtitle">Sign in to your account</p>
                </div>

                <!-- Login form -->
                <!-- TODO: connect form action to your database / backend -->
                <form class="auth-form" id="login-form" onsubmit="handleLogin(event)">

                    <div class="form-group">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" id="email" class="form-input" placeholder="you@example.com" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-input" placeholder="••••••••" required />
                    </div>

                    <!-- Role selector — employee / owner get different redirects -->
                    <div class="form-group">
                        <label class="form-label" for="role">Role</label>
                        <select id="role" class="form-input form-select">
                            <option value="customer">Customer</option>
                            <option value="employee">Employee</option>
                            <option value="owner">Owner / Admin</option>
                        </select>
                    </div>

                    <!-- Error shown here -->
                    <p class="form-error" id="login-error"></p>

                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fa fa-sign-in-alt"></i> Sign In
                    </button>

                </form>

                <p class="auth-note">
                    <!-- Remove this note when you connect a real database -->
                    Demo only: use any email + password <strong>admin</strong> to log in.
                </p>

            </div>
        </div>

    </main>


    <!-- ===================== JAVASCRIPT ===================== -->
    <script src="javascript\javascript.js"></script>
    <script>

        function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;
            const errorEl = document.getElementById('login-error');

            /* -------------------------------------------------------
               TODO: replace the demo check below with a real API call
               Example:
                 const res  = await fetch('/api/login', {
                   method : 'POST',
                   headers: { 'Content-Type': 'application/json' },
                   body   : JSON.stringify({ email, password, role })
                 });
                 const data = await res.json();
                 if (data.success) { ... }
            ------------------------------------------------------- */

            /* Demo login — remove this block when using a real database */
            if (password === 'admin') {
                const user = { name: email.split('@')[0], email: email, role: role };
                saveUser(user);
                errorEl.textContent = '';

                /* Redirect based on role */
                switch (role) {
                    case 'owner': window.location.href = 'admin.php'; break;
                    case 'employee': window.location.href = 'menu.php'; break;
                    default: window.location.href = 'index.php';
                }

            } else {
                errorEl.textContent = 'Incorrect credentials. Please try again.';
            }
            /* End demo block */
        }

        /* If already logged in, redirect away from login page */
        document.addEventListener('DOMContentLoaded', function () {
            const user = getUser();
            if (user) {
                window.location.href = user.role === 'owner' ? 'admin.php' : 'index.php';
            }
        });

    </script>

</body>

</html>