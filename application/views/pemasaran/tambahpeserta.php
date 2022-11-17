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
                <h4 class="page-title">PELATIHAN</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($pelatihan as $p) : ?>
                        <h3 class="text-dark"><?= $p['nama_kegiatan']; ?></h3>
                        <h4 class="text-danger">Kuota : <?= $p['kuota']; ?></h4>
                        <?php endforeach; ?>
                        <div class="col-lg-8">
                            <form method="post" class="form-peserta">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-centered mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 10%">#</th>
                                                <th style="width: 25%">Nama</th>
                                                <th style="width: 25%">Alamat</th>
                                                <th style="width: 20%">Nama Usaha</th>
                                                <th style="width: 20%">Jenis Usaha</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                                <hr>
                            </form>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="text-sm-end">
                                        <button type="submit" class="btn btn-danger"
                                            onclick="simpanDataPelatihan(`<?= $id_P; ?>`)">
                                            <i class="mdi mdi-cart-plus me-1"></i> Simpan Pendaftaran </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="border p-3 mt-4 mt-lg-0 rounded">
                                <h4 class="header-title mb-3">Pilih Peserta</h4>
                                <select class="form-control select2" data-toggle="select2" name="id_peserta"
                                    id="id_peserta">
                                </select>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="text-sm-end">
                                            <button class="btn btn-primary" id="add-peserta"
                                                onclick="tambahDataPeserta()">+ Tambah Peserta</button>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end .border-->
                        </div>

                    </div> <!-- end col -->
                </div>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div>
<!-- container -->

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    let dataYear = new Date().getFullYear();
    var idPelatihan = '<?= $id_P ?>';
    var idJU = '<?= $id_JU ?>';
    // setInterval(function() {
    $.ajax({
        url: "<?= base_url(); ?>pemasaran/getShowPeserta",
        data: {
            idju: idJU
        },
        method: "POST",
        dataType: "json",
        success: function(data) {
            $("<option>").attr("value", "").text("Pilih menu").appendTo("#id_peserta");
            for (let index = 0; index < data.length; index++) {
                var yearP = data[index].validasi_p;
                if (!(yearP == dataYear)) {
                    $("<option>").attr("value", data[index].id_peserta).text(data[index]
                        .nama_peserta).appendTo("#id_peserta");
                }
            }
        },
    });
    // }, 2000);
});
</script>