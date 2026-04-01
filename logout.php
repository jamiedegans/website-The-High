<?php
session_start();        // ← start session so to access it
session_unset()       // destroys all session variables
session_destroy();      // ← wipe everything in the session
session_start();      // ← start a new session so we can set a message
session_regenerate_id(true)  // ← generate a new session ID for security
header("location: login.php"); // ← send them to login page
exit();                 // ← stop any code running after the redirect
?>