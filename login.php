<?php
session_start(); // start session to access it'

include_once 'database.php'; // gives us the $pdo
include_once 'costums/password.php';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists in our  file
    if (isset($credentials[$email]) && password_verify($password, $credentials[$email]['password'])) {

        // Get role from the file
        $role = $credentials[$email]['role'];

        // Also fetch user from DB so we still get the id etc.
        $sql = "SELECT * FROM users WHERE email = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $user = $statement->fetch();

        $_SESSION['user_id'] = $user['id'] ?? 0;
        $_SESSION['role'] = $role;
        $_SESSION['email'] = $email;

        if ($role == 'admin') {
            header("location: admin.php");
            exit();
        } elseif ($role == 'worker') {
            header("location: about.php");
            exit();
        } else {
            header("location: menu.php");
            exit();
        }

    } else {
        $error = "Invalid email or password.";
    }
}

?>

<?php if (isset($error)) { ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php } ?>

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
    ?>
    <!-- ===================== MAIN ===================== -->
    <main class="site-main">

        <div class="auth-wrapper">
            <div class="auth-card">
                <div>
                    <h1>login try 8</h1>

                    <form action="login.php" method="post">
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" name="submit">Login</button>
                    </form>
                    <!-- Logo + title -->
                    <div class="auth-header">
                        <img src="images\logo.png" alt="The High Solan" class="auth-logo-img" />
                        <h2>The High Solan</h2>
                        <p class="subtitle">Sign in to your account</p>
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

</body>

</html>