<?php 
include('../vendor/autoload.php');
use App\ImageCrud\Databases\MySQL;
use App\ImageCrud\Databases\ProductModel;
use Helpers\HTTP;

$file_name = $_FILES['product_image']['name'];
$tmp = $_FILES['product_image']['tmp_name'];
$errors = $_FILES['product_image']['error'];
$type = $_FILES['product_image']['type'];

$data = [
    'category_id' => $_POST['category_id'],
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'price' => $_POST['price'],
    'qty' => $_POST['qty'],
    'product_image' => $file_name,
    'public_status' => $_POST['public_status'],
];
// echo "<pre>";
// print_r($data);
// echo "</pre>";
// die();
$db = new ProductModel(new MySQL());

if($type === 'image/jpeg' || $type === 'image/png' || $type === 'image/gif' || $type === 'image/jpg'){
   
    if($errors === 0){
        if(move_uploaded_file($tmp, 'product_images/'.$file_name)){
            $product_create = $db->insertProduct($data);

            if($product_create){
//                  echo "<pre>";
//    print_r($product_create);
//    echo "</pre>";
//    die();
                HTTP::redirect('../image_index.php?msg=Product has been created successfully.');
            }else{
                echo "Error";
            }
        }
    }
}else{
    echo "Please upload image file";
}