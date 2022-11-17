<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<!-- Page Heading -->
	<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-danger">DataTables User Admin</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<?php if (validation_errors()) : ?>
					<?php
					$this->session->set_flashdata(
						'message_managementUser',
						'<div class="alert alert-danger" role="alert">
							The All field is required!
						</div>'
					);
					?>
				<?php endif; ?>
				<?= $this->session->flashdata('message_managementUser'); ?>
				<button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#newUserAdminModal" onclick="addUserAdmin()">Add New User</button>
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Lengkap</th>
							<th scope="col">Email</th>
							<th scope="col">Role</th>
							<th scope="col">User Active</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($User as $u) : ?>
							<tr>
								<td scope="row"><?= $i; ?></td>
								<td><?= $u['name']; ?></td>
								<td><?= $u['email']; ?></td>
								<td><?= $u['role']; ?></td>
								<?php if ($u['is_active'] == 1) { ?>
									<td><h5 class="text-success">Active</h5></td>
								<?php } else { ?>
									<td><h5 class="text-danger">Non Active</h5></td>
								<?php } ?>
								<td>
									<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu<?= $u['id']; ?>" aria-expanded="true" aria-controls="collapseTwo">
										<i style="color: darkred;" class="fas fa-fw fa-bars"></i>
									</a>
									<div id="menu<?= $u['id']; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
										<div class="bg-white py-2 collapse-inner container rounded">
											<a type="button" href="<?= base_url('ManagementUser/detailUserAdmin/') . $u['id']; ?>" class="btn btn-sm btn-primary" data-id="<?= $u['id']; ?>"><i class="far fa-fw fa-file-alt"></i></a>
											<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#newUserAdminModal" data-id="<?= $u['id']; ?>" onclick="editUserAdmin(`<?= $u['id']; ?>`)"><i class="fas fa-fw fa-edit"></i></button>
											<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMenuModal" data-id="<?= $u['id']; ?>" onclick="deleteUserAdmin(`<?= $u['id']; ?>`)"><i class="fas fa-fw fa-trash-alt"></i></button>
										</div>
									</div>
								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newUserAdminModal" tabindex="-1" role="dialog" aria-labelledby="UserAdminModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="UserAdminModalLabel">Add New User</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
			</div>
			<form method="POST">
				<input type="hidden" name="id" id="id">
				<div class="modal-body">
					<div class="form-floating mb-2">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" />
                        <label for="floatingInput">Nama</label>
                    </div>
					
					<div class="form-floating mb-2">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                        <label for="floatingInput">Username</label>
                    </div>

					<div class="form-floating mb-2">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
						<label for="floatingInput">Email</label>
                    </div>
					
					<div class="form-floating mb-2">
						<input type="password" class="form-control form-password" id="password" name="password" placeholder="Password">
						<label for="floatingInput">Password</label>
					</div>
					<div class="form-check mb-2">
						<input type="checkbox" class="form-check-input form-checkbox" onclick="checkPassword()">
						<label for="hint">Show Password</label>
					</div>
					
					<div class="form-floating mb-2">
						<select class="form-select" name="role_id" id="role_id" aria-label="Floating label select">
						<option value="">Select Role User</option>
							<?php foreach ($User_Role as $ur) : ?>
								<option value="<?= $ur['id']; ?>"><?= $ur['role']; ?></option>
							<?php endforeach; ?>
						</select>
						<label for="floatingJenisUsaha">Pilih role user</label>
					</div>

					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="MenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="MenuModalLabel">Are you sure? Delete</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">Select "Delete" below if you are ready to end your current Menu Management.</div>
			<form method="POST">
				<input type="hidden" name="id_s" id="id_s">
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>