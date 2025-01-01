<div class="container mt-4">
    <div class="row">
        <div class="col-12 mx-auto rounded-3 ">
            <div class="bg-light card card-body border border-3 border-dark card-neoraised rounded-3" style="height: 67vh; overflow-y: scroll;">
                <div class="bg-light card-body">
                    <a href="<?= base_url('admin/data_chat') ?>" class="btn btn-primary btn-neoraised fw-bold border border-2 border-dark mb-3">Back</a>

                    <h1 class="card-title fw-bolder text-center mb-5 text-black py-3 fs-3">Chat
                        <?php if (isset($error_message)) : ?>
                            <?= htmlspecialchars($error_message) ?>
                        <?php else: ?>
                            <?= htmlspecialchars($users) ?>
                        <?php endif; ?>
                    </h1>


                    <?php if (empty($chats)): ?>
                        <div class="row">
                            <div class="col-12 mt-4 text-center">
                                <p class="text-muted text-black">Chatting kosong, user belum melakukan chat.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($chats as $chat): ?>
                            <?php if ($chat['role'] === 'user'): ?>
                                <div class="row">
                                    <!-- Tampilkan semua chat -->
                                    <!-- Pesan User -->
                                    <div class="col-10 col-lg-6 mb-4">
                                        <div class="card-body card-neoraised border border-2 border-dark rounded-3 bg-light shadow-md">
                                            <div class="mb-3">
                                                <img src="<?= base_url('public/img/user/' . $chat['foto_profil']) ?>" class="rounded-circle border border-2 border-dark card-neoraised me-2 mb-2" width="40" alt="<?= $chat['nama_user'] ?>">

                                                <?php $nama = $chat['nama_user'] ?? ''; ?>
                                                <?php if (strlen($nama) > 50) { ?>
                                                    <?php $nama = wordwrap($nama, 50, "<br>\n"); ?>
                                                <?php } ?>
                                                <span class="badge rounded-pill bg-warning card-neoraised border border-1 border-dark mb-3"> <a href="<?= base_url('akun/profil/' . $chat['nama_user']) ?>" class="text-decoration-none text-black"><?= $nama ?></a></span>
                                            </div>

                                            <!-- Display chat message or media -->
                                            <?php if (empty($chat['foto_chat'])): ?>
                                            <?php else: ?>

                                                <div class="d-flex justify-content-center">

                                                    <?php
                                                    $filePath = './public/img/chat/' . $chat['foto_chat'];
                                                    if (file_exists($filePath)) {
                                                        $mimeType = mime_content_type($filePath);
                                                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                        if (stripos($mimeType, 'image') !== false): ?>
                                                            <img src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" class="img-fluid rounded card-neoraised border border-1 border-dark" alt="Foto Chat" height="500" width="500">
                                                        <?php elseif (stripos($mimeType, 'video') !== false): ?>
                                                            <video class="img-fluid rounded card-neoraised border border-1 border-dark" controls>
                                                                <source src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" type="video/<?= $fileExtension ?>">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php elseif (stripos($mimeType, 'audio') !== false): ?>
                                                            <audio class="rounded card-neoraised border border-1 border-dark rounded-5" controls>
                                                                <source src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" type="audio/<?= $fileExtension ?>">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        <?php else: ?>
                                                            <a href="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none mt-3 mb-1 card-neoraised border border-1 border-dark py-4 px-4 rounded">
                                                                <i class="bi bi-download me-1"></i> Unduh file <i class="bi bi-file-earmark text-secondary"></i>
                                                            </a>
                                                        <?php endif;
                                                    } else { ?>
                                                        <p class="text-muted text-black">File telah dihapus.</p>
                                                    <?php } ?>

                                                </div>

                                            <?php endif; ?>

                                            <p class="card-text mt-lg-3 mt-0 text-black"><?= nl2br($chat['pesan']) ?></p>



                                            <p class="card-text text-end text-black"><small class="fw-light text-black"><?= $chat['tanggal_kirim'] ?> <i class="bi bi-check-circle-fill text-success card-neoraised rounded-circle mb-3" style="width: 75px; height: 75px;"></i></small></p>

                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>
                                <!-- Pesan Admin -->
                                <div class="row">
                                    <div class="col-10 col-lg-6 mb-4 ms-auto">
                                        <div class="card-body card-neoraised border border-2 border-dark rounded-3">
                                            <div class="mb-3">
                                                <img src="<?= empty($chat['foto_admin']) ? base_url('public/img/admin/deleted.jpg') : base_url('public/img/admin/' . $chat['foto_admin']) ?>" class="rounded-circle border border-2 border-dark card-neoraised me-2 mb-2" width="40" alt="<?= $chat['nama_admin'] ?>">


                                                <?php $nama = $chat['nama_admin'] ?? ''; ?>
                                                <?php if (strlen($nama) > 50) { ?>
                                                    <?php $nama = wordwrap($nama, 50, "<br>\n"); ?>
                                                <?php } ?>
                                                <span class="badge rounded-pill bg-danger card-neoraised border border-1 border-dark"> <?php if ($chat['id_admin'] == 1165): ?>
                                                        <a href="<?= base_url('akun/admin/bot') ?>" class="text-decoration-none text-white"><?= $nama ?></a>
                                                    <?php else: ?><a href="<?= base_url('akun/admin/' . $chat['nama_admin']) ?>" class="text-decoration-none text-white"><?= $nama ?></a><?php endif; ?></span>
                                            </div>
                                            <?php if (empty($chat['foto_chat'])): ?>
                                            <?php else: ?>
                                                <div class="d-flex justify-content-center">
                                                    <?php
                                                    $filePath = './public/img/chat/' . $chat['foto_chat'];
                                                    if (file_exists($filePath)) {
                                                        $mimeType = mime_content_type($filePath);
                                                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                        if (stripos($mimeType, 'image') !== false): ?>
                                                            <img src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" class="img-fluid rounded card-neoraised border border-1 border-dark" alt="Foto Chat" height="500" width="500">
                                                        <?php elseif (stripos($mimeType, 'video') !== false): ?>
                                                            <video class="img-fluid rounded card-neoraised border border-1 border-dark" controls>
                                                                <source src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" type="video/<?= $fileExtension ?>">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php elseif (stripos($mimeType, 'audio') !== false): ?>
                                                            <audio class="rounded card-neoraised border border-1 border-dark rounded-5" controls>
                                                                <source src="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" type="audio/<?= $fileExtension ?>">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        <?php else: ?>
                                                            <a href="<?= base_url('public/img/chat/' . $chat['foto_chat']) ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none mt-3 mb-1 card-neoraised border border-1 border-dark py-4 px-4 rounded">
                                                                <i class="bi bi-download me-1"></i> Unduh file <i class="bi bi-file-earmark text-secondary"></i>
                                                            </a>
                                                        <?php endif;
                                                    } else { ?>
                                                        <p class="text-muted text-black">File telah dihapus.</p>
                                                    <?php } ?>
                                                </div>
                                                <?php if ($this->session->userdata('nama_admin') === $chat['nama_admin']): ?>

                                                    <div class="d-flex justify-content-end mt-2">
                                                        <button type="button" class="btn btn-neoraised btn-danger btn-sm ms-2 mt-auto mb-auto rounded-circle border border-1 border-dark" onclick="confirmDeleteFile('<?= $chat['id_chat'] ?>')">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                        <script>
                                                            function confirmDeleteFile(id) {
                                                                const confirmBox = confirm("Anda yakin ingin menghapus file?");
                                                                if (confirmBox) {
                                                                    window.location.href = "<?= base_url('chatting/hapusFile_admin/' . $chat['id_chat']) ?>";
                                                                } else {
                                                                    return false;
                                                                }
                                                            }
                                                        </script>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <p class="card-text mt-lg-3 mt-0 text-black"><?= nl2br($chat['pesan']) ?></p>
                                            <?php if ($this->session->userdata('nama_admin') === $chat['nama_admin']): ?>

                                                <!-- Dropdown for actions -->
                                                <div class="d-flex justify-content-start gap-3 mt-3">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm border border-1 border-dark card-neoraised dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu border border-1 border-dark" aria-labelledby="dropdownMenuButton">
                                                            <li>
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal<?= $chat['id_chat'] ?>"><i class="bi bi-pencil-fill"></i> Edit</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="<?= base_url('chatting/delete_admin/' . $chat['id_chat']) ?>" onclick="return confirm('Yakin ingin menghapus pesan?')"><i class="bi bi-trash-fill"></i> Hapus</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="modal fade border border-1 border-dark" id="editModal<?= $chat['id_chat'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $chat['id_chat'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content card-neoraised border border-dark border-3">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bolder text-black" id="editModalLabel<?= $chat['id_chat'] ?>">Edit Pesan</h5>
                                                            <button type="button" class="btn-close text-black fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url('chatting/edit_admin/' . $chat['id_chat']) ?>" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="userComment<?= $chat['id_chat'] ?>" class="form-label text-black">Edit Pesan:</label>
                                                                    <textarea id="userComment<?= $chat['id_chat'] ?>" name="message" class="form-control card-neoraised text-black border border-2 border-dark" rows="4" style="resize: none;"><?= $chat['pesan'] ?></textarea>
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <label for="imageUpload<?= $chat['id_chat'] ?>" class="form-label text-black">Upload File:</label>
                                                                    <input type="file" id="imageUpload<?= $chat['id_chat'] ?>" name="image" class="form-control card-neoraised text-black border border-2 border-dark" onchange="previewFile(<?= $chat['id_chat'] ?>)">
                                                                </div>

                                                                <!-- Preview Section -->
                                                                <div id="previewContainer<?= $chat['id_chat'] ?>" class="mt-3">
                                                                    <img id="imagePreview<?= $chat['id_chat'] ?>" class="d-none img-fluid rounded" alt="Image Preview">
                                                                    <video id="videoPreview<?= $chat['id_chat'] ?>" class="d-none w-100 rounded" controls>
                                                                        <source id="videoSource<?= $chat['id_chat'] ?>" src="">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                    <audio id="audioPreview<?= $chat['id_chat'] ?>" class="d-none w-100" controls>
                                                                        <source id="audioSource<?= $chat['id_chat'] ?>" src="">
                                                                        Your browser does not support the audio tag.
                                                                    </audio>
                                                                    <div id="fileInfoPreview<?= $chat['id_chat'] ?>" class="d-none border p-3 rounded">
                                                                        <p><i class="bi bi-file-text"></i> <span id="fileName<?= $chat['id_chat'] ?>"></span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-neoraised fw-bold border border-1 border-dark" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary btn-neoraised fw-bold border border-1 border-dark">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function previewFile(chatId) {
                                                    const fileInput = document.getElementById(`imageUpload${chatId}`);
                                                    const file = fileInput.files[0];

                                                    // Referensi elemen pratinjau berdasarkan ID modal
                                                    const imagePreview = document.getElementById(`imagePreview${chatId}`);
                                                    const videoPreview = document.getElementById(`videoPreview${chatId}`);
                                                    const videoSource = document.getElementById(`videoSource${chatId}`);
                                                    const audioPreview = document.getElementById(`audioPreview${chatId}`);
                                                    const audioSource = document.getElementById(`audioSource${chatId}`);
                                                    const fileInfoPreview = document.getElementById(`fileInfoPreview${chatId}`);
                                                    const fileNameElement = document.getElementById(`fileName${chatId}`);

                                                    // Sembunyikan semua elemen pratinjau awalnya
                                                    imagePreview.classList.add('d-none');
                                                    videoPreview.classList.add('d-none');
                                                    audioPreview.classList.add('d-none');
                                                    fileInfoPreview.classList.add('d-none');

                                                    if (file) {
                                                        const fileType = file.type;

                                                        if (fileType.startsWith('image/')) {
                                                            // Pratinjau gambar
                                                            const reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                imagePreview.src = e.target.result;
                                                                imagePreview.classList.remove('d-none');
                                                            };
                                                            reader.readAsDataURL(file);
                                                        } else if (fileType.startsWith('video/')) {
                                                            // Pratinjau video
                                                            const fileURL = URL.createObjectURL(file);
                                                            videoSource.src = fileURL;
                                                            videoPreview.load();
                                                            videoPreview.classList.remove('d-none');
                                                        } else if (fileType.startsWith('audio/')) {
                                                            // Pratinjau audio
                                                            const fileURL = URL.createObjectURL(file);
                                                            audioSource.src = fileURL;
                                                            audioPreview.load();
                                                            audioPreview.classList.remove('d-none');
                                                        } else {
                                                            // Pratinjau file lainnya
                                                            fileNameElement.textContent = file.name;
                                                            fileInfoPreview.classList.remove('d-none');
                                                        }
                                                    }
                                                }
                                            </script>

                                            <p class="card-text text-end"><small class="fw-light text-dark"><i class="bi bi-check-circle-fill text-success me-2 card-neoraised rounded-circle mb-3" style="width: 75px; height: 75px;"></i><?= $chat['tanggal_kirim'] ?> </small></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-12 mt-4 ms-auto">
            <form method="POST" action="<?= base_url('chatting/send_message_admin/' . $chat['id_user']) ?>" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <textarea class="form-control card-neoraised border border-2 border-dark text-black" name="message" rows="2" placeholder="Tulis pesan..." aria-label="Tulis pesan" style="resize: none;"></textarea>
                    <button class="btn btn-primary btn-neoraised fw-bold border border-2 border-dark" type="submit">Kirim</button>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-success btn-neoraised dropdown-toggle fw-bold border border-2 border-dark" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Upload File
                    </button>
                    <ul class="dropdown-menu card-neoraised px-3 border border-dark border-2 w-100" aria-labelledby="dropdownMenuButton">
                        <li>
                            <input type="file" name="image" class="form-control-file card-neoraised border border-2 border-dark rounded-3" style="width: 100%;" onchange="previewSelectedFile(event)">
                        </li>
                        </li>
                        <li class="mt-3 mb-3">
                            <!-- Preview Container -->
                            <div id="previewContainer" class="d-flex flex-column align-items-center">
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded d-none border border-2 border-dark card card-neoraised" width="250" height="250">
                                <video id="videoPreview" controls class="img-fluid rounded d-none border border-2 border-dark card card-neoraised" width="250" height="250">
                                    <source id="videoSource" src="#" type="video/mp4" class="card card-neoraised border border-1 border-dark">
                                    Your browser does not support the video tag.
                                </video>
                                <audio id="audioPreview" controls class="d-none card-neoraised border border-2 border-dark rounded-5">
                                    <source id="audioSource" src="#" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                                <!-- Icon and File Name Preview -->
                                <div id="fileInfoPreview" class="d-none text-center mt-3 card-neoraised border border-2 border-dark rounded py-4 px-4">
                                    <i class="bi bi-file-earmark fs-1 text-secondary"></i>
                                    <p id="fileName" class="fw-bold text-black mt-2"></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <script>
                    function previewSelectedFile(event) {
                        const fileInput = event.target;
                        const file = fileInput.files[0];
                        const previewContainer = document.getElementById('previewContainer');

                        // Get all preview elements
                        const imagePreview = document.getElementById('imagePreview');
                        const videoPreview = document.getElementById('videoPreview');
                        const videoSource = document.getElementById('videoSource');
                        const audioPreview = document.getElementById('audioPreview');
                        const audioSource = document.getElementById('audioSource');
                        const fileInfoPreview = document.getElementById('fileInfoPreview');
                        const fileNameElement = document.getElementById('fileName');

                        // Hide all preview elements initially
                        imagePreview.classList.add('d-none');
                        videoPreview.classList.add('d-none');
                        audioPreview.classList.add('d-none');
                        fileInfoPreview.classList.add('d-none');

                        if (file) {
                            const fileType = file.type;

                            if (fileType.startsWith('image/')) {
                                // If the file is an image
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    imagePreview.src = e.target.result;
                                    imagePreview.classList.remove('d-none');
                                };
                                reader.readAsDataURL(file);
                            } else if (fileType.startsWith('video/')) {
                                // If the file is a video
                                const fileURL = URL.createObjectURL(file);
                                videoSource.src = fileURL;
                                videoPreview.load(); // Reload video with new source
                                videoPreview.classList.remove('d-none');
                            } else if (fileType.startsWith('audio/')) {
                                // If the file is an audio
                                const fileURL = URL.createObjectURL(file);
                                audioSource.src = fileURL;
                                audioPreview.load(); // Reload audio with new source
                                audioPreview.classList.remove('d-none');
                            } else {
                                // For other file types, show file info with icon
                                fileNameElement.textContent = file.name; // Display the file name
                                fileInfoPreview.classList.remove('d-none');
                            }
                        }
                    }
                </script>

        </div>
    </div>
</div>