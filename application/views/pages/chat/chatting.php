<div class="container mt-4">
    <div class="row">
        <div class="col-12 mx-auto rounded-3">
            <div class="card card-body border border-3 border-dark card-neoraised rounded-3" style="height: 74vh; overflow-y: scroll;">
                <div class="card-body">
                    <h1 class="card-title fw-bolder text-center mb-5">Chat Admin</h1>

                    <?php if (empty($chats)): ?>
                        <div class="row">
                            <div class="col-12 mt-4 text-center">
                                <p class="text-muted">Chatting kosong, silahkan chat dengan admin kami.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($chats as $chat): ?>
                            <?php if ($chat['role'] === 'user'): ?>
                                <div class="row">
                                    <!-- Tampilkan semua chat -->
                                    <!-- Pesan User -->
                                    <div class="col-10 col-lg-6 mt-4 ms-auto">
                                        <div class="card-body card-neoraised border border-2 border-dark rounded-3 bg-light shadow-md">
                                            <div class="mb-3">
                                                <img src="<?= base_url('public/img/user/' . $chat['foto_profil']) ?>" class="rounded-circle border border-2 border-dark card-neoraised me-2 mb-2" width="40" alt="<?= $chat['nama_user'] ?>">
                                                <?php $nama = $chat['nama_user']; ?>
                                                <?php if (strlen($nama) > 50) { ?>
                                                    <?php $nama = wordwrap($nama, 50, "<br>\n"); ?>
                                                <?php } ?>
                                                <span class="badge rounded-pill bg-warning card-neoraised border border-1 border-dark mb-3"><?= $nama ?></span>
                                            </div>

                                            <!-- Display chat message or media -->
                                            <?php if ($chat['foto_chat']): ?>
                                                <div class="d-flex justify-content-center">
                                                    <?php
                                                    $fileExtension = pathinfo($chat['foto_chat'], PATHINFO_EXTENSION);
                                                    if (stripos(mime_content_type('./public/img/chat/' . $chat['foto_chat']), 'image') !== false): ?>
                                                        <img src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" class="img-fluid rounded" alt="Foto Chat" height="500" width="500">
                                                    <?php elseif (stripos(mime_content_type('./public/img/chat/' . $chat['foto_chat']), 'video') !== false): ?>
                                                        <video class="img-fluid rounded" controls>
                                                            <source src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" type="video/<?= $fileExtension ?>">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    <?php elseif (stripos(mime_content_type('./public/img/chat/' . $chat['foto_chat']), 'audio') !== false): ?>
                                                        <audio controls>
                                                            <source src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" type="audio/<?= $fileExtension ?>">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    <?php else: ?>
                                                        <a href="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none mt-3 mb-1">
                                                            <i class="bi bi-download me-1"></i>Unduh file
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                            <p class="card-text mt-lg-3 mt-0"><?= nl2br($chat['pesan']) ?></p>

                                            <!-- Dropdown for actions -->
                                            <div class="d-flex justify-content-start gap-3 mt-3">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-sm border border-1 border-dark card-neoraised dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal<?= $chat['id_chat'] ?>"><i class="bi bi-pencil-fill"></i> Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="<?= base_url('chatting/delete/' . $chat['id_chat']) ?>" onclick="return confirm('Yakin ingin menghapus pesan?')"><i class="bi bi-trash-fill"></i> Hapus</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal<?= $chat['id_chat'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $chat['id_chat'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content card-neoraised border border-dark border-3">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bolder" id="editModalLabel<?= $chat['id_chat'] ?>">Edit Pesan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url('chatting/edit/' . $chat['id_chat']) ?>" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="userComment<?= $chat['id_chat'] ?>" class="form-label">Edit Pesan:</label>
                                                                    <textarea id="userComment<?= $chat['id_chat'] ?>" name="message" class="form-control card-neoraised" rows="4" style="resize: none;"><?= $chat['pesan'] ?></textarea>
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <label for="imageUpload<?= $chat['id_chat'] ?>" class="form-label">Upload File:</label>
                                                                    <input type="file" id="imageUpload<?= $chat['id_chat'] ?>" name="image" class="form-control card-neoraised">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-neoraised fw-bold" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary btn-neoraised fw-bold">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="card-text text-end"><small class="text-muted fw-light"><?= $chat['tanggal_kirim'] ?> <i class="bi bi-check-circle-fill text-success"></i></small></p>
                                        </div>
                                    </div>

                                </div>
                            <?php else: ?>
                                <!-- Pesan Admin -->
                                <div class="row">
                                    <div class="col-10 col-lg-6 mt-4">
                                        <div class="card-body card-neoraised border border-2 border-dark rounded-3">
                                            <div class="mb-3">
                                                <img src="<?= base_url('public/img/admin/' . $chat['foto_admin']) ?>" class="rounded-circle border border-2 border-dark card-neoraised me-2 mb-2" width="40" alt="<?= $chat['nama_admin'] ?>">
                                                <?php $nama = $chat['nama_admin']; ?>
                                                <?php if (strlen($nama) > 50) { ?>
                                                    <?php $nama = wordwrap($nama, 50, "<br>\n"); ?>
                                                <?php } ?>
                                                <span class="badge rounded-pill bg-danger card-neoraised border border-1 border-dark"><?= $nama ?></span>
                                            </div>
                                            <p class="card-text"><?= nl2br($chat['pesan']) ?></p>
                                            <?php if ($chat['foto_chat']): ?>
                                                <img src="<?= base_url('uploads/chat/' . $chat['foto_chat']) ?>" class="img-fluid rounded" alt="Foto Chat">
                                            <?php endif; ?>
                                            <p class="card-text text-end"><small class="text-muted fw-light"><i class="bi bi-check-circle-fill text-success me-1"></i><?= $chat['tanggal_kirim'] ?> </small></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-12 mt-4 ms-auto">
                        <form method="POST" action="<?= base_url('chatting/send_message') ?>" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <textarea class="form-control card-neoraised" name="message" rows="2" placeholder="Tulis pesan..." aria-label="Tulis pesan" style="resize: none;"></textarea>
                                <button class="btn btn-primary btn-neoraised fw-bold" type="submit">Kirim</button>
                            </div>
                            <div class="input-group mb-3">
                                <button class="btn btn-success btn-neoraised dropdown-toggle fw-bold" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Upload File
                                </button>
                                <ul class="dropdown-menu card-neoraised px-3 border border-dark border-2 w-100" aria-labelledby="dropdownMenuButton">
                                    <li><input type="file" name="image" class="form-control-file card-neoraised border border-2 border-dark rounded-3" style="width: 100%;"></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>