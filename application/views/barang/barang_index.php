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
                            <div class="form-inline mr-auto">
                                <div class="search-element">
                                    <?= stislaInputTextOnly('Nama barang..', 'nama_barang', $this->input->cookie('fnama_barang')); ?>
                                    <?= stislaButtonMedium("<i class='fa fa-search'></i>", "primary", "bCari"); ?>
                                </div>
                            </div>
                            <?php
                            echo "<div class='card-header-action'>";
                            echo "<div class='input-group'>";
                            if ($this->session->userdata('status') == 'ADMIN') {
                                echo "<button class='btn btn-success' data-toggle='modal' data-target='#addModal'><i class='fas fa-plus'></i> Add</button>";
                            }
                            echo "</div>";
                            ?>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                        <th>Nama Barang</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Stock</th>
                                        <th>
                                            <?= ($this->session->userdata('status') == 'ADMIN') ? 'Action' : ''?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = $this->uri->segment('3') + 1;
                                    foreach ($data as $barang) { ?>
                                        <tr>
                                            <td align="center"><?= $no++; ?></td>
                                            <td><?= "$barang[nama_barang]" . status_stock($barang['stock']); ?></td>
                                            <td><?php echo "Rp." . number_format($barang['harga'], "0", ".", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($barang['harga_jual'], "0", ".", ".") ?></td>
                                            <td><?= $barang['stock']; ?></td>
                                            <td>
                                                <?php
                                                if ($this->session->userdata('status') == 'ADMIN') { ?>
                                                    <a class="btn btn-icon btn-sm btn-info" href="<?= base_url('barang/update/' . encode($barang['id'])); ?>"><i class="fas fa-edit"></i> Edit</a>
                                                    <a href="<?= base_url('barang/delete/' . encode($barang['id'])); ?>" class="btn btn-icon btn-sm btn-danger" onClick="return confirm('Yakin menghapus Barang?');" title="delete"><i class="fas fa-trash-alt"></i> Delete</a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer float-right">
                        <span>Total Data : <?= $jumlah_data; ?></span>
                        <div class="float-right mr-3">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('barang'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="kode_barang" value="<?= $kode_barang ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama_barang" value="<?= set_value('nama_barang') ?>" placeholder="Nama Barang.." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="satuan_id">
                            <option> -- Pilih Satuan --</option>
                            <?php
                            foreach ($allSatuan as $satuan) { // Lakukan looping pada tabel satuan dari controller -> model
                                echo "<option value='" . $satuan['satuan_id'] . "'>" . $satuan['satuan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>" placeholder="Keterangan.." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="stock" value="<?= set_value('stock') ?>" placeholder="Stock.." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="harga" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= set_value('harga') ?>" placeholder="harga.." autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="harga_jual" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= set_value('harga_jual') ?>" placeholder="harga Jual.." autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('[bCari]').click(function() {
            setFilter();
            document.location.href = '<?= base_url('barang/index') ?>';
            return false;
        });

        function setFilter() {
            setCookies('fnama_barang', $('[name="nama_barang"]').val());
        };
    });
</script>