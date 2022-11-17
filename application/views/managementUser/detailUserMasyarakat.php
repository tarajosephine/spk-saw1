<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php foreach ($User_masyarakatById as $user) : ?>
        <!-- Page Heading -->
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
        <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#newPemiluPindahModal" data-id="<?= $user['id']; ?>" onclick="pengajuanSuratPindah(`<?= $user['id']; ?>`)">Setting User Admin</button>

        <div class="row">

            <div class="col-lg-6">
                <div class="card shadow mb-4 border-bottom-success">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail User Masyarakat</h6>
                    </div>
                    <div class="card-body">
                        <p>Data diri Masyarakat.</p>
                        <div class="mb-2">
                            <label class="small font-weight-bold" for="nama">NIK</label>
                            <p><?= $user['nik']; ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="nama">Nama Lengkap</label>
                            <p><?= $user['nama_lengkap']; ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="username">Username</label>
                            <p><?= $user['username']; ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="email">Email</label>
                            <p><?= $user['email']; ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="role">Jenis Kelamin</label>
                            <p><?= $user['jekel']; ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="role">Tanggal Lahir</label>
                            <p><?= tgl_indo2($user['tgl_lahir']); ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="role">Telpon</label>
                            <p><?= $user['phone']; ?></p>
                        </div>
                        <div class="mt-4 mb-2">
                            <label class="small font-weight-bold" for="nik">User Active</label>
                            <?php if ($user['is_active'] == 1) { ?>
                                <p>Active</p>
                            <?php } else { ?>
                                <p>Non Active</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="card shadow mb-4 border-bottom-success">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gambar User</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="small font-weight-bold" for="nik">Profile</label>
                            </div>
                            <img src="<?= base_url('assets/img/profile_masyarakat/') . $user['image']; ?>" class="card-img mx-auto d-block">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <?php endforeach; ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newPemiluPindahModal" tabindex="-1" role="dialog" aria-labelledby="PemiluPindahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PemiluPindahModalLabel">Konfirmasi Pengajuan Pemilu Pindahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="id_user_kpu" id="id_user_kpu" value="<?= $user['id']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tps_pindah" name="tps_pindah" placeholder="Pindah TPS">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kelurahan_pindah" name="kelurahan_pindah" placeholder="Pindah Kelurahan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kecamatan_pindah" name="kecamatan_pindah" placeholder="Pindah Kecamatan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kota_kabupaten_pindah" name="kota_kabupaten_pindah" placeholder="Pindah Kota / Kabupaten">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>