<!-- Main Content -->
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
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar <?= $title; ?></h4>
                            <div class="card-header-action">
                                <div class="input-group">
                                    <form action="<?= base_url($url) ?>" method="post">
                                        <input type="submit" class="btn btn-success" value="Print PDF" name="laporan">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                        <th>Nomor Resi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($allTransaksi as $t) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $t['no_resi']; ?></td>
                                            <td><?= $t['date_created']; ?></td>
                                            <td><?= "Rp. " . number_format($t['total'], "0", ".", ".")?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>