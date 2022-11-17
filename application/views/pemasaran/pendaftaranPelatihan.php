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
                <h4 class="page-title">MENU UTAMA</h4>
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
                        The Buttons extension for DataTables provides a common set of options, API methods and styling
                        to display buttons on a page
                        that will interact with a DataTable. The core library provides the based framework upon which
                        plug-ins can built.
                    </p>
                    <?= form_error('pendaftaranPelatihan', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
                    <?= $this->session->flashdata('message_pendaftaranPelatihan'); ?>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPPModal"
                        onclick="addPP()">Tambah Data Peserta</button>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Peserta</th>
                                        <th scope="col">Nama Usaha</th>
                                        <th scope="col">Tanggal Pendaftaran</th>
                                        <th scope="col">Nama Kegiatan</th>
                                        <th scope="col">Tanggal Pelatihan</th>
                                        <th scope="col">Waktu Pelatihan</th>
                                        <th scope="col">Tempat Pelatihan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pendaftaran as $p) : ?>
                                    <tr>
                                        <td scope="row"><?= $i; ?></td>
                                        <td><?= $p['nama_peserta']; ?></td>
                                        <td><?= $p['nama_usaha']; ?></td>
                                        <td><?= $p['tgl_pendaftaran']; ?></td>
                                        <td><?= $p['nama_kegiatan']; ?></td>
                                        <td><?= $p['tgl_pelatihan']; ?></td>
                                        <td><?= $p['waktu_pelatihan']; ?></td>
                                        <td><?= $p['tempat']; ?></td>
                                        <td>
                                            <div class="dropdown float-end">
                                                <a href="#" class="dropdown-toggle text-muted arrow-none"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-18"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <button class="dropdown-item" data-toggle="modal"
                                                        data-target="#newPPModal" data-id="<?= $p['id_pendaftaran']; ?>"
                                                        onclick="editPP(`<?= $p['id_pendaftaran']; ?>`)"><i
                                                            class="mdi mdi-pencil me-1"></i> Edit </button>
                                                    <!-- item-->
                                                    <button class="dropdown-item" data-toggle="modal"
                                                        data-target="#deletePPModal"
                                                        data-id="<?= $p['id_pendaftaran']; ?>"
                                                        onclick="deletePP(`<?= $p['id_pendaftaran']; ?>`)"><i
                                                            class="mdi mdi-delete me-1"></i> Hapus </button>
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
<div class="modal fade" id="newPPModal" tabindex="-1" role="dialog" aria-labelledby="PPModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PPModalLabel">Tambah Pendaftaran Pelatihan Baru</h5>
                <button onclick="javascript:void(0);" class="btn btn-close" data-dismiss="modal"></button>
            </div>
            <input type="hidden" name="id" id="id">
            <div class="modal-body">
                <h5 class="mt-0">Pilih Pelatihan</h5>
                <p>Pilih pelatihan mana yang akan di inputkan peserta pelatihan</p>
                </p>
                <?php foreach ($pelatihan as $p) : ?>
                <a href="<?php echo base_url() . 'pemasaran/createPendafataranPelatihan/' . $p['id_p'] . '/' . $p['id_ju']; ?>"
                    class="btn btn-primary btn-lg mb-2"> <?= $p['nama_kegiatan']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deletePPModal" tabindex="-1" role="dialog" aria-labelledby="deletePPModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePPModalLabel">Apakah benar ingin di hapus?</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal">
                    <i class="dripicons-cross noti-icon"></i>
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