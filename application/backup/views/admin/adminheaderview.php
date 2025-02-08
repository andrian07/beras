<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/summernote/summernote-bs4.min.css">
        <!-- jQuery -->
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/dist/js/3.3.1jquery.js"></script>
  <script src="<?php echo base_url(); ?>asset/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="<?php echo base_url(); ?>asset/dist/js/sweetalert2@11.js"></script>
  <style>
    .panel {
  display: none;
  overflow: hidden;
}

 .table-menu {
    margin-right: 6px;
}
.oaerror{
  width:100%;
  background-color: #ffffff;
  padding:20px;
  border:1px solid #eee;
  border-left-width:5px;
  border-radius: 3px;
  margin:10px auto;
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
}

.dangeres-error{
  border-left-color: #d9534f; /* Left side border color */
  background-color: rgba(217, 83, 79, 0.1); /*Same color as the left border with reduced alpha to 0.1*/
}

.dangeres-error strong{
  color:#d9534f;
}

.dangeres-sucess{
  border-left-color: #28a745; /* Left side border color */
  background-color: rgba(40, 167, 60, 0.1); /*Same color as the left border with reduced alpha to 0.1*/
}

.dangeres-sucess strong{
  color:#28a745;
}

.select2-container--default .select2-selection--single {
    height: 37px;
}

  </style>
</head>
<body class="hold-transition sidebar-mini sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <li class="nav-item dropdown">

        <p style="margin-top: 7px; font-weight: 900;">User Login( <?php echo $_SESSION['user_name']; ?> )</p>

      </li>
      <!-- Messages Dropdown Menu -->
    
      <!-- Notifications Dropdown Menu -->
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>asset/index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Admin
        <?php /*<img src="<?php echo base_url(); ?>asset/images/dnafarmasi.png" width="40%;">*/?>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" > 

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url();?>Admin" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                 Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>Masterdata/masterbarang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>Masterdata/mastersuplier" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Suplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>Masterdata/mastercustomer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>Masterdata/mastersales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>Masterdata/mastercompany" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Perusahaan</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                 Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if($_SESSION['user_role'] == 1){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Transaction/purchase" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
            <?php } ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Transaction/sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?php echo base_url(); ?>Project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proyek</p>
                </a>
              </li>
          
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                 Retur
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if($_SESSION['user_role'] == 1){ ?>
              <?php /*<li class="nav-item">
                <a href="<?php echo base_url(); ?>Retur/returpurchase" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Retur Pembelian</p>
                </a>
              </li> */ ?>
            <?php } ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Retur/retursales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Retur Penjualan</p>
                </a>
              </li>          
            </ul>
          </li>
     
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>Admin/report" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                 <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Report/reportstock" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Stock</p>
                </a>
              </li>
                    <?php if($_SESSION['user_role'] == 1){ ?>
               <li class="nav-item">
                <a href="<?php echo base_url(); ?>Report/paymentreport" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pembayaran</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Report/reporthutang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Hutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Report/reportpiutang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Piutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Report/reportomzet" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Omzet</p>
                </a>
              </li>
                <?php } ?>
            </ul>
          </li>
      
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>Admin/settingapps" class="nav-link">
               <i class="nav-icon fas fa-tools"></i>
              <p>
                Setting Aplikasi
                 <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Setting/settingunit" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting Unit</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?php echo base_url(); ?>Setting/settingcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Setting/changepassword" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ganti Password</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="<?php echo base_url(); ?>Setting/logout" class="nav-link">
               <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>