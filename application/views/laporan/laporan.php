<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Willy" />
    <style>
        /*design table 1*/
        .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        .table1,
        th,
        td {
            border: 1px solid #999;
            padding: 8px 20px;
        }
    </style>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
</head>

<body style="font-family: 'Courier';">
    <div class="container">
        <!--         <img src="<?= base_url(); ?>assets/img/brebes_logo.png" alt="Flowers in Chania"
            style="width:100px;height:100px; margin-left : 0px;float : left"></img> -->

        <h2 align="center" style="font-family: 'Courier';">TOKO BARANG</h2>
        <h3 align="center" style="font-family: 'Courier';">RUMBAI, PERUM RGM, PEKANBARU 24472</h3>
        <hr class="garis" />
        <!-- <hr/> -->
    </div>


    <div class="left" align='left' style="margin-top: 20px;">
        <p align="center" style="font-family: 'Courier';font-size: 20px">LAPORAN PENJUALAN</p>
    </div>


    <table class="table1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No Resi</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <?php $no = 1;
            foreach ($allTransaksi as $t) { ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $t['no_resi']; ?></td>
                    <td><?= $t['date_created']; ?></td>
                    <td><?= "Rp. " . number_format($t['total'], "0", ".", ".") ?></td>
                </tr>
            <?php } ?>
        </tbody>
        </tbody>
    </table>
    <div class="right" align='right' style="margin-top: 20px;">
        <p>Pekanbaru, <?= date('M Y'); ?></p>
    </div>
    </div>
</body>

</html>

<?php
?>