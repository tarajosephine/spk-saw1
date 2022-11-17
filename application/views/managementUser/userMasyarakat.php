<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Page Heading -->
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">DataTables User Masyarakat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if (validation_errors()) : ?>
                    <?php
                    $this->session->set_flashdata(
                        'message_managementUserMasyarakat',
                        '<div class="alert alert-danger" role="alert">
							The All field is required!
						</div>'
                    );
                    ?>
                <?php endif; ?>
                <?= $this->session->flashdata('message_managementUserMasyarakat'); ?>
                <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#newUserMasyarakatModal" onclick="addUserMasyarakat()">Add New User</button>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">User Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($User_masyarakat as $um) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $um['nik']; ?></td>
                                <td><?= $um['nama_lengkap']; ?></td>
                                <td><?= $um['jekel']; ?></td>
                                <?php if ($um['is_active'] == 1) { ?>
                                    <td>Active</td>
                                <?php } else { ?>
                                    <td>Non Active</td>
                                <?php } ?>
                                <td>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu<?= $um['id']; ?>" aria-expanded="true" aria-controls="collapseTwo">
                                        <i style="color: darkred;" class="fas fa-fw fa-bars"></i>
                                    </a>
                                    <div id="menu<?= $um['id']; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner container rounded">
                                            <a type="button" href="<?= base_url('ManagementUser/detailUserMasyarakat/') . $um['id']; ?>" class="btn btn-sm btn-primary" data-id="<?= $um['id']; ?>"><i class="far fa-fw fa-file-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#newUserMasyarakatModal" data-id="<?= $um['id']; ?>" onclick="editUserMasyarakat(`<?= $um['id']; ?>`)"><i class="fas fa-fw fa-edit"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUserMasyarakatModal" data-id="<?= $um['id']; ?>" onclick="deleteUserMasyarakat(`<?= $um['id']; ?>`)"><i class="fas fa-fw fa-trash-alt"></i></button>
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
<div class="modal fade" id="newUserMasyarakatModal" tabindex="-1" role="dialog" aria-labelledby="UserMasyarakatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserMasyarakatModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-password" id="password" name="password" placeholder="Password">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input form-checkbox" onclick="checkPassword()">
                            <label for="hint">Show Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="jekel" id="jekel" class="form-control">
                            <option value="">Select Jenis Kelamin</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Telphone">
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
<div class="modal fade" id="deleteUserMasyarakatModal" tabindex="-1" role="dialog" aria-labelledby="MenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MenuModalLabel">Delete Data User Masyarakat</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah data ini ingin di hapus?</div>
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