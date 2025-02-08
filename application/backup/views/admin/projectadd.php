<?php 
    
    define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
    require DOC_ROOT_PATH . $this->config->item('adminheaderlink');
 ?>

<style type="text/css">
  input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    margin-top: 40px;
}

.note-editable.card-block {
  min-height: 700px;
}

</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Proyek</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Input Proyek</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <section class="content">

      <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Form Proyek</h2></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
         <form action="<?php base_url();?>processaddprojectheader" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                        <label class="col-form-label">No Proyek:</label>
                        <?php 
                         
                          if($get_lastproject == null){
                            $project_code  = date('y/m').'/SM/'.$_SESSION['user_id'].'-1';
                          }else{
                            $project_code  = $get_lastproject[0]->project_header_number;
                            $project_code = substr($project_code, strpos($project_code, "-") + 1);
                            $project_code = $project_code + 1;
                            $project_code  = date('y/m').'/SM/'.$_SESSION['user_id'].'-'.$project_code;
                          }
                          
                        ?>
                         <input type="text" class="form-control" name="projectnumber" value="<?php echo $project_code ?>" readonly="">
                  </div>
              </div>
            </div>
          </div>

          <!-- /.card-body -->
      


         <div class="row">
       <div class="col-md-12">
          
        
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote" name="datasurat">
               
              </textarea>
            </div>

        </div>
    </div>
 

    <div class="card-footer" style="text-align: right;">
           <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </div>

    </section>
    </form>
  </div>

   <script type="text/javascript">
      $(document).ready(function() {
      $('#btnadd').click(function(e){
        e.preventDefault();
        var projectnumber = $("#projectnumber").val();
        var projectto = $("#projectto").val();
        var projectmonth = $("#projectmonth").val();
        var projectfrom = $("#projectfrom").val();
        var projectend = $("#projectend").val();
        var projectaddress = $("#projectaddress").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Project/processaddprojectheader",
            dataType: "json",
            data: {projectnumber:projectnumber, projectto:projectto, projectmonth:projectmonth, projectfrom:projectfrom, projectend:projectend, projectaddress:projectaddress},
            success : function(data){
                if (data.code == "200"){
                    window.location.replace('<?php echo base_url();?>Project');
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
      $('#addprojectcart').click(function(e){
        e.preventDefault();
        var projectnumber = $("#projectnumber").val();
        var ptname = $("#ptname").val();
        var ptprice = $("#ptprice").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Project/processaddprojectcart",
            dataType: "json",
            data: {projectnumber:projectnumber, ptname:ptname, ptprice:ptprice},
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
    function deletes(id, name){
      Swal.fire({
        title: 'Konfirmasi?',
        text: "Apakah Anda Yakin Menghapus Pt '"+name+"' ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace('<?php echo base_url();?>Project/deletecartproject?id='+id);
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
    function set_grandtotal_sales(){
      var total_sales_cart = document.getElementById("total_sales_cart").value;
      var discountsales = document.getElementById("discountsales").value;
      var calculation = total_sales_cart - discountsales;
      document.getElementById("grandtotalsales").value = calculation;
    }
</script>


<script type="text/javascript">
           $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Transaction/get_total_cart_sales",
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                     document.getElementById("total_sales_cart").value = data.total_sales_cart;
                     document.getElementById("grandtotalsales").value = data.total_sales_cart;
                } else {
                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                    })
                }
            }
        });
            
        //alert(penyiapan_code);
</script>

<script type="text/javascript">
           var fakturcode = $("#fakturcode").val();
           $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Transaction/get_gudang_input",
            dataType: "json",
            data: {fakturcode:fakturcode},
            success : function(data){
                if (data.code == "200"){
                    document.getElementById("warehouse").disabled = true;
                    document.getElementById("warehouse").value = data.sales_warehouse_cart_admin;

                } else {
                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                    })
                }
            }
        });
            
        //alert(penyiapan_code);
</script>

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
