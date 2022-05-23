    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/barang'); ?>" method="post">
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