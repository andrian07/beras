<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Faktur</title>

              <style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 1100px; margin: 0 auto;     }
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
               width: 260px;
            }   

            td.no-border.center-store-name.invoice-number {
                width: 200px;
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
                min-height: 50px;
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
                padding-top: 25px !important;
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
					     <p style="font-weight: 800;margin-top: -15px;">Jatuh Tempo:<?php $date = date_create($row->sales_due_date); echo date_format($date,"d-M-Y"); ?></p>
                                             <p style="font-weight: 800;margin-top: -15px;">Sales: <?php echo $row->sales_sales_name; ?></p>                	
                                             
                                          </td>
                                          <td class="no-border center-store-name invoice-number" style="text-align: center;">
                                            <h3 style="text-transform:uppercase; text-decoration: underline;">Faktur</h3>
                                            <h3 style="text-transform:uppercase;"><?php echo $row->sales_faktur_id; ?></h3>
					   
                                          </td>
                                          <td class="no-border right-store-name">
                                                <p style="font-size:15px; font-weight: 800;">
                                                <table>
                                            <tr><td  style="font-weight: 800;">Tanggal</td><td>:</td><td style="text-align: left;">Pontianak, <?php $date = date_create($row->sales_date); echo date_format($date,"d-M-Y"); ?></td></tr>
                                            <tr><td colspan="3">
						<p style="font-size: 16px; margin-top: -5px; font-weight: 800;">
                                                Kepada Yth, <br/>
                                                <?php echo $row->customer_name; ?> <br />
                                                <?php echo $row->customer_address; ?><br />
                                           </p>	
						</td></tr>


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
                            <td class="header-table" width="40%">Nama Produk</td>
                            <td class="header-table" width="15%">Harga</td>
                            <td class="header-table" width="13%">Qty</td>
                            <td class="header-table" width="13%">Diskon</td>
                            <td class="header-table" width="50%">Jumlah</td>
                            <td class="header-table" width="1%"></td>
                        </tr>
                        <?php $i = 0; ?>
                        <?php foreach ($datas['get_detail_sales_byfaktur'] as $row) { ?>
                      <tr style="height:5px;">
                          <?php $i++ ?>
                          <td class="no-border"><?php echo $i; ?></td>
                          <td class="no-border"><?php echo $row->master_barang_name; ?></td>
                          <td class="no-border"><?php echo 'Rp. '.number_format($row->sales_detail_price); ?></td>
                          <td class="no-border"><?php echo $row->sales_detail_satuan.' '.$row->unit_name; ?></td>
                           <td class="no-border"><?php echo 'Rp. '.number_format($row->sales_detail_discount); ?></td>
                           <td class="no-border" style="width:110px;"><?php echo 'Rp. '.number_format($row->sales_detail_total); ?></td>
                      </tr>
                
                      <?php } ?>
                        
                
                    </tbody>
                     <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                    <tfoot>

                        <tr>
                            <td  class="total-table no-border" style="width: 76%;"></td> 
                            <td class="right total-table no-border" style="font-weight: 800;">Total : </td>
                            <td class="left total-table no-border" ><?php echo 'Rp. '.number_format($row->sales_subtotal) ?></td> 
                        </tr>
                        <tr>
                            <td  class="no-border"></td> 
                            <td class="right no-border" style="font-weight: 800;">Disc : </td>
                            <td class="left no-border"><?php echo 'Rp. '.number_format($row->sales_discount) ?></td> 
                        </tr>
                        <tr>
                            <td class="no-border">
                                <div class="ttd">
                                    <p class="ttd_word" style="margin-left: 2%;">Hormat&nbsp;Kami,</p>
                                    <p class="ttd_word_supir" style="margin-left: 2%;">Supir</p>
                                    <p style="margin-left: 5%;">Penerima</p>
                                </div>
                            </td> 
                            <td class="right no-border" style="font-weight: 800;">PPN : </td>
                        <td class="left no-border"><?php echo 'Rp. '.number_format($row->sales_ppn) ?></td>          
                        </tr>
                        <tr>
                          
                            <td class="right no-border" style="font-weight: 900; font-size:18px;" colspan="2">Grand total : </td>
                        <td class="left no-border" style="font-weight: 900; font-size:18px;"><?php echo 'Rp. '.number_format($row->sales_total) ?></td>          
                        </tr>
                        <tr>
                            <td class="no-border sign-border">
                                <div class="ttd">
                                    <p class="ttd_word_titik">------------------------------</p>
                                    <p class="ttd_word_supir_titik">------------------------------</p>
                                    <p>------------------------------</p>
                                </div>
                            </td> 
                            <td class="right no-border"> </td>
                            <td class="no-border"></td>          
                        </tr>
                        <tr>
                            <td colspan="5" class="no-border">
                                 <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                                <p style="font-size: 11px;">Pembayaran Giro atau Transfer *<?php echo $row->mastercompany_bank_name ?>: <?php echo $row->mastercompany_bank_rek ?> a/n <?php echo $row->mastercompany_name ?><br />
                                - Barang di terima dalam keadaan baik <br />
                                - Barang yang sudah di beli tidak dapat di tukar / dikembalikan <br />
                                <?php if($row->show_tax_note == 'Y'){?>
                                - *PPN dibebaskan
                                <?php } ?>
                                </p>

                            <?php } ?>
                            </td>
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

