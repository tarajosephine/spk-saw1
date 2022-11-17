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
                <h4 class="page-title">MENU PESERTA</h4>
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
                        Menu ini digunakan untuk managemen data peserta. user pengguna dapat menambahkan data baru,
                        mengedit ataupun menghapus data peserta.
                    </p>
                    <?= form_error('no_ktp', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
                    <?= $this->session->flashdata('message_peserta'); ?>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                        data-target="#newPesertaModal" onclick="addPeserta()">Tambah Data Peserta</button>
                    <a type="button" class="btn btn-danger mb-3" href="<?= base_url('peserta/formDaftarPeserta'); ?>"><i
                            class="mdi mdi-file-import"></i> Import Daftar Peserta</a>
                    <a type="button" class="btn btn-danger mb-3" href="<?= base_url('peserta/formBerkasPeserta'); ?>"><i
                            class="mdi mdi-file-import"></i> Import Berkas Peserta</a>
                    <a type="button" class="btn btn-danger mb-3"
                        href="<?= base_url('peserta/formJangkauanPasarPeserta'); ?>"><i class="mdi mdi-file-import"></i>
                        Import Jangkauan Pasar Peserta</a>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatablePeserta"
                                class="table table-striped dt-responsive nowrap w-100 table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Data Usaha</th>
                                        <th scope="col">Data Berkas</th>
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
<div class="modal fade" id="newPesertaModal" tabindex="-1" role="dialog" aria-labelledby="PesertaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PesertaModalLabel">Tambah Peserta Baru</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="nama_peserta"
                            placeholder="Masukan nama peserta" />
                        <label for="floatingInput">Nama Peserta</label>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="floatingAlamat" name="alamat" placeholder="Masukan alamat"
                            cols="30" rows="10"></textarea>
                        <label for="floatingAlamat">Alamat KTP</label>
                    </div>

                    <div class="form-floating mb-2">
                        <select class="form-select" id="id_desa" name="id_desa"
                            aria-label="Floating label select example">
                            <option selected>Pilih Kelurahan</option>
                            <?php foreach ($desa as $ds) : ?>
                            <option value="<?= $ds['id_desa']; ?>"><?= $ds['nama_desa']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_desa">Kelurahan</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" id="floatingTelp" name="no_telpon" min="0"
                            placeholder="Masukan no telp" />
                        <label for="floatingTelp">No Telp</label>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingNKK" name="no_kk" min="0"
                                    placeholder="Masukan no KK" />
                                <label for="floatingTelp">No Kartu Keluarga</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingKTP" name="no_ktp" min="0"
                                    placeholder="Masukan no KTP" />
                                <label for="floatingTelp">No KTP</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingLahir" name="tempat_lahir"
                                    placeholder="Masukan Tempat Lahir" />
                                <label for="floatingTelp">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingTgl_lahir" name="tgl_lahir"
                                    placeholder="Masukan Tanggal Lahir" />
                                <label for="floatingTelp">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <select class="form-select" id="floatingJ_kel" name="j_kel"
                            aria-label="Floating label select example">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                        </select>
                        <label for="floatingJenisUsaha">Jenis Kelamin</label>
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

<!-- Modal Tambah Usaha -->
<div class="modal fade" id="tambahUsahaPesertaModal" tabindex="-1" role="dialog" aria-labelledby="UsahaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UsahaModalLabel">Tambah Usaha </h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
            </div>
            <form method="post">
                <input type="hidden" name="id_tu" id="id_tu">
                <div class="card-body">
                    <div id="progressbarwizard">

                        <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                            <li class="nav-item">
                                <a href="#usaha" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-file-document me-1"></i>
                                    <span class="d-none d-sm-inline">Usaha</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#jp" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-file-document me-1"></i>
                                    <span class="d-none d-sm-inline">Jangkauan Pasar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#omset" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-file-document me-1"></i>
                                    <span class="d-none d-sm-inline">Omset</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success"></i>
                                    <span class="d-none d-sm-inline">Finish</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content b-0 mb-0">

                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
                                </div>
                            </div>

                            <!-- DATA 1 -->
                            <!-- ################################################################################################################################# -->
                            <div class="tab-pane" id="usaha">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="nama_usaha"
                                                id="floatingNamaUsaha" placeholder="Masukan nama usaha" />
                                            <label for="floatingNamaUsaha">Nama Usaha</label>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <textarea class="form-control" id="floatingAlamat_usaha" name="alamat_usaha"
                                                placeholder="Masukan alamat Usaha" cols="30" rows="10"></textarea>
                                            <label for="floatingAlamat_usaha">Alamat Usaha </label>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <select class="form-select" id="id_desa_jp" name="id_desa_jp"
                                                aria-label="Floating label select example">
                                                <option selected>Pilih Kelurahan</option>
                                                <?php foreach ($desa as $ds) : ?>
                                                <option value="<?= $ds['id_desa']; ?>"><?= $ds['nama_desa']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="floatingKelurahan">Kelurahan</label>
                                        </div>

                                        <div class="row g-2 mb-2">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="jmlh_karyawan_pria"
                                                        id="floatingJmlh_karyawan_pria" min="0"
                                                        placeholder="Jumlah Karyawan Pria" />
                                                    <label for="floatingJmlh_karyawan_pria">Jumlah Karyawan Pria</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control"
                                                        name="jmlh_karyawan_wanita" id="floatingJmlh_karyawan_wanita"
                                                        min="0" placeholder="Jumlah Karyawan Wanita" />
                                                    <label for="floatingJmlh_karyawan_wanita">Jumlah Karyawan
                                                        Wanita</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2 mb-2">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <select class="form-select" id="floatingJenisUsaha"
                                                        name="jenis_usaha" aria-label="Floating label select example">
                                                        <option selected>Pilih menu</option>
                                                        <?php foreach ($jenis_usaha as $ju) : ?>
                                                        <option value="<?= $ju['id_ju']; ?>"><?= $ju['nama_usaha']; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label for="floatingJenisUsaha">Jenis Usaha</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <select class="form-select data_subju" id="floatingsubJenisUsaha"
                                                        name="subjenis_usaha"
                                                        aria-label="Floating label select example">
                                                    </select>
                                                    <label for="floatingJenisUsaha">Sub Jenis Usaha</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <!-- DATA 2 -->
                            <!-- ################################################################################################################################# -->
                            <div class=" tab-pane" id="jp">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating mb-2">
                                            <select class="form-select" id="floatingjp" name="jp"
                                                aria-label="Floating label select example">
                                                <option selected>Pilih menu</option>
                                                <option value="Dalam Negeri">Dalam Negeri</option>
                                                <option value="Luar Negeri, Langusng / Forwarder">Luar
                                                    Negeri</option>
                                            </select>
                                            <label for="floatingJangkauanPasar">Jangkauan Pasar</label>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="data-form-jp"></div>
                                    <!-- <div class="form-floating mb-2">
                                        <input type="text" class="form-control" name="nama_usaha" id="floatingNamaUsaha" placeholder="Masukan nama usaha" />
                                        <label for="floatingNamaUsaha">Nama Usaha</label>
                                    </div> -->
                                </div> <!-- end row -->
                            </div>

                            <!-- Data 3 -->
                            <!-- ################################################################################################################################# -->
                            <div class="tab-pane" id="omset">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-floating mb-2">
                                            <input type="number" class="form-control" name="aset" id="floatingAset"
                                                min="0" placeholder="Aset" />
                                            <label for="floatingAset">Aset</label>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <input type="number" class="form-control" name="omset" id="floatingOmset"
                                                min="0" placeholder="Omset" />
                                            <label for="floatingOmset">Omset</label>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <input type="number" class="form-control" name="modal_mandiri"
                                                id="floatingModalMandiri" min="0" placeholder="Modal Mandiri" />
                                            <label for="floatingModalMandiri">Modal Mandiri</label>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <input type="number" class="form-control" name="modal_luar"
                                                id="floatingModalLuar" min="0" placeholder="Modal Luar" />
                                            <label for="floatingModalLuar">Modal Luar</label>
                                        </div>

                                        <div class="row g-2 mb-2">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="n_kp"
                                                        id="floatingN_kp" min="0"
                                                        placeholder="Nilai Kapasitas Produk" />
                                                    <label for="floatingNamaUsaha">Nilai Kapasitas
                                                        Produk</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <select class="form-select" id="floatingSatuan" name="satuan"
                                                        aria-label="Floating label select example">
                                                        <option selected>Pilih menu</option>
                                                        <option value="Porsi">Porsi</option>
                                                        <option value="Pcs">Pcs</option>
                                                        <option value="Kodi">Kodi</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                    <label for="floatingSatuan">Satuan</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane" id="finish-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                            <h3 class="mt-0">Terima Kasih !</h3>

                                            <p class="w-75 mb-2 mx-auto">Jika ada data Usaha yang
                                                kosong, anda bisa di
                                                update data usaha ulang yang kekurangannya.</p>

                                            <div class="mb-3">
                                                <div class="form-check d-inline-block">
                                                    <input type="checkbox" class="form-check-input" id="customCheck3">
                                                    <label class="form-check-label" for="customCheck3">Saya setuju
                                                        upload data ini selesai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div> <!-- end row -->
                            </div>

                            <ul class="list-inline mb-0 wizard">
                                <li class="previous list-inline-item">
                                    <a href="#" class="btn btn-info">Previous</a>
                                </li>
                                <li class="next list-inline-item float-end">
                                    <a href="#" class="btn btn-info">Next</a>
                                </li>
                            </ul>

                        </div> <!-- tab-content -->
                    </div> <!-- end #progressbarwizard-->
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="uploadPesertaModal" tabindex="-1" role="dialog" aria-labelledby="UploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadModalLabel">Upload Foto Scan</h5>
                <button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
            </div>
            <?= form_open_multipart('peserta/uploadData'); ?>
            <input type="hidden" name="id_v" id="id_v" value="1">
            <input type="hidden" name="id_peserta" id="id_peserta">
            <div class="card-body">
                <div id="progressbarwizard2">

                    <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                        <li class="nav-item">
                            <a href="#nib" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success data_info_nib"></i>
                                <i class="mdi mdi-book-arrow-up-outline me-1"></i>
                                <span class="d-none d-sm-inline">NIB</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#prit" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success data_info_prit"></i>
                                <i class="mdi mdi-book-arrow-up-outline me-1"></i>
                                <span class="d-none d-sm-inline">PRIT</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#sertivikat" data-bs-toggle="tab" data-toggle="tab"
                                class="nav-link rounded-0 pt-2 pb-2">
                                <i
                                    class="mdi mdi-checkbox-marked-circle-outline me-1 text-success data_info_sertivikat"></i>
                                <i class="mdi mdi-book-arrow-up-outline me-1"></i>
                                <span class="d-none d-sm-inline">Sertivikat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#npwp" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success data_info_npwp"></i>
                                <i class="mdi mdi-book-arrow-up-outline me-1"></i>
                                <span class="d-none d-sm-inline">NPWP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#ktp" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success data_info_ktp"></i>
                                <i class="mdi mdi-book-arrow-up-outline me-1"></i>
                                <span class="d-none d-sm-inline">KTP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#brand" data-bs-toggle="tab" data-toggle="tab"
                                class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success data_info_brand"></i>
                                <i class="mdi mdi-book-arrow-up-outline me-1"></i>
                                <span class="d-none d-sm-inline">Brand</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#finish-u" data-bs-toggle="tab" data-toggle="tab"
                                class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success"></i>
                                <span class="d-none d-sm-inline">Finish</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content b-0 mb-0">

                        <div id="bar" class="progress mb-3" style="height: 7px;">
                            <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                        </div>

                        <!-- IMAGE 1 -->
                        <!-- ################################################################################################################################# -->
                        <div class="tab-pane" id="nib">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label" for="userName1">Upload Data</label>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="image-preview col-sm-3" id="imagePreview_1">
                                                            <img src="" alt="Image Preview" id="img1"
                                                                class="image-preview__image img-thumbnail input_data_1">
                                                            <span class="image-preview__default-text text_input_data_1">
                                                                Image Preview
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="img_1" name="img_1">
                                                        <div class="col-sm-12">
                                                            <div class="custom-file">
                                                                <input type="file" id="image_1" name="image_1"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>

                        <!-- IMAGE 2 -->
                        <!-- ################################################################################################################################# -->
                        <div class="tab-pane" id="prit">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label" for="userName1">Upload Data</label>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="image-preview col-sm-3" id="imagePreview_2">
                                                            <img src="" alt="Image Preview" id="img2"
                                                                class="image-preview__image img-fluid img-thumbnail input_data_2">
                                                            <span class="image-preview__default-text text_input_data_2">
                                                                Image Preview
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="img_2" name="img_2">
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" id="image_2" name="image_2"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>

                        <!-- IMAGE 3 -->
                        <!-- ################################################################################################################################# -->
                        <div class="tab-pane" id="sertivikat">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label" for="userName1">Upload Data</label>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="image-preview col-sm-3" id="imagePreview_3">
                                                            <img src="" alt="Image Preview" id="img3"
                                                                class="image-preview__image img-fluid img-thumbnail input_data_3">
                                                            <span class="image-preview__default-text text_input_data_3">
                                                                Image Preview
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="img_3" name="img_3">
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" id="image_3" name="image_3"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>

                        <!-- IMAGE 4 -->
                        <!-- ################################################################################################################################# -->
                        <div class="tab-pane" id="npwp">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label" for="userName1">Upload Data</label>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="image-preview col-sm-3" id="imagePreview_4">
                                                            <img src="" alt="Image Preview" id="img4"
                                                                class="image-preview__image img-fluid img-thumbnail input_data_4">
                                                            <span class="image-preview__default-text text_input_data_4">
                                                                Image Preview
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="img_4" name="img_4">
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" id="image_4" name="image_4"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>

                        <!-- IMAGE 5 -->
                        <!-- ################################################################################################################################# -->
                        <div class="tab-pane" id="ktp">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label" for="userName1">Upload Data</label>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="image-preview col-sm-3" id="imagePreview_5">
                                                            <img src="" alt="Image Preview" id="img5"
                                                                class="image-preview__image img-fluid img-thumbnail input_data_5">
                                                            <span class="image-preview__default-text text_input_data_5">
                                                                Image Preview
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="img_5" name="img_5">
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" id="image_5" name="image_5"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>

                        <!-- IMAGE 6 -->
                        <!-- ################################################################################################################################# -->
                        <div class="tab-pane" id="brand">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label" for="userName1">Upload Data</label>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="image-preview col-sm-3" id="imagePreview_6">
                                                            <img src="" alt="Image Preview" id="img6"
                                                                class="image-preview__image img-fluid img-thumbnail input_data_6">
                                                            <span class="image-preview__default-text text_input_data_6">
                                                                Image Preview
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="img_6" name="img_6">
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" id="image_6" name="image_6"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>

                        <div class="tab-pane" id="finish-u">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center">
                                        <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                        <h3 class="mt-0">Terima Kasih !</h3>

                                        <p class="w-75 mb-2 mx-auto">Jika ada data upload yang kosong, anda bisa di
                                            upload ulang yang kekurangannya.</p>

                                        <div class="mb-3">
                                            <div class="form-check d-inline-block">
                                                <input type="checkbox" class="form-check-input" id="customCheck3">
                                                <label class="form-check-label" for="customCheck3">Saya setuju upload
                                                    data ini selesai</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div> <!-- end row -->
                        </div>

                        <ul class="list-inline mb-0 wizard">
                            <li class="previous list-inline-item">
                                <a href="#" class="btn btn-info">Previous</a>
                            </li>
                            <li class="next list-inline-item float-end">
                                <a href="#" class="btn btn-info">Next</a>
                            </li>
                        </ul>

                    </div> <!-- tab-content -->
                </div> <!-- end #progressbarwizard-->
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deletePesertaModal" tabindex="-1" role="dialog" aria-labelledby="PesertaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PesertaModalLabel">Apakah benar ingin di hapus?</h5>
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

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    t = $('#datatablePeserta').DataTable({
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
            "url": "<?= base_url(); ?>peserta/getDataPesertaModal",
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
                "data": "nama_peserta",
            },
            {
                "data": "alamat"
            },
            {
                "data": "no_telpon"
            },
            {
                "data": "j_kel"
            },
            {
                "data": "validasi_du",
                "render": function(data) {
                    if (data == 1) {
                        return `<i class="mdi mdi-circle text-success"></i> Data Sudah Ada`;
                    } else {
                        return `<i class="mdi mdi-circle text-danger"></i> Data Belum Diinput`;
                    }
                }
            },
            {
                "data": "validasi_ud",
                "render": function(data) {
                    if (data == 1) {
                        return `<i class="mdi mdi-circle text-warning"></i> Berkas Belum Lengkap`;
                    } else if (data == 2) {
                        return `<i class="mdi mdi-circle text-success"></i> Berkas Sudah Diupload`;
                    } else {
                        return `<i class="mdi mdi-circle text-danger"></i> Berkas Belum Diupload`;
                    }
                }
            },
            {
                "data": "id_peserta",
                "render": function(data, type, row, meta) {
                    var html = "";
                    if (row.validasi_du == 1) {
                        html += `
							<!-- item-->
							<button class="dropdown-item" data-id="${row.id_peserta}"
								onclick="location.href='<?= base_url(); ?>Peserta/detailPeserta/${row.id_peserta}'"><i
									class="mdi mdi-equal-box me-1"></i> Detail </button>`;
                    }

                    if (row.validasi_du == 0) {
                        html += `
							<!-- item Tambah-->
							<button class="dropdown-item" data-toggle="modal" data-target="#tambahUsahaPesertaModal" data-id="${row.id_peserta}"
								onclick="tambahUsahaData(${row.id_peserta})"><i class="mdi mdi-layers"></i> Tambah Usaha </button>`;
                    } else {
                        html += `
							<!-- item Edit-->
							<button class="dropdown-item" data-toggle="modal" data-target="#tambahUsahaPesertaModal" data-id="${row.id_peserta}"
								onclick="editUsahaData(${row.id_peserta})"><i class="mdi mdi-layers"></i> Edit Usaha </button>`;
                    }

                    if (row.validasi_ud == 0) {
                        html += `
							<!-- item-->
							<button class="dropdown-item" data-toggle="modal" data-target="#uploadPesertaModal" data-id="${row.id_peserta}"
								onclick="uploadData(${row.id_peserta})"><i class="mdi mdi-cloud-upload"></i> Upload Berkas </button>`;
                    } else if (row.validasi_ud == 1) {
                        html += `
							<!-- item-->
							<button class="dropdown-item" data-toggle="modal" data-target="#uploadPesertaModal" data-id="${row.id_peserta}"
								onclick="editUploadData(${row.id_peserta})"><i class="mdi mdi-cloud-upload"></i> Lengkapi Berkas </button>`;
                    } else {
                        html += `
							<!-- item-->
							<label class="dropdown-item" data-toggle="modal"><i class="mdi mdi-checkbox-marked-circle-outline"></i> Berkas Susah
								Lengkap </label>`;
                    }

                    return `<td>
						<div class="dropdown float-end">
							<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="mdi mdi-dots-vertical font-18"></i>
							</a>
							<div id="Dataku" class="dropdown-menu dropdown-menu-end">
								${html}
								<!-- item-->
								<button class="dropdown-item" data-toggle="modal" data-target="#newPesertaModal"
									data-id="${row.id_peserta}" onclick="editPeserta(${row.id_peserta})"><i
										class="mdi mdi-account-edit"></i> Edit Profil</button>

								<!-- item-->
								<button class="dropdown-item" data-toggle="modal" data-target="#deletePesertaModal"
									data-id="${row.id_peserta}" onclick="deletePeserta(${row.id_peserta})"><i
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
// input data 1
// ##############################################################################
const inpFile_1 = document.getElementById('image_1');
const previewContainer_1 = document.getElementById('imagePreview_1');
const previewImage_1 = previewContainer_1.querySelector('.input_data_1');
const previewDefaultText_1 = previewContainer_1.querySelector('.text_input_data_1');

inpFile_1.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText_1.style.display = "none";
        previewImage_1.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage_1.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText_1.style.display = null;
        previewImage_1.style.display = null;
        previewImage_1.setAttribute("src", "");
    }
});

// input data 2
// ##############################################################################
const inpFile_2 = document.getElementById('image_2');
const previewContainer_2 = document.getElementById('imagePreview_2');
const previewImage_2 = previewContainer_2.querySelector('.input_data_2');
const previewDefaultText_2 = previewContainer_2.querySelector('.text_input_data_2');

inpFile_2.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText_2.style.display = "none";
        previewImage_2.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage_2.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText_2.style.display = null;
        previewImage_2.style.display = null;
        previewImage_2.setAttribute("src", "");
    }
});

// input data 3
// ##############################################################################
const inpFile_3 = document.getElementById('image_3');
const previewContainer_3 = document.getElementById('imagePreview_3');
const previewImage_3 = previewContainer_3.querySelector('.input_data_3');
const previewDefaultText_3 = previewContainer_3.querySelector('.text_input_data_3');

inpFile_3.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText_3.style.display = "none";
        previewImage_3.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage_3.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText_3.style.display = null;
        previewImage_3.style.display = null;
        previewImage_3.setAttribute("src", "");
    }
});

// input data 4
// ##############################################################################
const inpFile_4 = document.getElementById('image_4');
const previewContainer_4 = document.getElementById('imagePreview_4');
const previewImage_4 = previewContainer_4.querySelector('.input_data_4');
const previewDefaultText_4 = previewContainer_4.querySelector('.text_input_data_4');

inpFile_4.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText_4.style.display = "none";
        previewImage_4.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage_4.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText_4.style.display = null;
        previewImage_4.style.display = null;
        previewImage_4.setAttribute("src", "");
    }
});

// input data 5
// ##############################################################################
const inpFile_5 = document.getElementById('image_5');
const previewContainer_5 = document.getElementById('imagePreview_5');
const previewImage_5 = previewContainer_5.querySelector('.input_data_5');
const previewDefaultText_5 = previewContainer_5.querySelector('.text_input_data_5');

inpFile_5.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText_5.style.display = "none";
        previewImage_5.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage_5.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText_5.style.display = null;
        previewImage_5.style.display = null;
        previewImage_5.setAttribute("src", "");
    }
});

// input data 6
// ##############################################################################
const inpFile_6 = document.getElementById('image_6');
const previewContainer_6 = document.getElementById('imagePreview_6');
const previewImage_6 = previewContainer_6.querySelector('.input_data_6');
const previewDefaultText_6 = previewContainer_6.querySelector('.text_input_data_6');

inpFile_6.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText_6.style.display = "none";
        previewImage_6.style.display = "block";

        reader.addEventListener("load", function() {
            previewImage_6.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    } else {
        previewDefaultText_6.style.display = null;
        previewImage_6.style.display = null;
        previewImage_6.setAttribute("src", "");
    }
});
</script>