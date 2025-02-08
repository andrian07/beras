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
            <h1>Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Penjualan</li>
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
              <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Tanggal Dari:</label>
                         <input type="date" class="form-control" id="datefrom">
                  </div>
              </div>
               <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Tanggal Sampai:</label>
                         <input type="date" class="form-control" id="dateend">
                  </div>
              </div>
        
              
               <div class="col-md-3">
                 <div class="form-group">
                        <label class="col-form-label">Pelanggan <p style="display: inline; font-size: 11px; color: red;">*kosongkan untuk cari semua data</p></label>

                        <select id="customersales" class="form-control select2" style="width: 100%;">
                            <option></option>
                            <?php foreach($data['get_mastercustomer'] as $row){?>
                                <option value="<?php echo $row->customer_id; ?>"><?php echo $row->customer_name; ?></option>
                            <?php } ?>
                        </select>
                  </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                        <label class="col-form-label">Sales <p style="display: inline; font-size: 11px; color: red;">*kosongkan untuk cari semua data</p></label>

                        <select id="salesid" class="form-control select2" style="width: 100%;">
                            <option></option>
                            <?php foreach($data['get_mastersales'] as $row){?>
                                <option value="<?php echo $row->sales_id; ?>"><?php echo $row->sales_name; ?></option>
                            <?php } ?>
                        </select>
                  </div>
              </div>
        
         <div class="col-md-2">
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
                              <label  class="col-form-label">Total Invoice:</label>
                               <input type="text" class="form-control" id="total-payment" readonly="">
                          </div>
                          <div class="form-group">
                              <label  class="col-form-label">Potongan Retur:</label>
                               <input type="number" class="form-control" id="pot-retur" readonly="" value="0">
                          </div> 
                          <div class="form-group">
                              <label  class="col-form-label">Total Pembayaran:</label>
                               <input type="text" class="form-control" id="total-pemby" readonly="">
                          </div>
                          <div class="form-group">
                              <label  class="col-form-label">Di Bayarkan:</label>
                               <input type="number" class="form-control" id="total-payment-pay" oninput="calculationsisapay()">
                          </div>
                           <div class="form-group">
                              <label  class="col-form-label">Sisa Pembayran:</label>
                               <input type="number" class="form-control" id="sisa-payment" readonly="">
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

  
      <div class="modal fade bd-example-modal-lgsi" id="exampleModalprint" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Jenis Print</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
             </div>
              <div class="modal-body">
                          <form>  
                          
                          <div class="form-group">
                              <label  class="col-form-label">Print:</label>
                              <input type="hidden" class="form-control" id="invoice-print" readonly="">
                               <select class="form-control" id="printtype">
                                  <option value="1">Invoice</option>
                                  <option value="4">Invoice Baru</option>
                                  <option value="2">Surat Jalan</option>
                                  <option value="3">Kwitansi</option>
                                </select>
                          </div>
                         
                          </form>
                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success" onclick="printse()">Print</button>
                        </div>
          </div>
        </div>
      </div>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <a href="<?php echo base_url();?>Transaction/addsalesview"><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Input Penjualan</button></a>
          </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>No Faktur</th>
                          <th>Pelanggan</th>
                          <th>Tanggal Penjualan</th>
                          <th>Jatuh Tempo</th>
                          <th>Diskon</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data['get_salesheader'] as $row) { ?>
                      <tr>
                          <td><?php echo $row->sales_faktur_id; ?></td>
                          <td><?php echo $row->customer_name; ?></td>
                          <td><?php $date = date_create($row->sales_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php $date = date_create($row->sales_due_date); echo date_format($date,"d-M-Y"); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_discount); ?></td>
                          <td><?php echo 'Rp. '.number_format($row->sales_total); ?></td>
                          <td>
                            <?php if($row->sales_status == 'lunas'){?>
                            <span class="badge badge-success">Lunas</span>
                          <?php }else{ ?>
                            <span class="badge badge-danger"  data-id="<?php echo $row->sales_header_id ; ?>" data-faktur="<?php echo $row->sales_faktur_id; ?>" data-total="<?php echo $row->sales_total;?>" data-sisa="<?php echo $row->sales_sisa_pembayaran;?>" data-retur="<?php echo $row->retur_sales_total;?>" data-toggle="modal" data-target=".bd-example-modal-lgs">Belum Lunas</span>
                          <?php } ?>
                          </td>
                          <td>
                              <a class="btn btn-info btn-sm" href="<?php echo base_url();?>Transaction/detailsales?id=<?php echo $row->sales_faktur_id  ?>">
                              <i class="fas fa-eye">
                              </i>
                              Detail
                              </a>
                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-faktur="<?php echo $row->sales_faktur_id;?>" data-target=".bd-example-modal-lgsi">
                              <i class="fas fa-print">
                              </i>
                              Print
                              </a>
                              <?php if($row->sales_total == 0){?>
                              <a class="btn btn-danger btn-sm" onclick="deletes('<?php echo $row->sales_faktur_id ; ?>', '<?php echo $row->customer_name; ?>')">
                              <i class="fas fa-trash">
                              </i>
                              Hapus
                              </a>
                            <?php } ?>
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
      $('#payment').click(function(e){
        e.preventDefault();
        var invoicepayment = $("#invoice-payment").val();
        var totalpayment = $("#total-payment").val();
        var totalpaymentpay = $("#total-payment-pay").val();
        var sisapayment = $("#sisa-payment").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Transaction/updatepaymentsales",
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
      var customersales = $("#customersales").val();
      var salesid = $("#salesid option:selected").text();
      window.location.replace('<?php echo base_url();?>Transaction/sales?datefrom='+datefrom+'&dateend='+dateend+'&customersales='+customersales+'&salesid='+salesid);    
    }
</script>

<script type="text/javascript">
    function printse(){
      var printtype = $("#printtype").val();
      var invoice = $("#invoice-print").val();
      var url = '<?php echo base_url();?>Transaction/printnotapenjualan?id='+invoice+'&printtype='+printtype
      window.open(url, '_blank').focus();
  
    }
</script>

<script type="text/javascript">
    function calculationsisapay() {
      var total = $("#total-pemby").val();
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
        var retur = button.data('retur')

        var modal = $(this)
        modal.find('.modal-title').text('Pelunasan Pembayaran  ' + invoice)
        modal.find('#id-payment').val(id)
        modal.find('#invoice-payment').val(invoice)
        modal.find('#total-payment').val(sisa)
        modal.find('#sisa-payment').val(0)
        modal.find('#pot-retur').val(retur)
        modal.find('#total-payment-pay').val(sisa-retur)
        modal.find('#total-pemby').val(sisa-retur)

      })
    </script>

    <script type="text/javascript">
          $('#exampleModalprint').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var invoice   = button.data('faktur')

        var modal = $(this)
        modal.find('.modal-title').text('Print  ' + invoice)
        modal.find('#invoice-print').val(invoice)
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
          window.location.replace('<?php echo base_url();?>Transaction/deletesales?id='+id);
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
 
