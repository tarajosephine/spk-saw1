<!-- Begin Page Content -->
<div class="container-fluid">

	<h6 class="mb-3 text-gray-600">
		<a href="<?= $access; ?>">Role</a> / <?= $title; ?>
	</h6>
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<!-- Page Heading -->
	<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<?= $this->session->flashdata('message_roleAccess'); ?>
				<h5>Role : <?= $role['role']; ?></h5>
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Menu</th>
							<th scope="col">Access</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($menu as $m) : ?>
							<tr>
								<td scope="row"><?= $i; ?></td>
								<td><?= $m['menu']; ?></td>
								<td>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>" onclick="RoleAccess(`<?= $role['id']; ?>`, `<?= $m['id']; ?>`)">
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
