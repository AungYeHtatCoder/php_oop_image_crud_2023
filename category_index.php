<?php 
include('vendor/autoload.php');
use App\ImageCrud\Databases\MySQL;
use App\ImageCrud\Databases\CategoryModel;
$db = new CategoryModel(new MySQL);
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
     <h1 class="mt-4">Dashboard</h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
     </ol>


     <div class="card mb-4">
      <div class="card-header">
       <i class="fas fa-table me-1"></i>
       Category DataTable Example
      </div>
      <div class="card-body">
       <!-- table start -->
       <table id="datatablesSimple">
        <thead>
         <tr>
          <th>ID</th>
          <th>Category Name</th>
          <th>Create Date</th>
          <th>Update Date</th>
          <th>Action</th>
         </tr>
        </thead>
        <tfoot>
         <tr>
          <th>ID</th>
          <th>Category Name</th>
          <th>Create Date</th>
          <th>Update Date</th>
          <th>Action</th>
         </tr>
        </tfoot>
        <tbody>
         <?php 
         $categories = $db->GetAllCategory();
         // echo "<pre></pre>";
         // print_r($categories);
         // echo "</pre>";
         // die();
         foreach($categories as $category) :
         ?>
         <tr>
          <td><?= $category->id; ?></td>
          <td><?= $category->category_name; ?></td>
          <td><?= $category->created_at; ?></td>
          <td><?= $category->updated_at; ?></td>
          <td>
           <a href="" class="btn btn-primary btn-sm">Detail</a>
           <a href="" class="btn btn-warning btn-sm">Edit</a>
           <a href="" class="btn btn-danger btn-sm">Del</a>
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