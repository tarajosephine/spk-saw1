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
				<h4 class="page-title">Data Kriteria</h4>
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
						Menu ini digunakan untuk data Kriteria
					</p>
					<?= form_error('keluhan', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
					<?= $this->session->flashdata('message_kriteria'); ?>
					<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#inputModal"
						onclick="addKeluhanPelanggan()">Tambah Kriteria</button>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Kode Tes</th>
								<th scope="col">Kriteria</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($kriteria as $k) : ?>
							<tr>
								<td scope="row"><?= $i; ?></td>
								<td><?= $k['kd_tes']; ?></td>
								<td><?= $k['kriteria']; ?></td>
								<td><?= $k['status']; ?></td>
								<td>
									<div class="dropdown float-end">
										<a href="#" class="dropdown-toggle text-muted arrow-none"
											data-bs-toggle="dropdown" aria-expanded="false">
											<i class="mdi mdi-dots-vertical font-18"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<!-- item-->
											<button class="dropdown-item" data-toggle="modal" data-target="#InputModalLabel"
												data-id="<?= $k['kd_tes']; ?>"
												onclick="editKeluhanPelanggan(`<?= $k['kd_tes']; ?>`)"><i
													class="mdi mdi-pencil me-1"></i> Edit </button>
											<!-- item-->
											<button class="dropdown-item" data-toggle="modal" data-target="#deleteModal"
												data-id="<?= $k['kd_tes']; ?>"
												onclick="deleteKeluhanPelanggan(`<?= $k['kd_tes']; ?>`)"><i
													class="mdi mdi-delete me-1"></i> Hapus </button>
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
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="InputModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="InputModalLabel">Tambah Kriteria</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="kd_tes" name="kd_tes"
							placeholder="Kode Tes" value="<?= $pengurutanK['kodeTerbesar']; ?>" />
						<label for="floatingInput">Kode Kriteria</label>
					</div>

					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="kriteria" name="kriteria" placeholder="Masukkan Nama Kriteria"/>
						<label for="floatingInput">Nama Kriteria</label>
					</div>

					<div class="form-floating mb-2">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="status" value="1">
							<label class="form-check-label" for="inlineRadio1">Aktif</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="status" value="0">
							<label class="form-check-label" for="inlineRadio2">Non-Aktif</label>
						</div>
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="DeleteModalLabel">Hapus Menu</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class=" btn btn-close">
				</button>
			</div>
			<div class="modal-body">Apakah anda yakin ingin menghapus menu ini?</div>
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

<script type="text/javascript">
	// input data 1
	// ##############################################################################
	const inpFile_1 = document.getElementById('image_1');
	const previewContainer_1 = document.getElementById('imagePreview_1');
	const previewImage_1 = previewContainer_1.querySelector('.input_data_1');
	const previewDefaultText_1 = previewContainer_1.querySelector('.text_input_data_1');

	inpFile_1.addEventListener("change", function () {
		const file = this.files[0];

		if (file) {
			const reader = new FileReader();

			previewDefaultText_1.style.display = "none";
			previewImage_1.style.display = "block";

			reader.addEventListener("load", function () {
				previewImage_1.setAttribute("src", this.result);
			});
			reader.readAsDataURL(file);
		} else {
			previewDefaultText_1.style.display = null;
			previewImage_1.style.display = null;
			previewImage_1.setAttribute("src", "");
		}
	});
</script>
