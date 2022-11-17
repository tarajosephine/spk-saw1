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
				<h4 class="page-title">Data Pelanggan</h4>
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
						Menu ini digunakan untuk menambah data pelanggan
					</p>
					<?= form_error('pelanggan', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
					<?= $this->session->flashdata('message_pelanggan'); ?>
					<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#inputModal"
						onclick="addPelanggan()">Tambah Pelanggan</button>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">CID</th>
								<th scope="col">Nama</th>
								<th scope="col">Alamat</th>
								<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($pelanggan as $p) : ?>
							<tr>
								<td scope="row"><?= $i; ?></td>
								<td><?= $p['cid']; ?></td>
								<td><?= $p['nama']; ?></td>
								<td><?= $p['alamat']; ?></td>
								<td>
									<div class="dropdown float-end">
										<a href="#" class="dropdown-toggle text-muted arrow-none"
											data-bs-toggle="dropdown" aria-expanded="false">
											<i class="mdi mdi-dots-vertical font-18"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<!-- item-->
											<button class="dropdown-item" data-toggle="modal"
												data-target="#inputModal" data-id="<?= $p['cid']; ?>"
												onclick="editPelanggan(`<?= $p['cid']; ?>`)"><i
													class="mdi mdi-pencil me-1"></i> Edit </button>
											<!-- item-->
											<button class="dropdown-item" data-toggle="modal"
												data-target="#deleteModal" data-id="<?= $p['cid']; ?>"
												onclick="deletePelanggan(`<?= $p['cid']; ?>`)"><i
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
				<h5 class="modal-title" id="InputModalLabel">Tambah Data Pelanggan</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="POST">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-floating mb-2">
						<input type="number" class="form-control" id="cid" name="cid" placeholder="Masukan CID" autofocus />
						<label for="title">CID</label>
					</div>
					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Pelanggan" />
						<label for="nama">Nama Pelanggan</label>
					</div>
					<div class="form-floating mb-2">
						<textarea type="text" class="form-control" rows="3" id="alamat" name="alamat"
							placeholder="Masukan nama menu"></textarea>
						<!-- <input type="text" class="form-control" id="menu" name="menu" placeholder="Masukan nama menu" /> -->
						<label for="alamat">Alamat</label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
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
