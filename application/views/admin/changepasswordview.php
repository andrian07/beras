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
            <h1>Ganti Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Ganti Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="card">
        <div class="card-body">
            <div class="col-md-4">
                 <div class="form-group">
                    <label  class="col-form-label">Password Lama:</label>
                    <input type="password" class="form-control" id="oldpass" required="">
                  </div>
            </div>
            <div class="col-md-4">
                 <div class="form-group">
                    <label  class="col-form-label">Password Lama:</label>
                    <input type="password" class="form-control" id="newpass" required="">
                  </div>
            </div>
            <div class="col-md-4">
                 <div class="form-group">
                    <label  class="col-form-label">Ulangi Password Lama:</label>
                    <input type="password" class="form-control" id="confnewdpass" required="">
                  </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-info" id="changepass" style="margin-left: 28%;">Ubah</button>
        </div>

      </div>


    </section>

  </div>



    <script type="text/javascript">
      $(document).ready(function() {
      $('#changepass').click(function(e){
        e.preventDefault();
        var oldpass = $("#oldpass").val();
        var newpass = $("#newpass").val();
        var confnewdpass = $("#confnewdpass").val();
  
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Setting/processchangepass",
            dataType: "json",
            data: {oldpass:oldpass, newpass:newpass, confnewdpass:confnewdpass},
            success : function(data){
                if (data.code == "200"){
                window.location.replace('<?php echo base_url();?>Setting/logout');
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



<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
