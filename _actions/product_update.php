<?php
include('../vendor/autoload.php');
use App\ImageCrud\Databases\MySQL;
use App\ImageCrud\Databases\ProductModel;
use Helpers\HTTP;
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $file_name = $_FILES['product_image']['name'];
    $tmp = $_FILES['product_image']['tmp_name'];
    $errors = $_FILES['product_image']['error'];
    $type = $_FILES['product_image']['type'];
    $id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $publish_status = $_POST['public_status'];

    // Create an associative array with the updated data
    $data = [
        'id' => $id,
        'category_id' => $category_id,
        'title' => $title,
        'description' => $description,
        'price' => $price,
        'qty' => $qty,
        'public_status' => $publish_status,
    ];

    // Check if a new product image is provided
    if ($type === 'image/jpeg' || $type === 'image/png' || $type === 'image/gif' || $type === 'image/jpg') {
        if ($errors === 0) {
            // If a new image is provided, move it to the product_images directory
            if (move_uploaded_file($tmp, 'product_images/' . $file_name)) {
                // Set the product_image field in the data array to the new file name
                $data['product_image'] = $file_name;
            } else {
                echo "Error uploading image file";
                exit;
            }
        } else {
            echo "Error uploading image file";
            exit;
        }
    } else {
        // If no new image is provided, fetch the old product image from the database
        $db = new ProductModel(new MySQL());
        $oldProductImage = $db->getProductImageById($id);
        // Set the product_image field in the data array to the old file name
        $data['product_image'] = $oldProductImage;
    }

    // Perform the update operation using the ProductModel
    $db = new ProductModel(new MySQL());
    $updatedProductID = $db->updateProduct($data);

    // Check if the update was successful
    if ($updatedProductID) {
        // Redirect to the product index page with a success message
        HTTP::redirect('../image_index.php?msg=Product has been Updated successfully.');
    } else {
        // Redirect to the product edit page with an error message
        HTTP::redirect("product_edit.php?id=$id&error=Failed to update product.");
    }
} else {
    // If the form is not submitted, redirect to the index page
    HTTP::redirect('../image_index.php');
}