<?php

require_once 'vendor/autoload.php';

use Faker\Factory;

// Assuming you have a database connection setup in your ProductModel class
use App\ImageCrud\Databases\MySQL;
use App\ImageCrud\Databases\ProductModel;

// Create an instance of the Faker generator
$faker = Factory::create();

// Create a new ProductModel instance with your database connection
$db = new ProductModel(new MySQL());

// Number of fake products you want to generate
$numProducts = 50;

for ($i = 0; $i < $numProducts; $i++) {
    // Generate fake data for each product
    $data = [
        'category_id' => $faker->numberBetween(1, 10), // Replace 1 and 10 with your category IDs range
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(3),
        'price' => $faker->randomFloat(2, 10, 1000),
        'qty' => $faker->numberBetween(1, 100),
        'product_image' => $faker->imageUrl(200, 200, 'products', true, 'Faker', true),
        'public_status' => $faker->randomElement(['published', 'draft']),
    ];

    // Insert the fake product data into the database using your ProductModel
    $db->insertProduct($data);
}

echo "Fake data generated successfully!";