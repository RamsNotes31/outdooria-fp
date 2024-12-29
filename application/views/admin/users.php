<div class="container-fluid py-5 px-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 fw-bolder text-black">Data User</h1>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-success btn-neoraised btn-md fw-bold mt-3 border border-dark border-3">Back To Dasboard</a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-borderless card-neoraised border border-dark border-3" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Id Users</th>
                    <th class="text-center">Foto Profile</th>
                    <th class="text-center">Nama Users</th>
                    <th class="text-center">Email Users</th>
                    <th class="text-center">No Telp</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Tanggal Daftar</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="text-center"><?= $user->id_user ?></td>
                        <td class="text-center">
                            <?php if (file_exists(FCPATH . 'public/img/user/' . $user->foto_profil)) : ?>
                                <img src="<?= base_url('public/img/user/' . $user->foto_profil) ?>" alt="Profile 3" width="50" height="50" class="rounded-circle border border-dark card-neoraised">
                            <?php else : ?>
                                <img src="<?= base_url('public/img/user/default.png') ?>" alt="Profile 3" width="50" height="50" class="rounded-circle border border-dark card-neoraised">
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= $user->nama ?></td>
                        <td class="text-center"><?= $user->email ?></td>
                        <td class="text-center"><?= $user->no_telepon ?></td>
                        <td class="text-center"><?= $user->alamat ?></td>
                        <td class="text-center"><?= $user->password ?></td>
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
                        <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($user->tanggal_daftar)) ?></td>
                        <td class="text-center d-flex justify-content-center gap-3">
                            <a href="<?= base_url('akun/profil/' . $user->nama) ?>" class="btn btn-primary btn-sm btn-neoraised fw-bold">Detail</a>
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
                    <th class="text-center">Alamat</th>
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