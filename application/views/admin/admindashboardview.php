<?php 

define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('adminheaderlink');
date_default_timezone_set('Asia/Jakarta');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">

          <div class="card-body">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Total Data Hari Ini</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl">
                    <i class="ion ion-ios-refresh-empty"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-danger">Omzet Hari Ini</i> 

                    </span>
                    <?php foreach($data['get_transaction_today'] as $row){ ?>
                      <span class="text-muted"><?php echo 'Rp. '.number_format($row->total_transaction) ?></span>
                    <?php } ?>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl">
                    <i class="ion ion-ios-cart-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-danger">Hutang Hari Ini</i>

                    </span>
                    <?php foreach($data['get_hutang_today'] as $row){ ?>
                      <span class="text-muted"><?php echo 'Rp. '.number_format($row->total_hutang) ?></span>
                    <?php } ?>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                    <i class="ion ion-ios-people-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-down text-danger">Piutang Hari Ini</i>

                    </span>
                    <?php foreach($data['get_piutang_today'] as $row){ ?>
                      <span class="text-muted"><?php echo 'Rp. '.number_format($row->total_piutang) ?></span>
                    <?php } ?>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <!-- /.card-footer-->
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Paket Transaksi Hari Ini</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
              </a>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['get_product_total'] as $row){ ?>
                  <tr>
                    <td><?php echo $row->master_barang_name; ?></td>
                    <td><?php echo $row->total_satuan; ?></td>
                    <td><?php echo 'Rp. '.number_format($row->total_price); ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
       <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Piutang Customer Jatuh Tempo Hari Ini</h3>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-striped table-valign-middle">
            <thead>
              <tr>
                <th>Invoice</th>
                <th>Pelanggan</th>
                <th>Tgl Tempo</th>
                <th>Total Transaksi</th>
                <th>Sisa Hutang</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['get_list_piutang_today'] as $row){ ?>
                <tr>
                  <td><?php echo $row->sales_faktur_id; ?></td>
                  <td><?php echo $row->customer_name; ?></td>
                  <td><?php $date = date_create($row->sales_due_date); echo date_format($date,"d-M-Y"); ?></td>
                  <td><?php echo 'Rp. '.number_format($row->sales_total); ?></td>
                  <td><?php echo 'Rp. '.number_format($row->sales_sisa_pembayaran); ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-0">
          <h3 class="card-title">Item Yang Belum Di Kirim 3 Hari Terakhir</h3>
          <div class="card-tools">
            <a href="#" class="btn btn-tool btn-sm">
              <i class="fas fa-bars"></i>
            </a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-striped table-valign-middle">
            <thead>
              <tr>
                <th>Invoice</th>
                <th>Product</th>
                <th>Jumlah Pesanan</th>
                <th>Jumlah Terkirim</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data['get_not_send_product'] as $row){ ?>
                <tr>
                  <td><?php echo $row->sales_faktur_id; ?></td>
                  <td><?php echo $row->master_barang_name; ?></td>
                  <td><?php echo $row->sales_detail_satuan; ?></td>
                  <td><?php echo $row->sales_detail_sent; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php 
require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
?>

