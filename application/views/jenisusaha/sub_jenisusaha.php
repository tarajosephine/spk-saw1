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
                <h4 class="page-title">MENU SUB JENIS USAHA</h4>
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
                        Menu ini digunakan untuk managemen data Sub jenis usaha. user dapat menambahkan, mengedit dan menghapus data jenis usaha.
                    </p>
                    <?= form_error('message_subjenisUsaha', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
                    <?= $this->session->flashdata('message_subjenisUsaha'); ?>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubJenisUsaha" onclick="addSubJenisUsaha()">Tambah Data Sub Jenis Usaha</button>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Sub Usaha</th>
                                        <th scope="col">Jenis Usaha</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($sub_ju as $subju) : ?>
                                        <tr>
                                            <td scope="row"><?= $i; ?></td>
                                            <td><?= $subju['nama_sub']; ?></td>
                                            <td><?= $subju['nama_usaha']; ?></td>
                                            <td>
                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <!-- item-->
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#newSubJenisUsaha" data-id="<?= $subju['id_subju']; ?>" onclick="editSubJenisUsaha(`<?= $subju['id_subju']; ?>`)"><i class="mdi mdi-pencil me-1"></i> Edit </button>
                                                        <!-- item-->
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#deleteSubJenisUsahaModal" data-id="<?= $subju['id_subju']; ?>" onclick="deleteSubJenisUsaha(`<?= $subju['id_subju']; ?>`)"><i class="mdi mdi-delete me-1"></i> Hapus </button>
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
<div class="modal fade" id="newSubJenisUsaha" tabindex="-1" role="dialog" aria-labelledby="SubJenisUsahaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubJenisUsahaModalLabel">Tambah Sub Jenis Usaha Baru</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                </button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">

                    <div class="mb-2">
                        <div class="form-floating">
                            <select class="form-select" id="floatingid_jenis" name="id_jenis" aria-label="Floating label select example">
                                <option selected>Pilih menu</option>
                                <?php foreach ($jenis_usaha as $ju) : ?>
                                    <option value="<?= $ju['id_ju']; ?>"><?= $ju['nama_usaha']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="floatingJenisUsaha">Jenis Usaha</label>
                        </div>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="nama_subjenisusaha" placeholder="Masukan nama sub jenis usaha" />
                        <label for="floatingInput">Nama Sub Jenis Usaha</label>
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" name="keterangan" id="floatingKeterangan" cols="30" rows="10"></textarea>
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
<div class="modal fade" id="deleteSubJenisUsahaModal" tabindex="-1" role="dialog" aria-labelledby="SubJenisUsahaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubJenisUsahaModalLabel">Apakah benar ingin di hapus?</h5>
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