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
                <h4 class="page-title">MENU DATA KECAMATAN</h4>
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
                        Menu ini digunakan untuk managemen menu kecamatan yang ada di kota pekalongan
                    </p>
                    <?= form_error('kecamatan', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
                    <?= $this->session->flashdata('message_kecamatan'); ?>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKecModal" onclick="addKec()">Tambah Data Kecamatan</button>
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kecamatan as $kec) : ?>
                                <tr>
                                    <td scope="row"><?= $i; ?></td>
                                    <td><?= $kec['nama_kec']; ?></td>
                                    <td>
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical font-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <button class="dropdown-item" data-toggle="modal" data-target="#newKecModal" data-id="<?= $kec['id_kec']; ?>" onclick="editKec(`<?= $kec['id_kec']; ?>`)"><i class="mdi mdi-pencil me-1"></i> Edit </button>
                                                <!-- item-->
                                                <button class="dropdown-item" data-toggle="modal" data-target="#deleteKecModal" data-id="<?= $kec['id_kec']; ?>" onclick="deleteKec(`<?= $kec['id_kec']; ?>`)"><i class="mdi mdi-delete me-1"></i> Hapus </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

</div>
<!-- container -->

<!-- Modal -->
<div class="modal fade" id="newKecModal" tabindex="-1" role="dialog" aria-labelledby="KecModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="KecModalLabel">Tambah Data Kecamatan Baru</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                </button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="nama_kec" placeholder="Masukan nama kecamatan" />
                        <label for="floatingInput">Nama Kecamatan</label>
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
<div class="modal fade" id="deleteKecModal" tabindex="-1" role="dialog" aria-labelledby="KecModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="KecModalLabel">Apakah benar ingin di hapus?</h5>
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