<?php

use Faker\Factory as Faker;

// Autoload Composer dependencies (if not using Laravel or a framework that already handles this)
require_once 'vendor/autoload.php';

// Initialize Faker
$faker = Faker::create();

// Database connection (adjust the credentials as needed)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "image_crud";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate and insert fake data into the categories table
for ($i = 0; $i < 10; $i++) { // Insert 10 rows as an example
    $category_name = $faker->word; // Generate a random word as the category name

    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";

    if ($conn->query($sql) === true) {
        echo "New record created successfully: Category '$category_name' inserted.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();