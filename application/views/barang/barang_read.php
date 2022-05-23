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
                            <form class="form-inline mr-auto" method="get" action="<?= base_url($url); ?>">
                                <ul class="navbar-nav mr-3">

                                    <div class="form-group">
                                        <select class="form-control form-control-sm" name="searchid">
                                            <option>Tanggal</option>
                                            <?php
                                            foreach ($allDateBarang as $b) { // Lakukan looping pada tabel satuan dari controller -> model
                                                echo "<option value='" . date('d F Y', $b['date_created']) . "'>" . date('d F Y', $b['date_created']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </ul>
                                <div class="search-element">
                                    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" data-width="250">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-info" href="<?= base_url($url); ?>"><i class="fas fa-sync"></i></a>
                                    <div class="search-backdrop"></div>
                                </div>
                            </form>
                            <div class="card-header-action">
                                <div class="input-group">
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
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stock</th>
                                            <th>Tanggal Input</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($allBarang as $barang) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $barang['kode_barang']; ?></td>
                                                <td><?= $barang['nama_barang']; ?></td>
                                                <td><?php echo "Rp." . number_format($barang['harga'], "0", ".", ".") ?></td>
                                                <td><?php echo "Rp." . number_format($barang['harga_jual'], "0", ".", ".") ?></td>
                                                <td><?= $barang['stock']; ?></td>
                                                <td><?= date('d F Y', $barang['date_created']); ?></td>
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