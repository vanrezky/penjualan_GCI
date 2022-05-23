<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?> <?= $barang['kode_barang'] ?></h1>
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
                        <form method="post" action="<?= base_url('barang/update/' . $barang['id']); ?>">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="">Kode Barang</label>
                                            <input type="text" class="form-control" name="kode_barang" value="<?= $barang['kode_barang'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" value="<?= $barang['nama_barang'] ?>" placeholder="Nama Barang..">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Satuan</label>
                                            <select class="form-control" name="satuan_id" id="satuan">
                                                <?php
                                                foreach ($allSatuan as $satuan) { // Lakukan looping pada tabel satuan dari controller -> model
                                                    echo "<option value='" . $satuan['satuan_id'] . "'>" . $satuan['satuan'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="">Keterangan</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="keterangan" value="<?= $barang['keterangan'] ?>" placeholder="Keterangan..">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="">Stock</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="stock" value="<?= $barang['stock'] ?>" placeholder="Stock..">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label>Harga Beli</label>
                                            <input type="text" class="form-control" name="harga" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" data-a-sign="Rp. " data-a-dec="," data-a-sep="." value="<?= $barang['harga'] ?>" placeholder="harga..">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" name="harga_jual" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= $barang['harga_jual'] ?>" placeholder="harga..">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                                    <a class="btn btn-secondary" href="<?= base_url('barang') ?>">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.getElementById('satuan').value = <?php echo $barang['satuan_id']; ?>;
</script>