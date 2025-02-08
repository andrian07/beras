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
            <h1>Laporan Piutang Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Laporan Piutang Customer</li>
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
              <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Transaksi Dari:</label>
                        <?php if(isset($_GET['datefrom']) == 1){ ?>
                         <input type="date" class="form-control" id="datefrom" value="<?php echo $_GET['datefrom'] ?>">
                       <?php }else{ ?>
                        <input type="date" class="form-control" id="datefrom">
                      <?php } ?>
                  </div>
              </div>
               <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Transaksi Sampai:</label>
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

                        <select id="customersales" class="form-control select2" style="width: 100%;">
                            <option></option>
                            <?php foreach($data['get_mastercustomer'] as $row){?>
                                <option value="<?php echo $row->customer_id; ?>"><?php echo $row->customer_name; ?></option>
                            <?php } ?>
                        </select>
                  </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                        <label class="col-form-label">Sales <p style="display: inline; font-size: 11px; color: red;">*kosongkan untuk cari semua data</p></label>

                        <select id="salesid" class="form-control select2" style="width: 100%;">
                            <option></option>
                            <?php foreach($data['get_mastersales'] as $row){?>
                                <option value="<?php echo $row->sales_id; ?>"><?php echo $row->sales_name; ?></option>
                            <?php } ?>
                        </select>
                  </div>
              </div>
       
              <div class="col-md-2">
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
               <table  style="width:100%">
                  <thead>
                      <tr>
                          <th colspan="7" style="text-align: center; padding-bottom: 20px;">Laporan Piutang Customer</td>
                      </tr>
                      <tr>
                          <th>No Faktur</th>
                          <th>Pelanggan</th>
                          <th>Sales</th>
                          <th>Tanggal Penjualan</th>
                          <th>Jatuh Tempo</th>
                          <th>Diskon</th>
                           <th>Total</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data['get_reporthutang'] as $row) { ?>
                      <tr>
                          <td><?php echo $row->sales_faktur_id; ?></td>
                          <td><?php echo $row->customer_name; ?></td>
                          <td><?php echo $row->sales_sales_name; ?></td>
                          <td><?php $date = date_create($row->sales_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php $date = date_create($row->sales_due_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_discount); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_total); ?></td>
                          <td>
                            <?php if($row->sales_status == 'lunas'){?>
                            <span class="badge badge-success">Lunas</span>
                          <?php }else{ ?>
                            <span class="badge badge-danger"  data-id="<?php echo $row->sales_header_id ; ?>" data-faktur="<?php echo $row->sales_faktur_id; ?>" data-total="<?php echo $row->sales_total;?>" data-sisa="<?php echo $row->sales_sisa_pembayaran;?>" data-toggle="modal" data-target=".bd-example-modal-lgs">Belum Lunas</span>
                          <?php } ?>
                          </td>
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
      var salesid = $("#salesid option:selected").text();
      window.location.replace('<?php echo base_url();?>Report/reporthutang?datefrom='+datefrom+'&dateend='+dateend+'&customersales='+customersales+'&salesid='+salesid);    
    }
</script>


<script type="text/javascript">
    function excellexport(){
      var datefrom = $("#datefrom").val();
      var dateend = $("#dateend").val();
      var customersales = $("#customersales").val();
       var salesid = $("#salesid option:selected").text();
      window.location.replace('<?php echo base_url();?>Report/reporthutangexcell?datefrom='+datefrom+'&dateend='+dateend+'&customersales='+customersales+'&salesid='+salesid);    
    }
</script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
