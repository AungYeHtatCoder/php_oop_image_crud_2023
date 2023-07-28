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
       Image Create Form <span>
        <a href="image_index.php" class="btn btn-primary">Back</a>
       </span>
      </div>
      <div class="card-body">
       <!-- table start -->
       <?php 
              include('vendor/autoload.php');
              use App\ImageCrud\Databases\MySQL;
              use App\ImageCrud\Databases\CategoryModel;
              $db = new CategoryModel(new MySQL);
              $categories = $db->GetAllCategory();
              ?>
       <form action="_actions/product_create.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
         <select name="category_id" class="form-select" aria-label="Default select example">
          <option selected>Choose Product Category</option>
          <?php foreach($categories as $category) : ?>
          <option value="<?= $category->id; ?>"><?= $category->category_name; ?></option>
          <?php endforeach; ?>
         </select>
        </div>
        <div class="mb-3">
         <label for="Product Title" class="form-label">Product Name</label>
         <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp">
        </div>
        <div class="mb-3">
         <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
         <label for="Description" class="form-label">Description</label>
        </div>
        <div class="mb-3">
         <label for="Product Price" class="form-label">Product Price</label>
         <input type="number" class="form-control" name="price" id="price" aria-describedby="titleHelp">
        </div>

        <div class="mb-3">
         <label for="Product Price" class="form-label">Product QTY</label>
         <input type="number" class="form-control" name="qty" id="qty" aria-describedby="qtyHelp">
        </div>
        <div class="mb-3">
         <label for="formFile" class="form-label">Choose Your Product Image</label>
         <input class="form-control" name="product_image" type="file" id="product_image">
        </div>

        <div class="mb-3 form-check">
         <input type="checkbox" value="draft" name="public_status" class="form-check-input" id="exampleCheck1">
         <label class="form-check-label" for="exampleCheck1">Product Status</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
       </form>
       <!-- table end -->
      </div>
     </div>
    </div>
   </main>
   <?php include('layouts/footer.php'); ?>