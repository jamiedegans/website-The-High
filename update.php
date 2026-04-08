<?php
session_start();
include_once "database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit();
}

// The ? marks are placeholders to keep the query safe from SQL injection
if (isset($_POST['edit_item'])) {
    $sql = "UPDATE menu SET naam=?, prijs=?, category=?, ingredients=?, allergens=?, featured=? WHERE id=?";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        $_POST['dish-name'],
        $_POST['dish-price'],
        $_POST['dish-category'],
        $_POST['dish-ingredients'],
        $_POST['dish-allergens'],
        $_POST['dish-featured'],
        $_POST['item_id']
    ]);
}
 // The last one (item_id) is the hidden field from the form — it tells the DB which row to update

header("Location: admin.php");
exit; 


