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
                            </div>
                            <div class="card-header-action">
                                <div class="input-group" class="float-right">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#Modalmenu"><i class="fas fa-plus"></i> Add</button>
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
                                        <th>Role Access</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <form>
                                        <?php $no = 1;
                                        foreach ($role as $r) { ?>

                                            <tr>
                                                <td align="center"><?= $no++; ?></td>
                                                <td><?= $r['role'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('menu/roleaccess/') . encode($r['id']); ?>" class="btn btn-icon btn-sm btn-info"><i class="far fa-eye"></i> access</a>
                                                    <a href="<?= base_url('menu/roleaccess/') . encode($r['id']); ?>" class="btn btn-icon btn-sm btn-warning"><i class="far fa-edit"></i> Edit</a>
                                                    <a href="<?= base_url('menu/roleaccess/') . encode($r['id']); ?>" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                </tbody>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="Modalmenu">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($action); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <select class="form-control" name="jenis" id="jenis" onchange="cek_add()" required>
                                <option value="">Pilih</option>
                                <option value="menu">Menu</option>
                                <option value="submenu">Sub Menu</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="loading"></div>
                        </div>
                    </div>
                    <div class="tampilkan_form"></div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="tampilkan_data"></div>
<script type="text/javascript">
    function view(id_menu) {
        menu = $('[id="menu"]');
        $.ajax({
            type: 'POST',
            data: "cari=" + id_menu + "&menu=" + id_menu,
            url: '<?= base_url('menu/view') ?>',
            cache: false,
            beforeSend: function() {
                menu.attr('disabled', true);
                $('.loading').html("");
            },
            success: function(data) {
                setTimeout(function() {
                    menu.attr('disabled', false);
                    $('.loading').html('');
                    $('.tampilkan_data').html(data);
                }, 1000);
            }
        });
        return false;
    }

    function cek_add() {
        jenis = $('[name="jenis"]');
        $.ajax({
            type: 'POST',
            data: "cari=" + 'add' + "&jenis=" + jenis.val(),
            url: '<?= base_url('menu/view') ?>',
            cache: false,
            beforeSend: function() {
                jenis.attr('disabled', true);
                $('.loading').html("<img src='<?= base_url('assets/gif/loading.gif'); ?>' width='21'><small> Loading..</small>");

            },
            success: function(data) {
                setTimeout(function() {
                    jenis.attr('disabled', false);
                    $('.loading').html('');
                    $('.tampilkan_form').html(data);
                }, 1000);
            }
        });
        return false;
    }
</script>