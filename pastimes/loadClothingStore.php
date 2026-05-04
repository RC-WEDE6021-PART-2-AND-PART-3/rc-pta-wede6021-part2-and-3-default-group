<?php

include 'DBConn.php';

/*
Student Name: YOUR NAME
Student Number: YOUR NUMBER
Purpose: Create ClothingStore database tables
*/


$conn->query("SET FOREIGN_KEY_CHECKS = 0");

$conn->query("DROP TABLE IF EXISTS tblRating");
$conn->query("DROP TABLE IF EXISTS tblWishlist");
$conn->query("DROP TABLE IF EXISTS tblCart");
$conn->query("DROP TABLE IF EXISTS tblOrder");
$conn->query("DROP TABLE IF EXISTS tblClothes");
$conn->query("DROP TABLE IF EXISTS tblAdmin");
$conn->query("DROP TABLE IF EXISTS tblUser");

$conn->query("SET FOREIGN_KEY_CHECKS = 1");


$conn->query("
CREATE TABLE IF NOT EXISTS tblUser (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(255),
    is_verified TINYINT DEFAULT 0
)
");


$conn->query("
CREATE TABLE IF NOT EXISTS tblAdmin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255)
)
");


$conn->query("
CREATE TABLE IF NOT EXISTS tblClothes (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2),
    seller_id INT,
    image VARCHAR(255),
    category VARCHAR(50),
    FOREIGN KEY (seller_id) REFERENCES tblUser(user_id)
)
");


$conn->query("
CREATE TABLE IF NOT EXISTS tblCart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES tblUser(user_id),
    FOREIGN KEY (product_id) REFERENCES tblClothes(product_id)
)
");


$conn->query("
CREATE TABLE IF NOT EXISTS tblWishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES tblUser(user_id),
    FOREIGN KEY (product_id) REFERENCES tblClothes(product_id)
)
");


$conn->query("
CREATE TABLE IF NOT EXISTS tblRating (
    rating_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    rating INT,
    FOREIGN KEY (product_id) REFERENCES tblClothes(product_id)
)
");


$conn->query("
CREATE TABLE IF NOT EXISTS tblOrder (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_price DECIMAL(10,2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES tblUser(user_id)
)
");


echo "ClothingStore database loaded successfully.";

?>