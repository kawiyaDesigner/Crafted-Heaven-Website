<?php 
include 'navbar.php'; 
include("dbconn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="product.css" />
    <style>
        /* General body and page styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
          
            
            
        }

       

        /* Product section styling */
        .section__container {
            padding: 40px 20px;
            text-align: center;
            margin-top: 160px; /* Space below the fixed header */
        }

        /* Product header styling */
        .section__header {
            font-size: 36px;
            color: #073f7b; /* Text color */
            margin:75px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
           
            padding: 20px;
            position: fixed; /* Fixed position */
            top: 0;
            left: 0;
            width: 100%; /* Full width */
            z-index: 999; /* Ensure it stays on top */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow to give it a modern feel */
            border-radius: 0 0 10px 10px; /* Rounded corners at the bottom */
            display: block; /* Ensure it spans the entire width */
        }

        /* Product grid container */
        .product__grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* Product card styling */
        .product__card {
            background-color: white;
            m
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            overflow: hidden;
        }

      
        .product__card h4 {
            margin: 15px 0;
            font-size: 20px;
            color: #333;
        }

        .product__card p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        /* Hover effect on product card */
        .product__card:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .product__card:hover img {
            transform: scale(1.05);
        }

        /* Add to cart button styling */
        .btn-add-to-cart {
            background-color: #073f7b;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-add-to-cart:hover {
            background-color: #00254d;
            transform: translateY(-2px);
        }

        .btn-add-to-cart:active {
            background-color: #001e34;
            transform: translateY(0);
        }

        .btn-add-to-cart:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        /* Responsive design for mobile view */
        @media (max-width: 768px) {
            .product__grid {
                flex-direction: column;
                align-items: center;
            }
            .product__card {
                width: 80%;
                max-width: 400px;
            }
        }

    </style>
</head>
<body>
<section class="section__container" id="product">
    <h2 class="section__header">Products</h2>
    <div class="product__grid">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product__card">
            <h4><?php echo htmlspecialchars($row['name']); ?></h4>
            <p>Rs. <?php echo htmlspecialchars($row['price']); ?></p>
            <?php if (!empty($row['image'])): ?>
                <img src="<?php echo $row['image']; ?>" alt="Product Image" class="product__image">
            <?php else: ?>
                <img src="default-image.jpg" alt="Default Product Image" class="product__image">
            <?php endif; ?>
            
            <!-- Add to Cart Form -->
            <form action="add_to_cart.php" method="post" class="add-to-cart-form">
                <!-- Pass Product ID -->
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="btn-add-to-cart">Add to Cart</button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>
</section>
</body>
</html>
