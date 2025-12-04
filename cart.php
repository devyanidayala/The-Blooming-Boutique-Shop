<?php
session_start();
include 'header.php';

// Create cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// REMOVE ITEM
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// UPDATE QTY AND GO TO HOME PAGE
if (isset($_POST['update_qty'])) {
    foreach ($_POST['qty'] as $id => $quantity) {
        $_SESSION['cart'][$id]['quantity'] = max(1, (int)$quantity);
    }

    // Redirect to home after update
    header("Location: home.php");
    exit();
}
?>

<style>

    .hero-banner{
    width:100%;
    height:380px;
    background:url("images/flower-banner.jpg") no-repeat center/cover;
    border-radius:0 0 18px 18px;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
    margin-bottom:30px;
}

.cart-box{
    max-width:900px;
    margin:40px auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#d63384;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    text-align:center;
}

.cart-img{
    width:70px;
    height:70px;
    border-radius:10px;
    object-fit:cover;
}

.qty-input{
    width:60px;
    padding:5px;
}

.remove{
    color:red;
    font-size:22px;
    text-decoration:none;
    font-weight:bold;
}

.update-btn{
    margin-top:15px;
    padding:10px 20px;
    background:#444;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:16px;
}
.update-btn:hover{
    background:black;
}
</style>

<div class="hero-banner"></div>

<h2 style="text-align:center; font-size:28px; margin-top:20px; color:#d63384;">
    Welcome to The Blooming Boutique Shop
</h2>

<p style="text-align:center; max-width:700px; margin:10px auto; font-size:18px; color:#444;">
    Explore our stunning collection of fresh flowers, bouquets and beautiful floral gifts.
</p>

<div class="cart-box">
<h2>Your Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>
    <h3 style="text-align:center; color:#777;">Your Cart is Empty</h3>

<?php else: ?>

<form method="POST">

<table>
<tr>
    <th>Photo</th>
    <th>Name</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Remove</th>
</tr>

<?php
$grand_total = 0;

foreach ($_SESSION['cart'] as $id => $item):
    $total = $item['price'] * $item['quantity'];
    $grand_total += $total;
?>

<tr>
    <td><img src="<?= $item['image'] ?>" class="cart-img"></td>
    <td><?= $item['name'] ?></td>
    <td>₹<?= number_format($item['price']) ?></td>
    <td>
        <input type="number" name="qty[<?= $id ?>]" value="<?= $item['quantity'] ?>" 
               class="qty-input" min="1">
    </td>
    <td>₹<?= number_format($total) ?></td>
    <td><a href="cart.php?remove=<?= $id ?>" class="remove">×</a></td>
</tr>

<?php endforeach; ?>

</table>

<button type="submit" name="update_qty" class="update-btn">Update Cart</button>

</form>

<h2 style="text-align:right; margin-top:20px;">Grand Total: ₹<?= number_format($grand_total) ?></h2>

<?php endif; ?>
</div>

<?php include 'footer.php'; ?>
