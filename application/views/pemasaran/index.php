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
                <h4 class="page-title">KEGIATAN</h4>
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
                        Menu ini digunakan untuk membuat data pelatihan pada bidang perdagangan di Dinas Perdagangan,
                        Koperasi dan UKM Kota Pekalongan. menu ini hanya digunakan untuk mendata pelatihan, adapun
                        pendafataran pelatihan dapat dilakukan pada menu lain.
                    </p>
                    <?= form_error('pelatihan', '<div class="alert alert-danger" role="alert">
                    ', '
                    </div>'); ?>
                    <?= $this->session->flashdata('message_pelatihan'); ?>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                        data-target="#newPelatihanModal" onclick="addPelatihan()">Tambah Baru Kegiatan</button>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatableKegiatan" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Kegiatan</th>
                                        <th scope="col">Tanggal Pelatihan</th>
                                        <th scope="col">Tanggal Selesai Pelatihan</th>
                                        <th scope="col">Waktu Pelatihan</th>
                                        <th scope="col">Tempat</th>
                                        <th scope="col">Kuota</th>
                                        <th scope="col">Nama Usaha</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
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
<div class="modal fade" id="newPelatihanModal" tabindex="-1" role="dialog" aria-labelledby="PelatihanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PelatihanModalLabel">Tambah Baru Pelatihan</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                </button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                            placeholder="Nama kegiatan" autofocus />
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="tgl_pelatihan" name="tgl_pelatihan"
                                    placeholder="Tanggal Pelatihan" />
                                <label for="tgl_pelatihan">Tanggal Pelatihan</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="tgl_selesai_p" name="tgl_selesai_p"
                                    placeholder="Tanggal Selesai Pelatihan" />
                                <label for="tgl_pelatihan">Tanggal Selesai Pelatihan</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <input type="time" class="form-control" id="waktu_mulai_pelatihan"
                                    name="waktu_mulai_pelatihan" placeholder="Waktu Mulai Pelatihan" />
                                <label for="waktu_pelatihan">Waktu Mulai Pelatihan</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <input type="time" class="form-control" id="waktu_akhir_pelatihan"
                                    name="waktu_akhir_pelatihan" placeholder="Waktu Akhir Pelatihan" />
                                <label for="waktu_pelatihan">Waktu Akhir Pelatihan</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat" />
                        <label for="tempat">Tempat</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="kuota" name="kuota" placeholder="Kuota" />
                        <label for="kuota">Kuota</label>
                    </div>

                    <div class="form-floating mb-2">
                        <select class="form-select" id="floatingJenisUsaha" name="jenis_usaha"
                            aria-label="Floating label select example">
                            <option selected>Pilih menu</option>
                            <?php foreach ($jenis_usaha as $ju) : ?>
                            <option value="<?= $ju['id_ju']; ?>"><?= $ju['nama_usaha']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingJenisUsaha">Jenis Usaha</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deletePelatihanModal" tabindex="-1" role="dialog" aria-labelledby="PelatihanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PelatihanModalLabel">Apakah benar ingin di hapus?</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
                </button>
            </div>
            <div class="modal-body">Pilih tombol hapus untuk menghapus data ini.</div>
            <form method="POST">
                <input type="hidden" name="id_s" id="id_s">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    t = $('#datatableKegiatan').DataTable({
        "deferLoading": 57,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        aaSorting: [
            [5, "desc"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print', 'pageLength'
        ],
        ajax: {
            "url": "<?= base_url(); ?>pemasaran/getDataKegiatanModal",
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
                "data": "tgl_selesai_p"
            },
            {
                "data": "waktu_pelatihan"
            },
            {
                "data": "tempat"
            },
            {
                "data": "kuota"
            },
            {
                "data": "nama_usaha"
            },
            {
                "data": "id_p",
                "render": function(data, type, row, meta) {
                    var html = "";
                    return `<td>
						<div class="dropdown float-end">
							<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="mdi mdi-dots-vertical font-18"></i>
							</a>
							<div id="Dataku" class="dropdown-menu dropdown-menu-end">
								<!-- item-->
								<button class="dropdown-item" data-toggle="modal" data-target="#newPelatihanModal" data-id="${row.id_p}"
									onclick="editPelatihan(${row.id_p})"><i class="mdi mdi-pencil me-1"></i> Edit </button>

								<!-- item-->
								<button class="dropdown-item" data-toggle="modal" data-target="#deletePelatihanModal"
									data-id="${row.id_p}" onclick="deletePelatihan(${row.id_p})"><i
										class="mdi mdi-delete me-1"></i> Hapus </button>
							</div>
						</div>
					</td>`;
                }
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
});
</script>