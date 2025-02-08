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
            <h1>Laporan Pembayaran Hutang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Laporan Pembayaran Hutang</li>
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
                           <div class="form-group">
                        <label class="col-form-label">No Invoice</label>
                        <input type="text" class="form-control ui-autocomplete-input" id="invoiceno">
                  </div>
                  </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                        <button id="btnsearch" onclick="btnsearch()" class="btn btn-primary" style="margin-top: 37px;"><i class="fas fa-search"></i> Cari</button>
                  </div>
              </div>
       
            </div>
          </div>

          <!-- /.card-body -->
         
        </div>
    </section>
  

    <section class="content">
      <div class="card">
        <div class="card-footer">
               <table style="width:100%">
                  <thead>
                      <tr>
                          <th colspan="6" style="text-align: center; padding-bottom: 20px;">Laporan Pembayaran Hutang</td>
                      </tr>
                     
                      <tr>
                          <th>No Invoice</th>
                          <th>Tanggal Pembayaran</th>
                          <th>Pembayaran Ke</th>
                          <th>Total Bayar</th>
                          <th>Sisa Hutang</th>
                          <th>Status Hutang</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                    <?php $i = 1; ?>
                    <?php foreach ($get_paymentreport as $row) { ?>
                      <tr>
                          <td><?php echo $row->payment_hutang_faktur_id; ?></td>
                          <td><?php $date = date_create($row->payment_hutang_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td>Pembayaran Ke <?php echo $i ?></td>
                          <td><?php echo 'Rp. '.number_format($row->payment_hutang_total); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->payment_sisa_hutang); ?></td>
                          <td>
                              <?php if($row->payment_sisa_hutang == 0){?>
                            <span class="badge badge-success">Lunas</span>
                          <?php }else{ ?>
                            <span class="badge badge-danger">Belum Lunas</span>
                          <?php } ?>
                          </td>
                      </tr>
                        <?php $i ++ ?>
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
      var invoiceno = $("#invoiceno").val();
      window.location.replace('<?php echo base_url();?>Report/paymentreport?invoiceno='+invoiceno);    
    }
</script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
