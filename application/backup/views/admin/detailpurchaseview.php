<?php 
    
    define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
    require DOC_ROOT_PATH . $this->config->item('adminheaderlink');
 ?>

<style type="text/css">
  input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    margin-top: 40px;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pembelian #<?php echo $_GET['id']?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Detail Pembelian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="card">
        <div class="card-body">
          <div class="row">
              <?php foreach ($datas['get_header_purchase_byfaktur'] as $row) { ?>
              <div class="col-md-6">

                  <table>
                    <tr><td  style="font-weight: 800;">No Faktur</td><td>:</td><td><?php echo $row->purchase_faktur_id; ?></td></tr>
                    <tr><td  style="font-weight: 800;">Tanggal</td><td>:</td><td><?php $date = date_create($row->purchase_date); echo date_format($date,"d-M-Y"); ?></td></tr>
                    <tr><td  style="font-weight: 800;">Jatuh Tempo</td><td>:</td><td><?php $date = date_create($row->purchase_due_date); echo date_format($date,"d-M-Y"); ?></td></tr>
                    <tr><td  style="font-weight: 800;">Status Pembayaran</td><td>:</td><td><?php echo $row->purchase_status; ?></td></tr>
                  </table>
                  <p style="font-size: 14px;"></p>
              </div>
              <div class="col-md-6" style="text-align: right;"> 
                  <h2 style="font-size: 18px; font-weight: 800;"><?php echo $row->suplier_name; ?></h2>
                  <p style="font-size: 14px;">
                      <?php echo $row->suplier_address; ?><br />
                      <?php echo $row->suplier_phone; ?><br />
                     <?php echo 'Npwp: '.$row->suplier_npwp; ?>
                  </p>
              </div>
              
              <?php } ?>
            </div>

               <table  class="table table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Produk</th>
                          <th>Harga</th>
                          <th>Qty</th>
                          <th>Diskon</th>
                          <th>Jumlah</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($datas['get_detail_purchase_byfaktur'] as $row) { ?>
                      <tr>
                          <?php $i++ ?>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td><?php echo 'Rp. '.number_format($row->purchase_detail_price); ?></td>
                          <td><?php echo $row->purchase_detail_satuan.' '.$row->unit_name; ?></td>
                           <td><?php echo 'Rp. '.number_format($row->purchase_detail_discount); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->purchase_detail_total); ?></td>
                      </tr>
                      <?php } ?>
                       <?php foreach ($datas['get_header_purchase_byfaktur'] as $row) { ?>
                      <tr>
                        <td colspan="5" style="text-align: right; font-weight: 800;">Total</td><td><?php echo 'Rp. '.number_format($row->purchase_subtotal) ?></td>
                      </tr>
                      <tr>
                        <td colspan="5" style="text-align: right;  font-weight: 800;">Diskon</td><td><?php echo 'Rp. '.number_format($row->purchase_discount) ?></td>
                      </tr>
                      <tr>
                        <td colspan="5" style="text-align: right;  font-weight: 800;">PPN</td><td>0</td>
                      </tr>
                      <tr>
                        <td colspan="5" style="text-align: right;  font-weight: 800;">Grand Total</td><td><?php echo 'Rp. '.number_format($row->purchase_total) ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
        </div>

        <div class="card-footer">
          
        </div>

      </div>


    </section>

  </div>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
