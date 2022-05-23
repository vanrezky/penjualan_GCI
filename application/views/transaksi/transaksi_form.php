<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <?= $this->session->flashdata('message') ?>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        <?php } ?>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card-body p-0">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="">Cari Barang</label>
                                        <input type="text" class="form-control barang" name="nama" id="nama" placeholder="Ketik Nama Barang..">
                                        <input name="id" hidden>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="">Stock</label>
                                        <input type=" text" class="form-control" name="stock" placeholder="Stock.." readonly>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="">Harga</label>
                                        <input type="text" class="form-control" name="harga" placeholder="Harga.." readonly>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="">Satuan</label>
                                        <input type="text" class="form-control" name="satuan" placeholder="Satuan.." readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="add_cart btn btn-primary" type="button"><span class="fas fa-shopping-cart"></span> Tambahkan</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>
                                            <i class="fas fa-shopping-cart"></i> List Pembelian Barang
                                        </h4>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="<?= base_url('transaksi/save_transaksi') ?>" method="post">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="sortable-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                <i class="fas fa-th"></i>
                                                            </th>
                                                            <th>Nama Barang</th>
                                                            <th>Harga</th>
                                                            <th>Qty</th>
                                                            <th>Satuan</th>
                                                            <th>Total Harga</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="detail_cart">
                                                    </tbody>

                                                </table>
                                            </div>
                                            <button class="btn btn-primary float-left" type="button"><i class="fas fa-shopping-cart"></i> Beli</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Main Content -->
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui.css">
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-control barang').blur(function() {
            if ($(this).val().length === 0) {
                $(this).parents('p').addClass('warning');
            }
        });

        $('#nama').autocomplete({
            source: "<?php echo base_url('transaksi/get_autocomplete'); ?>",

            select: function(event, ui) {
                $('[name="id"]').val(ui.item.id);
                $('[name="stock"]').val(ui.item.stock);
                $('[name="harga"]').val(ui.item.harga);
                $('[name="satuan"]').val(ui.item.satuan);
                $('[name="qty"]').val(ui.item.qty);
            }
        });

        $('#detail_cart').load("<?php echo base_url('transaksi/load_cart'); ?>");

        $('.add_cart').click(function() {
            var nm_barang = $('[name="nama"]').val();
            var values = {
                'id': $('[name="id"]').val(),
                'qty': $('[name="qty"]').val(),
            };
            $.ajax({
                url: "<?= base_url('transaksi/add_to_cart'); ?>",
                method: "POST",
                data: values,
                success: function(data) {
                    iziToast.success({
                        title: nm_barang,
                        message: 'berhasil ditambahkan!',
                        position: 'topRight',
                    });
                    $('#detail_cart').html(data);
                },
                // error: function() {
                //     iziToast.warning({
                //         title: 'Not Found',
                //         message: 'Silahkan pilih barang terlebih dahulu!',
                //         position: 'topRight',
                //     });
                // }

            });
        });

        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('transaksi/hapus_cart'); ?>",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    iziToast.success({
                        title: 'Berhasil',
                        message: 'Barang berhasil dihapus!',
                        position: 'topRight'
                    });
                    $('#detail_cart').html(data);
                }
            });
        });


    });
</script>