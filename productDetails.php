<?php session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="css files/ProductDetailsStyle.css" />
    <link rel="stylesheet" href="css files/fonts.css" />
    <link rel="stylesheet" href="css files/commonStyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rozha+One&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("navigation.php") ;
?>
    <?php
        $title = $_GET['title'];
        $image = $_GET['image'];
        $price = $_GET['price'];
      ?>
    <div class="container">
        <div class="left">
            <div class="product">
                <div class="image-gallery">
                    <img src="images/<?php echo $image; ?>" id="productImg" alt="">
                </div>
                <div class="slogan poppins-medium">
                    <p>
                        Captivating and alluring, DivineDew Fragrance evokes the essence of timeless elegance.
                    </p>
                </div>
            </div>
        </div>
        <div class="right">
                <div class="details">
                    <div class="title poppins-medium"><?php echo $title; ?></div>
                    <h3>MYR<?php echo $price; ?></h3>
                    <p>Inspired by the enchanting allure of a summer garden in full bloom, our fragrance captivates with its delicate floral notes and vibrant freshness. At its heart, a bouquet of jasmine and rose petals intertwines with the sweet aroma of orange blossom, evoking memories of warm, sunlit afternoons.
                    </p>
                    <div class="ingredientBox">
                        <br>
                        <div class="Ititle helvetica">
                            Ingredient:
                            <span class="list helvetica">
                            Alcohol Denat, Dragrance, Water\Aqua\Eau,Gareniol, Ciltronellol, 
                            Hydroxycitronellal, Limonene, Linalooi
                            </span>
                        </div>
                        
                        <br>
                        <div class="Ititle helvetica ">
                            Lasting Time:
                        </div>
                        <div class="list helvetica">
                            4-6 hours
                        </div>
                        <br>
                        <div class="Ititle helvetica">
                            Dimension:
                        </div>
                        <div class="list helvetica">
                            12cm*5cm 
                        </div>
                        <br>
                        <div class="Ititle helvetica">
                            Weight:
                        </div>
                        <div class="list helvetica">
                            80g
                        </div>
                        <br>
                        <button class="button" onclick="addToCart('<?php echo $title; ?>', '<?php echo $image; ?>', '<?php echo $price; ?>')">+ Add to cart</button>
                        <script>
                        function addToCart(title, image, price) {
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "addToCart.php?title=" + encodeURIComponent(title) + "&image=" + encodeURIComponent(image) + "&price=" + encodeURIComponent(price), true);
                            xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                alert(xhr.responseText); 
                            } else {
                                alert('Error: ' + xhr.status); // Display error message if status is not 200
                            }
                        }
                    };
                            xhr.send();
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


    <?php
      include("footer.php");
    ?>

</html>

