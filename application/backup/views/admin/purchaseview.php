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
            <h1>Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Pembelian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <section class="content">

      <div class="card card-default collapsed-card">
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
                        <label class="col-form-label">Tanggal Dari:</label>
                         <input type="date" class="form-control" id="datefrom">
                  </div>
              </div>
               <div class="col-md-3">
                  <div class="form-group">
                        <label class="col-form-label">Tanggal Sampai:</label>
                         <input type="date" class="form-control" id="dateend">
                  </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                        <label class="col-form-label">Suplier <p style="display: inline; font-size: 11px; color: red;">*kosongkan suplier untuk cari semua data</p></label>
                         <input type="text"  class="form-control" id="suplierpurchase">
                  </div>
              </div>
       
              <div class="col-md-3">
                 <div class="form-group">
                        <button id="btnsearch" onclick="btnsearch()" class="btn btn-warning" style="margin-top: 37px;"><i class="fas fa-search"></i> Cari</button>
                  </div>
                  
              </div>
       
            </div>
          </div>

          <!-- /.card-body -->
         
        </div>
    </section>
    <div class="modal fade bd-example-modal-lgs" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pelunasan Pembayaran</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
             </div>
              <div class="modal-body">
                          <form>  
                          <div class="form-group">
                              <label  class="col-form-label">No Invoice:</label>
                              <input type="hidden" class="form-control" id="id-payment">
                               <input type="text" class="form-control" id="invoice-payment" readonly="">
                          </div> 
                          <div class="form-group">
                              <label  class="col-form-label">Total Pembayaran:</label>
                               <input type="text" class="form-control" id="total-payment" readonly="">
                          </div>
                           <div class="form-group">
                              <label  class="col-form-label">Sisa Pembayran:</label>
                               <input type="number" class="form-control" id="sisa-payment" readonly="">
                          </div>  
                          <div class="form-group">
                              <label  class="col-form-label">Di Bayarkan:</label>
                               <input type="number" class="form-control" id="total-payment-pay" oninput="calculationsisapay()">
                          </div>
                         
                          </form>
                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success" id="payment">Bayar</button>
                        </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo base_url(); ?>Transaction/uploadbukti" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             <div class="form-group">
                              <label  class="col-form-label">Upload File:</label>
                               <input type="hidden" name="purchaseheaderid" class="form-control" id="id-faktur-upload">
                               <input type="file" name="berkastp" class="form-control">
                          </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          </div>
        </div>
      </div>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <a href="<?php echo base_url();?>Transaction/addpurchaseview"><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Input Pembelian</button></a>
          </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>No Faktur</th>
                          <th>Suplier</th>
                          <th>Tanggal Pembelian</th>
                          <th>Jatuh Tempo</th>
                          <th>Diskon</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_purchaseheader as $row) { ?>
                      <tr>
                          <td><?php echo $row->purchase_faktur_id; ?></td>
                          <td><?php echo $row->suplier_name; ?></td>
                          <td><?php $date = date_create($row->purchase_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php $date = date_create($row->purchase_due_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->purchase_discount); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->purchase_total); ?></td>
                          <td>
                            <?php if($row->purchase_status == 'lunas'){?>
                            <span class="badge badge-success">Lunas</span>
                          <?php }else{ ?>
                            <span class="badge badge-danger"  data-id="<?php echo $row->purchase_header_id; ?>" data-faktur="<?php echo $row->purchase_faktur_id; ?>" data-total="<?php echo $row->purchase_total;?>" data-sisa="<?php echo $row->purchase_sisa_pembayaran;?>" data-toggle="modal" data-target=".bd-example-modal-lgs">Belum Lunas</span>
                          <?php } ?>
                          </td>
                          <td>
                              <a class="btn btn-info btn-sm" href="<?php echo base_url();?>Transaction/detailpurchase?id=<?php echo $row->purchase_faktur_id ?>">
                              <i class="fas fa-eye">
                              </i>
                              Detail
                              </a>
                              <?php if($row->purchase_total == 0){?>
                              <a class="btn btn-danger btn-sm" onclick="deletes('<?php echo $row->purchase_faktur_id ; ?>', '<?php echo $row->suplier_name; ?>')">
                              <i class="fas fa-trash">
                              </i>
                              Hapus
                              </a>
                            <?php } ?>
                              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" data-ids="<?php echo $row->purchase_header_id;?>" data-fakturcode="<?php echo $row->purchase_faktur_id;?>">
                              <i class="fas fa-upload">
                              </i>
                              Upload

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
      $('#btnsearch').click(function(e){
        e.preventDefault();
        var datefrom = $("#datefrom").val();
        var dateend = $("#dateend").val();
        var suplierpurchase = $("#suplierpurchase").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Transaction/purchase",
            dataType: "json",
            data: {datefrom:datefrom, dateend:dateend, suplierpurchase:suplierpurchase},
            success : function(data){
                if (data.code == "200"){
                    location.reload();
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
      $('#payment').click(function(e){
        e.preventDefault();
        var invoicepayment = $("#invoice-payment").val();
        var totalpayment = $("#total-payment").val();
        var totalpaymentpay = $("#total-payment-pay").val();
        var sisapayment = $("#sisa-payment").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Transaction/updatepayment",
            dataType: "json",
            data: {invoicepayment:invoicepayment, totalpayment:totalpayment, totalpaymentpay:totalpaymentpay, sisapayment:sisapayment},
            success : function(data){
                if (data.code == "200"){
                    location.reload();
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
    function btnsearch(){
      var datefrom = $("#datefrom").val();
      var dateend = $("#dateend").val();
      var suplierpurchase = $("#suplierpurchase").val();
      window.location.replace('<?php echo base_url();?>Transaction/purchase?datefrom='+datefrom+'&dateend='+dateend+'&suplierpurchase='+suplierpurchase);
      
    }
</script>

<script type="text/javascript">
    function calculationsisapay() {
      var total = $("#total-payment").val();
      var totalpay  = $("#total-payment-pay").val();
      var sisa = total - totalpay;
      document.getElementById("sisa-payment").value = sisa;
    }
</script>

<script type="text/javascript">
          $('#exampleModaledit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var invoice   = button.data('faktur')
        var id   = button.data('id')
        var total  = button.data('total')
        var sisa  = button.data('sisa')

        var modal = $(this)
        modal.find('.modal-title').text('Pelunasan Pembayaran  ' + invoice)
        modal.find('#id-payment').val(id)
        modal.find('#invoice-payment').val(invoice)
        modal.find('#total-payment').val(sisa)
        modal.find('#sisa-payment').val(sisa)
      })
    </script>

    <script type="text/javascript">
          $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var ids   = button.data('ids')
        var fakturcode   = button.data('fakturcode')
        var modal = $(this)
        modal.find('.modal-title').text('Upload  ' + fakturcode)
        modal.find('#id-faktur-upload').val(ids)
      })
    </script>


    <script type="text/javascript">
    function deletes(id, name){
      Swal.fire({
        title: 'Konfirmasi?',
        text: "Apakah Anda Yakin Menghapus Transaksi '"+id+"' ('"+name+"') ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace('<?php echo base_url();?>Transaction/deletepurchase?id='+id);
          Swal.fire(
            'Hapus!',
            'Sukses Hapus Data.',
            'Sukses'
          )
        }
      })
    }
</script>


<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
