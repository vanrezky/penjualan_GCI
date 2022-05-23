<script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog " role="document">
        <div class="modal-content large">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi <i><?= $v_data['no_resi']; ?></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($v_subdata as $d) { ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $d['nama_barang']; ?></td>
                                        <td><?= $d['satuan']; ?></td>
                                        <td><?= $d['harga_jual']; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" align="right"><strong>Total:</strong></td>
                                    <td><strong><?= $v_data['total']; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>