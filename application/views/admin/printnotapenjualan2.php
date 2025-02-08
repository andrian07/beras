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
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td class="no-border center-store-name">
                                    <h3>Nota Penjualan</h3>
                                </td>
                                <td class="no-border center-store-name invoice-number" style="text-align: center;"></td>
                                <td class="no-border right-store-name">
                                    <h3 style="text-transform:uppercase; text-decoration: underline;"><?php echo $datas['get_header_sales_byfaktur'][0]->mastercompany_name; ?></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                        <table class="table table-condensed">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Nomer</td>
                                            <td>:</td>
                                            <td><?php echo $row->sales_faktur_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gudang</td>
                                            <td>:</td>
                                            <td>Sakura Bizz</td>
                                        </tr>
                                        <tr>
                                            <td>Term</td>
                                            <td>:</td>
                                            <td><?php $date = date_create($row->sales_due_date); echo date_format($date,"d-M-Y"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sales</td>
                                            <td>:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td><?php echo $row->sales_sales_name; ?></td>
                                        </tr>
                                    </table>
                                </td>

                                <td>
                                    <table>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td><?php echo $row->sales_faktur_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mata Uang</td>
                                            <td>:</td>
                                            <td>IDR</td>
                                        </tr>
                                        <tr>
                                            <td>Kurs</td>
                                            <td>:</td>
                                            <td>1</td>
                                        </tr>
                                    </table>
                                </td>

                                <td>
                                    <table>
                                        <tr>
                                            <td>Customer</td>
                                            <td>:</td>
                                            <td><?php echo $row->customer_id; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td><?php echo $row->customer_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?php echo $row->customer_address; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kota</td>
                                            <td>:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Telp</td>
                                            <td>:</td>
                                            <td><?php echo $row->customer_phone; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
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
                                <td class="no-border">Terbilang: <?php echo $row->sales_terbilang; ?></td> 
                                <td class="right no-border" style="font-weight: 800;">PPN : </td>
                                <td class="left no-border"><?php echo 'Rp. '.number_format($row->sales_ppn) ?></td>          
                            </tr>
                            <tr>

                                <td class="right no-border" style="font-weight: 900; font-size:18px;" colspan="2">Grand total : </td>
                                <td class="left no-border" style="font-weight: 900; font-size:18px;"><?php echo 'Rp. '.number_format($row->sales_total) ?></td>          
                            </tr>
                            <tr>
                                <td colspan="5" class="no-border" style="border-bottom:1px dotted #000;">
                                   <?php foreach ($datas['get_header_sales_byfaktur'] as $row) { ?>
                                    <p style="font-size: 11px;">
                                        <?php if($row->show_tax_note == 'Y'){?>
                                            - *PPN dibebaskan
                                        <?php }else{ ?>
                                           - Harga Sudah Termasuk PPN 11%
                                       <?php } ?>
                                   </p>
                               <?php } ?>
                           </td>
                       </tr>
                       <tr>
                        <td colspan="3">
                        <table width="100%">
                            <td class="no-border">
                                <?php echo date('Y-m-d H:i:s'); ?>
                            </td>
                            <td class="no-border">
                                Printed By: <?php echo $_SESSION['user_name']; ?>
                            </td>
                            <td class="no-border" style="text-align: right;">
                                Page 1 of 1
                            </td>
                        </table>
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

