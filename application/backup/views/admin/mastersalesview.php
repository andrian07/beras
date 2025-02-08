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
            <h1>Master Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Master Sales</li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Master Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Nama Sales:</label>
                         <input type="text" class="form-control" id="salesname-add">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">No Telepon:</label>
                         <input type="number" step="any" class="form-control" id="salesphone-add">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="salesaddress-add"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Master Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                     </div>
                      <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Nama Sales:</label>
                        <input type="hidden" class="form-control" id="salesid-edit">
                         <input type="text" class="form-control" id="salesname-edit">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">No Telepon:</label>
                         <input type="number" step="any" class="form-control" id="salesphone-edit">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="salesaddress-edit"></textarea>
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
        <div class="card-header">
          <div class="card-tools">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Tambah</button>
          </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Nama Sales</th>
                          <th>No Hp</th>
                          <th>Alamat</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_mastersales as $row) { ?>
                      <tr>
                          <td><?php echo $row->sales_name; ?></td>
                          <td><?php echo $row->sales_phone; ?></td>
                          <td><?php echo $row->sales_address; ?></td>
                          <td>
                            <button class="btn btn-sm btn-danger table-menu" onclick="deletes('<?php echo $row->sales_id  ; ?>', '<?php echo $row->sales_name; ?>')" data-title="Hapus"><i class="fas fa-trash"></i></button>
                            <button data-id="<?php echo $row->sales_id; ?>" data-name="<?php echo $row->sales_name; ?>" data-phone="<?php echo $row->sales_phone; ?>" data-address="<?php echo $row->sales_address; ?>" type="button" class="btn btn-sm btn-primary table-menu" data-toggle="modal" data-target=".bd-example-modal-lgs"><i class="fas fa-edit"></i></button>
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
        var salesname = $("#salesname-add").val();
        var salesphone = $("#salesphone-add").val();
        var salesaddress = $("#salesaddress-add").val();
        var actiontype = 'add';
  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Masterdata/processaddsales",
            dataType: "json",
            data: {salesname:salesname, salesphone:salesphone, salesaddress:salesaddress, actiontype:actiontype},
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
      $('#edit').click(function(e){
        e.preventDefault();
        var id = $("#salesid-edit").val();
        var salesname = $("#salesname-edit").val();
        var salesphone = $("#salesphone-edit").val();
        var salesaddress = $("#salesaddress-edit").val();
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
                    url: "<?php echo base_url(); ?>Masterdata/processaddsales",
                    dataType: "json",
                    data: {id:id, salesname:salesname, salesphone:salesphone, salesaddress:salesaddress, actiontype:actiontype},
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
          window.location.replace('<?php echo base_url();?>Masterdata/deletmastersales?id='+id);
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
        var phone   = button.data('phone')
        var name   = button.data('name')
        var address  = button.data('address')
  
        var modal = $(this)
        modal.find('.modal-title').text('Edit ' + name)
        modal.find('#salesid-edit').val(id)
        modal.find('#salesphone-edit').val(phone)
        modal.find('#salesname-edit').val(name)
        modal.find('#salesaddress-edit').val(address)
      })
    </script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
