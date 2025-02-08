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
            <h1>Master Perusahaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Master Perusahaan</li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Master Perusahaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label  class="col-form-label">Nama Perusahaan:</label>
                         <input type="text" class="form-control" id="namecompany-add" required="">
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Alamat/No Telepon:</label>
                        <textarea class="form-control" id="phonecompany-add" required=""></textarea>
                      </div>
                      <div class="form-group">
                        <label  class="col-form-label">Email:</label>
                         <input type="text" class="form-control" id="emailcompany-add" required="">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Master Perusahaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
       </div>
        <div class="modal-body">
                    <form>  
                    <div class="form-group">
                        <label  class="col-form-label">Nama Perusahaan:</label>
                        <input type="hidden" class="form-control" id="id-edit">
                         <input type="text" class="form-control" id="namecompany-edit">
                      </div>     
                      <div class="form-group">
                        <label  class="col-form-label">Alamat/No Telepon:</label>
                        <textarea class="form-control" id="phonecompany-edit" required=""></textarea>
                      </div>
                       <div class="form-group">
                        <label  class="col-form-label">Email:</label>
                         <input type="text" class="form-control" id="emailcompany-edit" required="">
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
                          <th>Nama Perusahaan</th>
                          <th>Telephone</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_mastercompany as $row) { ?>
                      <tr>
                          <td><?php echo $row->mastercompany_name; ?></td>
                          <td><?php echo $row->mastercompany_phone; ?></td>
                          <td><?php echo $row->mastercompany_email; ?></td>
                        
                          <td>
                            <button class="btn btn-sm btn-danger table-menu" onclick="deletes('<?php echo $row->mastercompany_id ; ?>', '<?php echo $row->mastercompany_name; ?>')" data-title="Hapus"><i class="fas fa-trash"></i></button>
                            <button data-id="<?php echo $row->mastercompany_id; ?>" data-name="<?php echo $row->mastercompany_name; ?>" data-phone="<?php echo $row->mastercompany_phone; ?>" data-email="<?php echo $row->mastercompany_email; ?>"  type="button" class="btn btn-sm btn-primary table-menu" data-toggle="modal" data-target=".bd-example-modal-lgs"><i class="fas fa-edit"></i></button>
                            <a href="<?php echo base_url();?>Masterdata/masterbankaccount?id=<?php echo $row->mastercompany_id; ?>">
                            <button class="btn btn-sm btn-success table-menu"><i class="fab fa-cc-visa"></i></button>
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
        var namecompany = $("#namecompany-add").val();
        var phonecompany = $("#phonecompany-add").val();
        var emailcompany = $("#emailcompany-add").val();
        var actiontype = 'add';
  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Masterdata/processactioncompany",
            dataType: "json",
            data: {namecompany:namecompany, phonecompany:phonecompany, emailcompany:emailcompany, actiontype:actiontype},
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
        var id = $("#id-edit").val();
        var namecompany = $("#namecompany-edit").val();
        var phonecompany = $("#phonecompany-edit").val();
        var emailcompany = $("#emailcompany-edit").val();
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
                    url: "<?php echo base_url(); ?>Masterdata/processactioncompany",
                    dataType: "json",
                    data: {id:id, namecompany:namecompany, phonecompany:phonecompany, emailcompany:emailcompany, actiontype:actiontype},
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
          window.location.replace('<?php echo base_url();?>Masterdata/deletecompany?id='+id);
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
        var name   = button.data('name')
        var phone  = button.data('phone')
        var email  = button.data('email')

        var modal = $(this)
        modal.find('.modal-title').text('Edit ' + name)
        modal.find('#id-edit').val(id)
        modal.find('#namecompany-edit').val(name)
        modal.find('#phonecompany-edit').val(phone)
        modal.find('#emailcompany-edit').val(email)
      })
    </script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
