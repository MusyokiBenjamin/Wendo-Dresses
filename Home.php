<?php
include_once 'connection.php';

// Fetch products
$sql = 'SELECT * FROM products WHERE quantity > 0';
$result = $conn->query( $sql );
?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>Home - Wendo Dresses Collection</title>
<link href = 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel = 'stylesheet'>
<script>

function addToCart( product ) {
    console.log( 'Adding to cart:', product );
    let cart = JSON.parse( localStorage.getItem( 'cart' ) ) || [];
    const existingProduct = cart.find( item => item.id === product.id );
    if ( existingProduct ) {
        existingProduct.quantity += 1;
    } else {
        product.quantity = 1;
        cart.push( product );
    }
    localStorage.setItem( 'cart', JSON.stringify( cart ) );
    alert( `$ {
        product.name}
        has been added to your cart.` );
    }
    </script>
    </head>
    <body class = 'bg-gray-800 text-300'>

    <!-- Navigation -->
    <nav class = 'bg-pink-900 p-4'>
    <div class = 'container mx-auto flex justify-between items-center'>
    <a href = 'Home.php' class = 'text-white text-2xl font-bold'>Wendo Dresses Collection</a>
    <div class = 'space-x-4'>
    <a href = 'Home.php' class = 'text-white hover:text-black hover:underline'>Home</a>
    <a href = 'ViewCart.html' class = 'text-white hover:text-black hover:underline'>View Cart</a>
    <a href = 'Login.html' class = 'text-white hover:text-black hover:underline'>Login</a>
    <a href = 'ContactUs.html' class = 'text-white hover:text-black hover:underline'>Contact Us</a>
    <a href = 'Gallery.html' class = 'text-white hover:text-black hover:underline'>Gallery</a>
    </div>
    </div>
    </nav>

    <!-- Product Listings -->
    <div class = 'container mx-auto my-12 p-6 bg-pink-900 rounded shadow'>
    <h1 class = 'text-3xl font-bold text-white mb-4'>Available Dresses Today!</h1>
    <div class = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6'>
    <?php while ( $product = $result->fetch_assoc() ): ?>
    <div class = 'bg-pink-900 rounded shadow p-6'>
    <img src = "images/<?php echo htmlspecialchars($product['image']); ?>" alt = "<?php echo htmlspecialchars($product['name']); ?>" class = 'w-full h-48 object-cover rounded mb-4'>
    <h2 class = 'text-white font-semibold mb-2'><?php echo htmlspecialchars( $product[ 'name' ] );
    ?></h2>
    <p class = 'text-white mb-4'><?php echo nl2br( htmlspecialchars( $product[ 'description' ] ) );
    ?></p>
    <p class = 'text-white font-bold mb-4'>Kshs. <?php echo number_format( $product[ 'price' ], 2 );
    ?></p>
    <button onclick = 'addToCart({id: <?php echo $product["id"]; ?>, name: "<?php echo htmlspecialchars($product["name"]); ?>", price: <?php echo $product["price"]; ?>, image: "images/<?php echo htmlspecialchars($product["image"]); ?>"})' class = 'bg-white text-black px-4 py-2 rounded hover:bg-gray-300'>Add to Cart</button>
    </div>
    <?php endwhile;
    ?>
    </div>
    </div>

    <!-- Footer -->
    <footer class = 'bg-pink-900 text-white py-8'>
    <d class = 'container mx-auto px-4 flex flex-wrap justify-between'>
    <div class = 'w-full md:w-1/4 mb-8 md:mb-0'>
    <h2 class = 'text-xl font-bold mb-4'>About Us</h2>
    <p class = 'font-semibold'>Wendo Dresses Collection</p>
    <p>SASA MALL G4 Ground Floor, Moi Avenue.</p>
    <p>STAR MALL M21 opposite Firestation, Tom Mboya St. Nrb</p>
    <p>Call Us;
    0754509754 or 0702560853</p>
    <div class = 'flex space-x-4 mt-4'>
    <a href = 'https://www.facebook.com/share/p/wPeKSrYfEpPhHi2E/?mibextid=oFDknk' aria-label = 'Facebook'><img src = 'Images/660bcb3e9408cfa1747d2d6e4c8c4526.png' alt = 'Facebook' /></a>
    <a href = 'https://www.instagram.com/wendo_dresses_collection?igsh=YzA2Z2xkOHhlYTY3' aria-label = 'Instagram'><img src = 'Images/Instagram_logo_2016.svg.png' alt = 'Instagram' /></a>
    </div>
    </div>

    <div class = 'w-full md:w-1/4 mb-8 md:mb-0'>
    <h2 class = 'text-xl font-bold mb-4'>Latest Reels</h2>
    <p>- </p>
    <p>- </p>
    <p>- </p>
    </div>

    <div class = 'w-full md:w-1/4 mb-8 md:mb-0'>
    <h2 class = 'text-xl font-bold mb-4'>Latest Posts</h2>
    <p>- </p>
    <p>- </p>
    <p>- </p>
    <p>- </p>
    </div>

    <div class = 'w-full md:w-1/4 mb-8 md:mb-0'>
    <h2 class = 'text-xl font-bold mb-4'>Gallery Photos</h2>
    <div class = 'grid grid-cols-3 gap-2'>
    <!-- Wrap each image inside an anchor tag to make them clickable -->
    <a href = 'Gallery.html'>
    <img src = 'Images/IMG-20240903-WA0019.jpg' alt = 'Product 4' />
    </a>
    <a href = 'Gallery.html'>
    <img src = 'Images/IMG-20240903-WA0020.jpg' alt = 'Product 5' />
    </a>
    <a href = 'Gallery.html'>
    <img src = 'Images/IMG-20240903-WA0021.jpg' alt = 'Product 6' />
    </a>
    </div>
    </div>

    <div class = 'bg-pink-900 py-4 mt-8'>
    <div class = 'container mx-auto px-4 flex justify-center items-center text-center'>
    <p class = 'text-sm font-bold italic'>&copy;
    2024 Wendo Dresses Collection. All Rights Reserved.</p>
    </div>
    </div>

    </div>
    </div>
    </div>
    </footer>

    <?php
    $conn->close();
    ?>
    </body>
    </html>
