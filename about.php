<?php include 'header.php'; ?>

<div class="about-hero">
    <h1>About Our Flower Boutique</h1>
    <p>Bringing beauty & freshness to your special moments.</p>
</div>

<div class="about-section">
    <img src="https://i.imgur.com/9PLP1yS.jpeg" alt="">
    <div>
        <h2>Our Story</h2>
        <p>
            We started Blooming Boutique with a passion for flowers and creativity.  
            Every bouquet is hand-arranged with love and delivered with care.
        </p>
        <h2>Why Choose Us?</h2>
        <ul>
            <li>Fresh flowers daily</li>
            <li>Unique handcrafted designs</li>
            <li>Fast delivery</li>
            <li>Affordable prices</li>
        </ul>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
.about-hero{
    padding:60px;
    background:#ffe5ef;
    text-align:center;
}
.about-section{
    display:flex;
    gap:30px;
    padding:40px 60px;
    align-items:center;
}
.about-section img{
    width:45%;
    border-radius:16px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
.about-section ul{
    list-style:circle;
    line-height:1.8;
}
@media(max-width:768px){
    .about-section{ flex-direction:column; }
    .about-section img{ width:100%; }
}
</style>
