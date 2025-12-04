<?php include 'header.php'; ?>

<style>
.shop-container{
    max-width:1100px;
    margin:40px auto;
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:25px;
}

.card{
    background:#fff;
    border-radius:12px;
    padding:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    text-align:center;
}

.card img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:10px;
}

.btn-cart{
    background:#d63384;
    color:#fff;
    padding:10px 20px;
    border:none;
    margin-top:10px;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}
.btn-cart:hover{
    background:#b11f6b;
}
</style>

<div class="shop-container">

    <!-- Product 1 -->
    <div class="card">
        <img src="images/rose.jpg">
        <h3>Red Rose Bouquet</h3>
        <p>₹499</p>

        <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="id" value="1">
            <input type="hidden" name="name" value="Red Rose Bouquet">
            <input type="hidden" name="price" value="499">
            <input type="hidden" name="image" value="images/rose.jpg">

            <button class="btn-cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 2 -->
    <div class="card">
        <img src="images/lily.jpg">
        <h3>White Lily Flowers</h3>
        <p>₹699</p>

        <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="id" value="2">
            <input type="hidden" name="name" value="White Lily Flowers">
            <input type="hidden" name="price" value="699">
            <input type="hidden" name="image" value="images/lily.jpg">

            <button class="btn-cart">Add to Cart</button>
        </form>
    </div>

    <!-- Product 3 -->
    <div class="card">
        <img src="images/tulip.jpg">
        <h3>Pink Tulip Vase</h3>
        <p>₹899</p>

        <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="id" value="3">
            <input type="hidden" name="name" value="Pink Tulip Vase">
            <input type="hidden" name="price" value="899">
            <input type="hidden" name="image" value="images/tulip.jpg">

            <button class="btn-cart">Add to Cart</button>
        </form>
    </div>

</div>

<?php include 'footer.php'; ?>
