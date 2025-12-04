<?php include 'header.php'; ?>

<div class="contact-hero">
    <h1>Contact Us</h1>
    <p>We’re here to help you with anything!</p>
</div>

<div class="contact-section">
    <form class="contact-form">
        <h2>Send a Message</h2>
        <input type="text" placeholder="Your Name" required>
        <input type="email" placeholder="Your Email" required>
        <textarea placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>

    <div class="contact-info">
        <h2>Our Info</h2>
        <p><b>Phone:</b> +91 98765 43210</p>
        <p><b>Email:</b> bloomingboutique@gmail.com</p>
        <p><b>Address:</b> Ahmedabad, India</p>

        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18..."
            width="100%" height="250" style="border:0;" allowfullscreen="">
        </iframe>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
.contact-hero{
    padding:60px;
    background:#ffeaf3;
    text-align:center;
}
.contact-section{
    display:flex;
    gap:30px;
    padding:40px 60px;
}
.contact-form{
    width:50%;
    background:#fff;
    padding:30px;
    border-radius:16px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
.contact-form input, .contact-form textarea{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:10px;
    border:1px solid #ccc;
}
.contact-form button{
    background:#ff4f8b;
    color:#fff;
    padding:12px 18px;
    border:none;
    border-radius:10px;
    cursor:pointer;
}
.contact-info{
    width:50%;
}
@media(max-width:768px){
    .contact-section{ flex-direction:column; }
    .contact-form, .contact-info{ width:100%; }
}
</style>
