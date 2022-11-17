<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                    </form>
                </div>
                <h4 class="page-title">MENU BIDANG USAHA</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title"><?= $title; ?></h4>
                    <p class="text-muted font-14">
                        Menu ini digunakan untuk managemen data jenis usaha. user dapat menambahkan, mengedit dan menghapus data jenis usaha.
                    </p>
                    <?= form_error('jenisUsaha', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
                    <?= $this->session->flashdata('message_jenisUsaha'); ?>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newJenisUsaha" onclick="addJenisUsaha()">Tambah Data Bidang Usaha</button>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($jenis_usaha as $ju) : ?>
                                        <tr>
                                            <td scope="row"><?= $i; ?></td>
                                            <td><?= $ju['nama_usaha']; ?></td>
                                            <td><?= $ju['keterangan']; ?></td>
                                            <td>
                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <!-- item-->
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#newJenisUsaha" data-id="<?= $ju['id_ju']; ?>" onclick="editJenisUsaha(`<?= $ju['id_ju']; ?>`)"><i class="mdi mdi-pencil me-1"></i> Edit </button>
                                                        <!-- item-->
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#deleteJenisUsahaModal" data-id="<?= $ju['id_ju']; ?>" onclick="deleteJenisUsaha(`<?= $ju['id_ju']; ?>`)"><i class="mdi mdi-delete me-1"></i> Hapus </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

</div>
<!-- container -->

<!-- Modal -->
<div class="modal fade" id="newJenisUsaha" tabindex="-1" role="dialog" aria-labelledby="JenisUsahaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="JenisUsahaModalLabel">Tambah Bidang Usaha Baru</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                </button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="nama_usaha" placeholder="Masukan nama jenis usaha" />
                        <label for="floatingInput">Nama Bidang Usaha</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingKeterangan" name="keterangan" placeholder="Masukan Keterangan" />
                        <label for="floatingKeterangan">Keterangan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteJenisUsahaModal" tabindex="-1" role="dialog" aria-labelledby="JenisUsahaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="JenisUsahaModalLabel">Apakah benar ingin di hapus?</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                </button>
            </div>
            <div class="modal-body">Pilih tombol hapus untuk menghapus data ini.</div>
            <form method="POST">
                <input type="hidden" name="id_s" id="id_s">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>