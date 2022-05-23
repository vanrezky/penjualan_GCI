<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title . ' : ' . $role['role']; ?></h1>
        </div>
        <?= $this->session->flashdata('message') ?>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                        <th>Role</th>
                                        <th align="center">Active ?</th>
                                        <th align="center">Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form>
                                        <?php $no = 1;
                                        foreach ($menu as $m) { ?>
                                            <tr>
                                                <td align="center"><?= $no++; ?></td>
                                                <td><?= $m['menu_utama']['menu'] ?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" <?= check_access($role['id'], $m['menu_utama']['id_um']); ?> <?= "data-role='" . encode($role['id']) . "' data-menu='" . $m['menu_utama']['id_um'] . "'" ?>>
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php

                                                        $create = (isset($m['access']['a_create']) ? ($m['access']['a_create']  == 1 ? 'checked' : '') : '');
                                                        $read   = (isset($m['access']['a_read']) ? ($m['access']['a_read']  == 1 ? 'checked' : '') : '');
                                                        $update = (isset($m['access']['a_update']) ? ($m['access']['a_update']  == 1 ? 'checked' : '') : '');
                                                        $delete = (isset($m['access']['a_delete']) ? ($m['access']['a_delete']  == 1 ? 'checked' : '') : '');

                                                        echo check_access_crud($role['id'], $m['menu_utama']['id_um'], $create,$read,$update,$update); ?>
                                                </td>
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
<script>
    // $('#test').is(':checked'))

    function saveAsNewName(idum) {
        var values = {
            'v_idum': idum,
            'v_roleid': $('.custom-switch-input').data('role'),
            'v_create': $('#create' + idum).is(':checked') ? 1 : 0,
            'v_read': $('#read' + idum).is(':checked') ? 1 : 0,
            'v_update': $('#update' + idum).is(':checked') ? 1 : 0,
            'v_delete': $('#delete' + idum).is(':checked') ? 1 : 0,
        };
        $.ajax({
            url: "<?= base_url('menu/ajax_accesscrud'); ?>",
            type: "POST",
            data: values,
            dataType:'JSON',

            success: function() {
                document.location.href = "<?= base_url('menu/roleaccess/'); ?>" + values['v_roleid'];
            }
        });


    }
    $('.custom-switch-input').on('click', function() {
        var menuId = $(this).data('menu');
        var roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('menu/ajax_changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('menu/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>