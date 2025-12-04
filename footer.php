<footer style="
    background:#111827;
    color:white;
    padding:40px 20px;
    margin-top:50px;
">

    <div style="
        max-width:1200px;
        margin:auto;
        display:flex;
        flex-wrap:wrap;
        justify-content:space-between;
    ">

        <!-- Brand -->
        <div style="width:250px; margin-bottom:20px;">
            <h2 style="color:#f9fafb;">🌸 Blooming Boutique</h2>
            <p style="color:#d1d5db;">
                Beautiful flowers delivered with love.
            </p>
        </div>

        <!-- Quick Links -->
        <div style="margin-bottom:20px;">
            <h3 style="color:#f9fafb;">Quick Links</h3>
            <a href="home.php" style="color:#d1d5db; text-decoration:none; display:block; margin:4px 0;">Home</a>
            <a href="shop.php" style="color:#d1d5db; text-decoration:none; display:block; margin:4px 0;">Shop</a>
            <a href="about.php" style="color:#d1d5db; text-decoration:none; display:block; margin:4px 0;">About</a>
            <a href="contact.php" style="color:#d1d5db; text-decoration:none; display:block; margin:4px 0;">Contact</a>
        </div>

        <!-- Contact -->
        <div style="margin-bottom:20px;">
            <h3 style="color:#f9fafb;">Contact Us</h3>
            <p style="color:#d1d5db;">📞 +91 9876543210</p>
            <p style="color:#d1d5db;">📧 info@bloomingboutique.com</p>
            <p style="color:#d1d5db;">📍 Surat, Gujarat, India</p>
        </div>

        <!-- Newsletter -->
        <div style="margin-bottom:20px; width:280px;">
            <h3 style="color:#f9fafb;">Newsletter</h3>
            <p style="color:#d1d5db;">Subscribe for offers & updates</p>

            <form>
                <input type="email"
                       placeholder="Enter your email"
                       style="padding:10px; width:100%; border:none; border-radius:6px; margin-bottom:10px;">
                <button style="
                    background:#f472b6;
                    border:none;
                    color:white;
                    padding:10px 20px;
                    border-radius:6px;
                    cursor:pointer;
                ">Subscribe</button>
            </form>
        </div>

    </div>

    <div style="text-align:center; color:#9ca3af; margin-top:20px;">
        © <?= date("Y") ?> Blooming Boutique — All Rights Reserved.
    </div>

</footer>
