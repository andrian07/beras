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
                      <?php if($_SESSION['user_role'] == 1){ ?>
                      <div class="form-group">
                        <label  class="col-form-label">Harga Modal:</label>
                        <input type="number" class="form-control" id="modalitem-add" required="" value="0">
                      </div>
                       <?php } ?>
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
                         <input type="text" class="form-control" id="codeitem-edit" readonly>
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">Nama Barang:</label>
                         <input type="text" class="form-control" id="nameitem-edit" >
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
                       <?php if($_SESSION['user_role'] == 1){ ?>
                      <div class="form-group">
                        <label  class="col-form-label">Harga Modal:</label>
                        <input type="number" class="form-control" id="modalitem-edit" required="" value="0">
                      </div>
                      <?php } ?>
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
<div class="modal fade bd-example-modal-lga" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="passwordmodal">
                      </div>     
                    
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" id="changestyle">submit</button>
                  </div>
    </div>
  </div>
</div>


    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <?php /*<button type="button" class="btn btn-warning"><i class="fas fa-file-csv"></i> Excell</button> */ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Tambah</button>
          </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Kategori</th>
                          <th>Satuan</th>
                          <?php if($_SESSION['user_role'] == 1){ ?>
                          <th>Harga Modal</th>
                        <?php } ?>
                          <th>Harga Jual</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($datas['get_masterbarang'] as $row) { ?>
                      <tr>
                          <td><?php echo $row->master_barang_code; ?></td>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td><?php echo $row->category_name; ?></td>
                          <td><?php echo $row->unit_name; ?></td>
                             <?php if($_SESSION['user_role'] == 1){ ?>
                          <td><?php echo 'Rp.' .number_format($row->master_barang_harga_modal); ?></td>
                        <?php } ?>
                          <td><?php echo 'Rp.' .number_format($row->master_barang_harga_jual); ?></td>
                          <td>
                            <button class="btn btn-sm btn-danger table-menu" onclick="deletes('<?php echo $row->master_barang_id ; ?>', '<?php echo $row->master_barang_name; ?>')" data-title="Hapus"><i class="fas fa-trash"></i></button>
                            <button data-id="<?php echo $row->master_barang_id; ?>" data-code="<?php echo $row->master_barang_code; ?>" data-name="<?php echo $row->master_barang_name; ?>" data-category="<?php echo $row->master_barang_category_id; ?>" data-unit="<?php echo $row->master_barang_unit_id; ?>" data-modalitem="<?php echo $row->master_barang_harga_modal; ?>" data-jual="<?php echo $row->master_barang_harga_jual; ?>" type="button" class="btn btn-sm btn-primary table-menu" data-toggle="modal" data-target=".bd-example-modal-lgs"><i class="fas fa-edit"></i></button>
                            <a href="<?php echo base_url();?>Masterdata/masterbarangdetail?id=<?php echo $row->master_barang_id; ?>">
                            <button class="btn btn-sm btn-warning table-menu" data-title="Hapus"><i class="fas fa-warehouse"></i></button>
                            </a>
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
      $(document).ready(function() {
      $('#add').click(function(e){
        e.preventDefault();
        var codeitem = $("#codeitem-add").val();
        var nameitem = $("#nameitem-add").val();
        var categoryitem = $("#categoryitem-add").val();
        var unititem = $("#unititem-add").val();
        var modalitem = $("#modalitem-add").val();
        var jualitem = $("#jualitem-add").val();
        var actiontype = 'add';
  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Masterdata/processactionbarang",
            dataType: "json",
            data: {codeitem:codeitem, nameitem:nameitem, categoryitem:categoryitem, unititem:unititem, modalitem:modalitem, jualitem:jualitem, actiontype:actiontype},
            success : function(data){
                if (data.code == "200"){
                    location.reload();
                    Swal.fire('Saved!', '', 'success'); 
                } else {
                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                    })
                }
            }
        });
      });
  });
</script>


<script type="text/javascript">
      $(document).ready(function() {
      $('#changestyle').click(function(e){
        e.preventDefault();
        var passwordmodal = $("#passwordmodal").val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Masterdata/checkpassmodal",
            dataType: "json",
            data: {passwordmodal:passwordmodal},
            success : function(data){
                if (data.code == "200"){
                    document.getElementById("hargamodalth").style.display = "table-cell";
                    $(".hargamodaltd").css("display", "block");
                    $('#modal-lg').modal('hide');
                    //document.getElementsByClassName("hargamodaltd").style.display = "block";
                } else {
                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                    })
                }
            }
        });
      });
  });
</script>



<script type="text/javascript">
      $(document).ready(function() {
      $('#edit').click(function(e){
        e.preventDefault();
        var id = $("#id-edit").val();
        var codebu = $("#codebu-edit").val();
        var codeitem = $("#codeitem-edit").val();
        var nameitem = $("#nameitem-edit").val();
        var categoryitem = $("#categoryitem-edit").val();
        var unititem = $("#unititem-edit").val();
        var modalitem = $("#modalitem-edit").val();
        var jualitem = $("#jualitem-edit").val();
        var actiontype = 'edit';
  
  
          Swal.fire({
            title: 'Apakah Anda Ingin Menyimpan Perubahan Data?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                 $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>Masterdata/processactionbarang",
                    dataType: "json",
                    data: {id:id, codeitem:codeitem, nameitem:nameitem, categoryitem:categoryitem, unititem:unititem, modalitem:modalitem, jualitem:jualitem, actiontype:actiontype},
                    success : function(data){
                        if (data.code == "200"){
                                  location.reload();
                                  Swal.fire('Saved!', '', 'success'); 
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                              })
                        }
                    }
                });
            
            } else if (result.isDenied) {
              Swal.fire('Perubahan Tidak Di Simpan', '', 'info')
            }
          })
       
      });
  });
    </script>

    <script type="text/javascript">
    function deletes(id, name){
      Swal.fire({
        title: 'Konfirmasi?',
        text: "Apakah Anda Yakin Menghapus '"+name+"' ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace('<?php echo base_url();?>Masterdata/deletemasterbarang?id='+id);
          Swal.fire(
            'Hapus!',
            'Sukses Hapus Data.',
            'Sukses'
          )
        }
      })
    }
</script>


<script type="text/javascript">
          $('#exampleModaledit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id   = button.data('id')
        var code   = button.data('code')
        var name  = button.data('name')
        var category  = button.data('category')
        var unit  = button.data('unit')
        var modalitem  = button.data('modalitem')
        var jual  = button.data('jual')

        var modal = $(this)
        modal.find('.modal-title').text('Edit ' + name)
        modal.find('#id-edit').val(id)
        modal.find('#codeitem-edit').val(code)
        modal.find('#nameitem-edit').val(name)
        modal.find('#categoryitem-edit').val(category)
        modal.find('#unititem-edit').val(unit)
        modal.find('#modalitem-edit').val(modalitem)
        modal.find('#jualitem-edit').val(jual)
      })
    </script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
