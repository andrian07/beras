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
            <h1>Master Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Master Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- popup add -->
     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Master Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Kode Barang:</label>
                        <?php 
                          $randomcode = 'P-'.bin2hex(random_bytes(2));
                        ?>
                         <input type="text" class="form-control" id="codeitem-add" value="<?php echo $randomcode; ?>">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">Nama Barang:</label>
                         <input type="text" class="form-control" id="nameitem-add" required="">
                      </div>
                       <div class="form-group">
                        <label  class="col-form-label">Kategori:</label>
                        <select class="form-control" id="categoryitem-add">
                              <?php foreach ($datas['get_mastercategory'] as $row) { ?>
                              <option value="<?php echo $row->category_id  ?>"><?php echo $row->category_name; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                       <div class="form-group">
                        <label  class="col-form-label">Unit:</label>
                        <select class="form-control" id="unititem-add">
                              <?php foreach ($datas['get_masterunit'] as $row) { ?>
                              <option value="<?php echo $row->unit_id  ?>"><?php echo $row->unit_name; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Harga Modal:</label>
                        <input type="number" class="form-control" id="modalitem-add" required="" value="0">
                      </div>

                      <div class="form-group">
                        <label  class="col-form-label">Harga Jual:</label>
                        <input type="number" class="form-control" id="jualitem-add" required="" value="0"> 
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info"  id="add">Tambah</button>
                  </div>
    </div>
  </div>
</div>
    <!-- end popup add -->


     <!-- popup Edit -->
       <div class="modal fade bd-example-modal-lgs" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Master Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Kode Barang:</label>
                        <input type="hidden" class="form-control" id="id-edit">
                         <input type="text" class="form-control" id="codeitem-edit">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">Nama Barang:</label>
                         <input type="text" class="form-control" id="nameitem-edit" required="">
                      </div>
                       <div class="form-group">
                        <label  class="col-form-label">Kategori:</label>
                        <select class="form-control" id="categoryitem-edit">
                              <?php foreach ($datas['get_mastercategory'] as $row) { ?>
                              <option value="<?php echo $row->category_id  ?>"><?php echo $row->category_name; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                       <div class="form-group">
                        <label  class="col-form-label">Unit:</label>
                        <select class="form-control" id="unititem-edit">
                              <?php foreach ($datas['get_masterunit'] as $row) { ?>
                              <option value="<?php echo $row->unit_id  ?>"><?php echo $row->unit_name; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Harga Modal:</label>
                        <input type="number" class="form-control" id="modalitem-edit" required="" value="0">
                      </div>

                      <div class="form-group">
                        <label  class="col-form-label">Harga Jual:</label>
                        <input type="number" class="form-control" id="jualitem-edit" required="" value="0"> 
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id="edit">Edit</button>
                  </div>
    </div>
  </div>
</div>
    <!-- end popup Edit -->



    <section class="content">
      <div class="card">
        <div class="card-body">
               <table class="table table-striped table-bordered" style="width:100%">
                <?php $i = 1; ?>
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Gudang</th>
                          <th>Nama Barang</th>
                          <th>Kuantitas</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_masterbarang_detail as $row) { ?>
                      <tr>

                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->master_gudang_name; ?></td>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td><?php echo $row->master_gudang_stock; ?> <?php echo $row->unit_name; ?></td>
                           <?php $i++ ?>
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
 
