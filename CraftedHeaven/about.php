<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Craft Haven</title>

    <!-- Remixicon and Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="about.css" />
</head>
<body>
    <!-- About Section -->
    <section class="section__container about__container" id="about">
        <div class="about__header">
            <h2 class="section__header">About Us</h2>
            <p class="section__description">
                Create Your Dream Furniture: Easy Customization, Seamless Shopping, and Quality You Can Trust.
            </p>
        </div>

        <div class="about__content">
            <div class="about__image">
                <img src="assets/about.png" alt="About Craft Haven">
            </div>
            <div class="about__grid">
                <div class="about__card">
                    <h4>Our Story</h4>
                    <p>Crafting Unique, Customer-Friendly Furniture Experiences.</p>
                </div>
                <div class="about__card">
                    <h4>Our Mission</h4>
                    <p>Empowering You with 3D Customization and Personalized Design.</p>
                </div>
                <div class="about__card">
                    <h4>Why Choose Us</h4>
                    <p>Cutting-Edge 3D Technology, Quality Craftsmanship, and Customer-Centric Service.</p>
                </div>
                <div class="about__card">
                    <h4>Meet the Team</h4>
                    <p>Passionate Creators Delivering Innovation and Customer Satisfaction.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer" id="contact">
        <div class="section__container footer__container">
            <!-- Footer Column 1 -->
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#" class="logo">Craft Haven</a>
                </div>
                <p>Transform Your Space with Style - Shop, Design, and Customize with Confidence.</p>
                <ul class="footer__socials">
                    <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                    <li><a href="#"><i class="ri-twitter-fill"></i></a></li>
                    <li><a href="#"><i class="ri-linkedin-fill"></i></a></li>
                    <li><a href="#"><i class="ri-pinterest-fill"></i></a></li>
                </ul>
            </div>

            <!-- Footer Column 2 -->
            <div class="footer__col">
                <h4>Quick Links</h4>
                <ul class="footer__links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="living.html">Living</a></li>
                    <li><a href="bedroom.html">Bedroom</a></li>
                    <li><a href="decor.html">Decor</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="footer__bar">
            Copyright © 2024 Craft Haven. All rights reserved.
        </div>
    </footer>
</body>
</html>
