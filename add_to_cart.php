<?php
session_start();

// Create cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if product data is received
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image'])) {

    $id = $_POST['id'];

    // If same product added again → increase quantity
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "image" => $_POST['image'],
            "quantity" => 1
        ];
    }

    // Redirect to cart page
    header("Location: cart.php");
    exit();
}

// If no data → go back to home
header("Location: index.php");
exit();
?>
