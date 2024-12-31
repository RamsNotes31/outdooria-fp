<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data Chat</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Users</th>
                    <th class="text-center">Nama Users</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($user['id_user']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($user['nama']); ?></td>
                        <td class="text-center d-flex justify-content-center gap-3">
                            <a href="<?= base_url('admin/chat_detail/' . $user['id_user']) ?>" class="btn btn-primary btn-sm btn-neoraised fw-bold border border-dark border-3">Detail</a>
                        </td>
                        
                        
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Users</th>
                    <th class="text-center">Nama Users</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>