<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body py-3">
            <h6 class="m-0 font-weight-bold text-danger">DataTables Jangkauan Pasar Peserta</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <script>
                    $(document).ready(function() {
                        // Sembunyikan alert validasi kosong
                        $("#kosong").hide();
                    });
                </script>
                <a type="button" class="btn btn-danger mb-3" href="<?= base_url('assets/excel/format3.xlsx'); ?>"><i class="mdi mdi-download"></i> Download Format Excel</a>
                <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
                <form method="post" action="<?php echo base_url("peserta/formJangkauanPasarPeserta"); ?>" enctype="multipart/form-data">
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
                    echo "<form method='post' action='" . base_url("peserta/import3") . "'>";

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
                        $nama_jp = $row['B']; // Ambil data nama
                        $dn_prov = $row['C']; // Ambil data nama_jp
                        $dn_kab_kot = $row['D']; // Ambil data tempat
                        $benua = $row['E']; // Ambil data lahir
                        $negara = $row['F']; // Ambil data agama
                        $volume = $row['G']; // Ambil data jenis kelamin
                        $satuan_v = $row['H']; // Ambil data Periode Pemilihan
                        $nilai_ex = $row['I']; // Ambil data Periode Pemilihan

                        // Cek jika semua data tidak diisi
                        if ($id_peserta == "" && $nama_jp == "" && $dn_prov == "" && $dn_kab_kot == "" && $benua == "" && $negara == "" && $volume == "" && $satuan_v == "" && $nilai_ex == "")
                            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                        // Cek $numrow apakah lebih dari 1
                        // Artinya karena baris pertama adalah nama-nama kolom
                        // Jadi dilewat saja, tidak usah diimport
                        if ($numrow > 1) {
                            // Jika salah satu data ada yang kosong
                            if ($id_peserta == "" or $nama_jp == "" or $dn_prov == "" or $dn_kab_kot == "" or $benua == "" or $negara == "" or $volume == "" or $satuan_v == "" or $nilai_ex == "") {
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