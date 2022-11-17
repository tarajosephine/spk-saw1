<!-- Start Content-->
<div class="container-fluid">
    <?php foreach ($peserta as $p) : ?>
    <input type="hidden" id="_idpeserta" name="_idpeserta" value="<?= $idDetail; ?>">
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
                <h4 class="page-title">Detail Data Peserta</h4>
            </div>
        </div>
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-xxl-8 col-xl-7">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">

                    <div class="clearfix"></div>

                    <h3 class="mt-3">Nama Usaha</h3>

                    <div class="row">
                        <div class="col-6">
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Pemilik</p>
                            <div class="d-flex">
                                <div>
                                    <h5 class="mt-1 font-14">
                                        <?= $p['nama_peserta']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Alamat</p>
                            <div class="d-flex">
                                <i class='uil uil-map-marker font-18 text-info me-1'></i>
                                <div>
                                    <h5 class="mt-1 font-14">
                                        <?= $p['alamat']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Jenis Usaha</p>
                            <div class="d-flex">
                                <div>
                                    <h5 class="mt-1 font-14">
                                        <?= $p['nama_usaha']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Sub Jenis Usaha</p>
                            <div class="d-flex">
                                <div>
                                    <h5 class="mt-1 font-14">
                                        <?= $p['nama_sub']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Nomor telepon</p>
                            <div class="d-flex">
                                <div>
                                    <h5 class="mt-1 font-14">
                                        <?= $p['no_telpon']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase">Sosial Media</p>

                            <?php if ($sosial_media) : ?>
                            <?php foreach ($sosial_media as $sm) : ?>
                            <li>
                                <tr>
                                    <td>
                                        <?= $sm['nama_sosmed']; ?> :
                                    </td>

                                    <td>
                                        <a href="<?= $sm['url']; ?>">
                                            <?= $sm['akun']; ?>
                                        </a>
                                    </td>

                                    <td>
                                        <button class="btn btn-light btn-sm" data-toggle="modal"
                                            data-target="#tambahSosmed" data-id="<?= $sm['id_sm']; ?> :"
                                            onclick="editSosialMedia(`<?= $sm['id_sm']; ?> :`)">
                                            <i class="mdi mdi-account-edit"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm" data-toggle="modal"
                                            data-target="#deleteSosmedModal" data-id="<?= $sm['id_sm']; ?> :"
                                            onclick="deleteSosialMedia(`<?= $sm['id_sm']; ?> :`)">
                                            <i class="mdi mdi-delete me-1"></i>
                                        </button>
                                    </td>

                                </tr>
                            </li>

                            <?php endforeach; ?>
                            <?php else : ?>
                            <li>
                                <tr>
                                    <td>
                                        Tidak Ada
                                    </td>
                                </tr>
                            </li>
                            <?php endif; ?>
                            <br>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahSosmed"
                                data-id="<?= $idDetail; ?>" onclick="sosialMedia(`<?= $idDetail; ?>`)">Tambah Sosial
                                Media</button>
                        </div>
                    </div>

                    <h5 class="mt-3">Detail data lain:</h5>
                    <?php foreach ($peserta as $du) : ?>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Nama Usaha :
                            </p>
                            <p class="text-muted mb-2">
                                <?= $du['nu_peserta']; ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Alamat Usaha :
                            </p>
                            <p class="text-muted mb-2">
                                <i class='uil uil-map-marker font-18 text-info me-1'></i> <?= $du['alamat_usaha']; ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Kelurahan :
                            </p>
                            <p class="text-muted mb-2">
                                <?= $du['nama_desa']; ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Kecamatan :
                            </p>
                            <p class="text-muted mb-2">
                                <?= $du['nama_kec']; ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Jumlah Karyawan :
                            </p>
                            <p class="text-muted mb-2">
                                Pria : <?= $du['jml_pria']; ?> Orang, Wanita : <?= $du['jml_wanita']; ?> Orang
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Omset :
                            </p>
                            <p class="text-muted mb-2">
                                <?= rupiah($du['omset']); ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Modal Mandiri :
                            </p>
                            <p class="text-muted mb-2">
                                <?= rupiah($du['modal_mandiri']); ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Kapasitas Produksi :
                            </p>
                            <p class="text-muted mb-2">
                                <?= number_format($du['kapasitas_produksi']); ?> <?= $du['satuan']; ?>
                            </p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted mb-2">
                                Modal Luar :
                            </p>
                            <p class="text-muted mb-2">
                                <?= rupiah($du['modal_luar']); ?>
                            </p>
                        </div>

                        <?php endforeach; ?>
                    </div>

                    <h5 class="mt-3">Detail data Pelatihan:</h5>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatablePelatihane" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Pelatihan</th>
                                        <th scope="col">Tanggal Pelatihan</th>
                                        <th scope="col">Waktu Pelatihan</th>
                                        <th scope="col">Tempat</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <!-- start sub tasks/checklists -->
                    <h5 class="mt-4 mb-2 font-16">Kelengkapan data :</h5>
                    <p style="font-style: italic;">Data yang sudah ada akan tercentang, jika belum maka belum tercentang
                    </p>

                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="checklist1" disabled>
                        <label class="text form-check-label strikethrough" for="checklist1"></label>
                        <label>Berkas KTP</label>
                    </div>

                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="checklist2" disabled>
                        <label class="form-check-label strikethrough" for="checklist2"></label>
                        <label>Berkas Sertifikat</label>
                    </div>

                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="checklist3" disabled>
                        <label class="form-check-label strikethrough" for="checklist3"></label>
                        <label>Berkas Nomor Ijin Berusaha (NIB)</label>
                    </div>

                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="checklist4" disabled>
                        <label class="form-check-label strikethrough" for="checklist4"></label>
                        <label>Berkas PRIT</label>
                    </div>

                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="checklist5" disabled>
                        <label class="form-check-label strikethrough" for="checklist5"></label>
                        <label>Berkas NPWP</label>
                    </div>

                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="checklist6" disabled>
                        <label class="form-check-label strikethrough" for="checklist6"></label>
                        <label>Logo Brand</label>
                    </div>
                    <!-- end sub tasks/checklists -->

                </div> <!-- end card-body-->

            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xxl-4 col-xl-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Lengkapi data peserta</h5>
                    <?= form_open_multipart('peserta/uploadData'); ?>
                    <input type="hidden" name="id_v" id="id_v">
                    <input type="hidden" name="id_peserta" id="id_peserta" value="<?= $idDetail; ?>">
                    <div class="fallback dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
                        data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                        <label>KTP</label>
                        <input id="image_1" name="image_1" class="form-control mb-2" type="file">
                        <input type="hidden" id="img_1" name="img_1">
                        <label>SERTIFIKAT</label>
                        <input id="image_2" name="image_2" class="form-control mb-2" type="file">
                        <input type="hidden" id="img_2" name="img_2">
                        <label>NIB</label>
                        <input id="image_3" name="image_3" class="form-control mb-2" type="file">
                        <input type="hidden" id="img_3" name="img_3">
                        <label>PRIT</label>
                        <input id="image_4" name="image_4" class="form-control mb-2" type="file">
                        <input type="hidden" id="img_4" name="img_4">
                        <label>NPWP</label>
                        <input id="image_5" name="image_5" class="form-control mb-2" type="file">
                        <input type="hidden" id="img_5" name="img_5">
                        <label>BRAND</label>
                        <input id="image_6" name="image_6" class="form-control mb-2" type="file">
                        <input type="hidden" id="img_6" name="img_6">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                    </form>

                    <h5 class="card-title mt-3 mb-2">Data yang sudah lengkap</h5>

                    <div class="upload_img"></div>
                    <div class="upload_img1"></div>
                    <div class="upload_img2"></div>
                    <div class="upload_img3"></div>
                    <div class="upload_img4"></div>
                    <div class="upload_img5"></div>
                    <div class="upload_img6"></div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div id="tambahSosmed" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="SosialMediaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="SosialMediaModalLabel">Tambah sosial media</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="POST">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_peserta" id="id_peserta">
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <select class="form-select" id="floatingSosmed" name="nama_sosmed"
                                aria-label="Floating label select example">
                                <option selected>Pilih Sosmed</option>
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                            </select>
                            <label for="floatingSosmed">Sosmed</label>
                        </div>

                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingURL" name="url"
                                placeholder="Masukan alamat" />
                            <label for="floatingURL">URl sosmed</label>
                        </div>

                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingAkun" name="akun"
                                placeholder="Masukan no telp" />
                            <label for="floatingAkun">Nama Sosmed</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteSosmedModal" tabindex="-1" role="dialog" aria-labelledby="SosmedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SosmedModalLabel">Apakah benar ingin di hapus?</h5>
                    <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                    </button>
                </div>
                <div class="modal-body">Pilih tombol hapus untuk menghapus data ini.</div>
                <form method="POST">
                    <input type="hidden" name="id_s" id="id_s">
                    <input type="hidden" name="id_pesertas" id="id_pesertas">
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
</div>
<!-- end container -->

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    const idedit = document.getElementById('_idpeserta').value;
    t = $('#datatablePelatihane').DataTable({
        "deferLoading": 57,
        pageLength: 5,
        lengthMenu: [10, 20, 50, 100],
        aaSorting: [
            [5, "desc"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        ajax: {
            "url": "<?= base_url(); ?>peserta/getDataPelatihanModal/" + idedit,
            "type": "POST"
        },
        order: [
            [0, 'asc']
        ],
        columnsDefs: [{
            target: [-1],
            orderable: false
        }],
        columns: [{
                "data": 'no',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "nama_kegiatan",
            },
            {
                "data": "tgl_pelatihan"
            },
            {
                "data": "waktu_pelatihan"
            },
            {
                "data": "tempat"
            }
        ],
        "processing": true,
        serverSide: true,
        "retrieve": true,
    });

    t.on('order.dt search.dt', function() {
        let i = 1;

        t.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();

    setInterval(function() {
        $.ajax({
            url: "<?= base_url(); ?>peserta/getUploadDataModal",
            data: {
                id: idedit,
            },
            method: "POST",
            dataType: "json",
            success: function(data) {
                if (data) {
                    $(".upload_img").html('');
                    if (data.nib) {
                        $("#checklist1").attr("checked", true);
                        $("#img_1").val(data.nib);
                        $(".upload_img1").html(`
                            <label>Berkas Nomor Ijin Berusaha (NIB)</label>
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= base_url(); ?>assets/images/data-peserta/${data.nib}" class="avatar-sm rounded" alt="file-image">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">${data.nib}</a>
                                            <p class="mb-0">Sukses</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a type="button" class="btn btn-link btn-lg text-muted" href="<?= base_url(); ?>assets/images/data-peserta/${data.nib}" download="${data.nib}">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                    } else {
                        $("#checklist1").attr("checked", false);
                        $("#img_1").val("");
                        $(".upload_img1").html('');
                    }

                    if (data.prit) {
                        $("#checklist2").attr("checked", true);
                        $("#img_2").val(data.prit);
                        $(".upload_img2").html(`
                            <label>Berkas PRIT</label>
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= base_url(); ?>assets/images/data-peserta/${data.prit}" class="avatar-sm rounded" alt="file-image">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">${data.prit}</a>
                                            <p class="mb-0">Sukses</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a type="button" class="btn btn-link btn-lg text-muted" href="<?= base_url(); ?>assets/images/data-peserta/${data.prit}" download="${data.prit}">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                    } else {
                        $("#checklist2").attr("checked", false);
                        $("#img_2").val("");
                        $(".upload_img2").html('');
                    }

                    if (data.sertivikat) {
                        $("#checklist3").attr("checked", true);
                        $("#img_3").val(data.sertivikat);
                        $(".upload_img3").html(`
                            <label>Berkas Sertivikat</label>
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= base_url(); ?>assets/images/data-peserta/${data.sertivikat}" class="avatar-sm rounded" alt="file-image">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">${data.sertivikat}</a>
                                            <p class="mb-0">Sukses</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a type="button" class="btn btn-link btn-lg text-muted" href="<?= base_url(); ?>assets/images/data-peserta/${data.sertivikat}" download="${data.sertivikat}">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                    } else {
                        $("#checklist3").attr("checked", false);
                        $("#img_3").val("");
                        $(".upload_img3").html('');
                    }

                    if (data.npwp) {
                        $("#checklist4").attr("checked", true);
                        $("#img_4").val(data.npwp);
                        $(".upload_img4").html(`
                            <label>Berkas NPWP</label>
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= base_url(); ?>assets/images/data-peserta/${data.npwp}" class="avatar-sm rounded" alt="file-image">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">${data.npwp}</a>
                                            <p class="mb-0">Sukses</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a type="button" class="btn btn-link btn-lg text-muted" href="<?= base_url(); ?>assets/images/data-peserta/${data.npwp}" download="${data.npwp}">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                    } else {
                        $("#checklist4").attr("checked", false);
                        $("#img_4").val("");
                        $(".upload_img4").html('');
                    }

                    if (data.ktp) {
                        $("#checklist5").attr("checked", true);
                        $("#img_5").val(data.ktp);
                        $(".upload_img5").html(`
                            <label>Berkas KTP</label>
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= base_url(); ?>assets/images/data-peserta/${data.ktp}" class="avatar-sm rounded" alt="file-image">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">${data.ktp}</a>
                                            <p class="mb-0">Sukses</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a type="button" class="btn btn-link btn-lg text-muted" href="<?= base_url(); ?>assets/images/data-peserta/${data.ktp}" download="${data.ktp}">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                    } else {
                        $("#checklist5").attr("checked", false);
                        $("#img_5").val("");
                        $(".upload_img5").html('');
                    }

                    if (data.brand) {
                        $("#checklist6").attr("checked", true);
                        $("#img_6").val(data.brand);
                        $(".upload_img6").html(`
                            <label>Berkas Logo Brand</label>
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= base_url(); ?>assets/images/data-peserta/${data.brand}" class="avatar-sm rounded" alt="file-image">
                                        </div>
                                        <div class="col ps-0">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">${data.brand}</a>
                                            <p class="mb-0">Sukses</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a type="button" class="btn btn-link btn-lg text-muted" href="<?= base_url(); ?>assets/images/data-peserta/${data.brand}" download="${data.brand}">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                    } else {
                        $("#checklist6").attr("checked", false);
                        $("#img_6").val("");
                        $(".upload_img6").html('');
                    }
                } else {
                    console.log(data + "data tidak masuk");
                    $(".upload_img").html(`
                        <label>Berkas Logo Brand</label>
                        <div class="card mb-1 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="<?= base_url(); ?>assets/images/sialng.png" class="avatar-sm rounded" alt="file-image">
                                    </div>
                                    <div class="col ps-0">
                                        <a href="javascript:void(0);" class="text-muted fw-bold">Data Tidak Ada</a>
                                        <p class="mb-0">Kosong</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `);
                }
            },
        });

    }, 2000);
});
</script>