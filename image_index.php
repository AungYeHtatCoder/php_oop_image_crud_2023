<?php 
include('vendor/autoload.php');
use App\ImageCrud\Databases\MySQL;
use App\ImageCrud\Databases\ProductModel;
$db = new ProductModel(new MySQL());
$products = $db->getAllProduct();
// var_dump($products);
// die();
?>
<?php 
include('layouts/head.php');
?>

<body class="sb-nav-fixed">
 <?php include('layouts/navbar.php'); ?>
 <div id="layoutSidenav">
  <?php include('layouts/sidebar.php'); ?>
  <div id="layoutSidenav_content">
   <main>
    <div class="container-fluid px-4">
     <h1 class="mt-4">Image Dashboard</h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Image Dashboard</li>
     </ol>


     <div class="card mb-4">
      <div class="card-header">
       <i class="fas fa-table me-1"></i>
       Image DataTable Example <span><a href="image_create.php" class="btn btn-primary btn-sm">New Product
         Create</a></span>
      </div>
      <div class="card-body">
       <!-- table start -->
       <table id="datatablesSimple">
        <thead>
         <tr>
          <th>ID</th>
          <th>ProductName</th>
          <th>CategoryName</th>
          <th>Price</th>
          <th>QTY </th>
          <th>Status</th>
          <th>Image</th>
          <th>Action</th>
         </tr>
        </thead>
        <tfoot>
         <tr>
          <th>ID</th>
          <th>ProductName</th>
          <th>CategoryName</th>
          <th>Price</th>
          <th>QTY </th>
          <th>Status</th>
          <th>Image</th>
          <th>Action</th>
         </tr>
        </tfoot>
        <tbody>
         <?php foreach($products as $product) : ?>
         <tr>
          <td><?= $product['id']; ?></td>
          <td><?= $product['title']; ?></td>
          <td><?= $product['category_name']; ?></td>
          <td><?= $product['price']; ?></td>
          <td><?= $product['qty']; ?></td>
          <td>
           <?php if ($product['public_status'] === 'draft') : ?>
           <span class="badge bg-secondary">Not Published</span>
           <?php else : ?>
           <span class="badge bg-success">Published</span>
           <?php endif; ?>
          </td>
          <td>
           <img src="_actions/product_images/<?= $product['product_image']; ?>" width="100px" height="100px" alt="">
          </td>

          <td>
           <a href="product_edit.php?id=<?= $product['id'];?>" class="btn btn-warning btn-sm">Edit</a>
           <a href="_actions/product_del.php?id=<?= $product['id'];?>" class="btn btn-danger btn-sm">Del</a>

          </td>

         </tr>
         <?php endforeach; ?>
        </tbody>
       </table>

       <!-- table end -->
      </div>
     </div>
    </div>
   </main>
   <?php include('layouts/footer.php'); ?>