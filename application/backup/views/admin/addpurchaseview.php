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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Input Pembelian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo base_url();?>Admin/dashboardadmin">Home</a></li>
                  <li class="breadcrumb-item active">Input Pembelian</li>
              </ol>
          </div>
      </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">

  <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Form Pembelian</h2></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
    </div>
</div>
<!-- /.card-header -->

<div class="card-body">

    <div class="row">
        <div class="col-md-1 text-right"><label class="col-form-label">No Faktur:</label></div>
        <div class="col-md-3">
            <?php 
            if($datas['get_lastpurchase'] == null){
                $purchase_code  = 'P-02'.$_SESSION['user_id'].'/1';
            }else{
                $purchase_code  = $datas['get_lastpurchase'][0]->purchase_faktur_id;
                $purchase_code = substr($purchase_code, strpos($purchase_code, "/") + 1);
                $purchase_code = $purchase_code + 1;
                $purchase_code  = 'P-02'.$_SESSION['user_id'].'/'.$purchase_code;
            }
            ?>
            <input type="text" class="form-control" id="fakturcode" value="<?php echo $purchase_code ?>" readonly="">
        </div>
        <div class="col-md-4 text-right"></div>
        <div class="col-md-2 text-right"><label class="col-form-label">Tanggal:</label></div>
        <div class="col-md-2">
            <input type="date" class="form-control" id="purchasedate"  value="<?php echo date("Y-m-d"); ?>">
        </div>
    </div>

    <div class="row" style="margin-top:5px">
        <div class="col-md-1 text-right"><label class="col-form-label">Suplier:</label></div>
        <div class="col-md-3">
            <select id="suplierpurchase" class="form-control select2" style="width: 100%;">
                <option></option>
                <?php foreach($datas['get_mastersuplier'] as $row){?>
                    <option value="<?php echo $row->suplier_id; ?>"><?php echo $row->suplier_name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4 text-right"></div>
        <div class="col-md-2 text-right"><label class="col-form-label">Jatuh Tempo:</label></div>
        <div class="col-md-2">
            <input type="date" class="form-control" id="purchaseduedate"  value="<?php echo date("Y-m-d"); ?>">
        </div>
    </div>

    <div class="row" style="margin-top:5px">
        <div class="col-md-1 text-right"><label class="col-form-label">Perusahaan:</label></div>
        <div class="col-md-3">
            <select class="form-control" id="companypurchase" onchange="set_gudang()">
                <option></option>
                <?php foreach ($datas['get_mastercompany'] as $row) { ?>
                    <option value="<?php echo $row->mastercompany_id  ?>"><?php echo $row->mastercompany_name  ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4 text-right"></div>
        <div class="col-md-2 text-right"><label class="col-form-label">Gudang:</label></div>
        <div class="col-md-2">
            <select class="form-control" id="gudang">
                <option></option>
                <?php foreach($datas['get_gudang'] as $row){?>
                    <option value="<?php echo $row->master_gudang_id; ?>"><?php echo $row->master_gudang_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row" style="margin-top:5px">
        <div class="col-md-1 text-right"><label class="col-form-label">Payment:</label></div>
        <div class="col-md-3">
            <select class="form-control" id="paymentstatus">
                <option></option>
                <option value="lunas">Lunas</option>
                <option value="hutang">Hutang</option>
            </select>
        </div>

        <div class="col-md-8 text-right"></div>
    </div>


</div>

<!-- /.card-body -->
</div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="row">
          <div class="col-md-3">
           <div class="form-group">
            <label class="col-form-label">Nama Barang</label>
            <select id="purcasedetailitem" class="form-control select2" style="width: 100%;" onchange="setprice()">
              <option></option>
              <?php foreach($datas['get_masterbarang'] as $row){?>
                <option value="<?php echo $row->master_barang_id ; ?>"><?php echo $row->master_barang_name; ?></option>
            <?php } ?>
        </select>

        <?php /*  <input type="text" class="form-control" id="purcasedetailitem" required=""> */ ?>
    </div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label class="col-form-label">Qty</label>
    <input type="number" step="any" class="form-control" id="qtycartdetailpurchase" required="">
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label class="col-form-label">Harga Beli Satuan</label>
    <input type="number" step="any" class="form-control" id="buydetailpurchase" required="">
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <label class="col-form-label">Discount</label>
    <input type="number" step="any" class="form-control" id="discountcartdetailpurchase" value="0">
</div>
</div>
<div class="col-md-2">
   <div class="form-group">
    <button id="addpurchasecart" class="btn btn-primary" style="margin-top: 38px;"><i class="fas fa-plus"></i></button>
</div>
</div>
</div>
</div>
<div class="card-body">
 <table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
      <tr>
          <th>No</th>
          <th width="25%;">Item</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Diskon</th>
          <th>Sub total</th>
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
                 <input type="text" class="form-control" id="total_purchase_cart"  readonly="" >
             </div>
         </div>
         <div class="form-group row" style="margin-top:-12px;">
            <label for="footer_total_discount" class="col-sm-7 col-form-label text-right:">Discount :</label>
            <div class="col-sm-5">
                <input type="number" step="any" class="form-control" id="discountpurchase" oninput="set_grandtotal_purchase()" />
            </div>
        </div>
        <div class="form-group row" style="margin-top:-12px;">
            <label for="footer_dpp" class="col-sm-7 col-form-label text-right:">Grand Total :</label>
            <div class="col-sm-5">
                <input type="text"  class="form-control" id="grandtotalpurchase" readonly="">
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
    get_total_cart_purchase();
    get_last_post_cart();

    $(document).ready(function() {
        $('#btnadd').click(function(e){
            e.preventDefault();
            var fakturcode = $("#fakturcode").val();
            var suplierpurchase = $("#suplierpurchase").val();
            var purchasedate = $("#purchasedate").val();
            var purchaseduedate = $("#purchaseduedate").val();
            var total_purchase_cart = $("#total_purchase_cart").val();
            var discountpurchase = $("#discountpurchase").val();
            var grandtotalpurchase = $("#grandtotalpurchase").val();
            var paymentstatus = $("#paymentstatus").val();
            var companypurchase = $("#companypurchase").val();
            var gudang = $("#gudang").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Transaction/processaddheaderpurchase",
                dataType: "json",
                data: {fakturcode:fakturcode, suplierpurchase:suplierpurchase, purchasedate:purchasedate, purchaseduedate:purchaseduedate, total_purchase_cart:total_purchase_cart, discountpurchase:discountpurchase, grandtotalpurchase:grandtotalpurchase, paymentstatus:paymentstatus, gudang:gudang, companypurchase:companypurchase},
                success : function(data){
                    if (data.code == "200"){
                        window.location.replace('<?php echo base_url();?>Transaction/purchase');
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


    function table_data_temp() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Transaction/get_purchasecart_table",
            dataType: "json",
            data: {},
            success : function(data){ 
                let text = "";
                let j = 1;
                for (let i = 0; i < data.length; i++) {
                    text += '<tr><td>'+j+'</td><td>'+data[i].master_barang_name+'</td><td>'+new Intl.NumberFormat().format(data[i].purchase_detail_cart_price)+'</td><td>'+data[i].purchase_detail_cart_satuan+' '+data[i].unit_name+'</td><td>'+new Intl.NumberFormat().format(data[i].purchase_detail_cart_discount)+'</td><td>'+new Intl.NumberFormat().format(data[i].purchase_detail_cart_total)+'</td><td><button class="btn btn-sm btn-danger table-menu" onclick="deletes('+data[i].purchase_detail_cart_id+')" data-title="Hapus"><i class="fas fa-trash"></i></button></td></tr>';
                    document.getElementById("data-temp-trx").innerHTML = text;
                    j++;
                }
            }
        });
    }
    $(document).ready(function() {
        $('#addpurchasecart').click(function(e){
            e.preventDefault();
            var purcasedetailitem = $("#purcasedetailitem").val();
            var qtycartdetailpurchase = $("#qtycartdetailpurchase").val();
            var discountcartdetailpurchase = $("#discountcartdetailpurchase").val();
            var fakturcode = $("#fakturcode").val();
            var buydetailpurchase = $("#buydetailpurchase").val();
            var suplierpurchase = $("#suplierpurchase").val();
            var companypurchase = $("#companypurchase").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Transaction/processaddpurchasedetailcart",
                dataType: "json",
                data: {purcasedetailitem:purcasedetailitem, qtycartdetailpurchase:qtycartdetailpurchase, discountcartdetailpurchase:discountcartdetailpurchase, fakturcode:fakturcode, buydetailpurchase:buydetailpurchase, suplierpurchase:suplierpurchase, companypurchase:companypurchase},
                success : function(data){
                    if (data.code == "200"){
                        table_data_temp();
                        get_total_cart_purchase();
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

    function clear_input()
    {
        $('#purcasedetailitem').val(null).trigger('change');
        document.getElementById("qtycartdetailpurchase").value = null;
        document.getElementById("buydetailpurchase").value = null;
        document.getElementById("discountcartdetailpurchase").value = 0;
    }

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
                    url: "<?php echo base_url(); ?>/Transaction/deletecartpurchase",
                    dataType: "json",
                    data: {id:id},
                    success : function(data){
                        console.log(data);
                        if (data.code == "200"){
                            table_data_temp();
                            get_total_cart_purchase();
                            Swal.fire(
                                'Hapus!',
                                'Sukses Hapus Data.',
                                'Sukses'
                                )
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

    function set_grandtotal_purchase(){
        var total_purchase_cart = document.getElementById("total_purchase_cart").value;
        var discountpurchase = document.getElementById("discountpurchase").value;
        var calculation = total_purchase_cart - discountpurchase;
        document.getElementById("grandtotalpurchase").value = calculation;
    }

    function setprice(){
        var purcasedetailitem = document.getElementById("purcasedetailitem").value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Transaction/get_price_by_id_purchase?id="+purcasedetailitem,
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                    document.getElementById("buydetailpurchase").value = data.master_barang_harga_modal;
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

    function set_gudang(){
        var purcasedetailitem = document.getElementById("companypurchase").value;
        if(purcasedetailitem == 1){
            document.getElementById("gudang").value = 2;
        }else{
            document.getElementById("gudang").value = 1;
        }
    }


    function get_total_cart_purchase(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Transaction/get_total_cart_purchase",
            dataType: "json",
            data: {},
            success : function(data){
                if (data.code == "200"){
                    document.getElementById("total_purchase_cart").value = data.total_purchase_cart;
                    document.getElementById("grandtotalpurchase").value = data.total_purchase_cart;
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


    function get_last_post_cart(){
        var fakturcode = $("#fakturcode").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Transaction/get_last_post_cart",
            dataType: "json",
            data: {fakturcode:fakturcode},
            success : function(data){
                if (data.code == "200"){
                    $("#suplierpurchase").select2('val',data.purchase_detail_cart_suplier);
                    document.getElementById("companypurchase").value = data.purchase_detail_cart_company;
                    document.getElementById("suplierpurchase").readOnly = true;
                    $('#suplierpurchase').attr("disabled", true);
                    $('#companypurchase').attr("disabled", true);
                    var company = document.getElementById("companypurchase").value;
                    if(company == 1){
                        document.getElementById("gudang").value = 2;
                    }else{
                        document.getElementById("gudang").value = 1;
                    }
                }
            }
        });
    }

</script>



