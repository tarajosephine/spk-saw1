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
				<h4 class="page-title">SUB MENU UTAMA</h4>
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
						Menu ini digunakan untuk managemen submenu yang ada pada sidebar, submenu ini menginduk pada menu utama aplikasi
					</p>
					<?php if (validation_errors()) : ?>
						<?php
						$this->session->set_flashdata(
							'message_submenu',
							'<div class="alert alert-danger" role="alert">The All field is required!</div>'
						);
						?>
					<?php endif; ?>
					<?= $this->session->flashdata('message_submenu'); ?>
					<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal" onclick="addSubMenu()">Add Sub New Menu</button>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Title</th>
								<th scope="col">Menu</th>
								<th scope="col">Url</th>
								<!-- <th scope="col">Icon</th> -->
								<th scope="col">Active</th>
								<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($subMenu as $sm) : ?>
								<tr>
									<td scope="row"><?= $i; ?></td>
									<td><?= $sm['title']; ?></td>
									<td><?= $sm['menu']; ?></td>
									<td><?= $sm['url']; ?></td>
									<!-- <td><?= $sm['icon']; ?></td> -->
									<td><?php
										if ($sm['is_active'] == 1) {
											echo '<h5 class="text-success">Active</h5>';
										} else {
											echo '<h5 class="text-danger">Nonactive</h5>';
										}
										?>
									</td>
									<td>
										<div class="dropdown float-end">
											<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="mdi mdi-dots-vertical font-18"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-end">
												<!-- item-->
												<button class="dropdown-item" data-toggle="modal" data-target="#newSubMenuModal" data-id="<?= $sm['id']; ?>" onclick="editSubMenu(`<?= $sm['id']; ?>`)"><i class="mdi mdi-pencil me-1"></i> Edit </button>
												<!-- item-->
												<button class="dropdown-item" data-toggle="modal" data-target="#deleteSubMenuModal" data-id="<?= $sm['id']; ?>" onclick="deleteSubMenu(`<?= $sm['id']; ?>`)"><i class="mdi mdi-delete me-1"></i> Hapus </button>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="SubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="SubMenuModalLabel">Add New Sub Menu</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="POST">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="title" name="title" placeholder="Nama kegiatan" autofocus />
						<label for="title">Nama sub menu</label>
					</div>

					<div class="form-floating mb-2">
						<select class="form-select" id="menu_id" name="menu_id" aria-label="Floating label select example">
							<option selected>Open this select menu</option>
							<?php foreach ($menu as $m) : ?>
								<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="floatingJenisUsaha">Pilih Menu</label>
					</div>

					<div class="row g-2 mb-2">
						<div class="col-md">
							<div class="form-floating">
								<input type="text" class="form-control" id="url" name="url" placeholder="Sub menu url" autofocus />
								<label for="url">URL Sub menu</label>
							</div>
						</div>
						<div class="col-md">
							<div class="form-floating">
								<input type="text" class="form-control" id="icon" name="icon" placeholder="Sub menu icon" autofocus />
								<label for="icon">Icon Sub menu</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active?
							</label>
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
<div class="modal fade" id="deleteSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteSubMenuModalLabel">Hapus Sub Menu</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<div class="modal-body">Select "Delete" below if you are ready to end your current Menu Management.</div>
			<form method="POST">
				<input type="hidden" name="id_s" id="id_s">
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>