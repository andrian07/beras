<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Faktur</title>

        <style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 1100px; margin: 0 auto; }
            .btn { border-radius: 0; margin-bottom: 5px; }
            .bootbox .modal-footer { border-top: 0; text-align: center; }
            h3 { margin: 5px 0; }
            .order_barcodes img { float: none !important; margin-top: 5px; }
            .center-store-name{
                text-align: center;
            }
            .center-store-name{
                text-align: left;
            }

            td.no-border.center-store-name {
               width: 220px;
            }

            td.no-border.center-store-name.invoice-number {
                width: 250px;
            }

            #wrapper {
			    max-width: 1100px;
			    margin: 0 auto;
			}
			.table {
			    width: 100%;
			    max-width: 100%;
			    margin-bottom: 20px;
			}
            .header-table{
                border-bottom: 1px dashed ;
                border-top: 1px dashed  !important;
            }
            .right{
                text-align: right;
            }
            .left{
                text-align: left;
            }
            .center{
                text-align: center;
            }

            td {
                font-size: 13px;
            }

            .total-table{
                border-top: 1px dashed  !important;
            }
            .body-table{
                min-height: 200px;
                display: table-caption;
                width: 100%;
            }
            .sign{
                padding-top: 70px !important;
            }
            .ttd p{
                display: inline;
            }
            .ttd_word{
                margin-right: 20%;
            }
            .ttd_word_titik{
                margin-right: 8%;
            }
            .ttd_word_supir{
                margin-right: 20%;
            }
            .ttd_word_supir_titik{
                margin-right: 8%;
            }
            .sign-border{
                padding-top: 55px !important;
            }
            .table{
                margin-bottom: 0px;
            }
            p{
                font-size: 13px;
            }
            h3{
                font-size: 20px;
            }
            h4{
                font-size: 24px;
            }
            .invoice-number p{
                margin-left: 28%;
            }
           /* @media print {
                .no-print { display: none; }
                #wrapper { max-width: 1100px; width: 100%; min-width: 250px; margin: 0 auto; }
                .no-border { border: none !important; }
                table tfoot { display: table-row-group; }
            }*/
        </style>
    </head>

    <body>


    <div id="wrapper">
        <div id="receiptData">
            <div class="no-print">
            </div>
            <div id="receipt-data">
                    <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                    <table class="table table-condensed">
                            <tbody>
                                    <tr>
                                         <td class="no-border center-store-name">
                                              <h4 style="font-size: 1.3em;"><?php echo $row->mastercompany_name; ?></h4>
                                              <p style="font-size:13px; line-height: 14px; margin-top: -20px;"><?php echo $row->mastercompany_phone; ?> <br />e-mail:<?php echo $row->mastercompany_email; ?></p></p>
                                        
                                          </td>
                                          <td class="no-border center-store-name invoice-number" style="text-align: center;">
                                            <h3 style="text-transform:uppercase; text-decoration: underline;">SURAT JALAN</h3>
                                            <h3 style="text-transform:uppercase;"><?php echo $row->sales_faktur_id; ?></h3>
                                          </td>
                                          <td class="no-border right-store-name">
                                                <p style="font-size:15px; font-weight: 800;">
                                                <table>
                                            <tr><td  style="font-weight: 800;">Tanggal</td><td>:</td><td>Pontianak, <?php $date = date_create($row->sales_date); echo date_format($date,"d-M-Y"); ?>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td  style="font-weight: 800;">Perushaan</td><td>:</td><td><?php echo $row->customer_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td  style="font-weight: 800;">Alamat</td><td>:</td><td><?php echo $row->customer_address; ?></td>
                                
                                            </tr>
                                                </table>
                                            </p>
                                           
                                          </td>

                                    </tr>
                            </tbody>
                     </table>
                    <?php } ?>
         
                

                <div style="clear:both;"></div>
                <table class="table table-condensed">
                    <tbody class="body-table">
                        <tr>
                        	<td class="header-table" width="5%">No</td>
                            <td class="header-table" width="30%">Nama Produk</td>
                            <td class="header-table" width="22%">Qty</td>
                            <td class="header-table" width="50%">Keterangan</td>
                            <td class="header-table" width="1%"></td>
                        </tr>
                        <?php $i = 0; ?>
                        <?php foreach ($datas['get_detail_sales_byfaktur'] as $row) { ?>
                      <tr style="height:5px;">
                          <?php $i++ ?>
                          <td class="no-border"><?php echo $i; ?></td>
                          <td class="no-border"><?php echo $row->master_barang_name; ?></td>
                          <td class="no-border"><?php echo $row->sales_detail_satuan.' '.$row->unit_name; ?></td>
                           <td class="no-border"></td>
                      </tr>
                
                      <?php } ?>
                        
                   
                    

                      
                    </tbody>
                     <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                    <tfoot>
                        <tr>
                            <td class="total-table no-border" style="padding-top: 10px; font-weight: 800;">Perhatian: <br />Barang Sudah Diterima dalam Keadaan Baik Dan Cukup</td>
                        </tr>
            
                       
                        <tr>
                            <td class="no-border" style="padding-top: 30px;">
                                <div class="ttd">
                                    <p class="ttd_word" style="margin-left: 12%;">Penerima/Pembeli</p>
                                   
                                    <p style="margin-left: 10%;">Hormat Kami</p>
                                </div>
                            </td> 
                            
                        </tr>
                        <tr>
                              <td class="no-border"></td> 
                                  
                        </tr>
                        <tr>
                            <td class="no-border sign-border" colspan="3">
                                <div class="ttd">
                                    <p class="ttd_word_titik" style="margin-left: 10%;">------------------------------</p>
                                    <p style="margin-left: 15%;">------------------------------</p>
                                </div>
                            </td> 
                            <td class="right no-border"> </td>
                            <td class="no-border"></td>          
                        </tr>
                    </tfoot>
                <?php } ?>
                </table>
            </div>

        
            <div style="clear:both;"></div>
        </div></div>

    </div>
</div>
</div>

</body>
</html>

