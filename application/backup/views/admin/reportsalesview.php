<?php 
    
    define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
    require DOC_ROOT_PATH . $this->config->item('adminheaderlink');
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <section class="content">

      <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Pencarian</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
         
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                        <label class="col-form-label">Jatuh Tempo Dari:</label>
                        <?php if(isset($_GET['datefrom']) == 1){ ?>
                         <input type="date" class="form-control" id="datefrom" value="<?php echo $_GET['datefrom'] ?>">
                       <?php }else{ ?>
                        <input type="date" class="form-control" id="datefrom">
                      <?php } ?>
                  </div>
              </div>

               <div class="col-md-3">
                  <div class="form-group">
                        <label class="col-form-label">Jatuh Tempo Sampai:</label>
                        <?php if(isset($_GET['dateend']) == 1){ ?>
                         <input type="date" class="form-control" id="dateend" value="<?php echo $_GET['dateend'] ?>">
                         <?php }else{ ?>
                        <input type="date" class="form-control" id="dateend">
                         <?php } ?>
                  </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                        <label class="col-form-label">Pelanggan <p style="display: inline; font-size: 11px; color: red;">*kosongkan untuk cari semua data</p></label>
                        <?php if(isset($_GET['customersales']) == 1){ ?>
                         <input type="text"  class="form-control" id="customersales" value="<?php echo $_GET['customersales'] ?>">
                        <?php }else{ ?>
                           <input type="text"  class="form-control" id="customersales">
                               <?php } ?>
                  </div>
              </div>
       
              <div class="col-md-3">
                 <div class="form-group">
                        <button id="btnsearch" onclick="btnsearch()" class="btn btn-warning" style="margin-top: 37px;"><i class="fas fa-search"></i> Cari</button>
                        <button id="excellexport" onclick="excellexport()" class="btn btn-success" style="margin-top: 37px;"><i class="fas fa-file-excel"></i> Excel</button>
                  </div>
              </div>
       
            </div>
          </div>

          <!-- /.card-body -->
         
        </div>
    </section>


    <section class="content">
      <div class="card">
       
        <div class="card-body">
               <table style="width:100%">
                  <thead>
                     <tr>
                          <th>No</th>
                          <th>No Faktur</th>
                          <th>Nama Barang</th>
                          <th>Harga</th>
                          <th>Qty</th>
                          <th>Satuan</th>
                          <th>Diskon</th>
                          <th>Total</th>
                          <th>Tanggal Transaksi</th>
                      </tr>
                  </thead>

                  <tbody>
                    <?php $i = 0; ?>

                    <?php foreach ($datas['get_report_sales'] as $row) { ?>
                      <tr>
                          <?php $i++ ?>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->sales_faktur_id; ?></td>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_detail_price); ?></td>
                          <td><?php echo $row->sales_detail_satuan ?></td>
                          <td><?php echo $row->unit_name ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_detail_discount); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_detail_total); ?></td>
                          <td><?php $date = date_create($row->sales_date); echo date_format($date,"d-M-Y"); ?></td>
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


<script type="text/javascript">
    function btnsearch(){
      var datefrom = $("#datefrom").val();
      var dateend = $("#dateend").val();
      var customersales = $("#customersales").val();
      window.location.replace('<?php echo base_url();?>Report/reporthutang?datefrom='+datefrom+'&dateend='+dateend+'&customersales='+customersales);    
    }
</script>


<script type="text/javascript">
    function excellexport(){
      var datefrom = $("#datefrom").val();
      var dateend = $("#dateend").val();
      var customersales = $("#customersales").val();
      window.location.replace('<?php echo base_url();?>Report/reporthutangexcell?datefrom='+datefrom+'&dateend='+dateend+'&customersales='+customersales);    
    }
</script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
