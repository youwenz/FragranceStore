<?php session_start(); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="css files/cartPageStyle.css" />
    <link rel="stylesheet" href="css files/fonts.css" />
    <link rel="stylesheet" href="css files/commonStyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rozha+One&display=swap" rel="stylesheet">
</head>

<body>
    <?php    
    include("navigation.php") 
    ?>
    <div class="cartContainer">
        <div class="column1">
            <div class="cartTitle poppins-medium">
                Your cart items
            </div>
            <br>
            <div class="hyperLink roboto-regular">
                <a href="listingPage.php"> Back to shopping</a>
                
            </div>
        </div>
    <br>
    <br>

    <div class="column2">
        <div class="row">
            <div class="title tableColumn poppins-medium">
                Product
            </div>
            <div class="product-details tableColumn poppins-medium" style="padding-left: 130px;">
                Unit Price
            </div>
            <div class="product-details tableColumn poppins-medium">
                Quantity
            </div>
            <div class="product-details tableColumn poppins-medium">
                Total
            </div>
        </div>
    </div>

    <div class ="cartProducts">
    <?php
    
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
    ?>
        <div class="row">
            <div class="productDetails poppins-medium">
                <div class="image-gallery">
                    <img src="Images/<?php echo $item['image']; ?>" id="productImg" alt="<?php echo $item['title']; ?>">
                </div>
            </div>
            <div class="productDetailsName poppins-medium">
                <div class="productName poppins-medium" style="width: 370px;">
                    <?php echo $item['title']; ?>
                </div>
                <br>
                <div class="remove roboto-regular">
                <a class="remove-btn" data-title="<?php echo $item['title']; ?>" onclick="removeItem('<?php echo $item['title']; ?>')"> Remove </a>
                </div>
            </div>
            <div class="productDetails poppins-medium">
                <div class="price"><?php echo $item['price']; ?>MYR</div>
            </div>
            <div class="productDetails poppins-medium">
                <div class="increment-box">
                <button class="decrement-btn" data-title="<?php echo $item['title']; ?>">-</button>
                <input type="number" class="quantity-input" value= <?php echo $item['quantity']?> data-title="<?php echo $item['title']; ?>">
                <button class="increment-btn" data-title="<?php echo $item['title']; ?>">+</button>
                </div>
            </div>
            <div class="productDetails poppins-medium" >
                <div class="price"><?php echo $item['price']*$item['quantity']; ?>MYR</div>
            </div>
        </div>
        <?php
        }
        } else {
            ?>
            <div class ="poppins-medium"id="errorMessage">Your cart is empty.</div>
            <?php
        }
        ?>
   </div>

   <script>
    document.querySelectorAll('.remove-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        var title = button.getAttribute('data-title');
        removeItem(title);
    });
});
    function removeItem(title) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'addToCart.php?action=remove&title=' + encodeURIComponent(title), true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                location.reload();
            }
        };
        xhr.send();
    }
</script>

<div class="column3">
    <div class="total-container">
        <div class="total roboto-medium">
            Sub-total
        </div>
        <div class="amount roboto-medium">
            <?php
            $total = 0;
            if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price']*$item['quantity'];
            }
            echo $total . "MYR" ;
            $_SESSION['total'] = $total;
        }
            ?>
        </div>
        <button class="button" onclick="redirectToShippingPage()">Check-out</button>
    </div>
</div>
</div>


<script>
    function redirectToShippingPage() {
        window.location.href = "shippingPage.php";
    }
    document.addEventListener('DOMContentLoaded', function() {
    const decrementBtns = document.querySelectorAll('.decrement-btn');
    
    decrementBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const container = btn.closest('.row');
            const quantityInput = container.querySelector('.quantity-input');
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                var title = btn.getAttribute('data-title');
                updateItem(title, -1);
            }
        });
    });

    const incrementBtns = document.querySelectorAll('.increment-btn');
    
    incrementBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const container = btn.closest('.row');
            const quantityInput = container.querySelector('.quantity-input');
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
            var title = btn.getAttribute('data-title');
            updateItem(title, 1);
        });
    });

    function updateItem(title, value) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'addToCart.php?action=update&title=' + encodeURIComponent(title) + '&quantity=' + value, true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                location.reload();
            }
        };
        xhr.send();
    }

    
});

    </script>
</body>

<?php include("footer.php");?>

</html>