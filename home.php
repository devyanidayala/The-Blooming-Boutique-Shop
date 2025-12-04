<?php include 'header.php'; ?>

<style>
.home-box{
    max-width:1100px;
    margin:40px auto;
    text-align:center;
}

.product-list{
    display:flex;
    justify-content:center;
    gap:25px;
    margin-top:40px;
}

.card{
    width:250px;
    background:white;
    padding:15px;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.card img{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:10px;
}

.btn-cart{
    background:#d63384;
    color:#fff;
    border:none;
    padding:10px 18px;
    margin-top:10px;
    border-radius:6px;
    cursor:pointer;
}
.btn-cart:hover{
    background:#b11f6b;
}
</style>

<div class="home-box">
    <h1>Welcome to The Blooming Boutique Shop</h1>
    <p>Fresh Flowers • Fast Delivery • Lowest Price</p>

    <div class="product-list">

        <!-- Product 1 -->
        <div class="card">
            <img src="images/rose.jpg">
            <h3>Red Rose Bouquet</h3>
            <p>₹499</p>

            <form action="add_to_cart.php" method="POST">
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

            <form action="add_to_cart.php" method="POST">
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

            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="id" value="3">
                <input type="hidden" name="name" value="Pink Tulip Vase">
                <input type="hidden" name="price" value="899">
                <input type="hidden" name="image" value="images/tulip.jpg">
                <button class="btn-cart">Add to Cart</button>
            </form>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>
