<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="home.css" />
</head>
<body>

    <header class="section__container header__container" id="home">
      <div class="header__image">
        <img src="assets/product-7.png" alt="header" />
      </div>
      <div class="header__content">
        <div>
          <h1>Design Your Dream Furniture</h1>
          <p>
            Personalized, Customizable, and Hassle-Free Shopping.
          </p>
        </div>
      </div>
    </header>

    <section class="section__container deals__container">
      <div class="deals__card">
        <h2 class="section__header">Hot Deals Just For You!</h2>
        <p>Shop the Hottest Picks Loved by Our Customers!</p>
      </div>
      <div class="deals__card">
        <span><i class="ri-cash-line"></i></span>
        <h4>Secure payments</h4>
        <p>Earn a 5% cashback reward on every furniture purchase you make!</p>
      </div>
      <div class="deals__card">
        <span><i class="ri-calendar-schedule-line"></i></span>
        <h4>30 day terms</h4>
        <p>
          Take advantage of our best payment terms, completely interest-free!
        </p>
      </div>
      <div class="deals__card">
        <span><i class="ri-currency-line"></i></span>
        <h4>Save money</h4>
        <p>
          Discover unbeatable prices and save big money on top-quality
          furniture!
        </p>
      </div>
    </section>

    

    <section class="section__container product__container" id="product">
      <h2 class="section__header">Products</h2>
      <div class="product__grid">
        <div class="product__card">
          <h4>Modern Chair</h4>
          <p>Rs.5500.00</p>
          <img src="assets/product-1.png" alt="product" />
        </div>
        <div class="product__card">
          <h4>Dining Chair</h4>
          <p>Rs.8000.00</p>
          <img src="assets/product-3.png" alt="product" />
        </div>        
        <div class="product__card">
          <h4>Deluxe Chair</h4>
          <p>Rs.2500.00</p>
          <img src="assets/product-8.png" alt="product" />
        </div>
        <div class="product__card">
          <h4>Modern Lamp</h4>
          <p>Rs.3500.00</p>
          <img src="assets/product-9.png" alt="product" />
        </div>
        <div class="product__card">
          <h4>Vintage Chair</h4>
          <p>Rs.6500.00</p>
          <img src="assets/product-6.png" alt="product" />
        </div>
        <div class="product__card">
          <h4>Stylish Chair</h4>
          <p>Rs.4500.00</p>
          <img src="assets/product-5.png" alt="product" />
        </div>
        
      </div>
    </section>
    <section class="section__container about__container" id="about">
      <div class="about__header">
        <div>
          <h2 class="section__header">About us</h2>
          <p class="section__description">
            Our passion for exceptional craftsmanship drives us to curate the
            best pieces for every room in your house.
          </p>
        </div>
      </div>
      <div class="about__content">
        <div class="about__image">
          <img src="assets/about.png" alt="about" />
        </div>
        <div class="about__grid">
          <div class="about__card">
            <h3></h3>
            <h4>Our Story:</h4>
            <p>
              Crafting Unique, Customer-Friendly Furniture Experiences.
            </p>
          </div>

          <div class="about__card">
            <h4>Our Mission</h4>
            <p>
              Empowering You with 3D Customization and Personalized Design
            </p>
          </div>

          <div class="about__card">
            <h4>Why Choose Us</h4>
            <p>Cutting-Edge 3D Technology, Quality Craftsmanship, and Customer-Centric Service</p>
          </div>

          <div class="about__card">
            <h4>Meet the Team</h4>
            <p>
              Passionate Creators Delivering Innovation and Customer Satisfaction.
            </p>
          </div>

        </div>
      </div>
    </section>
    
    <section class="section__container client__container">
      <div class="client__content">
        <h2 class="section__header">What our happy clients say</h2>
        <p class="section__description">
          Testimonials Highlighting Our Commitment to Quality, Exceptional
          Service, and Customer Satisfaction
        </p>
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
              <div class="client__card">
                <img src="assets/user-1.jpg" alt="user" />
                <div>
                  <p>
                    Absolutely love the 3D customization tool! 
                    Designing my own furniture was so fun and easy, 
                    and the final product looks exactly how I envisioned.
                  </p>
                  <h4>Dan Shawn</h4>
                  <h5>CEO</h5>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client__card">
                <img src="assets/user-2.jpg" alt="user" />
                <div>
                  <p>
                    The variety of styles and materials is amazing! 
                    I was able to create a piece that perfectly fits my home, and the quality is top-notch.
                  </p>
                  <h4>Lilly Thompson</h4>
                  <h5>Event Manager</h5>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client__card">
                <img src="assets/user-3.jpg" alt="user" />
                <div>
                  <p>
                    A truly unique shopping experience. 
                    The combination of stunning designs and customization options 
                    made it easy to find something that feels truly one-of-a-kind
                  </p>
                  <h4>Nate Archibald</h4>
                  <h5>Entrepreneur</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer" id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="footer__logo">
            <a href="#" class="logo">Craft Haven</a>
          </div>
          <p>
            Transform Your Space with Style - Shop, Design, and Customize with Confidence.
          </p>
          <ul class="footer__socials">
            <li>
              <a href="#"><i class="ri-facebook-fill"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-linkedin-fill"></i></a>
            </li>
            <li>
              <a href="#"><i class="ri-pinterest-fill"></i></a>
            </li>
          </ul>
        </div>
        
        
        <div class="footer__col">
          <h4></h4>
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
        Copyright © 2024 CraftHaven . All rights reserved.
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
</body>
</html>