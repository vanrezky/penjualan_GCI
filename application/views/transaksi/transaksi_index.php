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
                            <h4>Daftar <?= $title; ?> <?= date('d F Y'); ?></h4>
                            <div class="card-header-action">
                                <div class="input-group">
                                    <a class="btn btn-success" href="<?= base_url($url); ?>"><i class="fas fa-plus"></i> Add</a> </div>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($allTransaksi as $t) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $t['no_resi']; ?></td>
                                            <td><?= $t['date_created']; ?></td>
                                            <td>
                                                <button id="barang" name="barang" onclick="view('<?= encode($t['no_resi']); ?>')" class="btn btn-icon btn-sm btn-info">
                                                    <span id="show" class="fas fa-eye"></span>
                                                    <span id="preload" class="spinner-border spinner-border-sm" role="status" hidden="true" aria-hidden="true"></span>
                                                    View
                                                </button>
                                                <a href="<?= site_url('transaksi/delete/' . encode($t['no_resi'])); ?>" onClick="return confirm('Yakin Hapus data Transaksi');" class="btn btn-icon btn-sm btn-danger" title="delete"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="tampilkan_data"></div>
<script type="text/javascript">
    function view(no_resi) {
        barang = $('[id="barang"]');
        $.ajax({
            type: 'POST',
            data: {
                barang: no_resi
            },
            url: '<?= base_url('transaksi/view') ?>',
            cache: false,
            beforeSend: function() {
                barang.attr('disabled', true);
                $("#preload").attr("hidden", false);
                $('#show').hide();
            },
            success: function(data) {
                setTimeout(function() {
                    barang.attr('disabled', false);
                    $("#preload").attr("hidden", true);
                    $('#show').show();
                    $('.tampilkan_data').html(data);
                }, 1500);
            }
        });
        return false;
    }
</script>
