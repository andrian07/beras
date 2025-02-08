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
            <h1>Master Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Master Customer</li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Master Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Nama Customer:</label>
                         <input type="text" class="form-control" id="customername-add">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">No Telepon:</label>
                         <input type="number" step="any" class="form-control" id="notelp-add">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">No NPWP:</label>
                        <input type="number" class="form-control" id="nonpwp-add">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="address-add"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Master Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                     </div>
                      <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Nama customer:</label>
                        <input type="hidden" class="form-control" id="customerid-edit">
                         <input type="text" class="form-control" id="customername-edit">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">No Telepon:</label>
                         <input type="number" step="any" class="form-control" id="notelp-edit">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">No NPWP:</label>
                        <input type="number" class="form-control" id="nonpwp-edit">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="address-edit"></textarea>
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
                          <th>Nama Customer</th>
                          <th>Alamat</th>
                          <th>No Telpon</th>
                          <th>NPWP</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_mastercustomer as $row) { ?>
                      <tr>
                          <td><?php echo $row->customer_name; ?></td>
                          <td><?php echo $row->customer_address; ?></td>
                          <td><?php echo $row->customer_phone; ?></td>
                          <td><?php echo $row->customer_npwp; ?></td>
                          <td>
                            <button class="btn btn-sm btn-danger table-menu" onclick="deletes('<?php echo $row->customer_id  ; ?>', '<?php echo $row->customer_name; ?>')" data-title="Hapus"><i class="fas fa-trash"></i></button>
                            <button data-id="<?php echo $row->customer_id; ?>" data-name="<?php echo $row->customer_name; ?>" data-phone="<?php echo $row->customer_phone; ?>" data-address="<?php echo $row->customer_address; ?>" data-npwp="<?php echo $row->customer_npwp; ?>" type="button" class="btn btn-sm btn-primary table-menu" data-toggle="modal" data-target=".bd-example-modal-lgs"><i class="fas fa-edit"></i></button>
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
        var customername = $("#customername-add").val();
        var notelp = $("#notelp-add").val();
        var nonpwp = $("#nonpwp-add").val();
        var address = $("#address-add").val();
        var actiontype = 'add';
  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Masterdata/processaddcustomer",
            dataType: "json",
            data: {customername:customername, notelp:notelp, nonpwp:nonpwp, address:address, actiontype:actiontype},
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
        var id = $("#customerid-edit").val();
        var customername = $("#customername-edit").val();
        var notelp = $("#notelp-edit").val();
        var nonpwp = $("#nonpwp-edit").val();
        var address = $("#address-edit").val();
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
                    url: "<?php echo base_url(); ?>Masterdata/processaddcustomer",
                    dataType: "json",
                    data: {id:id, customername:customername, notelp:notelp, nonpwp:nonpwp, address:address, actiontype:actiontype},
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
          window.location.replace('<?php echo base_url();?>Masterdata/deletemastercustomer?id='+id);
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
        var npwp  = button.data('npwp')
  
        var modal = $(this)
        modal.find('.modal-title').text('Edit ' + name)
        modal.find('#customerid-edit').val(id)
        modal.find('#notelp-edit').val(phone)
        modal.find('#customername-edit').val(name)
        modal.find('#nonpwp-edit').val(npwp)
        modal.find('#address-edit').val(address)
      })
    </script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
