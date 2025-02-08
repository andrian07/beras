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
            <h1>Retur Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Retur Penjualan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <a href="<?php echo base_url();?>Retur/addretursales"><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Input Retur Penjualan</button></a>
          </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>No Retur Faktur</th>
                          <th>No Retur Referensi</th>
                          <th>Tanggal Retur</th>
                          <th>Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_header_faktur as $row) { ?>
                      <tr>
                          <td><?php echo $row->retur_sales_faktur_id; ?></td>
                          <td><?php echo $row->retur_sales_faktur_ref; ?></td>
                          <td><?php $date = date_create($row->retur_sales_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->retur_sales_total); ?></td>
                          <td>
                  
                              <a class="btn btn-info btn-sm" href="<?php echo base_url();?>Retur/printinvoiceretursales?id=<?php echo $row->retur_sales_faktur_id  ?>">
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


<?php 
    require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
 ?>
 
