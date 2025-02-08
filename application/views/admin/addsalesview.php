<?php 

define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('adminheaderlink');
date_default_timezone_set('Asia/Jakarta');
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
.text-right{
    text-align: right;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Penjualan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
              <li class="breadcrumb-item active">Input Penjualan</li>
          </ol>
      </div>
  </div>
</div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Form Penjualan</h2></h3>
            <div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col-md-1 text-right"><label class="col-form-label">No Faktur:</label></div>
                <div class="col-md-3">
                    <?php 
                    if($datas['get_lastsales'] == null){
                        $salescode_code  = 'S-02'.$_SESSION['user_id'].'/1';
                    }else{
                        $salescode_code  = $datas['get_lastsales'][0]->sales_faktur_id;
                        $salescode_code = substr($salescode_code, strpos($salescode_code, "/") + 1);
                        $salescode_code = $salescode_code + 1;
                        $salescode_code  = 'S-02'.$_SESSION['user_id'].'/'.$salescode_code;
                    }
                    ?>
                    <input type="text" class="form-control" id="fakturcode" value="<?php echo $salescode_code ?>" readonly="">
                </div>

                <div class="col-md-2 text-right"><label class="col-form-label">Pelanggan:</label></div>
                <div class="col-md-2">
                    <select class="form-control select2" id="customersales" >
                        <option></option>
                        <?php foreach ($datas['get_mastercustomer'] as $row) { ?>
                            <option value="<?php echo $row->customer_id  ?>"><?php echo $row->customer_name;  ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-2 text-right"><label class="col-form-label">Tanggal:</label></div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="salesdate"  value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>

            <div class="row" style="margin-top: 5px;">
                <div class="col-md-1 text-right"><label class="col-form-label">No PO:</label></div>
                <div class="col-md-3">
                    <input type="text"  class="form-control" id="ponumber">
                </div>

                <div class="col-md-2 text-right"><label class="col-form-label">Nama Perusahaan:</label></div>
                <div class="col-md-2">
                    <select class="form-control" id="companypurchase" onchange="set_gudang()">
                        <option></option>
                        <?php foreach ($datas['get_mastercompany'] as $row) { ?>
                            <option value="<?php echo $row->mastercompany_id  ?>"><?php echo $row->mastercompany_name  ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-2 text-right"><label class="col-form-label">Jatuh Tempo:</label></div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="salesduedate"  value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>

            <div class="row" style="margin-top: 5px;">
                <div class="col-md-1 text-right"><label class="col-form-label">Nama Sales</label></div>
                <div class="col-md-3">
                    <select class="form-control select2" id="salesname">
                        <option></option>
                        <?php foreach ($datas['get_mastersales'] as $row) { ?>
                            <option value="<?php echo $row->sales_id  ?>"><?php echo $row->sales_name  ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-2 text-right"><label class="col-form-label">Status Payment:</label></div>
                <div class="col-md-2">
                    <select class="form-control" id="paymentstatus">
                        <option></option>
                        <option value="lunas">Lunas</option>
                        <option value="hutang">Hutang</option>
                    </select>
                </div>

                <div class="col-md-2 text-right"></div>
                <div class="col-md-2" style="padding-left:25px;">
                    <input type="checkbox" class="form-check-input" id="show_tax_note" checked>
                    <label class="form-check-label" for="show_tax_desc">Tampilkan Note PPN</label>
                </div>

            </div>

        </div>

        <!-- /.card-body -->
    </div>
</section>


<section class="content">
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <label class="col-form-label">Gudang</label>
                    <select class="form-control" id="warehouse" onchange="checkperusahaan()">
                        <option></option>
                        <?php foreach ($datas['get_gudang'] as $row) { ?>
                            <option value="<?php echo $row->master_gudang_id ?>"><?php echo $row->master_gudang_name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="col-form-label">Nama Barang</label>
                    <select class="form-control select2" id="purcasedetailitem" style="width: 100%;" onchange="setprice()">
                        <option></option>
                        <?php foreach ($datas['get_masterbarang'] as $row) { ?>
                            <option value="<?php echo $row->master_barang_id ?>"><?php echo $row->master_barang_name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="col-form-label">Qty</label>
                    <input type="number" step="any" class="form-control" id="qtycartdetailsales" required="" >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="col-form-label">Harga Jual Terakhir</label>
                    <input type="text" step="any" class="form-control" id="sellprice" required="">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="col-form-label">Discount</label>
                    <input type="number" step="any" class="form-control" id="discountcartdetailsales" value="0">
                </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                <label class="col-form-label">Keterangan</label>
                <textarea class="form-control" id="salesdesc"></textarea> 
            </div>
        </div>
        <div class="col-md-2">
           <div class="form-group">
            <button id="addsalescart" class="btn btn-primary" style="margin-top: 38px;"><i class="fas fa-plus"></i></button>
        </div>
    </div>
</div>
</div>
<div class="card-body">
 <table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
      <tr>
          <th style="width: 25%;">Item</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Diskon</th>
          <th>Sub total</th>
          <th>Keterangan</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody id="data-temp-trx">

  </tbody>
</table>
</div>

<div class="card-footer">
    <div class="row form-space">    
        <div class="col-lg-6">
            <div class="form-group">
                <div class="col-sm-8">

                </div>
            </div>
        </div>

        <div class="col-lg-6 text-right">
            <div class="form-group row">
                <label for="footer_sub_total" class="col-sm-7 col-form-label text-right:">Total:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="total_sales_cart"  readonly="" >
                </div>
            </div>
            <div class="form-group row" style="margin-top:-12px;">
                <label for="footer_total_discount" class="col-sm-7 col-form-label text-right:">Discount :</label>
                <div class="col-sm-5">
                    <input type="number" step="any" class="form-control" id="discountsales" oninput="set_grandtotal_sales()">
                </div>
            </div>
            <div class="form-group row" style="margin-top:-12px;">
                <label for="footer_dpp" class="col-sm-7 col-form-label text-right:">PPN :</label>
                <div class="col-sm-5">
                    <select class="form-control" id="ppn" onchange="ppn_cal(this)">
                        <option value="0">0%</option>
                        <option value="11">11%</option>
                        <option value="12">12%</option>
                    </select>
                    <input type="hidden" step="any" class="form-control" id="ppn_nominal">
                </div>
            </div>
            <div class="form-group row" style="margin-top:-12px;">
                <label for="footer_total_ppn" class="col-sm-7 col-form-label text-right:">Grand Total :</label>
                <div class="col-sm-5">
                    <input type="text"  class="form-control" id="grandtotalsales" readonly="">
                </div>
            </div>
            <div class="col-sm-12">
                <button id="btnadd" class="btn btn-success button-header-custom-save"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>

    </div>
</div>

</div>


</section>

</div>





<?php 
require DOC_ROOT_PATH . $this->config->item('adminfooterlink');
?>

<script>

    table_data_temp();
    get_total_cart();

    function setprice(){
        var purcasedetailitem = document.getElementById("purcasedetailitem").value;
        var companypurchase = document.getElementById("companypurchase").value;
        var customersales = document.getElementById("customersales").value;
        if(customersales == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Silahkan Isi Nama Pelanggan Terlebih Dahulu',
            })
        }
        if(companypurchase == ""){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Silahkan Pilih Nama Perusahaan Terlebih Dahulu',
            })
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Transaction/get_price_by_id?id="+purcasedetailitem+"&cust="+customersales,
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                    document.getElementById("sellprice").value = data.master_barang_harga_jual;
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

    function clear_input()
    {
        $('#purcasedetailitem').val(null).trigger('change');
        document.getElementById("qtycartdetailsales").value = 0;
        document.getElementById("sellprice").value = 0;
    }


    $(document).ready(function() {
        $('#btnadd').click(function(e){
            e.preventDefault();
            var fakturcode = $("#fakturcode").val();
            var customersales = $("#customersales").val();
            var salesdate = $("#salesdate").val();
            var salesduedate = $("#salesduedate").val();
            var total_sales_cart = $("#total_sales_cart").val();
            var discountsales = $("#discountsales").val();
            var ppnsales = $("#ppn_nominal").val();
            var grandtotalsales = $("#grandtotalsales").val();
            var paymentstatus = $("#paymentstatus").val();
            var salesname = $( "#salesname option:selected" ).text();
            var warehouse = $("#warehouse").val();
            var ponumber = $("#ponumber").val();
            var companypurchase = $("#companypurchase").val();

            if (document.getElementById('show_tax_note').checked) {
                var show_tax_note = 'Y';
            }
            else {
                var show_tax_note = 'N';
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Transaction/processaddheadersales",
                dataType: "json",
                data: {fakturcode:fakturcode, customersales:customersales, salesdate:salesdate, salesduedate:salesduedate, total_sales_cart:total_sales_cart, discountsales:discountsales, grandtotalsales:grandtotalsales, paymentstatus:paymentstatus, salesname:salesname, warehouse:warehouse, ponumber:ponumber, companypurchase:companypurchase, ppn:ppnsales, show_tax_note:show_tax_note},
                success : function(data){
                    if (data.code == "200"){
                        window.location.replace('<?php echo base_url();?>Transaction/sales');
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

    $(document).ready(function() {
      $('#addsalescart').click(function(e){
        e.preventDefault();
        var purcasedetailitem = $("#purcasedetailitem").val();
        var qtycartdetailsales = $("#qtycartdetailsales").val();
        var discountcartdetailsales = $("#discountcartdetailsales").val();
        var warehouse = $("#warehouse").val();
        var fakturcode = $("#fakturcode").val();
        var salesdesc = $("#salesdesc").val();
        var sellprice = $("#sellprice").val();
        var customersales = $("#customersales").val();
        var companypurchase = $("#companypurchase").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Transaction/processaddsalesdetailcart",
            dataType: "json",
            data: {purcasedetailitem:purcasedetailitem, qtycartdetailsales:qtycartdetailsales, discountcartdetailsales:discountcartdetailsales, fakturcode:fakturcode, warehouse:warehouse, salesdesc:salesdesc, sellprice:sellprice, customersales:customersales, companypurchase:companypurchase},
            success : function(data){
                if (data.code == "200"){
                    table_data_temp();
                    get_total_cart();
                    clear_input();
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



     function deletes(id){
        Swal.fire({
            title: 'Konfirmasi?',
            text: "Apakah Anda Yakin Menghapus Pembelian?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>/Transaction/deletecartsales",
                    dataType: "json",
                    data: {id:id},
                    success : function(data){
                        if (data.code == "200"){
                            table_data_temp();
                            get_total_cart();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Success Delete',
                            }) 
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.msg,
                            })
                        }
                    }
                });
            }
        })
    }

    function set_grandtotal_sales(){
        var total_sales_cart = document.getElementById("total_sales_cart").value;
        var discountsales = document.getElementById("discountsales").value;
        var calculation = total_sales_cart - discountsales;
        document.getElementById("grandtotalsales").value = calculation;
        document.getElementById("ppn").value = 0;
    }

    function ppn_cal(selectObject){
        var total_sales_cart = document.getElementById("total_sales_cart").value;
        var discountsales = document.getElementById("discountsales").value;
        var calculation = total_sales_cart - discountsales;
        var ppn_cal = (selectObject.value/100 * calculation);
        var total_cal = calculation + ppn_cal;
        document.getElementById("grandtotalsales").value = total_cal;
        document.getElementById("ppn_nominal").value = ppn_cal;
    }


    function get_total_cart() {
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
    }




    function table_data_temp() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Transaction/get_salescart_table",
            dataType: "json",
            data: {},
            success : function(data){  
                let text = "";
                for (let i = 0; i < data.length; i++) {
                    text += '<tr><td>'+data[i].master_barang_name+'</td><td>'+new Intl.NumberFormat().format(data[i].sales_detail_cart_price)+'</td><td>'+data[i].sales_detail_cart_satuan+' '+data[i].unit_name+'</td><td>'+new Intl.NumberFormat().format(data[i].sales_detail_cart_discount)+'</td><td>'+new Intl.NumberFormat().format(data[i].sales_detail_cart_total)+'</td><td>'+data[i].sales_description_cart+'</td><td><button class="btn btn-sm btn-danger table-menu" onclick="deletes('+data[i].sales_detail_cart_id+')" data-title="Hapus"><i class="fas fa-trash"></i></button></td></tr>';
                    document.getElementById("data-temp-trx").innerHTML = text;
                }
            }
        });
    }

    function set_gudang(){
        var purcasedetailitem = document.getElementById("companypurchase").value;
        if(purcasedetailitem == 1){
            document.getElementById("warehouse").value = 2;
        }else{
            document.getElementById("warehouse").value = 1;
        }
    }

    var fakturcode = $("#fakturcode").val();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>/Transaction/get_last_post_cart_sales",
        dataType: "json",
        data: {fakturcode:fakturcode},
        success : function(data){
            if (data.code == "200"){
                $("#customersales").select2('val',data.sales_detail_cart_customer);
                document.getElementById("companypurchase").value = data.sales_detail_cart_company;
                document.getElementById("customersales").readOnly = true;
                $('#companypurchase').attr("disabled", true);
            }
        }
    });


    var fakturcode = $("#fakturcode").val();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>/Transaction/get_gudang_input",
        dataType: "json",
        data: {fakturcode:fakturcode},
        success : function(data){
            if (data.code == "200"){
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

    </script>
