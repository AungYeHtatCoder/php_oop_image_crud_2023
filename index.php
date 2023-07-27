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
       DataTable Example
      </div>
      <div class="card-body">
       <!-- table start -->

       <!-- table end -->
      </div>
     </div>
    </div>
   </main>
   <?php include('layouts/footer.php'); ?>