<?php if ($jenis == 'menu') { ?>
    <div class="form-group">
        <input type="text" class="form-control" name="menu" placeholder="Nama menu..">
    </div>
<?php } else if ($jenis == 'submenu') { ?>
    <div class="form-group">
        <select class="form-control" name="menu_id">
            <option value="">Pilih menu</option>
            <?php foreach ($v_menu as $data) {
                echo '<option value="' . $data['id_um'] .  '">' . $data['menu'] . '</option>';
            } ?>
        </select>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="title" placeholder="Title..">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="url" placeholder="Field url..">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="icon" placeholder="Icon..">
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck1">
        <label class="custom-control-label" name="is_active" for="customCheck1">Is Active ?</label>
    </div>
<?php } else if ($jenis == 'view') { ?>
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        });
    </script>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content large">
                <div class="modal-header">
                    <h5 class="modal-title"><i><?= $v_data['menu']; ?></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('menu/update/' . $v_data['id_um']); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="menu" class="col-sm-3 col-form-label">Nama Menu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="menu_id" value="<?= $v_data['menu']; ?>" autocomplete="off" required>
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
                                            <th>Title</th>
                                            <th>Field Url</th>
                                            <th>Icon </th>
                                            <th>Is Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($v_subdata as $data) { ?>

                                            <tr>
                                                <td align="center"><?= $no++; ?></td>
                                                <td><?= $data['title']; ?></td>
                                                <td><?= $data['field_url']; ?></td>
                                                <td><i class="<?= $data['icon']; ?>"></i></td>
                                                <td><?= $data['is_active']; ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php } 

?>
