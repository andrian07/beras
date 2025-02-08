<?php include 'header.php'; ?>
  


  <div class="content-wrapper">


    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Barang</h1>
          </div>
          <div class="col-sm-6">
              
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
          	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url(); ?>masterdata/processupdatebarang" method="POST">
                 <?php foreach($get_masterbarang_by_id as $row){?>
                <div class="card-body">
                <div class="row">

				<div class="col-sm-12">  
      

                  <div class="form-group"> 
                    <label for="exampleInputEmail1">Kode Produk</label>
                    <input type="text" id="productcode" name="productcode" class="form-control" placeholder="Kode Produk" readonly="" value="<?php echo $row->produk_code; ?>">
                  </div>

                  <div class="form-group"> 
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" name="productname" class="form-control" placeholder="Nama Poduk" required="" value="<?php echo $row->produk_name; ?>">
                  </div>

                  <?php if($row->produk_type == 9){ ?>
                 <div class="form-group"> 
                    <label for="exampleInputEmail1">Bonus Produk</label>
                    <input type="number" name="bonusproduct" class="form-control" placeholder="Bonus Poduk" required="" value="<?php echo $row->harga_bonus; ?>">
                  </div>
                  <?php } ?>
                    <div class="form-group"> 
                    <label for="exampleInputEmail1">Keterangan Produk</label>
                    <textarea class="form-control" placeholder="Keterangan" required="" name="desc"><?php echo $row->package_desc; ?></textarea>

                  </div>
                  
                </div>

            	</div>
                <!-- /.card-body -->

               
           		</div>
           		 <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              <?php } ?>
              </form>
            </div>
      </div>
    </section>
   
  </div>
 

<?php include 'footer.php'; ?>