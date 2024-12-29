<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data User</h1>
        <a href="<?= base_url('admin/tambah') ?>" class="btn btn-warning btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Tambah Admin</a>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Admin</th>
                    <th class="text-center">Foto Profile</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Email Admin</th>
                    <th class="text-center">No Telp</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Tanggal Daftar</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="text-center"><?= $user->id_admin ?></td>
                        <td class="text-center">
                            <?php if (file_exists(FCPATH . 'public/img/admin/' . $user->foto_admin)) : ?>
                                <img src="<?= base_url('public/img/admin/' . $user->foto_admin) ?>" alt="Profile" width="50" height="50" class="rounded-circle border border-dark card-neoraised">
                            <?php else : ?>
                                <img src="<?= base_url('public/img/admin/default.png') ?>" alt="Profile" width="50" height="50" class="rounded-circle border border-dark card-neoraised">
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= $user->nama_admin ?></td>
                        <td class="text-center"><?= $user->email_admin ?></td>
                        <td class="text-center"><?= $user->no_telp_admin ?></td>
                        <td class="text-center">
                            <?php
                            if ($this->session->userdata('nama_admin') != $user->nama_admin) {
                                echo password_hash($user->password_admin, PASSWORD_DEFAULT);
                            } else {
                                echo $user->password_admin;
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            switch ($user->jenis_kelamin) {
                                case 'L':
                                    echo 'Pria';
                                    break;
                                case 'P':
                                    echo 'Wanita';
                                    break;
                                default:
                                    echo 'Others';
                            }
                            ?>
                        </td>
                        <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($user->tanggal_ditambahkan)) ?></td>
                        <td class="text-center d-flex justify-content-center gap-3">
                            <a href="<?= base_url('akun/admin/' . $user->nama_admin) ?>" class="btn btn-primary btn-sm btn-neoraised fw-bold">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Id Admin</th>
                    <th class="text-center">Foto Profile</th>
                    <th class="text-center">Nama Admin</th>
                    <th class="text-center">Email Admin</th>
                    <th class="text-center">No Telp</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Tanggal Daftar</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>