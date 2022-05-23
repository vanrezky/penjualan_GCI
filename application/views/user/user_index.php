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
                <div class="col-md-12 col-sm-12 col-lg-5">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Daftar <?= $title; ?></h4>
                            <div class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add</button> </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <?php foreach ($allUser as $user) { ?>
                                    <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                                        <div class="avatar-item">
                                            <a href="user/profile">
                                                <img alt="image" src="<?= base_url('assets/img/' . $user['image']); ?>" class="img-fluid" data-toggle="tooltip" title="" data-original-title="<?= $user['name'] ?>">
                                            </a>
                                            <div class="avatar-badge" title="" data-toggle="tooltip" data-original-title="<?= $user['role'] ?>"><i class="<?= role($user['role_id']) ?>"></i></div>
                                        </div>
                                    </div>
                                <?php } ?>

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
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/user'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>" placeholder="Nama Lengkap..">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" value="<?= set_value('email') ?>" placeholder="Email aktif..">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password1" class="form-control" placeholder="Password..">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password2" class="form-control" placeholder="retype Password..">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="role_id">
                                <?php
                                foreach ($allRole as $role) { // Lakukan looping pada variabel siswa dari controller
                                    echo "<option value='" . $role['id'] . "'>" . $role['role'] . "</option>";
                                }
                                ?>
                            </select>
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