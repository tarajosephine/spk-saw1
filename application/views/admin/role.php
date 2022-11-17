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
				<h4 class="page-title">Role</h4>
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
						Menu ini digunakan untuk managemen user, selain itu menu ini juga digunakan untuk memberikan akses pada menu yang diinginkan.
					</p>
					<?= form_error('role', '<div class="alert alert-danger" role="alert">
						', '
					</div>'); ?>
					<?= $this->session->flashdata('message_role'); ?>

					<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal" onclick="addRole()">Add New Role</button>

					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Role</th>
								<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($role as $r) : ?>
								<tr>
									<td scope="row"><?= $i; ?></td>
									<td><?= $r['role']; ?></td>
									<td>
										<div class="dropdown float-end">
											<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="mdi mdi-dots-vertical font-18"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-end">
												<!-- item-->
												<button class="dropdown-item" data-id="<?= $r['id']; ?>" onclick="location.href=`<?php echo base_url('admin/roleAccess/') . $r['id']; ?>`"><i class="mdi mdi-equal-box me-1"></i> Akses </button>
												<!-- item-->
												<button class="dropdown-item" data-toggle="modal" data-target="#newRoleModal" data-id="<?= $r['id']; ?>" onclick="editRole(`<?= $r['id']; ?>`)"><i class="mdi mdi-pencil me-1"></i> Edit </button>
												<!-- item-->
												<button class="dropdown-item" data-toggle="modal" data-target="#deleteRoleModal" data-id="<?= $r['id']; ?>" onclick="deleteRole(`<?= $r['id']; ?>`)"><i class="mdi mdi-delete me-1"></i> Hapus </button>
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
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="RoleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="RoleModalLabel">Add New Role</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="POST">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="role" name="role" placeholder="Role name" autofocus>
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
<div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="RoleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="RoleModalLabel">Are you sure? Delete</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<div class="modal-body">Apakah anda yakin ingin menghapus data user ini?</div>
			<form method="POST">
				<input type="hidden" name="id_s" id="id_s">
				<div class="modal-footer">
					<button class="btn btn-warning" type="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-danger">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>