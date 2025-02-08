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
            <h1>Laporan Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Laporan Produk</li>
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
                        <label class="col-form-label">Gudang</label>
                        <select class="form-control" id="warehouse">
                          <option value="0">Semua</option>
                          <option value="1">CV Gantari Makmur</option>
                          <option value="2">CV Sukses Madiri</option>
                          <option value="3">PD Sukses Madiri</option>
                        </select>
                  </div>
                  </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                        <button id="btnsearch" onclick="btnsearch()" class="btn btn-primary" style="margin-top: 37px;"><i class="fas fa-search"></i> Cari</button>
                        <button id="btnsearch" onclick="excellexport()" class="btn btn-warning" style="margin-top: 37px;"><i class="fas fa-file-csv"></i> Excel</button>
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
                          <th colspan="3" style="text-align: center; padding-bottom: 20px;">Laporan Stok</td>
                      </tr>
                      <tr>
                          <th>Nama Gudang</th>
                          <th>Nama Perusahaan</th>
                          <th>Nama Produk</th>
                          <th>Stok</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($datas['get_reportstock'] as $row) { ?>
                      <tr>
                          <td><?php echo $row->master_gudang_name; ?></td>
                          <td><?php echo $row->mastercompany_name; ?></td>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td><?php echo number_format($row->master_gudang_stock).' '.$row->unit_name; ?></td>
                      </tr>

                      <?php } ?>
                  </tbody>
                </table>
        </div>


        <div class="card-body" style="margin-top: 120px; background-color: yellow;">
               <table style="width:100%">
                  <thead>
                      <tr>
                          <th colspan="3" style="text-align: center; padding-bottom: 20px;">Data Barang Belum Masuk Gudang</td>
                      </tr>
                      <tr>
                          <th>Nama Produk</th>
                          <th>Stok</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($datas['get_stocknotinputed'] as $row) { ?>
                      <tr>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td>0</td>
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
      var warehouse = $("#warehouse").val();
      window.location.replace('<?php echo base_url();?>Report/reportstock?warehouse='+warehouse);    
    }
</script>


<script type="text/javascript">
    function excellexport(){
      var warehouse = $("#warehouse").val();
      window.location.replace('<?php echo base_url();?>Report/reportstockexcell?warehouse='+warehouse);    
    }
</script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
