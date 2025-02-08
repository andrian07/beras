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
               width: 230px;
            }

            td.no-border.center-store-name.invoice-number {
                width: 300px;
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
                font-size: 15px;
            }

            .total-table{
                border-top: 1px dashed  !important;
            }
            .body-table{
                min-height: 150px;
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
                                                <h4 style="font-size: 1.2em;"><?php echo $row->mastercompany_name; ?></h4>
                                              <p style="font-size:13px; line-height: 16px; margin-top: -15px;"><?php echo $row->mastercompany_phone; ?> <br />PONTIANAK<br />e-mail:<?php echo $row->mastercompany_email; ?></p></p>

                                        
                                             
                                          </td>
                                          <td class="no-border center-store-name invoice-number" style="text-align: center;">
                                            <h3 style="text-transform:uppercase; text-decoration: underline;">KWITANSI</h3>
                                            <h3 style="text-transform:uppercase;"><?php echo $row->sales_faktur_id; ?></h3>
                                          </td>
                                          <td class="no-border right-store-name">
                                               
                                           
                                          </td>

                                    </tr>
                            </tbody>
                     </table>
                    <?php } ?>
         
                

                <div style="clear:both;"></div>
                <table class="table table-condensed">
                    <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                    <tbody class="body-table">
                        <tr>
                        	<td style="padding-top: 16px;">Sudah Terima Dari</td>
                            <td style="padding-top: 16px;">:</td>
                            <td style="padding-top: 16px;border-bottom: 1px black solid;"><?php echo $row->customer_name; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 16px;">Uang Sejumlah</td>
                            <td style="padding-top: 16px;">:</td>
                            <td style="padding-top: 16px;border: 1px black solid; padding-bottom: 15px; padding-left: 5px;padding-right: 5px;"># <?php echo $row->sales_terbilang; ?> #</td>
                        </tr>
                        <tr>
                            <td style="padding-top: 16px;">Untuk Pembayaran</td>
                            <td style="padding-top: 16px;">:</td>
                            <td style="padding-top: 16px;border-bottom: 1px black solid;"><?php echo $row->sales_po; ?></td>
                        </tr>
                      
                    </tbody>
                     <?php } ?>
                    <tfoot>

            
                    <tr>
                        <td style="font-weight: 800; font-size: 22px; padding-top: 20px;">Terbilang: Rp. <?php echo number_format($row->sales_total); ?></td> <td>Pontianak, <?php $date = date_create(date($row->sales_date)); echo date_format($date,"d-M-Y"); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 800;">Rekening Pembayaran: </td>
                    </tr>
                     <tr>
                        <td>
                            <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                            <?php echo $row->mastercompany_name; ?> <br />
                            <?php echo $row->mastercompany_bank_name; ?>  <br />
                            No. Rekening: <?php echo $row->mastercompany_bank_rek; ?>
                            <?php } ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td><td>------------------------------</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

        
            <div style="clear:both;"></div>
        </div></div>

    </div>
</div>
</div>

</body>
</html>

