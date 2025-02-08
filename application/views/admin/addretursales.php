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
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Retur Penjualan</h1>
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

      <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Form Retur Penjualan</h2></h3>

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
                        <label class="col-form-label">No Faktur Retur:</label>
                        <?php 
                          if($datas['get_lastretursales'] == null){
                            $retur_sales_code  = 'R-02'.$_SESSION['user_id'].'/1';
                          }else{
                            $retur_sales_code  = $datas['get_lastretursales'][0]->retur_sales_faktur_id;
                            $retur_sales_code = substr($retur_sales_code, strpos($retur_sales_code, "/") + 1);
                            $retur_sales_code = $retur_sales_code + 1;
                            $retur_sales_code  = 'P-02'.$_SESSION['user_id'].'/'.$retur_sales_code;
                          }
                        ?>
                        <input type="text" class="form-control" id="retursalesfakturid"  value="<?php echo $retur_sales_code; ?>" readonly>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">No Faktur Penjualan:</label>
                        <?php 
                          if($datas['get_retur_sales_cart'] == null){
                         ?>
                        <select class="form-control select2 salesfakturid1" id="salesfakturid" onchange="setheaderdata()">
                          <option></option>
                          <?php foreach ($datas['get_salesheader_retur'] as $row) { ?>
                          <option value="<?php echo $row->sales_faktur_id  ?>"><?php echo $row->sales_faktur_id;  ?></option>
                        <?php } ?>
                        </select>
                    <?php }else{ ?>
                        <select class="form-control  salesfakturid1" id="salesfakturid" onchange="setheaderdata()">
                          <option></option>
                          <?php foreach ($datas['get_salesheader_retur'] as $row) { ?>
                          <option value="<?php echo $row->sales_faktur_id  ?>"><?php echo $row->sales_faktur_id;  ?></option>
                        <?php } ?>
                        </select>
                    <?php } ?>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Pelanggan:</label>
                        <select class="form-control" id="customersales" disabled>
                          <option></option>
                          <?php foreach ($datas['get_mastercustomer'] as $row) { ?>
                          <option value="<?php echo $row->customer_id  ?>"><?php echo $row->customer_name;  ?></option>
                        <?php } ?>
                        </select>
                  </div>
              </div>
               <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Nama Perusahaan:</label>
                          <select class="form-control" id="companypurchase" onchange="set_gudang()" disabled>
                          <option></option>
                          <?php foreach ($datas['get_mastercompany'] as $row) { ?>
                          <option value="<?php echo $row->mastercompany_id  ?>"><?php echo $row->mastercompany_name  ?></option>
                        <?php } ?>
                        </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                        <label class="col-form-label">Tanggal:</label>
                         <input type="date" class="form-control" id="salesdate"  value="<?php echo date("Y-m-d"); ?>">
                  </div>
              </div>
        
             <div class="col-md-3">
                  <div class="form-group">
                        <label class="col-form-label">Penagihan:</label>
                        <select class="form-control" id="billingtype" onchange="setbilling()">
                          <option></option>
                          <option value="1">Potong Tagihan</option>
                          <option value="2">Nota Baru</option>
                        </select>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                        <label class="col-form-label">Status Pembayaran (Nota Baru):</label>
                        <select class="form-control" id="billingtypepayment">
                          <option></option>
                          <option value="lunas">Lunas</option>
                          <option value="hutang">Hutang</option>
                        </select>
                  </div>
              </div>
               
                <div class="col-md-5">
                  <div class="form-group">
                        <label class="col-form-label">Total Bayar:</label>
                         <input type="text" class="form-control" id="totalretur" readonly>
                  </div>
              </div>
            </div>
          </div>

          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
           <button id="btnadd" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </div>
    </section>


    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="row">
            
          <div class="col-md-3">
                 <div class="form-group">
                        <label class="col-form-label">Nama Barang</label>
                        <select class="form-control select2" id="purcasedetailitem" style="width: 100%;" onchange="setdetailretur()">
                          <option></option>
                          <?php foreach ($datas['get_masterbarang'] as $row) { ?>
                          <option value="<?php echo $row->master_barang_id ?>"><?php echo $row->master_barang_name ?></option>
                        <?php } ?>
                        </select>
                  </div>
          </div>
          <div class="col-md-2">
                 <div class="form-group">
                        <label class="col-form-label">Gudang</label>
                        <select class="form-control" id="warehouse" disabled>
                          <option></option>
                          <?php foreach ($datas['get_gudang'] as $row) { ?>
                          <option value="<?php echo $row->master_gudang_id ?>"><?php echo $row->master_gudang_name ?></option>
                        <?php } ?>
                        </select>
                  </div>
              </div>
            <div class="col-md-1">
                 <div class="form-group">
                        <label class="col-form-label">Qty Transaksi</label>
                         <input type="number" step="any" class="form-control" id="qtycartdetailsales" required="" readonly>
                  </div>
          </div>
           <div class="col-md-2">
                 <div class="form-group">
                        <label class="col-form-label">Harga Jual</label>
                         <input type="number" step="any" class="form-control" id="cartdetailsalesprice" required="">
                  </div>
          </div>
          <div class="col-md-1">
                 <div class="form-group">
                        <label class="col-form-label">Qty Retur</label>
                         <input type="number" step="any" class="form-control" id="retursalesqty" required="">
                  </div>
          </div>
          <div class="col-md-2">
                 <div class="form-group">
                        <label class="col-form-label">Keterangan</label>
                         <textarea class="form-control" id="returdesc"></textarea> 
                  </div>
          </div>
          <div class="col-md-1">
                 <div class="form-group">
                        <button id="addretursalescart" class="btn btn-primary" style="margin-top: 38px;"><i class="fas fa-plus"></i></button>
                  </div>
          </div>
        </div>
        </div>
        <div class="card-body">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Total Price</th>
                          <th>Gudang</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($datas['get_retur_sales_cart'] as $row) { ?>
                      <tr>
                          <td><?php echo $row->master_barang_name; ?></td>
                          <td><?php echo $row->retur_sales_cart_qty; ?></td>
                          <td><?php echo 'Rp. '.number_format($row->retur_sales_cart_total); ?></td>
                          <td><?php echo $row->master_gudang_name; ?></td>
                          <td><?php echo $row->retur_sales_cart_desc; ?></td>
                          <td>
                             <button class="btn btn-sm btn-danger table-menu" onclick="deletes('<?php echo $row->retur_sales_cart_id    ; ?>', '<?php echo $row->master_barang_name; ?>')" data-title="Hapus"><i class="fas fa-trash"></i></button>
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
      $('#addretursalescart').click(function(e){
        e.preventDefault();
        var retursalesfakturid = $("#retursalesfakturid").val();
        var salesfakturid = $("#salesfakturid").val();
        var retursalesitem = $("#purcasedetailitem").val();
        var retursalesqty = $("#retursalesqty").val();
        var warehouse = $("#warehouse").val();
        var returdesc = $("#returdesc").val();
        var qtycartdetailsales = $("#qtycartdetailsales").val();
        var cartdetailsalesprice = $("#cartdetailsalesprice").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Retur/processaddsalesreturcart",
            dataType: "json",
            data: {retursalesfakturid:retursalesfakturid, salesfakturid:salesfakturid, cartdetailsalesprice:cartdetailsalesprice, retursalesitem:retursalesitem, retursalesqty:retursalesqty, warehouse:warehouse, returdesc:returdesc, qtycartdetailsales:qtycartdetailsales},
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
      $('#btnadd').click(function(e){
        e.preventDefault();
        var retursalesfakturid = $("#retursalesfakturid").val();
        var salesfakturid = $("#salesfakturid").val();
        var customersales = $("#customersales").val();
        var companypurchase = $("#companypurchase").val();
        var returdate = $("#salesdate").val();
        var billingtype = $("#billingtype").val();
        var billingtypepayment = $("#billingtypepayment").val();
        var totalretur = $("#totalretur").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Retur/processaddheaderretursales",
            dataType: "json",
            data: {retursalesfakturid:retursalesfakturid, salesfakturid:salesfakturid, customersales:customersales, companypurchase:companypurchase, returdate:returdate, billingtype:billingtype, billingtypepayment:billingtypepayment, totalretur:totalretur},
            success : function(data){
                if (data.code == "200"){
                    window.location.replace('<?php echo base_url();?>Retur/retursales');
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
    function setheaderdata(){
      var salesfakturid = document.getElementById("salesfakturid").value;
      $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Retur/get_sales_header_data?id="+salesfakturid,
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                     document.getElementById("customersales").value = data.sales_customer_id;
                     document.getElementById("companypurchase").value = data.sales_company_id;
                } else {
                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                    })
                }
            }
        });
    }


    function setbilling() {
        var billingtype = document.getElementById("billingtype").value;
        if(billingtype == 1){
             $('#billingtypepayment').attr("disabled", true);
        }else{
            $('#billingtypepayment').attr("disabled", false);
        }
    }


    function setdetailretur() {
        var purcasedetailitem = document.getElementById("purcasedetailitem").value;
        var salesfakturid = document.getElementById("salesfakturid").value;
      $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Retur/get_detailretur?id="+purcasedetailitem+"&salesfakturid="+salesfakturid,
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                     document.getElementById("warehouse").value = data.sales_detail_warehouse;
                     document.getElementById("qtycartdetailsales").value = data.sales_detail_satuan;
                     document.getElementById("cartdetailsalesprice").value = data.sales_detail_price;
                } else {
                    Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                    })
                }
            }
        });
    }
</script>

<script type="text/javascript">
           $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Retur/get_last_post_cart_sales",
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                     
                     document.getElementById("customersales").value = data.sales_customer_id;
                     document.getElementById("companypurchase").value = data.sales_company_id;
                     $('#salesfakturid').val(data.retur_sales_cart_inv);
                     $('#salesfakturid').attr("disabled", true);
                }
            }
        });
            
        //alert(penyiapan_code);
</script>


<script type="text/javascript">
          var retursalesfakturid = document.getElementById("retursalesfakturid").value;
           $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Retur/get_total_cart_sales",
            dataType: "json",
            data: {retursalesfakturid:retursalesfakturid},
            success : function(data){
                if (data.code == "200"){
                     document.getElementById("totalretur").value = data.total_retur;   
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
    function deletes(id, name){
      Swal.fire({
        title: 'Konfirmasi?',
        text: "Apakah Anda Yakin Menghapus REtur '"+name+"' ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace('<?php echo base_url();?>Retur/deletecartretur?id='+id);
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
 
