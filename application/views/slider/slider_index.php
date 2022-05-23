
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
                                <p class="section-lead">
                                Rekomendasi ukuran gambar slider adalah 1920x670 px.
                            </p>
                            </div>
                            <div class="card-header-action">
                                <div class="input-group" class="float-right">
                                    <a class="btn btn-success" href="<?= base_url('slider/data')?>"><i class="fas fa-plus"></i> tambah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Simple</h4>
                                </div>
                                <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block" src="../assets/img/news/img01.jpg" alt="First slide">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Simple</h4>
                                </div>
                                <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block" src="../assets/img/news/img01.jpg" alt="First slide">
                                        </div>
                                    </div>
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
<div class="tampilkan_data"></div>
<script type="text/javascript">
</script>