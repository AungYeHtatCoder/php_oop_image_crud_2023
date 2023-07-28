<?php
include('../vendor/autoload.php');
use App\ImageCrud\Databases\MySQL;
use App\ImageCrud\Databases\ProductModel;
use Helpers\HTTP;
$db = new ProductModel(new MySQL());

// Replace $productID with the ID of the product you want to delete
//$productID = 123;
$id = $_GET['id'];
// Call the deleteProduct method
$deleted = $db->deleteProduct($id);

// Check if the deletion was successful
if ($deleted) {
    //echo "Product has been deleted successfully.";
    HTTP::redirect('../image_index.php');
} else {
    echo "Failed to delete product.";
}