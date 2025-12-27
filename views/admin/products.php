<?php
session_start();

// CEK LOGIN ADMIN
if (!isset($_SESSION['level']) || $_SESSION['level'] != 0) {
    header("Location: ../../index.php");
    exit;
}

require_once "../../classes/Produk.php";
$produk = new Produk();

// Handle Actions
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$editData = null;

if ($action == 'edit' && isset($_GET['id'])) {
    $editData = mysqli_fetch_assoc($produk->getById($_GET['id']));
}

$data = $produk->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Products | AMD Admin</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    
    <style>
        .brand-link {
            background: linear-gradient(135deg, #ff0000, #d40000) !important;
            color: white !important;
        }
        .sidebar-dark-danger .nav-sidebar>.nav-item>.nav-link.active {
            background: #ff0000 !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index.php" class="nav-link"><i class="fas fa-home"></i> Home</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user"></i> <?= $_SESSION['username'] ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-danger elevation-4">
        <a href="dashboard.php" class="brand-link text-center">
            <span class="brand-text font-weight-bold">AMD ADMIN</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-user-shield fa-2x text-white"></i>
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $_SESSION['username'] ?></a>
                    <small class="text-muted">Administrator</small>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="products.php" class="nav-link active">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Manage Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../index.php" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Visit Website</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-danger">Manage Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                
                <!-- Add/Edit Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-<?= $action == 'edit' ? 'edit' : 'plus' ?>"></i>
                                    <?= $action == 'edit' ? 'Edit Product' : 'Add New Product' ?>
                                </h3>
                            </div>
                            <form action="../../process/proses_produk.php" method="POST">
                                <div class="card-body">
                                    <input type="hidden" name="aksi" value="<?= $action == 'edit' ? 'edit' : 'tambah' ?>">
                                    <?php if ($action == 'edit'): ?>
                                        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" name="nama" class="form-control" 
                                               placeholder="Enter product name" 
                                               value="<?= $editData ? htmlspecialchars($editData['nama_produk']) : '' ?>" 
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Price (Rp)</label>
                                        <input type="number" name="harga" class="form-control" 
                                               placeholder="Enter price" 
                                               value="<?= $editData ? $editData['harga'] : '' ?>" 
                                               required>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-save"></i> 
                                        <?= $action == 'edit' ? 'Update' : 'Save' ?>
                                    </button>
                                    <?php if ($action == 'edit'): ?>
                                        <a href="products.php" class="btn btn-secondary">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info-circle"></i> Information</h3>
                            </div>
                            <div class="card-body">
                                <p><strong>Total Products:</strong> <?= mysqli_num_rows($data) ?></p>
                                <p><strong>Action:</strong> <?= $action == 'edit' ? 'Editing product' : 'Adding new product' ?></p>
                                <hr>
                                <p class="text-muted">
                                    <i class="fas fa-lightbulb"></i> 
                                    Products added here will be displayed in the Products page for all users.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-danger">
                                <h3 class="card-title"><i class="fas fa-list"></i> All Products</h3>
                            </div>
                            <div class="card-body">
                                <table id="productsTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        $data = $produk->getAll();
                                        while($row = mysqli_fetch_assoc($data)): 
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                            <td>
                                                <a href="products.php?action=edit&id=<?= $row['id'] ?>" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="../../process/proses_produk_admin.php?action=delete&id=<?= $row['id'] ?>" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2025 AMD Admin.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>

</body>
</html>