<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['title'])) {
    $titleToRemove = $_GET['title'];
    
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['title'] === $titleToRemove) {
            unset($_SESSION['cart'][$index]);
            echo 'Item removed from cart successfully.';
            exit; 
        }
    }

    echo 'Item not found in cart.';

}else if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['title']) && isset($_GET['quantity'])) {
    $titleToUpdate = $_GET['title'];
    $value = $_GET['quantity']; 

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['title'] === $titleToUpdate) {
            $item['quantity'] = $item['quantity'] + $value;
            echo 'Item quantity updated successfully.';
            exit; 
        }
    }

    echo 'Item not found in cart.';

} else {
    $title = $_GET['title'];
    $image = $_GET['image'];
    $price = $_GET['price'];
    $quantity = 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'title' => $title,
        'image' => $image,
        'price' => $price,
        'quantity' => $quantity
    ];

    echo 'Product added to cart successfully.';
}

