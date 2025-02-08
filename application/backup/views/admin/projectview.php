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
            <h1>Proyek</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Proyek</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  

    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <a href="<?php echo base_url();?>Project/Projectadd"><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Input Proyek</button></a>
          </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>No Proyek</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_projectheader as $row) { ?>
                      <tr>
                          <td><?php echo $row->project_header_number; ?></td>
                          <td>
                                <a class="btn btn-warning btn-sm" href="<?php echo base_url();?>Project/print?id=<?php echo $row->project_header_number  ?>">
                              <i class="fas fa-print">
                              </i>
                              Print
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

<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
