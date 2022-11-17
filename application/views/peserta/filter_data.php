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
                <h4 class="page-title">Filter Data Peserta</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xxl-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- <form action="/dashboard/laporan_transaksi" method="post"> -->
                        <div class="row gy-2 gx-2 align-items-center">
                            <h4>Filtering Data Pelaku Usaha UMKM</h4>
                            <h6 class="font-13 mt-3">Inputkan tanggal awal laporan dan tanggal akhir laporan</h6>
                            <div class="row g-2">

                                <div class="mb-3 col-md-3 form-floating">
                                    <select id="floatingKecamatan" class="form-select" name="kecamatan"
                                        aria-label="Floating label select example">
                                        <option>Pilih Kecamatan</option>
                                        <?php foreach ($kecamatan as $kec) : ?>
                                        <option value="<?= $kec['id_kec']; ?>"><?= $kec['nama_kec']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingKecamatan">Pilih Kecamatan</label>
                                </div>

                                <div class="mb-3 col-md-3 form-floating">
                                    <select class="form-select data_subdes" id="floatingDesa" name="desa"
                                        aria-label="Floating label select example">
                                    </select>
                                    <label for="floatingDesa">Pilih Kelurahan</label>
                                </div>

                                <div class="mb-3 col-md-3 form-floating">
                                    <select class="form-select" id="floatingJenisUsaha" name="jenis_usaha"
                                        aria-label="Floating label select example">
                                        <option selected>Pilih menu</option>
                                        <?php foreach ($jenis_usaha as $ju) : ?>
                                        <option value="<?= $ju['id_ju']; ?>"><?= $ju['nama_usaha']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingJenisUsaha">Jenis Usaha</label>
                                </div>

                                <div class="mb-3 col-md-3 form-floating">
                                    <select class="form-select data_subju" id="floatingsubJenisUsaha"
                                        name="subjenis_usaha" aria-label="Floating label select example">
                                    </select>
                                    <label for="floatingsubJenisUsaha">Sub Jenis Usaha</label>
                                </div>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="datatableFilter" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama usaha</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Jenis Usaha</th>
                                <th scope="col">Sub jenis usaha</th>
                                <th scope="col">Jumlah Kegiatan Yang diikuti</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


    <div id="tambahSosmed" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Tambah sosial media</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
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
                        <input type="text" class="form-control" id="floatingSosmed" name="akun"
                            placeholder="Masukan no telp" />
                        <label for="floatingSosmed">Nama Sosmed</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
<!-- end container -->

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    Table = $('#datatableFilter').DataTable({
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
            "url": "<?= base_url(); ?>peserta/getPesertaDataModal",
            "type": "POST",
            "data": function(d) {
                return $.extend({}, d, {
                    "kecamatan": $("#floatingKecamatan").val(),
                    "desa": $("#floatingDesa").val(),
                    "JUsaha": $("#floatingJenisUsaha").val(),
                    "subJUsaha": $("#floatingsubJenisUsaha").val()
                });
            }
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
                "data": "nu_peserta"
            },
            {
                "data": "nama_peserta"
            },
            {
                "data": "no_telpon"
            },
            {
                "data": "alamat"
            },
            {
                "data": "nama_usaha"
            },
            {
                "data": "nama_sub"
            },
            {
                "data": "kegiatan"
            },
            {
                "data": "idPeserta",
                "render": function(data, type, row, meta) {
                    var html = "";
                    if (row.validasi_du == 1) {
                        html += `
						<!-- item-->
						<button class="dropdown-item" data-id="${row.idPeserta}"
							onclick="location.href='<?= base_url(); ?>Peserta/detailPeserta/${row.idPeserta}'"><i
								class="mdi mdi-equal-box me-1"></i> Detail </button>`;
                    }
                    return `<td>
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical font-18"></i>
								</a>
								<div id="Dataku" class="dropdown-menu dropdown-menu-end">
									${html}
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

    Table.on('order.dt search.dt', function() {
        let i = 1;

        Table.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();

    $('#floatingKecamatan,#floatingDesa,#floatingJenisUsaha,#floatingsubJenisUsaha').bind("keyup change",
        function() {
            Table.clear().draw();
            Table.rows.add(data).draw();
        });
});
</script>