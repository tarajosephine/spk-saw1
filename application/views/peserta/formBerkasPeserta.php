<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body py-3">
            <h6 class="m-0 font-weight-bold text-danger">DataTables Berkas Peserta</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <script>
                    $(document).ready(function() {
                        // Sembunyikan alert validasi kosong
                        $("#kosong").hide();
                    });
                </script>
                <a type="button" class="btn btn-danger mb-3" href="<?= base_url('assets/excel/format2.xlsx'); ?>"><i class="mdi mdi-download"></i> Download Format Excel</a>
                <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
                <form method="post" action="<?php echo base_url("peserta/formBerkasPeserta"); ?>" enctype="multipart/form-data">
                    <!-- 
                    -- Buat sebuah input type file
                    -- class pull-left berfungsi agar file input berada di sebelah kiri
                    -->
                    <input type="file" class="btn btn-danger mb-3" name="file">
                    <!-- <i class="fas fa-fw fa-file-import"></i> -->

                    <!--
                    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
                    -->
                    <button class="btn btn-danger mb-3" style='margin-left: 5px;' name="preview"><i class="mdi mdi-cloud-sync"></i> Cek Data</button>
                </form>

                <?php
                if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form 
                    if (isset($upload_error)) { // Jika proses upload gagal
                        echo "<div style='color: red;'>" . $upload_error . "</div>"; // Muncul pesan error upload
                        die; // stop skrip
                    }

                    // Buat sebuah tag form untuk proses import data ke database
                    echo "<form method='post' action='" . base_url("peserta/import2") . "'>";

                    // Buat sebuah div untuk alert validasi kosong
                    echo "<div style='color: red;' id='kosong'>
                            Jika Data yang belum di isi Akan berwarna Merah Muda, Cek <span id='jumlah_kosong'></span> data yang belum diisi.
                        </div>";

                    $numrow = 1;
                    $kosong = 0;
                    $number = 0;

                    // Lakukan perulangan dari data yang ada di excel
                    // $sheet adalah variabel yang dikirim dari controller
                    foreach ($sheet as $row) {
                        // Ambil data pada excel sesuai Kolom
                        $no = $number; // Ambil data nik
                        $id_peserta = $row['A']; // Ambil data nik
                        $nama_usaha = $row['B']; // Ambil data nama
                        $alamat_usaha = $row['C']; // Ambil data alamat
                        $id_desa_jp = $row['D']; // Ambil data tempat
                        $jml_pria = $row['E']; // Ambil data lahir
                        $jml_wanita = $row['F']; // Ambil data agama
                        $id_ju = $row['G']; // Ambil data jenis kelamin
                        $sub_ju = $row['H']; // Ambil data Periode Pemilihan
                        $aset = $row['I']; // Ambil data Periode Pemilihan
                        $omset = $row['J']; // Ambil data Periode Pemilihan
                        $modal_mandiri = $row['K']; // Ambil data Periode Pemilihan
                        $modal_luar = $row['L']; // Ambil data Periode Pemilihan
                        $kapasitas = $row['M']; // Ambil data Periode Pemilihan
                        $satuan = $row['N']; // Ambil data Periode Pemilihan

                        // Cek jika semua data tidak diisi
                        if ($id_peserta == "" && $nama_usaha == "" && $alamat_usaha == "" && $id_desa_jp == "" && $jml_pria == "" && $jml_wanita == "" && $id_ju == "" && $sub_ju == "" && $aset == "" && $omset == "" && $modal_mandiri == "" && $modal_luar == "" && $kapasitas == "" && $satuan == "")
                            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                        // Cek $numrow apakah lebih dari 1
                        // Artinya karena baris pertama adalah nama-nama kolom
                        // Jadi dilewat saja, tidak usah diimport
                        if ($numrow > 1) {
                            // Jika salah satu data ada yang kosong
                            if ($id_peserta == "" or $nama_usaha == "" or $alamat_usaha == "" or $id_desa_jp == "" or $jml_pria == "" or $jml_wanita == "" or $id_ju == "" or $sub_ju == "" or $aset == "" or $omset == "" or $modal_mandiri == "" or $modal_luar == "" or $kapasitas == "" or $satuan == "") {
                                $kosong++; // Tambah 1 variabel $kosong
                            }
                        }

                        $numrow++; // Tambah 1 setiap kali looping
                        $number++; // Number urutan
                    }

                    // Cek apakah variabel kosong lebih dari 0
                    // Jika lebih dari 0, berarti ada data yang masih kosong
                    if ($kosong > 0) {
                ?>
                        <script>
                            $(document).ready(function() {
                                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                                $("#jumlah_kosong").text('<?= $kosong; ?>');

                                $("#kosong").show(); // Munculkan alert validasi kosong
                            });
                        </script>
                <?php
                    } else { // Jika semua data sudah diisi
                        // echo "<hr>";

                        // Buat sebuah tombol untuk mengimport data ke database
                        echo "<button type='submit' class='btn btn-danger mb-3' style='margin:5px;' name='import'>Import</button>";
                        echo "<button class='btn btn-danger mb-3' style='margin:5px;' href='" . base_url("peserta") . "'>Cancel</button>";
                    }
                }
                ?>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->