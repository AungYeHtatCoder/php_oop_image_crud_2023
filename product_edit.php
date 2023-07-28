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
     <h1 class="mt-4">Product Dashboard Update</h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Product Dashboard</li>
     </ol>


     <div class="card mb-4">
      <div class="card-header">
       <i class="fas fa-table me-1"></i>
       Product Create Form <span>
        <a href="image_index.php" class="btn btn-primary">Back</a>
       </span>
      </div>
      <div class="card-body">
       <!-- table start -->
       <?php 
              include('vendor/autoload.php');
              use App\ImageCrud\Databases\MySQL;
              use App\ImageCrud\Databases\CategoryModel;
              use App\ImageCrud\Databases\ProductModel;
              $db = new ProductModel(new MySQL);
              $id = $_GET['id'];
              $products = $db->getProductByID($id);
              $category_db = new CategoryModel(new MySQL());
              $categories = $category_db->GetAllCategory();

              // Get the old selected category ID and old product image filename
              $oldCategoryID = $products['category_id'];
              $oldProductImage = $products['product_image'];
              $productStatus = $products['public_status'];
              // var_dump($products);
              // die();
              ?>
       <form action="_actions/product_update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $products['id']; ?>">
        <div class="mb-3">
         <select name="category_id" class="form-select" aria-label="Default select example">
          <option selected>Choose Product Category</option>
          <?php foreach ($categories as $category) : ?>
          <option value="<?= $category->id; ?>" <?= ($category->id == $oldCategoryID) ? 'selected' : ''; ?>>
           <?= $category->category_name; ?>
          </option>
          <?php endforeach; ?>
         </select>
        </div>
        <div class="mb-3">
         <label for="Product Title" class="form-label">Product Name</label>
         <input type="text" name="title" class="form-control" id="title" value="<?= $products['title']; ?>"
          aria-describedby="titleHelp">
        </div>
        <div class="mb-3">
         <textarea name="description" class="form-control" id="" cols="30" rows="10">
          <?= $products['description']; ?>
         </textarea>
         <label for="Description" class="form-label">Description</label>
        </div>
        <div class="mb-3">
         <label for="Product Price" class="form-label">Product Price</label>
         <input type="number" class="form-control" name="price" value="<?= $products['price']; ?>" id="price"
          aria-describedby="titleHelp">
        </div>

        <div class="mb-3">
         <label for="Product Price" class="form-label">Product QTY</label>
         <input type="number" class="form-control" name="qty" value="<?= $products['qty']; ?>" id="qty"
          aria-describedby="qtyHelp">
        </div>
        <div class="mb-3">
         <label for="formFile" class="form-label">Choose Your Product Image</label>
         <input class="form-control" name="product_image" type="file" id="product_image">
         <!-- Display the old product image if available -->
         <?php if ($oldProductImage) : ?>
         <img src="_actions/product_images/<?= $oldProductImage; ?>" width="100px" height="100px"
          alt="Old Product Image">
         <?php endif; ?>
        </div>

        <div class="mb-3">
         <label for="Product Status" class="form-label">Product Status</label>
         <select class="form-select" name="public_status" aria-label="Default select example">
          <option value="draft" <?= ($products['public_status'] === 'draft') ? 'selected' : ''; ?>>
           <?php echo ($products['public_status'] === 'draft') ? 'Draft (Old)' : 'Draft'; ?>
          </option>
          <option value="published" <?= ($products['public_status'] === 'published') ? 'selected' : ''; ?>>
           <?php echo ($products['public_status'] === 'published') ? 'Published (Old)' : 'Published'; ?>
          </option>
         </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
       </form>
       <!-- table end -->
      </div>
     </div>
    </div>
   </main>
   <?php include('layouts/footer.php'); ?>